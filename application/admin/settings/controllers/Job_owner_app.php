<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_owner_app extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$data['group_persetujuan'] = get_data('tbl_group_persetujuan','is_active',1)->result_array();
		$data['user'] = get_data('tbl_user','is_active',1)->result_array();
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
		$data = get_data('tbl_job_owner_persetujuan','id',post('id'))->row_array();
		$data['id_lokasi']= json_decode($data['id_lokasi'],true);
		$data['id_team']= json_decode($data['id_team'],true);
		$data['id_divisi']= json_decode($data['id_divisi'],true);
		render($data,'json');
	}

	function save() {
		$data = post();

		$nama = get_data('tbl_user','id',$data['userid'])->row();
		if(isset($nama)) $data['nama'] = $nama->nama;
		if(is_array(post('id_lokasi')) && count(post('id_lokasi')) > 0) {
			$lokasi 			= get_data('tbl_m_cabang','id',post('id_lokasi'))->result_array();
			$data['id_lokasi']= json_encode(post('id_lokasi'));
			$_lokasi					= [];
			foreach($lokasi as $k) {
				$_lokasi[] 			= $k['nama'];
			}
			$data['nama_lokasi']	= implode(', ',$_lokasi);
		}

		if(is_array(post('id_team')) && count(post('id_team')) > 0) {
			$team 			= get_data('tbl_m_team','id',post('id_team'))->result_array();
			$data['id_team']= json_encode(post('id_team'));
			$_team					= [];
			foreach($team as $t) {
				$_team[] 			= $t['nama'];
			}
			$data['nama_team']	= implode(', ',$_team);
		}

		if(is_array(post('id_team')) && count(post('id_team')) > 0) {
			$team 			= get_data('tbl_m_team','id',post('id_team'))->result_array();
			$data['id_team']= json_encode(post('id_team'));
			$_team					= [];
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

		$response = save_data('tbl_job_owner_persetujuan',$data,post(':validation'));
		render($response,'json');
	}

	function delete() {
		$response = destroy_data('tbl_job_owner_persetujuan','id',post('id'));
		render($response,'json');
	}

	function template() {
		ini_set('memory_limit', '-1');
		$arr = ['userid' => 'userid','id_group_persetujuan' => 'id_group_persetujuan','id_lokasi' => 'id_lokasi','id_team' => 'id_team','id_divisi' => 'id_divisi','is_active' => 'is_active'];
		$config[] = [
			'title' => 'template_import_job_owner_app',
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function import() {
		ini_set('memory_limit', '-1');
		$file = post('fileimport');
		$col = ['userid','id_group_persetujuan','id_lokasi','id_team','id_divisi','is_active'];
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
					$save = insert_data('tbl_job_owner_persetujuan',$data);
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
		$arr = ['userid' => 'Userid','id_group_persetujuan' => 'Id Group Persetujuan','id_lokasi' => 'Id Lokasi','id_team' => 'Id Team','id_divisi' => 'Id Divisi','is_active' => 'Aktif'];
		$data = get_data('tbl_job_owner_persetujuan')->result_array();
		$config = [
			'title' => 'data_job_owner_app',
			'data' => $data,
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

}