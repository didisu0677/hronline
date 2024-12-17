<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Karyawan extends BE_Controller {

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
		$data = get_data('tbl_karyawan','id',post('id'))->row_array();
		render($data,'json');
	}

	function save() {
		$response = save_data('tbl_karyawan',post(),post(':validation'));
		render($response,'json');
	}

	function delete() {
		$response = destroy_data('tbl_karyawan','id',post('id'));
		render($response,'json');
	}

	function template() {
		ini_set('memory_limit', '-1');
		$arr = ['nip' => 'nip','nama' => 'nama','namakecil' => 'namakecil','alamat' => 'alamat','kelurahan' => 'kelurahan','kecamatan' => 'kecamatan','kota' => 'kota','kodepos' => 'kodepos','telpon' => 'telpon','agama' => 'agama','kewarganegaraan' => 'kewarganegaraan','noktp' => 'noktp','npwp' => 'npwp','ttlkontrak' => 'ttlkontrak','tglkontrakakhir' => 'tglkontrakakhir','status' => 'status','jnskelamin' => 'jnskelamin','tgllahir' => 'tgllahir','tempatlahir' => 'tempatlahir','tglmasuk' => 'tglmasuk','kdcaba' => 'kdcaba','kduker' => 'kduker','kdjaba' => 'kdjaba','tglkeluar' => 'tglkeluar','is_active' => 'is_active'];
		$config[] = [
			'title' => 'template_import_karyawan',
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function import() {
		ini_set('memory_limit', '-1');
		$file = post('fileimport');
		$col = ['nip','nama','namakecil','alamat','kelurahan','kecamatan','kota','kodepos','telpon','agama','kewarganegaraan','noktp','npwp','ttlkontrak','tglkontrakakhir','status','jnskelamin','tgllahir','tempatlahir','tglmasuk','kdcaba','kduker','kdjaba','tglkeluar','is_active'];
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
					$save = insert_data('tbl_karyawan',$data);
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
		$arr = ['nip' => 'Nip','nama' => 'Nama','namakecil' => 'Namakecil','alamat' => 'Alamat','kelurahan' => 'Kelurahan','kecamatan' => 'Kecamatan','kota' => 'Kota','kodepos' => 'Kodepos','telpon' => 'Telpon','agama' => 'Agama','kewarganegaraan' => 'Kewarganegaraan','noktp' => 'Noktp','npwp' => 'Npwp','ttlkontrak' => 'Ttlkontrak','tglkontrakakhir' => '-dTglkontrakakhir','status' => 'Status','jnskelamin' => 'Jnskelamin','tgllahir' => '-dTgllahir','tempatlahir' => 'Tempatlahir','tglmasuk' => '-dTglmasuk','kdcaba' => 'Kdcaba','kduker' => 'Kduker','kdjaba' => 'Kdjaba','tglkeluar' => '-dTglkeluar','is_active' => 'Aktif'];
		$data = get_data('tbl_karyawan')->result_array();
		$config = [
			'title' => 'data_karyawan',
			'data' => $data,
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

}