<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form_vaksin extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		if(user('id_pelamar')) {
			$data['title']	= lang('form_medref');
			$data	= get_data('tbl_m_pelamar','id',user('id_pelamar'))->row_array();

			$data['form_medref'] = get_data('tbl_form_medref','is_active',1)->result_array();

			render($data);
		} else render('404');
	}


}
