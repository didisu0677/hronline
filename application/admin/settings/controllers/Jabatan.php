<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jabatan extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$data['department']	= get_data('tbl_m_divisi',[
			'where'	=> [
				'is_active'	=> 1,
			]
		])->result_array();
		render($data);
	}

	function data() {
		$data = data_serverside();
		render($data,'json');
	}

	function get_data() {
		$data = get_data('tbl_m_jabatan','id',post('id'))->row_array();
		render($data,'json');
	}

	function save() {
		$data = post();
		$department = get_data('tbl_m_divisi','id',post('id_department'))->row();
		if(isset($department)) $data['kode_department'] = $department->kode;
		$response = save_data('tbl_m_jabatan',$data,post(':validation'));

		render($response,'json');
	}

	function delete() {
		$response = destroy_data('tbl_m_jabatan','id',post('id'));
		render($response,'json');
	}

	function template() {
		ini_set('memory_limit', '-1');
		$arr = ['kode_jabatan' => 'kode_jabatan','nama_jabatan' => 'nama_jabatan','id_department' => 'id_department','kode_department' => 'kode_department','is_active' => 'is_active'];
		$config[] = [
			'title' => 'template_import_jabatan',
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function import() {
		ini_set('memory_limit', '-1');
		$file = post('fileimport');
		$col = ['kode_jabatan','nama_jabatan','id_department','kode_department','is_active'];
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
					$save = insert_data('tbl_m_jabatan',$data);
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
		$arr = ['kode_jabatan' => 'Kode Jabatan','nama_jabatan' => 'Nama Jabatan','id_department' => 'Id Department','kode_department' => 'Kode Department','is_active' => 'Aktif'];
		$data = get_data('tbl_m_jabatan')->result_array();
		$config = [
			'title' => 'data_jabatan',
			'data' => $data,
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

}