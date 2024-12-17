<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templat_surat extends BE_Controller {

	var $variable;

	function __construct() {
		parent::__construct();
		$this->variable = [
			'kontrak' => [
				'nomor_spk','nama_pengadaan','nilai_pengadaan','nama_vendor','nomor_kontrak','tanggal_mulai_kontrak','tanggal_selesai_kontak','tanggal_dikeluarkan','tempat_dikeluarkan','nama_pihak1','jabatan_pihak1','alamat_pihak1','nama_pihak2','jabatan_pihak2','alamat_pihak2','isi_kontrak'
			],
			'promosi'		=> [
				'nomor_sk','nama','nama_divisi','jabatan_lama','jabatan_baru','tanggal_sk','nama_hr','jabatan_hr',
				'atasan_langsung','lokasi','nama_head','jabatan_head']
		];
	}

	function index() {
		$data['page']		= get('p') && get('p') != 'kontrak' ? get('p') : 'kontrak';
		$periode			= get('d');
		$list 				= ['kontrak','promosi','rejoin','relokasi','terminate','demosi'];
		$data['variable']	= isset($this->variable[$data['page']]) ? $this->variable[$data['page']] : [];

		if(in_array($data['page'],$list)) {
			$arr 			= [
				'key'		=> $data['page']
			];
			if($periode) {
				$arr['periode']	= $periode;
			}
			$konten 		= get_data('tbl_template_surat',[
				'where'		=> $arr
			])->row();
			if(!isset($konten->id)) {
				$konten 		= get_data('tbl_template_surat',[
					'where'		=> [
						'key'	=> $data['page']
					],
					'sort_by'	=> 'periode',
					'sort'		=> 'DESC'
				])->row();
			}
			$data['konten']		= isset($konten->id) ? $konten->konten : '';
			$data['periode']	= isset($konten->id) ? $konten->periode : date('Y-m-d');
			$data['riwayat']	= get_data('tbl_template_surat',[
				'select'		=> 'id,periode',
				'where'			=> [
					'key'		=> $data['page']
				],
				'sort_by'		=> 'periode',
				'sort'			=> 'DESC'
			])->result();
			render($data);
		} else {
			render('404');
		}
	}

	function save() {
		$data 		= post();
		$check 		= get_data('tbl_template_surat',[
			'where'	=> [
				'periode'	=> $data['periode'],
				'key'		=> $data['key']
			]
		])->row();
		$variabel 	= isset($this->variable[post('key')]) ? json_encode($this->variable[post('key')]) : '';
		if(isset($check->id)) {
			update_data('tbl_template_surat',['konten'=>post('konten','html'),'variabel'=>$variabel],'id',$check->id);
		} else {
			insert_data('tbl_template_surat',['konten'=>post('konten','html'),'variabel'=>$variabel,'key'=>post('key'),'periode'=>$data['periode']]);
		}
		$response 	= array(
			'status'	=> 'success',
			'message'	=> lang('data_berhasil_diperbaharui')
		);
		render($response,'json');
	}

	function delete() {
		$cek_template 	= get_data('tbl_template_surat','id',post('id'))->row();
		$cek_key 		= get_data('tbl_template_surat',[
			'select'	=> 'count(id) AS jml',
			'where'		=> [
				'key'	=> $cek_template->key
			]
		])->row();
		if($cek_key->jml > 1) {
			$response = delete_data('tbl_template_surat','id',post('id'));
			render([
				'status'	=> 'success',
				'message'	=> lang('data_berhasil_dihapus')
			],'json');
		} else {
			render(denied(),'json');
		}
	}

}