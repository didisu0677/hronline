<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_lamaran extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$data['syarat']	= get_data('tbl_persyaratan_karyawan a',[
			'where' => [
			'a.is_active'=>1,
		],
		'sort_by' => 'a.id',	
		])->result();

		$data['opt_posisi'] = get_data('tbl_posisi_lamaran',[
			'where' => [
				'is_active'=>1
			]
			
		])->result_array();

		
		$data['dok']	= get_data('tbl_m_dokumen_pelamar','is_active',1)->result();

		render($data);
	}

	function data($lulus="") {
		$config				= [];		 	
		if(menu()['access_additional']) {
			$config['button'][]	= button_serverside('btn-success','btn-verifikasi',['fa-check-square',lang('verifikasi'),true],'verifikasi',['status_test'=>1]);
		}

		$config['button'][]		= button_serverside('btn-primary',base_url('recruitment/form_lamaran/test/'),['fa-adjust',lang('test'),true],'btn-detail',['lulus_verifikasi'=>0]);

		$config['join'] = [
			'tbl_posisi_lamaran on tbl_posisi_lamaran.id = tbl_m_pelamar.id_posisi_lamaran type LEFT',
		];

		// debug($pos3);die;
		$job_owner = '"'.user('id').'"';
		if(user('id_group') > 1) {
			$config['where']['tbl_m_pelamar.job_owner like'] = "%".user('id')."%";
		}


		$config['where']['lulus_verifikasi'] 	= $lulus;
	

		$data = data_serverside($config);
		render($data,'json');
	}

	function get_data() {
		$data = get_data('tbl_m_pelamar a',[
				'select' => 'a.*,b.id as wawancara',
				'join' => 'tbl_form_wawancara b on a.id = b.id_pelamar type LEFT',
				'where' => [
					'a.id' => post('id'),
				],
			])->row_array();
		// $data['file'] 			= json_decode($data['lampiran'],true);
		$data['dir_upload'] = base_url(dir_upload('pelamar'));

		$data['dok']	= get_data('tbl_m_dokumen_pelamar','is_active',1)->result();
		$uplfile 		= get_data('tbl_upl_dokumen_pelamar','id_pelamar',post('id'))->result();
		$data['file']	= [];
		foreach($uplfile as $u) {
			$data['file'][$u->id_dokumen] = $u->file;
		}

		render($data,'json');
	}

	function get_test($type ='echo',$id='') {
		if(post('id') !=""){	
			$id_pelamar = post('id');
	    }else{
	    	$id_pelamar = $id;
	    }

	    $test 			= get_data('tbl_persyaratan_karyawan a',[
	        'select'	=> 'a.*,b.file_dokumen,b.keterangan',
			'join' => 'tbl_test_newemp b on a.id = b.id_test LEFT',
	        'where' 	=> [
	            'b.id_pelamar' => $id_pelamar,
			],
			'sort_by' => 'a.id',
			'sort' => 'ASC'
	    ])->result();
	    // $data 			= '<option value=""></option>';
	    // foreach($dokter as $e) {
	    //     $data 		.= '<option value="'.$e->id.'" data-id_dr ="'.$e->id.'" data-spesialis="'.$e->spesialis.'" data-kelas_dr="'.$e->kelas.'">'.$e->kode_dokter.' | '.$e->nama_dokter. ' ['.$e->kota.']'.'</option>';
	    // }
	    
	    if($type == 'echo') echo $data;
	    else return $data;
	}

	function save() {
		$data = post();

		$pos_jabatan = get_data('tbl_posisi_lamaran','id',$data['id_posisi_lamaran'])->row();
		if(isset($pos_jabatan)) $data['posisi_lamaran'] = $pos_jabatan->nama;
	
		$response = save_data('tbl_m_pelamar',$data,post(':validation'));
		if($response['status'] == 'success') {

			// debug($response);die;
	
			$id_dok 			= post('id_dok');
			$file 				= post('file');
			$old_file 			= post('old_file');
			$pelamar 			= get_data('tbl_m_pelamar','id',$response['id'])->row();

			$d 					= [];
			$dir 				= '';
			foreach($id_dok as $k => $v) {
				if(!is_dir(FCPATH . "assets/uploads/pelamar/".$pelamar->id.'/')){
					$oldmask = umask(0);
					mkdir(FCPATH . "assets/uploads/pelamar/".$pelamar->id.'/',0777);
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
					if(@copy($file[$k], FCPATH . 'assets/uploads/pelamar/'.$pelamar->id.'/'.basename($file[$k]))) {
						$d[$k]['file']	= basename($file[$k]);
						if(!$dir) $dir = str_replace(basename($file[$k]),'',$file[$k]);
						if($old_file[$k]) {
							@unlink(FCPATH . 'assets/uploads/pelamar/'.$pelamar->id.'/'.$old_file[$k]);
						}
					}
				}
			}
			delete_data('tbl_upl_dokumen_pelamar','id_pelamar',$pelamar->id);
			if(count($d)) {
				$save 	= insert_batch('tbl_upl_dokumen_pelamar',$d);
			}
			if($dir) {
				delete_dir(FCPATH . $dir);
			}
		}
		
		render($response,'json');
	}

	function save_test() {

		$id_test = post('id_syarat');
		$file_syarat = post('file_syarat');
		$old_file_syarat = post('old_file_syarat');
		$keterangan = post('keterangan');

		$last_update 	= date('Y-m-d H:i:s');
		$update_by = user('nama');
		
		// debug($id_test);die;

		// $id_asset = get_data('tbl_asset','id',$response['id'])->row();

		$d 					= [];
		$dir 				= '';
		foreach($id_test as $k => $v) {
			if(!is_dir(FCPATH . "assets/uploads/test/".post('_id').'/')){
				$oldmask = umask(0);
				mkdir(FCPATH . "assets/uploads/test/".post('_id').'/',0777);
				umask($oldmask);
			}
			$dok 			= get_data('tbl_persyaratan_karyawan','id',$id_test[$k])->row();
			$d[$k] 			= [
				'id_pelamar'		=> post('_id'),
				'id_test'			=> $dok->id,
				'_key'	    		=> $dok->_key,
				'keterangan'		=> $keterangan[$k],
				'file_dokumen'		=> $old_file_syarat[$k],
				'update_at' => $last_update,
				'update_by' => $update_by
				
			];
			if($file_syarat[$k] && $file_syarat[$k] != $old_file_syarat[$k]) {
				if(@copy($file_syarat[$k], FCPATH . 'assets/uploads/test/'.post('_id').'/'.basename($file_syarat[$k]))) {
					$d[$k]['file_dokumen']	= basename($file_syarat[$k]);
					if(!$dir) $dir = str_replace(basename($file_syarat[$k]),'',$file_syarat[$k]);
					if($old_file_syarat[$k]) {
						@unlink(FCPATH . 'assets/uploads/test/'.post('_id').'/'.$old_file_syarat[$k]);
					}
				}
			}elseif(!$file_syarat[$k]) {
				$d[$k]['file_dokumen'] = '';
				if($old_file_syarat[$k]) {
					@unlink(FCPATH . 'assets/uploads/test/'.post('_id').'/'.$old_file_syarat[$k]);
				}
			}    

		}

		delete_data('tbl_test_newemp','id_pelamar',post('_id'));
		if(count($d)) {
			$save 	= insert_batch('tbl_test_newemp',$d);
			if($save) update_data('tbl_m_pelamar',['status_test' => 1],'id',post('_id'));
		}

		if($dir) {
			delete_dir(FCPATH . $dir);
		}

        render([
            'status'	=> 'success',
            'message'	=> lang('data_berhasil_disimpan')
        ],'json');

	}

	function wawancara(){

		$data = get_data('tbl_m_pelamar a',[
			'select' => 'a.*,b.id_jabatan,b.tanggal_wawancara,b.pewawancara,b.jumlah_nilai,b.rata_rata_nilai,b.kesimpulan',
			'join' => 'tbl_form_wawancara b on a.id = b.id_pelamar type LEFT',
			'where' => [
				'a.id' => post('id')
			],
			
			])->row_array();


		$data['nilai'] = get_data('tbl_isi_wawancara','id_pelamar',post('id'))->result_array();
		render($data,'json');
	}

	function save_wawancara() {
		$data = post();
		$isi = post('isi');
		$nilai = post('nilai');
		$catatan = post('catatan');
		$cek = get_data('tbl_form_wawancara','id_pelamar',post('_idw'))->row();
		if(!isset($cek)){
			$data['id'] = 0;
		}else{
			$data['id'] = $cek->id;
		} 
		$jabatan = get_data('tbl_m_jabatan','id',$data['id_jabatan_wawancara'])->row();
		$lokasi = get_data('tbl_m_cabang','id',$data['id_lokasi_wawancara'])->row();

		$data2 = [
			'id' => $data['id'],
			'id_pelamar' => $data['_idw'],
			'id_jabatan' => $data['id_jabatan_wawancara'],
			'id_lokasi' => $data['id_lokasi_wawancara'],
			'tanggal_wawancara' => $data['tanggal_wawancara'],
			'pewawancara' => $data['pewawancara'],
			'jumlah_nilai' => $data['jumlah'],
			'rata_rata_nilai' => $data['rata_rata'],
			'kesimpulan' => $data['kesimpulan']
		];

		$response = save_data('tbl_form_wawancara',$data2,post(':validation'));
		if($response['status']== 'success') {
			foreach($isi as $k => $v) {
				$d[$k] 			= [
					'id_pelamar' 		=> $data['_idw'],
					'id_wawancara'		=> $k,
					'nama'				=> $v,
					'nilai'		=> $nilai[$k],
					'catatan'		=> $catatan[$k],
				];
			}

			update_data('tbl_m_pelamar',['id_lokasi'=>$data['id_lokasi_wawancara'],'id_jabatan'=>$data['id_jabatan_wawancara']],'id',$data['_idw']);
		}

		delete_data('tbl_isi_wawancara','id_pelamar',$data['_idw']);
		if(count($d)) {
			$save 	= insert_batch('tbl_isi_wawancara',$d);
		}

		render($response,'json');
		// debug($dt);die;
	}

	function training(){

		$data = get_data('tbl_m_pelamar a',[
			'select' => 'a.*,b.mulai_training,b.selesai_training,b.pembimbing,b.kelayakan,b.alasan',
			'join' => 'tbl_layak_training b on a.id = b.id_pelamar type LEFT',
			'where' => [
				'a.id' => post('id')
			],
			
			])->row_array();

			$data['detail']	= get_data('tbl_persetujuan_training a',[
				'select'	=> 'a.*',
				'where'		=> 'a.id_pelamar = '.post('id'),
				'sort_by'	=> 'a.level_persetujuan'
			])->result_array();

		render($data,'json');
	}

	function save_layaktraining() {
		$data = post();
		$periode = post('::periode');
		$mulai = $periode[0];
		$selesai = $periode[1];
		$nama_atasan = post('nama_atasan');
		$jabatan = post('jabatan');
		$username = post('username_atasan');

		$cek = get_data('tbl_layak_training','id_pelamar',post('_idl'))->row();
		if(!isset($cek)){
			$data['id'] = 0;
		}else{
			$data['id'] = $cek->id;
		} 

		$lokasi = get_data('tbl_m_cabang','id',$data['id_lokasi_training'])->row();

		$data2 = [
			'id' => $data['id'],
			'id_pelamar' => $data['_idl'],
			'mulai_training' => $mulai,
			'selesai_training' => $selesai,
			'alamat_domisili' => $data['alamat_domisili'],
			'pembimbing' => $data['pembimbing'],
			'id_lokasi' => $data['id_lokasi_training'],
			'lokasi' => $lokasi->nama,
			'kelayakan' => $data['kelayakan'],
			'alasan' => $data['alasan'],
		];

		$response = save_data('tbl_layak_training',$data2,post(':validation'));
		if($response['status']= 'success'){
			update_data('tbl_m_pelamar',['id_lokasi'=>$data['id_lokasi_training']],'id',$data['_idl']);

			$c  = [];
			if(is_array($nama_atasan)) {
				$no = 0;
				foreach($nama_atasan as $k => $v) {
					if($nama_atasan[$k] != '' ) {
						$no++;
						$c[$k]		= [
							'id_pelamar'  => post('_idl'),
							'id_user' => $username[$k],
							'nama_atasan' => $nama_atasan[$k],
							'level_persetujuan' => $k,
							'jabatan' => $jabatan[$k],
						];

						$dt_user 			= get_data('tbl_user','id',$username[$k])->row_array();
						$c[$k]['username']	= isset($dt_user['username']) ? $dt_user['username'] : '';

					}
				}
			}
			delete_data('tbl_persetujuan_training','id_pelamar',post('_idl'));
			if(count($c)) insert_batch('tbl_persetujuan_training',$c);
		}
		render($response,'json');
		// debug($dt);die;
	}

	function exception(){	

		$data['umur'] = 0;
		$data = get_data('tbl_m_pelamar a',[
			'select' => 'a.*,b.nama,b.usia,b.id_penyimpangan,b.ket_penyimpangan,b.alasan_diterima,c.nama as pendidikan',
			'join' => ['tbl_exception_pelamar b on a.id = b.id_pelamar type LEFT',
						'tbl_m_pendidikan c on a.pendidikan_terakhir = c.id type LEFT'
			],
			'where' => [
				'a.id' => post('id')
			],
			
			])->row_array();

			$data['penyimpangan'] = explode(', ',$data['ket_penyimpangan']);
			$data['id_penyimpangan'] = explode(', ',$data['id_penyimpangan']);
			$data['pendidikan_terakhir'] = $data['pendidikan'];

			$lahir = str_replace('/','-',c_date($data['tanggal_lahir']));
			if($data['tanggal_lahir'] != '0000-00-00') $usia = umur($lahir);
		
			if(!isset($data['usia'])) $data['usia'] = $usia;


			$data['detail']	= get_data('tbl_persetujuan_exception a',[
				'select'	=> 'a.*',
				'where'		=> 'a.id_pelamar = '.post('id'),
				'sort_by'	=> 'a.level_persetujuan'
			])->result_array();
			

		render($data,'json');
	}

	function save_exception() {
		$data = post();
		$nama_penyetuju = post('nama_penyetuju');
		$jabatan_persetujuan = post('jabatan_persetujuan');
		$username_persetujuan = post('username_persetujuan');
		$id_penyimpangan = post('id_penyimpangan');
		$ket_penyimpangan = post('ket_penyimpangan');

		$cek = get_data('tbl_exception_pelamar','id_pelamar',post('_ide'))->row();
		if(!isset($cek)){
			$data['id'] = 0;
		}else{
			$data['id'] = $cek->id;
		} 

		$lokasi = get_data('tbl_m_cabang','id',$data['id_lokasi_sop'])->row();

		$data2 = [
			'id' => $data['id'],
			'id_pelamar' => $data['_ide'],
			'nama' => $data['nama_epelamar'],
			'pendidikan' => $data['pendidikan_eterakhir'],
			'usia' => $data['eumur'],
			'id_lokasi' => $data['id_lokasi_sop'],
			'alasan_diterima' => $data['alasan_diterima']
		];

			$c  = '';
			$cn  = '';
			if(is_array($id_penyimpangan)) {
				$no = 0;
				foreach($id_penyimpangan as $k => $v) {
					if($v != '' ) {
						if($c==''){
							$c = $v;
						}else{
							$c = $c . ', '.$v;
						}
					}

					if($ket_penyimpangan[$k] != '' ) {
						if($cn==''){
							$cn = $ket_penyimpangan[$k];
						}else{
							$cn = $cn . ', '.$ket_penyimpangan[$k];
						}
					}
				}
			}
			$data2['id_penyimpangan'] = $c;
			$data2['ket_penyimpangan'] = $cn;

			// debug($data2);die;

		$response = save_data('tbl_exception_pelamar',$data2,post(':validation'));
		if($response['status']= 'success'){
			
			$cp  = [];
			if(is_array($nama_penyetuju)) {
				$no = 0;
				foreach($nama_penyetuju as $k1 => $v1) {
					if($nama_penyetuju[$k1] != '' ) {
						$no++;
						$cp[$k1]		= [
							'id_pelamar'  => post('_ide'),
							'id_user' => $username_persetujuan[$k1],
							'nama_atasan' => $nama_penyetuju[$k1],
							'level_persetujuan' => $k1,
							'jabatan' => $jabatan_persetujuan[$k1],
						];

						$dt_user 			= get_data('tbl_user','id',$username_persetujuan[$k1])->row_array();
						$cp[$k1]['username']	= isset($dt_user['username']) ? $dt_user['username'] : '';

					}
				}
			}
			delete_data('tbl_persetujuan_exception','id_pelamar',post('_ide'));
			if(count($cp)) insert_batch('tbl_persetujuan_exception',$cp);
		}
		render($response,'json');
		// debug($dt);die;
	}

	function form_medref(){

		$data = get_data('tbl_m_pelamar a',[
			'select' => 'a.*',
			'where' => [
				'a.id' => post('id')
			],
			
			])->row_array();

			$data['isi_form']	= get_data('tbl_form_mrpelamar a',[
				'select'	=> 'a.*',
				'where'		=> 'a.id_pelamar = '.post('id'),
			])->result_array();
			
			// debug($data['isi_form']);die;

		render($data,'json');
	}

	function form_remunerasi(){

		$data = get_data('tbl_m_pelamar a',[
			'select' => 'a.*,b.gaji_pokok,b.tunjangan_transport,b.tunjangan_makan,b.nama_pemegang,b.nomor_rekening,b.nama_bank,b.nama_cabang',
			'join' => 'tbl_remunerasi_pelamar b on a.id = b.id_pelamar type LEFT',
			'where' => [
				'a.id' => post('id')
			],
			
			])->row_array();

		
			// debug($data['isi_form']);die;

		render($data,'json');
	}

	function save_remunerasi() {
		$data = post();
		$cek = get_data('tbl_remunerasi_pelamar','id_pelamar',post('_idrem'))->row();
		if(!isset($cek)){
			$data['id'] = 0;
		}else{
			$data['id'] = $cek->id;
		} 

		$data2 = [
			'id' => $data['id'],
			'id_pelamar' => $data['_idrem'],
			'nomor_rekening' =>$data['nomor_rekening'],
			'nama_pemegang' => $data['nama_pemegang'],
			'nama_bank' => $data['nama_bank'],
			'nama_cabang' => $data['nama_cabang'],
			'gaji_pokok' => $data['gaji_pokok'],
			'tunjangan_transport' => $data['tunjangan_transport'],
			'tunjangan_makan' => $data['tunjangan_makan']

		];

		$response = save_data('tbl_remunerasi_pelamar',$data2,post(':validation'));

		render($response,'json');
		// debug($dt);die;
	}

	function save_form_medref() {
		$data = post();
		$ya = post('check_ya');
		$tidak = post('check_tidak');
		$pertanyaan = post('pertanyaan');
		$cek = get_data('tbl_form_wawancara','id_pelamar',post('_idmr'))->row();
		if(!isset($cek)){
			$data['id'] = 0;
		}else{
			$data['id'] = $cek->id;
		} 

		foreach($pertanyaan as $k => $v) {
			$d[$k] 			= [
				'id_pelamar' 		 => $data['_idmr'],
				'id_form_pertanyaan' => $k,
				'ya' => (isset($ya[$k])) ? 1 : 0 ,
				'tidak' => (isset($tidak[$k]))  ? 1 : 0 ,
			];
		}


		delete_data('tbl_form_mrpelamar','id_pelamar',$data['_idmr']);
		if(count($d)) {
			$save 	= insert_batch('tbl_form_mrpelamar',$d);
		}

		$response = [
			'status' => 'success',
			'message' => lang('data_berhasil_di_simpan')
		];

		render($response,'json');
		// debug($dt);die;
	}

	function form_vaksin(){

		$data = get_data('tbl_m_pelamar a',[
			'select' => 'a.*,b.status_vaksinasi,b.nama_vaksin_primer,b.tanggal_vaksin1,b.tanggal_vaksin2,b.status_booster,b.nama_booster,b.tanggal_booster',
			'join' => 'tbl_vaksinasi_pelamar b on a.id = b.id_pelamar type LEFT',
			'where' => [
				'a.id' => post('id')
			],
			
			])->row_array();


		render($data,'json');
	}

	function save_vaksin() {
		$data = post();
		$cek = get_data('tbl_vaksinasi_pelamar','id_pelamar',post('_idv'))->row();
		if(!isset($cek)){
			$data['id'] = 0;
		}else{
			$data['id'] = $cek->id;
		} 

		$data2 = [
			'id' => $data['id'],
			'id_pelamar' => $data['_idv'],
			'status_vaksinasi' =>$data['status_vaksinasi'],
			'nama_vaksin_primer' => $data['nama_vaksin_primer'],
			'tanggal_vaksin1' => $data['tanggal_vaksin1'],
			'tanggal_vaksin2' => $data['tanggal_vaksin2'],
			'status_booster' => $data['status_booster'],
			'nama_booster' => $data['nama_booster'],
			'tanggal_booster' => $data['tanggal_booster']

		];

		$response = save_data('tbl_vaksinasi_pelamar',$data2,post(':validation'));

		render($response,'json');
		// debug($dt);die;
	}

	function get_atasan($type ='echo') {
        $user            = get_data('tbl_user a',[
            'where'     => [
                'a.is_active' => 1,
            ]
        ])->result();

        $data           = '<option value=""></option>';
        foreach($user as $e2) {
            $data       .= '<option value="'.$e2->id.'">'.$e2->nama.'</option>';
        }

        if($type == 'echo') echo $data;
        else return $data;       
    }

	function get_penyimpangan($type ='echo') {
        $user            = get_data('tbl_m_exception_recruitment a',[
            'where'     => [
                'a.is_active' => 1,
            ]
        ])->result();

        $data           = '<option value=""></option>';
        foreach($user as $e2) {
            $data       .= '<option value="'.$e2->id.'">'.$e2->ket_penyimpangan.'</option>';
        }

        if($type == 'echo') echo $data;
        else return $data;       
    }


	function save_verifikasi() {
		$dt = post();
		$check = post('check_verifikasi');

		$dt['id'] = $dt['id_pelamar'];
		$response = save_data('tbl_m_pelamar',$dt,post(':validation'));
		if($response['status'] =='success') {
			update_data('tbl_test_newemp',['check'=>0],['id_pelamar'=>$dt['id']]);
			// get_data('tbl_test_newemp','id_pelamar' )
			foreach($check as $c =>$v) {
				if($c) {
					update_data('tbl_test_newemp',['check'=>1],['id_pelamar'=>$dt['id'],'id_test'=>$c]);
				}
			}
		}

		render($response,'json');
		// debug($dt);die;
	}
	
	function delete() {
		$response = destroy_data('tbl_m_pelamar','id',post('id'));
		if($response['status'] == 'success') {
			
			destroy_data('tbl_keluarga_pelamar','id_pelamar',post('id'));
			destroy_data('tbl_saudara_pelamar','id_pelamar',post('id'));
			destroy_data('tbl_anak_pelamar','id_pelamar',post('id'));

			destroy_data('tbl_form_wawancara','id_pelamar',post('id'));
			destroy_data('tbl_isi_wawancara','id_pelamar',post('id'));
			destroy_data('tbl_layak_training','id_pelamar',post('id'));
		}
		render($response,'json');
	}

	function detail($id=0) {

		$data	= get_data('tbl_m_pelamar a',[
			'select' 	=> 'a.*',
			// 'join'		=> ['tbl_m_medical_treatment b on a.id_medical_treatment = b.id type LEFT',
			// 				'tbl_m_transfer_rekening c on a.id_transfer_rekening = c.id type LEFT'
			// 				],
			'where'		=> [
				'__m'  => 'a.id ="'.$id.'"'
			],
			])->row_array();
		$data['file'] 			= json_decode($data['lampiran'],true);

		// $data['detail']	= get_data('tbl_m_persetujuan a',[
		//     'select'	=> 'a.*',
		//     'where'		=> 'a.nip = '.$data['nip'],
		//     'sort_by'	=> 'a.urutan_approval'
		// ])->result_array();

		if(isset($data['id'])) {
			render($data,'layout:false');
		} else {
			echo lang('tidak_ada_data');
		}

	}

	function template() {
		ini_set('memory_limit', '-1');
		$arr = ['nama' => 'nama','alamat_domisili' => 'alamat_domisili','alamat_ktp' => 'alamat_ktp','telepon' => 'telepon','photo' => 'photo','tempat_lahir' => 'tempat_lahir','tanggal_lahir' => 'tanggal_lahir','jenis_kelamin' => 'jenis_kelamin','agama' => 'agama','status_pernikahan' => 'status_pernikahan','alamat_email' => 'alamat_email','npwp' => 'npwp','alamat_npwp' => 'alamat_npwp','nomor_sim' => 'nomor_sim','nomor_jamsostek' => 'nomor_jamsostek','nomor_bpjs_naker' => 'nomor_bpjs_naker','nomor_bpjs_kesehatan' => 'nomor_bpjs_kesehatan','tinggi_badan' => 'tinggi_badan','berat_badan' => 'berat_badan','suami_istri' => 'suami_istri','nama_ayah' => 'nama_ayah','nama_ibu' => 'nama_ibu','nama_ayah_mertua' => 'nama_ayah_mertua','nama_ibu_mertua' => 'nama_ibu_mertua','jumlah_saudara_kandung' => 'jumlah_saudara_kandung','jumlah_anak' => 'jumlah_anak','nama_bisa_Dihubungi' => 'nama_bisa_Dihubungi','alamat_bisa_dihubungi' => 'alamat_bisa_dihubungi','telepon_bisa_dihubungi' => 'telepon_bisa_dihubungi','status_bisa_dihubungi' => 'status_bisa_dihubungi','is_active' => 'is_active'];
		$config[] = [
			'title' => 'template_import_form_lamaran',
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function import() {
		ini_set('memory_limit', '-1');
		$file = post('fileimport');
		$col = ['nama','alamat_domisili','alamat_ktp','telepon','photo','tempat_lahir','tanggal_lahir','jenis_kelamin','agama','status_pernikahan','alamat_email','npwp','alamat_npwp','nomor_sim','nomor_jamsostek','nomor_bpjs_naker','nomor_bpjs_kesehatan','tinggi_badan','berat_badan','suami_istri','nama_ayah','nama_ibu','nama_ayah_mertua','nama_ibu_mertua','jumlah_saudara_kandung','jumlah_anak','nama_bisa_Dihubungi','alamat_bisa_dihubungi','telepon_bisa_dihubungi','status_bisa_dihubungi','is_active'];
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
					$save = insert_data('tbl_m_pelamar',$data);
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
		$arr = ['nama' => 'Nama','alamat_domisili' => 'Alamat Domisili','alamat_ktp' => 'Alamat Ktp','telepon' => 'Telepon','photo' => 'Photo','tempat_lahir' => 'Tempat Lahir','tanggal_lahir' => '-dTanggal Lahir','jenis_kelamin' => 'Jenis Kelamin','agama' => 'Agama','status_pernikahan' => 'Status Pernikahan','alamat_email' => 'Alamat Email','npwp' => 'Npwp','alamat_npwp' => 'Alamat Npwp','nomor_sim' => 'Nomor Sim','nomor_jamsostek' => 'Nomor Jamsostek','nomor_bpjs_naker' => 'Nomor Bpjs Naker','nomor_bpjs_kesehatan' => 'Nomor Bpjs Kesehatan','tinggi_badan' => 'Tinggi Badan','berat_badan' => 'Berat Badan','suami_istri' => 'Suami Istri','nama_ayah' => 'Nama Ayah','nama_ibu' => 'Nama Ibu','nama_ayah_mertua' => 'Nama Ayah Mertua','nama_ibu_mertua' => 'Nama Ibu Mertua','jumlah_saudara_kandung' => 'Jumlah Saudara Kandung','jumlah_anak' => 'Jumlah Anak','nama_bisa_Dihubungi' => 'Nama Bisa Dihubungi','alamat_bisa_dihubungi' => 'Alamat Bisa Dihubungi','telepon_bisa_dihubungi' => 'Telepon Bisa Dihubungi','status_bisa_dihubungi' => 'Status Bisa Dihubungi','is_active' => 'Aktif'];
		$data = get_data('tbl_m_pelamar')->result_array();
		$config = [
			'title' => 'data_form_lamaran',
			'data' => $data,
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}
	function verifikasi() {
		$id = post('id');
		$data	= get_data('tbl_m_pelamar a',[
			'where' => [
			'a.id'=>$id,
		],
		'sort_by' => 'a.id',	
		])->row_array();
		// $data['file'] 			= json_decode($data['lampiran'],true);

		
		$data['file'] 		= get_data('tbl_upl_dokumen_pelamar',[
			'where' => [
				'id_pelamar' => $id,
				'file !=' => '',
			],
		])->result();


		// debug($data['file']);die;

		$data['test']	= get_data('tbl_persyaratan_karyawan a',[
			'select'	=> 'a.*,b.check,b.file_dokumen,b.keterangan,b.id_pelamar, c.id_pelamar as idwawancara, 
							d.id_pelamar as idtraining, e.id_pelamar as idexception, f.id_pelamar as idremunerasi, 
							g.id_pelamar as idform_mr,h.id_pelamar as idvaksin',
			'join' 		=> ['tbl_test_newemp b on a.id = b.id_test type LEFT',
							'tbl_form_wawancara c on b.id_pelamar = c.id_pelamar and b._key = "wawancara" type LEFT',
							'tbl_layak_training d on b.id_pelamar = d.id_pelamar and b._key = "training" type LEFT',
							'tbl_exception_pelamar e on b.id_pelamar = e.id_pelamar and b._key = "exception" type LEFT',
							'tbl_remunerasi_pelamar f on b.id_pelamar = f.id_pelamar and b._key = "remunerasi" type LEFT',
							'tbl_form_mrpelamar g on b.id_pelamar = g.id_pelamar and b._key = "form_mr" type LEFT',
							'tbl_vaksinasi_pelamar h on b.id_pelamar = h.id_pelamar and b._key = "vaksin" type LEFT'
							],
			'where' 	=> [
				'b.id_pelamar' => $id,
				'a.is_active' => 1
			],
			'sort_by' => 'a.id',
			'sort' => 'ASC'
		])->result_array();
			// debug($data['test']);die;
		render($data,'json');
	}

	function test($encode_id='') {
        $id 		= decode_id($encode_id);
		if(count($id) == 2) {
			$data	= get_data('tbl_m_pelamar a',[
				'select' => 'a.*,b.id as wawancara',
				'join' => 'tbl_form_wawancara b on a.id = b.id_pelamar type LEFT',
				'where' => [
				'a.id'=>$id[0],
			],
			'sort_by' => 'a.id',	
			])->row_array();
			

			// $data['file'] 			= json_decode($data['lampiran'],true);

			$data['file'] 		= get_data('tbl_upl_dokumen_pelamar',[
				'where' => [
					'id_pelamar' => $id[0],
					'file !=' => '',
				],
			])->result_array();
			// debug($data['file']);die;
			// $data['file']	= [];
			// foreach($uplfile as $u) {
			// 	$data['file'][$u->id_dokumen] = $u->file;
			// }


			// debug($id[0]);die;
			$persyaratan = get_data('tbl_persyaratan_karyawan','is_active',1)->result();
			foreach($persyaratan as $p) {
				$cek =  get_data('tbl_test_newemp',[
					'where' => [
						'id_pelamar' => $id[0],
						'id_test' => $p->id
					],
				])->row();

				if(!isset($cek)) {
					$data_test = [
						'id_pelamar' => $id[0],
						'id_test' => $p->id,
						'_key' => $p-> _key
					];
					insert_data('tbl_test_newemp',$data_test);
				}
			}

			$data['test']	= get_data('tbl_persyaratan_karyawan a',[
				'select'	=> 'a.*,b.file_dokumen,b.keterangan,b.id_pelamar',
				'join' => ['tbl_test_newemp b on a.id = b.id_test type LEFT',
			],
				'where' 	=> [
					'b.id_pelamar' => $id,
					'a.is_active' => 1
				],
				'sort_by' => 'a.id',
				'sort' => 'ASC'
			])->result_array();


			$data['m_wawancara']	= get_data('tbl_m_wawancara a',[
				'where' => [
				'a.is_active'=>1,
			],
			'sort_by' => 'a.id',	
			])->result();

			$data['jabatan'] = get_data('tbl_m_jabatan','is_active',1)->result_array(); 
			$data['lokasi'] = get_data('tbl_m_cabang','is_active',1)->result_array(); 

			$data['form_medref'] = get_data('tbl_form_medref','is_active',1)->result_array();

			// debug($data['syarat']);die;
		    		            
           render($data);
        } else render('404');
	}

	function cetak_fwawancara($encode_id='') {
	    $decode = decode_id($encode_id);
	    if(count($decode) == 2) {
	        $id 	= $decode[0];
	        $data	= get_data('tbl_form_wawancara a',[
	        	'select'  => 'a.*,b.nama,c.nama_jabatan, d.nama as lokasi',
				'join' => ['tbl_m_pelamar b on a.id_pelamar = b.id type LEFT',
						   'tbl_m_jabatan c on a.id_jabatan = b.id type LEFT',
						   'tbl_m_cabang d on a.id_lokasi = d.id type LEFT'
			],
	        	'where' => [
	        		'a.id_pelamar' => $id
	        	]
	        ])->row_array();
			
			$data['test']	= get_data('tbl_m_wawancara a',[
				'select'	=> 'a.*,b.nilai,b.catatan',
				'join' => ['tbl_isi_wawancara b on a.id = b.id_wawancara type LEFT',
			],
				'where' 	=> [
					'a.is_active' => 1,
					'b.id_pelamar' => $id
				],
				'sort_by' => 'a.id',
				'sort' => 'ASC'
			])->result_array();

	        if(isset($data['id'])) {

				render($data,'pdf');
	        } else {
	            render('404');
	        }
	    } else {
	        render('404');
	    }
	}

	function cetak_training($encode_id='') {
	    $decode = decode_id($encode_id);
	    if(count($decode) == 2) {
	        $id 	= $decode[0];
	        $data	= get_data('tbl_layak_training a',[
	        	'select'  => 'a.*,b.nama,b.alamat_domisili',
				'join'	=> 'tbl_m_pelamar b on a.id_pelamar = b.id type LEFT',
	        	'where' => [
	        		'a.id_pelamar' => $id
	        	]
	        ])->row_array();

			$data['persetujuan'] = get_data('tbl_persetujuan_training',[
				'select' => '*',
				'where' => [
					'id_pelamar'=> $id,
				],
				'sort_by' => 'level_persetujuan',
				])->result_array();
			
	        if(isset($data['id'])) {
				render($data,'pdf');
	        } else {
	            render('404');
	        }
	    } else {
	        render('404');
	    }
	}

	function cetak_exception($encode_id='') {
	    $decode = decode_id($encode_id);
	    if(count($decode) == 2) {
	        $id 	= $decode[0];
	        $data	= get_data('tbl_exception_pelamar a',[
	        	'select'  => 'a.*,b.nama as _nama,c.nama as lokasi',
				'join'  => ['tbl_m_pelamar b on a.id_pelamar = b.id type LEFT',
							'tbl_m_cabang c on a.id_lokasi = c.id type LEFT'
				],
	        	'where' => [
	        		'a.id_pelamar' => $id
	        	]
	        ])->row_array();
			
			$data['persetujuan'] = get_data('tbl_persetujuan_exception',[
				'select' => '*',
				'where' => [
					'id_pelamar'=> $id,
				],
				'sort_by' => 'level_persetujuan',
				])->result_array();
			
	        if(isset($data['id'])) {

				render($data,'pdf');
	        } else {
	            render('404');
	        }
	    } else {
	        render('404');
	    }
	}

	function cetak_remunerasi($encode_id='') {
	    $decode = decode_id($encode_id);
	    if(count($decode) == 2) {
	        $id 	= $decode[0];
	        $data	= get_data('tbl_remunerasi_pelamar a',[
	        	'select'  => 'a.*,b.nama',
				'join' => 'tbl_m_pelamar b on a.id_pelamar = b.id type LEFT',
	        	'where' => [
	        		'a.id_pelamar' => $id
	        	]
	        ])->row_array();
			
	        if(isset($data['id'])) {

				render($data,'pdf');
	        } else {
	            render('404');
	        }
	    } else {
	        render('404');
	    }
	}

	function cetak_form_mr($encode_id='') {
	    $decode = decode_id($encode_id);
	    if(count($decode) == 2) {
	        $id 	= $decode[0];
	        $data	= get_data('tbl_form_mrpelamar a',[
	        	'select'  => 'a.*,b.nama,c.nama_jabatan, d.nama as lokasi',
				'join' => ['tbl_m_pelamar b on a.id_pelamar = b.id type LEFT',
				'tbl_m_jabatan c on b.id_jabatan = c.id type LEFT',
				'tbl_m_cabang d on b.id_lokasi = d.id type LEFT'
			],
	        	'where' => [
	        		'a.id_pelamar' => $id
	        	]
	        ])->row_array();
			
			$data['form']	= get_data('tbl_form_medref a',[
				'select'	=> 'a.*,b.ya,b.tidak',
				'join' => ['tbl_form_mrpelamar b on b.id_form_pertanyaan = a.id type LEFT',
			],
				'where' 	=> [
					'a.is_active' => 1,
					'b.id_pelamar' => $id
				],
				'sort_by' => 'a.id',
				'sort' => 'ASC'
			])->result_array();

	        if(isset($data['id'])) {

				render($data,'pdf');
	        } else {
	            render('404');
	        }
	    } else {
	        render('404');
	    }
	}

	function cetak_form_vaksin($encode_id='') {
	    $decode = decode_id($encode_id);
	    if(count($decode) == 2) {
	        $id 	= $decode[0];
	        $data	= get_data('tbl_vaksinasi_pelamar a',[
	        	'select'  => 'a.*,b.nama',
				'join' => 'tbl_m_pelamar b on a.id_pelamar = b.id type LEFT',
	        	'where' => [
	        		'a.id_pelamar' => $id
	        	]
	        ])->row_array();
			
	        if(isset($data['id'])) {

				render($data,'pdf');
	        } else {
	            render('404');
	        }
	    } else {
	        render('404');
	    }
	}


	function update_jobowner() {	
		$pelamar = get_data('tbl_m_pelamar',[
			'where' => [
				'is_active' => 1,
				'id_posisi_lamaran' => 8,
			],
			])->result();

		foreach($pelamar as $p){
			update_data('tbl_m_pelamar',['job_owner' => ''],['id'=>$p->id]); 
			$job_owner = get_data('tbl_posisi_lamaran','id',$p->id_posisi_lamaran)->row();
			if($job_owner){
			   update_data('tbl_m_pelamar',['job_owner' => $job_owner->id_pic],['id'=>$p->id]); 
			}
		}
		echo 'update sukses';

	}
}