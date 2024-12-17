<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class New_employee extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$data['jabatan'] = get_data('tbl_m_jabatan','is_active',1)->result_array();
		render($data);
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
		$config['button'][]	= button_serverside('btn-default','btn-create-nip',['fa-book-user',lang('create_nip'),true],'act-change-password',['is_final_approve'=>1]);
		
		$config['join'] = [
			'tbl_user on tbl_disposisi.job_owner = tbl_user.username type LEFT',
		];

		$config['where']['left(tbl_disposisi.deskripsi,2)'] = '01';

		$data = data_serverside($config);
		render($data,'json');
	}

	function get_data() {
		$data = get_data('tbl_disposisi a',[
			'select' => 'a.*,b.id as id_pelamar',
			'join'  => 'tbl_m_pelamar b on a.id_pelamar = b.id type LEFT',
			'where' => [
				'a.id' => post('id')
			],
			])->row_array();

		render($data,'json');
	}

	function get_combo(){

		$arr            = [
			'select'	=> 'a.*,b.nama as education,c.nama as nama_cabang,e.group as bisunit,
							f.gaji_pokok, f.tunjangan_transport, f.tunjangan_makan',
			'join'      => ['tbl_m_pendidikan b on a.pendidikan_terakhir = b.id type LEFT',
							'tbl_m_cabang c on a.id_lokasi = c.id type LEFT',
							'tbl_m_jabatan d on a.id_jabatan = d.id type LEFT',
							'tbl_m_divisi e on d.kode_department = e.kode type LEFT',
							'tbl_remunerasi_pelamar f on a.id = f.id_pelamar type LEFT'
			],
			'where' => [
				'a.nomor_disposisi'	=> '',
				'a.lulus_verifikasi'  => 1                     
			],
		];

		$cb_pelamar = get_data('tbl_m_pelamar a',$arr)->result();


	    $data['id_pelamar']    = '<option value=""></option>';
	    foreach($cb_pelamar as $d) {
			$lahir = str_replace('/','-',c_date($d->tanggal_lahir));
			if($d->tanggal_lahir != '0000-00-00') $usia = umur($lahir);
	        $data['id_pelamar'] .= '<option value="'.$d->id.'"
			data-nama="'.$d->nama.'"
			data-pendidikan_terakhir="'.$d->education.'"
			data-posisi_kerja_terakhir="'.$d->posisi_kerja_terakhir.'"
			data-lama_pengalaman_kerja="'.$d->lama_pengalaman_kerja.'"
			data-lokasi ="'.$d->nama_cabang.'"
			data-jabatan ="'.$d->id_jabatan.'"
			data-divisi ="'.$d->bisunit.'"
			data-gaji_pokok ="'.custom_format($d->gaji_pokok,0).'"
			data-tunjangan_transport ="'.custom_format($d->tunjangan_transport,0).'"
			data-tunjangan_makan ="'.custom_format($d->tunjangan_makan,0).'"
            data-jenis_kelamin="'.$d->jenis_kelamin.'"
			data-posisi_lamaran="'.$d->posisi_lamaran.'"
			data-usia="'.$usia.'" 
            >'.$d->id . ' - ' .$d->nama.'</option>';
	    }

	    render($data,'json');
	}

	function get_team($kode=''){
		$arr            = [
			'select'	=> 'a.*',
			'where' => [
				'a.is_active'  => 1,
				'a.divisi' => $kode                     
			],
		];

		$cb_team = get_data('tbl_m_team a',$arr)->result();

		// debug($cb_team);die;
	    $data['team']    = '<option value=""></option>';
	    foreach($cb_team as $d) {
	        $data['team'] .= '<option value="'.$d->id.'"
			data-nama="'.$d->nama.'"
            >'.$d->nama.'</option>';
	    }

	    render($data,'json');
	}

	function save() {
		$data = post();

		// debug($data);die;
		$data['deskripsi'] = '01-New_employee';

		$pelamar = get_data('tbl_m_pelamar','id',$data['id_pelamar'])->row();
		if($pelamar) $data['nama'] = $pelamar->nama;
	
		$response = save_data('tbl_disposisi',$data,post(':validation'));

		// die;

		if($response['status']=='success') {
			$disposisi = get_data('tbl_disposisi','id',$response['id'])->row();
			update_data('tbl_m_pelamar',['nomor_disposisi'=>$disposisi->nomor_disposisi],'id', $data['id_pelamar']) ;

			
			$jabatan = get_data('tbl_m_jabatan','id',$disposisi->id_disposisi_jabatan)->row();

			$rs = get_data('tbl_approval_jabatan a',[
				'select' => 'a.*,b.nama as flow, b.level as level_approval',
				'join'   => 'tbl_flow_approval b on a.flow_approval = b.id type LEFT',
				'where' => [
					'a.kode_jabatan' => $jabatan->kode_jabatan,
				],
				'sort_by' => 'b.level',
				'sort' => 'ASC'
			])->result();


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
						'subject'		=> 'Here is approval Request for the new employee <strong>'.$disposisi->nama.'</strong>',
						'to'			=> $user->email,
						'nama_user'		=> $user->nama,
						'description'	=> $desctiption,
						'detail' => 	$data,
						'url'			=> $link
					]);
				}
			}
		}
		
		render($response,'json');
	}

	function save_nip() {

		// debug($data);die;
		$data['nip'] = post('nip');
		$data['id'] = post('id_nip');
		$data['join_date'] = post('tanggal_masuk');

		$response = save_data('tbl_disposisi',$data,post(':validation'));
		render($response,'json');
	}

	function detail($id='') {

		$data				= get_data('tbl_disposisi a',[
			'select' => 'a.*',
			'where'  => [			
				'a.id' => $id,
			],
		])->row_array();


		render($data,'layout:false');
	}

	function delete() {
		$response = destroy_data('tbl_disposisi','id',post('id'));
		render($response,'json');
	}

	function template() {
		ini_set('memory_limit', '-1');
		$arr = ['id_pelamar' => 'id_pelamar','tanggal_disposisi' => 'tanggal_disposisi','status_disposisi' => 'status_disposisi','is_active' => 'is_active'];
		$config[] = [
			'title' => 'template_import_disposisi',
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function import() {
		ini_set('memory_limit', '-1');
		$file = post('fileimport');
		$col = ['id_pelamar','tanggal_disposisi','status_disposisi','is_active'];
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
		$arr = ['id_pelamar' => 'Id Pelamar','tanggal_disposisi' => '-dTanggal Disposisi','status_disposisi' => 'Status Disposisi','is_active' => 'Aktif'];
		$data = get_data('tbl_disposisi')->result_array();
		$config = [
			'title' => 'data_disposisi',
			'data' => $data,
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function get_approval($type ='echo',$id_jabatan='') {
		
		if(post('id_jabatan') !=""){	
			$id_jabatan = post('id_jabatan');
	    }else{
	    	$id_jabatan = $id_jabatan;
	    }

		$kode_jabatan = '';

		$jabatan = get_data('tbl_m_jabatan','id',$id_jabatan)->row();
		if($jabatan) $kode_jabatan = $jabatan->kode_jabatan;
		$rs = get_data('tbl_approval_jabatan a',[
			'select' => 'a.*,b.nama as flow',
			'join'   => 'tbl_flow_approval b on a.flow_approval = b.id type LEFT',
			'where' => [
				'a.kode_jabatan' => $kode_jabatan,
			],
			'sort_by' => 'b.level',
			'sort' => 'ASC'
		])->result();
		

		$data  =   '<label class="col-sm-2 col-form-label">FLow Approval</label>';
		$data  .= '<div class="form-group row mb-2 ">';
	    foreach($rs as $e) {
			$nama_apprpoval = $e->nama_approval ;

	        $data 	.= '<label class="col-sm-12 offset-sm-3 col-form-label sub-1">'.$e->nama_approval . ' - ' . $e->flow .' </label>'; 

	    }
		$data   .= '</div>';
		

		// debug($data);die;
	   	if($type == 'echo') echo $data;
	    else return $data;
	}

	function cetak_newdisposisi($encode_id='') {
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