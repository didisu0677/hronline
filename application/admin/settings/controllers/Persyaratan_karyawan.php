<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Persyaratan_karyawan extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		render();
	}

	function data() {
		$data = data_serverside();
		render($data,'json');
	}

	function get_data() {
		$data = get_data('tbl_persyaratan_karyawan','id',post('id'))->row_array();
		render($data,'json');
	}

	function save() {
		$data = post();
		if(post('is_form') == 'Input Form' || post('input_form') == 1) {
			$data['is_form'] = 1;
		}else{
			$data['is_form'] = 0;
		}
		$response = save_data('tbl_persyaratan_karyawan',$data,post(':validation'));
		render($response,'json');
	}

	function delete() {
		$response = destroy_data('tbl_persyaratan_karyawan','id',post('id'));
		render($response,'json');
	}

	function template() {
		ini_set('memory_limit', '-1');
		$arr = ['nama_persyaratan' => 'nama_persyaratan','status_persyaratan' => 'status_persyaratan','keterangan' => 'keterangan','is_active' => 'is_active'];
		$config[] = [
			'title' => 'template_import_persyaratan_karyawan',
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function import() {
		ini_set('memory_limit', '-1');
		$file = post('fileimport');
		$col = ['nama_persyaratan','status_persyaratan','keterangan','is_active'];
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
					$save = insert_data('tbl_persyaratan_karyawan',$data);
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
		$arr = ['nama_persyaratan' => 'Nama Persyaratan','status_persyaratan' => 'Status Persyaratan','keterangan' => 'Keterangan','is_active' => 'Aktif'];
		$data = get_data('tbl_persyaratan_karyawan')->result_array();
		$config = [
			'title' => 'data_persyaratan_karyawan',
			'data' => $data,
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

}