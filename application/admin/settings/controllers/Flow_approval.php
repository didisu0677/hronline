<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flow_approval extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		render();
	}

	function data() {
		$config =[];
		$config =[
			'sort_by' => 'level',
		];

		if(get('jenis')) $config['where']['id_jenis'] = get('jenis');
		$data = data_serverside($config);
		render($data,'json');
	}

	function get_data() {
		$data = get_data('tbl_flow_approval','id',post('id'))->row_array();
		render($data,'json');
	}

	function save() {
		$data = post();
		$data['jenis'] = ($data['id_jenis'] == 1) ? lang('disposisi') : lang('Relocation');
		$response = save_data('tbl_flow_approval',$data,post(':validation'));
		render($response,'json');
	}

	function delete() {
		$response = destroy_data('tbl_flow_approval','id',post('id'));
		render($response,'json');
	}

	function template() {
		ini_set('memory_limit', '-1');
		$arr = ['jenis' => 'jenis','nama' => 'nama','level' => 'level','mandatory' => 'mandatory','is_active' => 'is_active'];
		$config[] = [
			'title' => 'template_import_flow_approval',
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function import() {
		ini_set('memory_limit', '-1');
		$file = post('fileimport');
		$col = ['jenis','nama','level','mandatory','is_active'];
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
					$save = insert_data('tbl_flow_approval',$data);
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
		$arr = ['jenis' => 'Jenis','nama' => 'Nama','level' => 'Level','mandatory' => 'Mandatory','is_active' => 'Aktif'];
		$data = get_data('tbl_flow_approval')->result_array();
		$config = [
			'title' => 'data_flow_approval',
			'data' => $data,
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

}