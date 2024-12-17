<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		if(user('id_pelamar')) {
			$data['title']	= lang('dokumen');
			$data['pelamar']	= get_data('tbl_m_pelamar','id',user('id_pelamar'))->row_array();



			// debug($data['pelamar']);die;
			$data['dok']	= get_data('tbl_m_dokumen_pelamar','is_active',1)->result();
			$uplfile 		= get_data('tbl_upl_dokumen_pelamar','id_pelamar',user('id_pelamar'))->result();
			$data['file']	= [];
			$data['tanggal_kadaluarsa']	= [];
			foreach($uplfile as $u) {
				$data['file'][$u->id_dokumen] = $u->file;
				$data['tanggal_kadaluarsa'][$u->id_dokumen] = c_date($u->tanggal_kadaluarsa);
			}
			render($data);
		} else render('404');
	}

	function save() {
		if(user('id_pelamar')) {

			$data['id']				= user('id_pelamar');
			$data['photo'] = post('photo');
			// debug(post());die;
			$response 	= save_data('tbl_m_pelamar',$data,post(':validation'));
			if($response['status'] == 'success') {
	
				$id_dok 			= post('id');
				$file 				= post('file');
				$old_file 			= post('old_file');
				$pelamar 			= get_data('tbl_m_pelamar','id',user('id_pelamar'))->row();

				$d 					= [];
				$dir 				= '';
				foreach($id_dok as $k => $v) {
					if(!is_dir(FCPATH . "assets/uploads/pelamar/".user('id_pelamar').'/')){
						$oldmask = umask(0);
						mkdir(FCPATH . "assets/uploads/pelamar/".user('id_pelamar').'/',0777);
						umask($oldmask);
					}
					$dok 			= get_data('tbl_m_dokumen_pelamar','id',$id_dok[$k])->row();
					$d[$k] 			= [
						'id_pelamar'		=> $pelamar->id,
						'kode_pelamar'		=> $pelamar->kode_pelamar,
						'id_dokumen'		=> $dok->id,
						'kode_dokumen'		=> $dok->kode_dokumen,
						'nama_dokumen'		=> $dok->nama_dokumen,
						'file'				=> $old_file[$k]
					];

					if($file[$k] && $file[$k] != $old_file[$k]) {
						if(@copy($file[$k], FCPATH . 'assets/uploads/pelamar/'.user('id_pelamar').'/'.basename($file[$k]))) {
							$d[$k]['file']	= basename($file[$k]);
							if(!$dir) $dir = str_replace(basename($file[$k]),'',$file[$k]);
							if($old_file[$k]) {
								@unlink(FCPATH . 'assets/uploads/pelamar/'.user('id_pelamar').'/'.$old_file[$k]);
							}
						}
					}
				}
				delete_data('tbl_upl_dokumen_pelamar','id_pelamar',user('id_pelamar'));
				if(count($d)) {
					$save 	= insert_batch('tbl_upl_dokumen_pelamar',$d);
				}
				if($dir) {
					delete_dir(FCPATH . $dir);
				}
				// if($vendor->verifikasi_dokumen == 9 && post('ajukan')) {
				// 	update_data('tbl_vendor',['verifikasi_dokumen'=>0],'id',$vendor->id);
				// 	$user_persetujuan = get_data('tbl_user',[
				// 		'where'     => [
				// 			'is_active' => 1,
				// 			'id_group'  => id_group_access('checklist_rekanan','additional')
				// 		]
				// 	])->result();
				// 	$email_notifikasi = [];
				// 	foreach($user_persetujuan as $u) {
				// 		$link               = base_url().'manajemen_rekanan/checklist_rekanan?i='.encode_id([$vendor->id,rand()]);
				// 		$desctiption        = $vendor->nama.' mengajukan ceklist dan verifikasi ulang dokumen persyaratan';
				// 		$data_notifikasi    = [
				// 			'title'         => 'Ceklist dan Verifikasi',
				// 			'description'   => $desctiption,
				// 			'notif_link'    => $link,
				// 			'notif_date'    => date('Y-m-d H:i:s'),
				// 			'notif_type'    => 'info',
				// 			'notif_icon'    => 'fa-check',
				// 			'id_user'       => $u->id,
				// 			'transaksi'     => 'checklist_rekanan',
				// 			'id_transaksi'  => $vendor->id
				// 		];
				// 		insert_data('tbl_notifikasi',$data_notifikasi);
				// 		$email_notifikasi[] = $u->email;
				// 	}
				// 	if(setting('email_notification') && count($email_notifikasi) ) {
				// 		send_mail([
				// 			'subject'		=> 'Verifikasi dan Checklist',
				// 			'to'			=> $email_notifikasi,
				// 			'description'	=> $desctiption,
				// 			'url'			=> $link
				// 		]);
				// 	}
				// }
			}

			render($response,'json');
		} else render('404');
	}
}
