<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat_keputusan extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		render();
	}

	function data() {
		$config				= [
			'access_edit'	=> false,
			'access_view'	=> false,
			'access_delete'	=> false
		];

		
		$config['join'] = [
			'tbl_surat_keputusan on tbl_disposisi.id = tbl_surat_keputusan.id_disposisi type LEFT',
		];

		$config['where']['is_final_approve'] = 1;

		$config['button'][]	= button_serverside('btn-default','btn-print',['fa-print',lang('cetak'),true],'act-print',['status_disposisi'=>'Create SK']);

		if(menu()['access_edit']) {
			$config['button'][]	= button_serverside('btn-warning','btn-input',['fa-edit',lang('ubah'),true],'edit');
		}
	    if(menu()['access_delete']) {
	        $config['button'][]	= button_serverside('btn-danger','btn-delete',['fa-trash-alt',lang('hapus'),true],'delete',['status_disposisi'=>'Create SK']);
	    }

		

		$data = data_serverside($config);
		render($data,'json');
	}

	function get_data() {
		$data = get_data('tbl_disposisi','id',post('id'))->row_array();
		render($data,'json');
	}

	function save() {
		$data = post();

		$disposisi = get_data('tbl_disposisi','id',post('id'))->row();
		$cek_sk = get_data('tbl_surat_keputusan','id_disposisi',post('id'))->row();
		if($cek_sk) {
			$data['id']  = $cek_sk->id;
		}else{
			$data['id'] = 0 ;
		}

		$data['jenis_sk'] = $disposisi->deskripsi;
		$data['id_disposisi'] = $disposisi->id;
		$data['nomor_disposisi'] = $disposisi->nomor_disposisi;

		$template = get_data('tbl_template_surat','key','promosi')->row();
		$data['tanggal_template'] = $template->periode;
		$response = save_data('tbl_surat_keputusan',$data,post(':validation'));
		if($response['status'] == 'success') {
			$sk = get_data('tbl_surat_keputusan','id',$response['id'])->row();
			update_data('tbl_disposisi',['nomor_sk'=>$sk->nomor_sk,'status_disposisi'=>'Create SK'],['id'=>post('id')]);
		}

		// debug($data);die;
		render($response,'json');
	}

	function delete() {
		
		$disposisi = get_data('tbl_disposisi','id',post('id')) ->row();
		if($disposisi) $response = destroy_data('tbl_surat_keputusan','id_disposisi',$disposisi->id); 
		
		if($response['status']= 'success') {
			update_data('tbl_disposisi',['nomor_sk'=>'','status_disposisi'=>'Approved']);
		}

		render($response,'json');
	}

	function template() {
		ini_set('memory_limit', '-1');
		$arr = ['jenis_sk' => 'jenis_sk','nip' => 'nip','nama' => 'nama','tanggal_berlaku' => 'tanggal_berlaku','tanggal_selesai' => 'tanggal_selesai','jabatan_lama' => 'jabatan_lama','jabatan_baru' => 'jabatan_baru','atasan' => 'atasan','is_active' => 'is_active'];
		$config[] = [
			'title' => 'template_import_surat_keputusan',
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function import() {
		ini_set('memory_limit', '-1');
		$file = post('fileimport');
		$col = ['jenis_sk','nip','nama','tanggal_berlaku','tanggal_selesai','jabatan_lama','jabatan_baru','atasan','is_active'];
		$this->load->library('simpleexcel');
		$this->simpleexcel->define_column($col);
		$jml = $this->simpleexcel->read($file);
		$c = 0;
		foreach($jml as $i => $k) {
			if($i==0) {
				for($j = 2; $j <= $k; $j++) {
					$data = $this->simpleexcel->parsing($i,$j);
					$data['create_at'] = date('Y-m-d H:i:s');
					$data['create_by'] = user('nama');
					$save = insert_data('tbl_surat_keputusan',$data);
					if($save) $c++;
				}
			}
		}
		$response = [
			'status' => 'success',
			'message' => $c.' '.lang('data_berhasil_disimpan').'.'
		];
		@unlink($file);
		render($response,'json');
	}

	function export() {
		ini_set('memory_limit', '-1');
		$arr = ['jenis_sk' => 'Jenis Sk','nip' => 'Nip','nama' => 'Nama','tanggal_berlaku' => 'Tanggal Berlaku',
				'tanggal_selesai' => 'Tanggal Selesai','jabatan_lama' => 'Jabatan Lama','jabatan_baru' => 'Jabatan Baru',
				'nama_hr' => 'Menyetujui HR','jabatan_hr'=>'Jabatan HR','nama_head' => 'Menyetujui Head','jabatan_head' => 'Jabatan Head',
				'is_active' => 'Aktif'];
		$data = get_data('tbl_surat_keputusan')->result_array();
		$config = [
			'title' => 'data_surat_keputusan',
			'data' => $data,
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function cetak($encode_id=''){
		$decode = decode_id($encode_id);
		if(count($decode) == 2) {

			$id 								= $decode[0];
			$record								= get_data('tbl_surat_keputusan a',[
				'select' => 'a.*',
				'join' => 'tbl_disposisi b on a.id_disposisi = b.id type LEFT',
				'where' => [
					'a.id_disposisi' => $id
				],
			])->row_array();
			$tanggal_template					= $record['tanggal_template'];
			$record['tanggal_sk']	= date_indo($record['tanggal_sk']);
			$record['tanggal_berlaku']	= date_indo($record['tanggal_berlaku']);

			$data['html']					= template_pdf($record,'promosi',$tanggal_template);
			render($data,'pdf');
		} else {
			render('404');
		}
	}

}