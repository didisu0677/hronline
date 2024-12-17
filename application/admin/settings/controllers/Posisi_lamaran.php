<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posisi_lamaran extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$data['pic'] = get_data('tbl_user','is_active',1)->result_array();
		$data['lokasi'] = get_data('tbl_m_cabang','is_active',1)->result_array();
		$data['divisi'] = get_data('tbl_m_divisi','is_active',1)->result_array();
		$data['team'] = get_data('tbl_m_team','is_active',1)->result_array();
		render($data);
	}

	function data() {
		$data = data_serverside();
		render($data,'json');
	}

	function get_data() {
		$data = get_data('tbl_posisi_lamaran','id',post('id'))->row_array();
		$data['id_lokasi']= json_decode($data['id_lokasi'],true);
		$data['id_team']= json_decode($data['id_team'],true);
		$data['id_divisi']= json_decode($data['id_divisi'],true);
		$data['id_pic']= json_decode($data['id_pic'],true);
		render($data,'json');
	}

	function save() {

		$data = post();
		if(is_array(post('id_lokasi')) && count(post('id_lokasi')) > 0) {
			$lokasi 			= get_data('tbl_m_cabang','id',post('id_lokasi'))->result_array();
			$data['id_lokasi']= json_encode(post('id_lokasi'));
			$_lokasi					= [];
			foreach($lokasi as $k) {
				$_lokasi[] 			= $k['nama'];
			}
			$data['nama_lokasi']	= implode(', ',$_lokasi);
		}

		if(is_array(post('id_team')) && count(post('team')) > 0) {
			$team 			= get_data('tbl_m_team','id',post('id_team'))->result_array();
			$data['id_team']= json_encode(post('id_team'));
			$_lokasi					= [];
			foreach($team as $t) {
				$_team[] 			= $t['nama'];
			}
			$data['nama_team']	= implode(', ',$_team);
		}

		if(is_array(post('id_divisi')) && count(post('id_divisi')) > 0) {
			$divisi 			= get_data('tbl_m_divisi','id',post('id_divisi'))->result_array();
			$data['id_divisi']= json_encode(post('id_divisi'));
			$_divisi					= [];
			foreach($divisi as $d) {
				$_divisi[] 			= $d['keterangan'];
			}
			$data['nama_divisi']	= implode(', ',$_divisi);
		}

		if(is_array(post('id_pic')) && count(post('id_pic')) > 0) {
			$pic 			= get_data('tbl_user','id',post('id_pic'))->result_array();
			$data['id_pic']= json_encode(post('id_pic'));
			$_divisi					= [];
			foreach($pic as $d) {
				$_pic[] 			= $d['nama'];
			}
			$data['nama_pic']	= implode(', ',$_pic);
		}

		$response = save_data('tbl_posisi_lamaran',$data,post(':validation'));
		render($response,'json');
	}

	function delete() {
		$response = destroy_data('tbl_posisi_lamaran','id',post('id'));
		render($response,'json');
	}

	function template() {
		ini_set('memory_limit', '-1');
		$arr = ['nama' => 'nama','is_active' => 'is_active'];
		$config[] = [
			'title' => 'template_import_posisi_lamaran',
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function import() {
		ini_set('memory_limit', '-1');
		$file = post('fileimport');
		$col = ['nama','is_active'];
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
					$save = insert_data('tbl_posisi_lamaran',$data);
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
		$arr = ['nama' => 'Nama','is_active' => 'Aktif'];
		$data = get_data('tbl_posisi_lamaran')->result_array();
		$config = [
			'title' => 'data_posisi_lamaran',
			'data' => $data,
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

}