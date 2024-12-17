<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Divisi extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$data['flow']	= get_data('tbl_flow_approval a',[
			'where' => [
			'a.is_active'=>1,
		],
		'sort_by' => 'a.level',	
		])->result();

		render($data);
	}

	function data() {
		$config				= [
		];
		$config['access_view']			= true;
	
		if(menu()['access_additional']) {
			$config['button'][]	= button_serverside('btn-success','btn-verifikasi',['fa-file-signature',lang('verifikasi'),true],'verifikasi');
		}

		$data = data_serverside($config);
		render($data,'json');
	}

	function get_data() {
		$data = get_data('tbl_m_divisi','id',post('id'))->row_array();
		render($data,'json');
	}

	function save() {
		$response = save_data('tbl_m_divisi',post(),post(':validation'));
		render($response,'json');
	}

	function save_flow() {
		debug(post());die;
		// $response = save_data('tbl_m_divisi',post(),post(':validation'));
		// render($response,'json');

		render([
            'status'	=> 'success',
            'message'	=> lang('data_berhasil_disimpan')
        ],'json');
	}

	function delete() {
		$response = destroy_data('tbl_m_divisi','id',post('id'));
		render($response,'json');
	}

	function template() {
		ini_set('memory_limit', '-1');
		$arr = ['kode' => 'kode','keterangan' => 'keterangan','singkatan' => 'singkatan','group' => 'group','is_active' => 'is_active'];
		$config[] = [
			'title' => 'template_import_divisi',
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function import() {
		ini_set('memory_limit', '-1');
		$file = post('fileimport');
		$col = ['kode','keterangan','singkatan','group','is_active'];
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
					$save = insert_data('tbl_m_divisi',$data);
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
		$arr = ['kode' => 'Kode','keterangan' => 'Keterangan','singkatan' => 'Singkatan','group' => 'Group','is_active' => 'Aktif'];
		$data = get_data('tbl_m_divisi')->result_array();
		$config = [
			'title' => 'data_divisi',
			'data' => $data,
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function flow_approval($id='') {
		$data	= get_data('tbl_flow_approval a',[
			'where' => [
			'a.id'=>$id,
		],
		'sort_by' => 'a.id',	
		])->row_array();

		$data['flow']	= get_data('tbl_flow_approval a',[
			'select' => 'a.*',
			'where' => [
			'a.is_active'=>0,
		],
		'sort_by' => 'a.level',	
		])->result();

		$data['opt_pic']		= get_data('tbl_user','is_active',1)->result_array();

		render($data,'layout:false');

	}

	function verifikasi() {
		$id = post('id');
		$data	= get_data('tbl_m_divisi','id',$id)->row_array();

		
		$data['divisi'] = $data['keterangan'];


		$data['flow']		= get_data('tbl_flow_approval')->result();
		$data['opt_pic']		= get_data('tbl_user','is_active',1)->result_array();
		// debug($data);die;

		// debug($data);die;
		render($data,'json');
	}

}