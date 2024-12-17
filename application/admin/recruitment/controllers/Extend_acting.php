<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Extend_acting extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		render();
	}

	function data() {
		$config =[
	        'access_edit'	=> false,
			'access_delete'	=> false,
	    ];

	    if(menu()['access_edit']) {
	        $config['button'][]	= button_serverside('btn-warning','btn-input',['fa-edit',lang('ubah'),true],'edit',['last_approve'=>'0000-00-00 00:00:00']);
		}
		if(menu()['access_delete']) {
	        $config['button'][]	= button_serverside('btn-danger','btn-delete',['fa-trash-alt',lang('hapus'),true],'delete',['last_approve'=>'0000-00-00 00:00:00']);
	    }

		$config['button'][]	= button_serverside('btn-success','btn-print',['fa-print',lang('cetak'),true],'act-print');

		$config['join'] = [
			'tbl_user on tbl_disposisi.job_owner = tbl_user.username type LEFT',
		];
		$config['where']['left(tbl_disposisi.deskripsi,2)'] = '07';
		$data = data_serverside($config);
		render($data,'json');
	}

	function get_data() {
		$data = get_data('tbl_disposisi','id',post('id'))->row_array();
		render($data,'json');
	}

	function get_combo(){

		$arr            = [
			'select'	=> 'a.*,b.nama as nama_cabang,c.nama_jabatan as jabatan,e.group as divisi, e.keterangan as department',
			'join'      => ['tbl_m_cabang b on a.kdcaba = b.kode type LEFT',
							'tbl_m_jabatan c on a.kdjaba = c.kode_jabatan type LEFT',
							'tbl_unit_kerja d on a.kduker = d.kode type LEFT',
							'tbl_m_divisi e on d.noaccount = e.kode type LEFT'
			],
			'where' => [
				'a.tglkeluar'	=> null,               
			],
		];

		$cb_pelamar = get_data('tbl_karyawan a',$arr)->result();
		// debug($cb_pelamar);die;

	    $data['nip']    = '<option value=""></option>';
	    foreach($cb_pelamar as $d) {
			$join = ($d->tglmasuk != '0000-00-00' && $d->tglmasuk != null) ? $d->tglmasuk : '0000-00-00';
	        $data['nip'] .= '<option value="'.$d->nip.'"
			data-nama="'.$d->nama.'"
			data-jabatan="'.$d->jabatan.'"
			data-lokasi ="'.$d->nama_cabang.'"
			data-divisi ="'.$d->divisi.'"
			data-department ="'.$d->department.'"
			data-join_date = "'.$join.'"
            >'.$d->nip . ' - ' .$d->nama.'</option>';
	    }

		// debug($data);die;

	    render($data,'json');
	}

	function save() {
		$data['deskripsi'] = '07-ExtendActing';
		$disposisi = get_data('tbl_karyawan a',[
			'select'	=> 'a.*,b.nama as lokasi,c.nama_jabatan as jabatan,e.group as divisi, e.keterangan as department,
							c.id as id_disposisi_jabatan, nama_jabatan as posisi_disposisi',			
			'join'      => ['tbl_m_cabang b on a.kdcaba = b.kode type LEFT',
				'tbl_m_jabatan c on a.kdjaba = c.kode_jabatan type LEFT',
				'tbl_unit_kerja d on a.kduker = d.kode type LEFT',
				'tbl_m_divisi e on d.noaccount = e.kode type LEFT'
            ],	
			'where' => [
				'a.nip' => post('nip'),
			],
		])->row();
		if($disposisi) {
			$cek = get_data('tbl_disposisi',[
				'where' => [
					'nip' => post('nip'),
					'left(deskripsi,2)' => '07'
				]
			])->row();
			$data = [
				'id_pelamar' => 0,
				'nip' => $disposisi->nip,
				'nama' => $disposisi->nama,
				'tanggal_disposisi' => post('tanggal_disposisi'),
				'deskripsi' => '07-ExtendActing',
				'education' => '',
				'age' => umur($disposisi->tgllahir),
				'id_disposisi_jabatan' => $disposisi->id_disposisi_jabatan,
				'posisi_disposisi' => $disposisi->posisi_disposisi,
				'divisi' => $disposisi->divisi,
				'department' => $disposisi->department,
				'team' => post('team'),
				'lokasi' => $disposisi->lokasi,
				'join_date' => $disposisi->tglmasuk, 
				'end_join'  => post('end_join'),
				'noted'  => post('noted'),
			];

			if(!isset($cek->id)) {
				$data['id'] = 0;
			}else{
				$data['id'] = $cek->id;
				$data['nomor_disposisi'] = $cek->nomor_disposisi;
			}
		}

		$response = save_data('tbl_disposisi',$data,post(':validation'));
		if($response['status']=='success'){
			$dt_disposisi = get_data('tbl_disposisi','id',$response['id'])->row();
			$jabatan = get_data('tbl_m_jabatan','id',$dt_disposisi->id_disposisi_jabatan)->row();

			$rs = get_data('tbl_approval_jabatan a',[
				'select' => 'a.*,b.nama as flow, b.level as level_approval',
				'join'   => 'tbl_flow_approval b on a.flow_approval = b.id type LEFT',
				'where' => [
					'a.kode_jabatan' => $jabatan->kode_jabatan,
				],
				'sort_by' => 'b.level',
				'sort' => 'ASC'
			])->result();

			if($rs) {
				foreach($rs as $d) {
					$c[] = [
						'id_disposisi' => $response['id'],
						'id_approval' => $d->flow_approval,
						'flow_approval' => $d->flow,
						'username' => $d->username,
						'nama' => $d->nama_approval,
						'level_approval' => $d->level_approval
					];
				}

				delete_data('tbl_approval_disposisi','id_disposisi',$response['id']);

				if(count($c)) {
					$save 	= insert_batch('tbl_approval_disposisi',$c);
				}

				update_data('tbl_disposisi',['status_disposisi'=>$c[0]['flow_approval'],'job_owner'=>$c[0]['username']],'id',$response['id']);

				$user		= get_data('tbl_user','username',$c[0]['username'])->row();

				if(isset($user->email)) {
					$link				= base_url().'recruitment/approval_disposisi';
					$desctiption 		= 'Approval Request for the new employee <strong>'.$dt_disposisi->nama.'</strong>' ;
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
							'subject'		=> 'Here is approval Request for the new employee <strong>'.$dt_disposisi->nama.'</strong>',
							'to'			=> $user->email,
							'nama_user'		=> $user->nama,
							'description'	=> $desctiption,
							'detail' => 	$data,
							'url'			=> $link
						]);
					}
				}
			}
		}
		render($response,'json');
	}

	function delete() {
		$response = destroy_data('tbl_disposisi','id',post('id'));
		render($response,'json');
	}

	function template() {
		ini_set('memory_limit', '-1');
		$arr = ['id_pelamar' => 'id_pelamar','nama' => 'nama','nomor_disposisi' => 'nomor_disposisi','tanggal_disposisi' => 'tanggal_disposisi','deskripsi' => 'deskripsi','education' => 'education','age' => 'age','pengalaman' => 'pengalaman','year_service' => 'year_service','id_disposisi_jabatan' => 'id_disposisi_jabatan','posisi_disposisi' => 'posisi_disposisi','divisi' => 'divisi','team' => 'team','lokasi' => 'lokasi','status_disposisi' => 'status_disposisi','job_owner' => 'job_owner','join_date' => 'join_date','end_join' => 'end_join','gaji_pokok' => 'gaji_pokok','tunjangan_transport' => 'tunjangan_transport','tunjangan_makan' => 'tunjangan_makan','housing_allowance' => 'housing_allowance','last_approve' => 'last_approve','is_final_approve' => 'is_final_approve','is_active' => 'is_active'];
		$config[] = [
			'title' => 'template_import_pass_probation',
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function import() {
		ini_set('memory_limit', '-1');
		$file = post('fileimport');
		$col = ['id_pelamar','nama','nomor_disposisi','tanggal_disposisi','deskripsi','education','age','pengalaman','year_service','id_disposisi_jabatan','posisi_disposisi','divisi','team','lokasi','status_disposisi','job_owner','join_date','end_join','gaji_pokok','tunjangan_transport','tunjangan_makan','housing_allowance','last_approve','is_final_approve','is_active'];
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
					$save = insert_data('tbl_disposisi',$data);
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
		$arr = ['id_pelamar' => 'Id Pelamar','nama' => 'Nama','nomor_disposisi' => 'Nomor Disposisi','tanggal_disposisi' => '-dTanggal Disposisi','deskripsi' => 'Deskripsi','education' => 'Education','age' => 'Age','pengalaman' => 'Pengalaman','year_service' => 'Year Service','id_disposisi_jabatan' => 'Id Disposisi Jabatan','posisi_disposisi' => 'Posisi Disposisi','divisi' => 'Divisi','team' => 'Team','lokasi' => 'Lokasi','status_disposisi' => 'Status Disposisi','job_owner' => 'Job Owner','join_date' => '-dJoin Date','end_join' => '-dEnd Join','gaji_pokok' => 'Gaji Pokok','tunjangan_transport' => 'Tunjangan Transport','tunjangan_makan' => 'Tunjangan Makan','housing_allowance' => 'Housing Allowance','last_approve' => '-dLast Approve','is_final_approve' => 'Is Final Approve','is_active' => 'Aktif'];
		$data = get_data('tbl_disposisi')->result_array();
		$config = [
			'title' => 'data_pass_probation',
			'data' => $data,
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function cetak_extacting($encode_id='') {
	    $decode = decode_id($encode_id);
	    if(count($decode) == 2) {
	        $id 	= $decode[0];
	        $data	= get_data('tbl_disposisi a',[
	        	'select'  => 'a.*',
	        	'where' => [
	        		'a.id' => $id
	        	]
	        ])->row_array();

			$data['approval'] = get_data('tbl_approval_disposisi a',[
				'select' => 'a.*, c.kode_jabatan, b.id_disposisi_jabatan,d.tanda_tangan',
				'join' => [
					'tbl_disposisi b on a.id_disposisi = b.id type LEFT',
					'tbl_m_jabatan c on b.id_disposisi_jabatan = c.id type LEFT',
					'tbl_approval_jabatan d on a.username = d.username and c.kode_jabatan = d.kode_jabatan type LEFT',
				],
				'where' => [
					'a.id_disposisi'=>$id
				],
				'sort_by' => 'level_approval'
				])->result_array();
			
				// debug($data['approval']);die;
	        if(isset($data['id'])) {

				render($data,'pdf:landscape');
	        } else {
	            render('404');
	        }
	    } else {
	        render('404');
	    }
	}

}