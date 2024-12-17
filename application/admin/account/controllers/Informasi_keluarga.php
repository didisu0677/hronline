<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informasi_keluarga extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		if(user('id_pelamar')) {
			include_lang('recruitment');
			$data['title']	= lang('dokumen');
		
			render($data);
		} else render('404');
	}
}