<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Set_approval extends BE_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$data['user']	= get_data('tbl_user',[
			'where'	=> [
				'is_active'	=> 1,
			]
		])->result_array();

		$data['jabatan']	= get_data('tbl_m_jabatan a',[
			'select' => 'a.*, b.keterangan as divisi',
			'join' => 'tbl_m_divisi b on a.id_department = b.id type LEFT',
			'where'	=> [
				'a.is_active'	=> 1,
			]
		])->result_array();

		$data['flow']	= get_data('tbl_flow_approval',[
			'where'	=> [
				'id_jenis'	=> 1,
			]
		])->result();

		$data['divisi']	= get_data('tbl_m_divisi',[
			'where'	=> [
				'is_active'	=> 1,
			]
		])->result_array();

		render($data);
	}

	function data() {
		$config = [];
		$kode = [];
		$jabatan = get_data('tbl_approval_jabatan a',[
			    'select' => 'distinct a.kode_jabatan',
				'where' => [
					'__m' => 'a.kode_jabatan in (select kode_jabatan from tbl_m_jabatan b where b.is_active =1)'
				]
			])->result();
		foreach($jabatan as $a) {
			$kode[] = $a->kode_jabatan;
		}

		if(count($kode)) {
			$config['where']['kode_jabatan'] 	= $kode;
		}else{
			$config['where']['kode_jabatan'] 	= '06041977';
		}

		$data = data_serverside($config);
		render($data,'json');
	}

	function get_data() {
		// debug(post('id'));die;
		$data = get_data('tbl_m_jabatan','id',post('id'))->row_array();
		// debug($jabatan);die;

		$data['approval'] = get_data('tbl_approval_jabatan a',[
			'select' => 'a.*,b.id as id_jabatan, b.nama_jabatan,b.id_department,b.kode_department',
			'join' => 'tbl_m_jabatan b on a.kode_jabatan = b.kode_jabatan type LEFT',
			'where'  => [
				'b.id'=>post('id'),
			],
			
			])->result_array();
		// debug($data);die;


		render($data,'json');
	}

	function save() {
		$ttd = $this->input->post('tanda_tangan') ;
		
		$data = post();

		$username		= post('nama_pic');
		$old_tanda_tangan = post('old_tanda_tangan');
		$mandatory = post('check');

		$last_update 				= date('Y-m-d H:i:s');
		$update_by = user('nama');

		// debug($old_tanda_tangan);die;

		// $response = save_data('tbl_jabatan',post(),post(':validation'));
		$kode_jabatan = '';
		$jabatan = get_data('tbl_m_jabatan','id',$data['kode_jabatan'])->row();

		if(isset($jabatan)) $kode_jabatan = $jabatan->kode_jabatan;
		if(isset($level)) $level_approval = $level->level;

		$idfile = $kode_jabatan . $data['jenis_approval'];

		$last_file = [];
		if($data['kode_jabatan']) {
			$dt = get_data('tbl_approval_jabatan',['kode_jabatan'=>$kode_jabatan,'jenis_approval'=>$data['jenis_approval']])->result();
			if(count($dt)) {
				foreach($dt as $d) {
					if($d->tanda_tangan != '') {
						$last_file[$d->flow_approval] = $d->tanda_tangan;
					}
				}
			}
		}

		// debug($ttd);die;
		// debug($last_file);die;
		// // if($response['status'] == 'success') {
	    //     $dt_master	= get_data('tbl_jabatan','id',$response['id'])->row_array();

	        // delete_data('tbl_approval_jabatan',['kode_jabatan'=>$kode_jabatan,'jenis_approval'=>$data['jenis_approval']]);

			$c	= [];
			if(is_array($username)) {
				// debug('x');die;
				$level = 0;
				foreach($username as $k => $v) {
					if($v != '') {

									
						// debug($filename);die;

						$level_approval = 0;
						$level = get_data('tbl_flow_approval','id',$k)->row();
						if(isset($level)) $level_approval = $level->level;

						$level++;
						$c[$k]		= [
							'kode_jabatan'		=> $kode_jabatan,
							'jenis_approval'	=> $data['jenis_approval'],
							'flow_approval'		=> $k,
							'level_approval'	=> $level_approval,
							'userid'			=> $v,
							'tanda_tangan'		=> $old_tanda_tangan[$k],
							'mandatory'			=> (isset($mandatory[$k]) ? 1 : 0),
							'update_at'			=> $last_update,
							'update_by'			=> $update_by
						];


						
						$file 						= $ttd;
						$dir 						= '';
						// debug($file);die;
						foreach($file as $k1 => $f) {
							if($file[$k] && $file[$k] != $old_tanda_tangan[$k]) {
								if(file_exists($f)) {
									if(@copy($f, FCPATH . 'assets/uploads/approval_jabatan/'.$idfile.basename($f))) {
										$c[$k1]['tanda_tangan']	= $idfile.basename($f);
										if(!$dir) $dir = str_replace(basename($f),'',$idfile.$f);
										if($old_tanda_tangan[$k1]) {
											@unlink(FCPATH . 'assets/uploads/approval_jabatan/'.$old_tanda_tangan[$k1]);
										}
									}
								}
							}//elseif(!$file[$k]) {
							// 	$c[$k1]['tanda_tangan'] = '';
							// 	if($old_tanda_tangan[$k]) {
							// 		@unlink(FCPATH . 'assets/uploads/approval_jabatan/'.$old_tanda_tangan[$k1]);
							// 	}
							// }  
						}
					
						$dt_user 			= get_data('tbl_user','id',$v)->row_array();
						$c[$k]['username']	= isset($dt_user['username']) ? $dt_user['username'] : '';
						$c[$k]['nama_approval']	= isset($dt_user['nama']) ? $dt_user['nama'] : '';

					}
				}
			}


			delete_data('tbl_approval_jabatan',['kode_jabatan'=>$kode_jabatan,'jenis_approval'=>$data['jenis_approval']]);

			if(count($c)) {
				$save 	= insert_batch('tbl_approval_jabatan',$c);
			}

		$response = [
			'status' => 'success',
			'message' => 'berhasil'
		];
		render($response,'json');
	}

	function delete() {
		$response = destroy_data('tbl_jabatan','id',post('id'));
		if($response['status'] == 'success') {
			destroy_data('tbl_approval_jabatan','id_jabatan',post('id'));
		}
		render($response,'json');
	}

	function template() {
		ini_set('memory_limit', '-1');
		$arr = ['kode_jabatan' => 'kode_jabatan','nama_jabatan' => 'nama_jabatan','is_active' => 'is_active'];
		$config[] = [
			'title' => 'template_import_set_approval',
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function import() {
		ini_set('memory_limit', '-1');
		$file = post('fileimport');
		$col = ['kode_jabatan','nama_jabatan','is_active'];
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
					$save = insert_data('tbl_jabatan',$data);
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
		$arr = ['kode_jabatan' => 'Kode Jabatan','nama_jabatan' => 'Nama Jabatan','is_active' => 'Aktif'];
		$data = get_data('tbl_jabatan')->result_array();
		$config = [
			'title' => 'data_set_approval',
			'data' => $data,
			'header' => $arr,
		];
		$this->load->library('simpleexcel',$config);
		$this->simpleexcel->export();
	}

	function get_approval($type ='echo',$jenis_approval='') {
		
		$jenis_approval = post('jenis_approval');
		

		$data['detail']= get_data('tbl_flow_approval',[
			'where' => [
				'id_jenis' => $jenis_approval
			]
		])->result_array();
		
		

		// debug($data);die;
		render($data,'json');
	}
}