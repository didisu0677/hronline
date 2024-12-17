<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends FE_Controller {

	public function index() {
        $this->load->helper('text');
        $data['loker']  = get_data('tbl_posisi_lamaran',[
            'where' => [
                'is_active' => 1
            ]
            ])->result_array();
		$data['title']		= 'Info Lowongan Kerja';
		render($data);
    }

    
    function detail($id='') {
        $id = decode_id($id);
        $id = isset($id[0]) ? $id[0] : 0;

        $data = get_data('tbl_posisi_lamaran','id = '.$id)->row_array();
        if(isset($data['id'])) {
            $data['title']      = $data['nama'];
            render($data);
        } else render('404');
    }

    function download($encode_id='') {
        $id             = decode_id($encode_id);
        $id             = isset($id[0]) ? $id[0] : 0;
        $data           = get_data('tbl_posisi_lamaran','id = '.$id)->row_array();
        if(isset($data['id'])) {

            render($data,'pdf');
        } else render('404');
    }
}