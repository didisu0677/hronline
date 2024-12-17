<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$pelamar 						= [];
		
		if(user('id_pelamar')) $pelamar 	= get_data('tbl_m_pelamar','id',user('id_pelamar'))->row_array();
		if(isset($pelamar['id'])) {
			include_lang('auth');
			$data 						= $pelamar;

			if($data['tanggal_lahir'] != '0000-00-00') $data['tanggal_lahir'] =c_date($data['tanggal_lahir']);
			$data['title']				= lang('profil');

			$data['opt_posisi'] = get_data('tbl_posisi_lamaran',[
				'where' => [
					'is_active'=>1,
					'id' => $data['id_posisi_lamaran']
				],
				])->result_array();

			$data['pendidikan'] = get_data('tbl_m_pendidikan','is_active',1)->result_array();

			render($data,'view:account/profile/pelamar');
		} else {
			$data['title']				= lang('profil');
			render($data);			
		}
	}

	function save() {
		$response = save_data('tbl_user', post(), post(':validation'));
		render($response,'json');
	}
	
	function save_pelamar() {
		$data					= post();
		$data['id']				= user('id_pelamar');

		// $data['tanggal_lahir'] = c_date($data['tanggal_lahir']);

		$response 	= save_data('tbl_m_pelamar',$data,post(':validation'));
		// if($response['status'] == 'success') {
	
		// }
		render($response,'json');
	}
}