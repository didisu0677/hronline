<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Approval_disposisi extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		render();
	}

	function data() {

		
		$config =[
			'access_input'	=> false,
			'access_edit'	=> false,
	        'access_delete'	=> false,
	        'access_view'   => false,
 	    ];

 	    
		if(in_array(user('id_group'),id_group_access('approval_disposisi','input'))){
 	    	$config['where'] 	= [
				'job_owner' 	=> user('username')
			];
 	    }

		if(menu()['access_edit']) {
			$config['button'][]	= button_serverside('btn-success','btn-input',['fa-check-square',lang('verifikasi'),true],'verifikasi');
		}
		
		$config['where']['is_final_approve !='] = 1;
		$data = data_serverside($config);
		render($data,'json');
	}

	function get_data() {
		$data = get_data('tbl_disposisi','id',post('id'))->row_array();
		$data['posisi']    = '';

		$arr            = [
			'select'	=> 'a.*',
			'where' => [
				'a.id_disposisi'	=> $data['id'],                 
			],
		];

	
		
		if(in_array(user('id_group'),id_group_access('approval_disposisi','input'))){
			$arr['where']['a.username'] = $data['job_owner'];
		}


		$combo= get_data('tbl_approval_disposisi a',$arr)->result();

	    foreach($combo as $d) {
	        $data['posisi'] .= '<option value="'.trim($d->username).'">'.$d->username. ' - '. $d->nama.'</option>';
	    }
		render($data,'json');
	}

	function save() {

		$last_update 	= date('Y-m-d H:i:s');

		$save = update_data('tbl_approval_disposisi',
			['tanggal_approval'=>$last_update,
			'status_approval' => post('persetujuan'),
			'keterangan_approval'=>post('noted')]
			,['id_disposisi'=>post('id'),'username'=>post('job_owner')]);

		if($save){

			$disposisi = get_data('tbl_disposisi','id',post('id')) ->row();
			$data = get_data('tbl_disposisi','id',post('id'))->row_array();

			$next_approval = get_data('tbl_approval_disposisi',[
				'where' => [
					'id_disposisi'=>post('id'),
					'username !=' => post('job_owner'),
					'status_approval' => 0,
				],
				'sort_by' => 'level_approval',
				'sort' => 'ASC'
				])->row();

			if(isset($next_approval)) {
				update_data('tbl_disposisi',['job_owner'=>$next_approval->username,'status_disposisi'=>$next_approval->flow_approval,'last_approve'=>$last_update],'id',post('id'));
				
				$user		= get_data('tbl_user','username',$disposisi->job_owner)->row();
				if(isset($user->email)) {
					$link				= base_url().'recruitment/approval_disposisi';
					$desctiption 		= 'Approval Request for the new employee <strong>'.$disposisi->nama.'</strong>' ;

					$data_notifikasi 	= [
						'title'			=> 'Approval Disposition',
						'description'	=> $desctiption,
						'notif_link'	=> $link,
						'notif_date'	=> date('Y-m-d H:i:s'),
						'notif_type'	=> 'info',
						'notif_icon'	=> 'fa-exchange-alt',
						'id_user'		=> $user->id,
						'transaksi'		=> 'Aprroval_Disposisi',
						'id_transaksi'	=> post('id')
					];
					insert_data('tbl_notifikasi',$data_notifikasi);	

	
					if(setting('email_notification')) {
						send_mail([
							'subject'		=> 'Approval Request for the new employee <strong>'.$disposisi->nama.'</strong>',
							'to'			=> $user->email,
							'nama_user'		=> $user->nama,
							'description'	=> 'Here is ' . $desctiption,
							'description2'	=> 'For the approval by sistem please click link below :',
							'detail' => 	'',
							'url'			=> $link
						]);
					}
				}
			}else{

				$user_id		= get_data('tbl_user','id_group',3)->result();
				update_data('tbl_disposisi',['is_final_approve'=>post('persetujuan'),'status_disposisi' => 'Approved'],'id',post('id'));
			
				$link				= base_url().'recruitment/approval_disposisi';
				$desctiption 		= 'Approval Request for the new employee <strong>'.$disposisi->nama. '</strong>' ;
				if($user_id) {
					foreach($user_id as $i) {
						$data_notifikasi 	= [
							'title'			=> 'Approval Disposition',
							'description'	=> $desctiption,
							'notif_link'	=> $link,
							'notif_date'	=> date('Y-m-d H:i:s'),
							'notif_type'	=> 'info',
							'notif_icon'	=> 'fa-exchange-alt',
							'id_user'		=> $i,
							'transaksi'		=> 'Aprroval_Disposisi',
							'id_transaksi'	=> post('id')
						];
						insert_data('tbl_notifikasi',$data_notifikasi);	
					}

					if(setting('email_notification')) {
						send_mail([
							'subject'		=> 'Approval Request for the new employee <strong>'.$disposisi->nama.' was approve'.'</strong>',
							'to'			=> $user->email,
							'nama_user'		=> '',
							'description'	=> $desctiption,
							'description2'	=> 'For checking disposition status please click link below :',
							'detail' => 	'',
							'url'			=> $link
						]);
					}
				}
			}
		}

			
		$response = [
			'status' => 'success',
			'message' => lang('data_berhasil_disimpan')
		];
		

		render($response,'json');
	}

	function delete() {
		$response = destroy_data('tbl_approval_disposisi','id',post('id'));
		render($response,'json');
	}

	function template() {
		ini_set('memory_limit', '-1');
		$arr = ['id_pelamar' => 'id_pelamar','id_disposisi' => 'id_disposisi','id_approval' => 'id_approval','nama_approval' => 'nama_approval','tanggal_approval' => 'tanggal_approval','status_approval' => 'status_approval','keterangan_approval' => 'keterangan_approval','is_active' => 'is_active'];
		$config[] = [
			'title' => 'template_import_approval_disposisi',
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function import() {
		ini_set('memory_limit', '-1');
		$file = post('fileimport');
		$col = ['id_pelamar','id_disposisi','id_approval','nama_approval','tanggal_approval','status_approval','keterangan_approval','is_active'];
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
					$save = insert_data('tbl_approval_disposisi',$data);
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
		$arr = ['id_pelamar' => 'Id Pelamar','id_disposisi' => 'Id Disposisi','id_approval' => 'Id Approval','nama_approval' => 'Nama Approval','tanggal_approval' => '-dTanggal Approval','status_approval' => 'Status Approval','keterangan_approval' => 'Keterangan Approval','is_active' => 'Aktif'];
		$data = get_data('tbl_approval_disposisi')->result_array();
		$config = [
			'title' => 'data_approval_disposisi',
			'data' => $data,
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

}