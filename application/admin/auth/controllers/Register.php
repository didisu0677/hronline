<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends BE_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('securimage');
    }

    public function index() {
        $d = decode_id(get('token'));
        include_lang('recruitment');
        if(isset($d[0]) && $d[0] > strtotime('now')) {
            $data['layout']             = 'register';
            $data['title']              = lang('pendaftaran_rekanan');
            $data['opt_posisi'] = get_data('tbl_posisi_lamaran','is_active',1)->result_array();
            $data['pendidikan'] = get_data('tbl_m_pendidikan','is_active',1)->result_array();

            $data['captcha']            = Securimage::getCaptchaHtml(array('input_name' => 'ct_captcha', 'placeholder' => lang('tuliskan_teks_diatas')));;
            render($data);
        } else {
            redirect();
        }
    }

    function generate_password() {
        $data = [
            substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz'), 0, 6),
            substr(str_shuffle('1234567890'), 0, 1),
            substr(str_shuffle('!@#$%&?=+-_'), 0, 1)
        ];
        shuffle($data);
        return $data[0].$data[1].$data[2];
    }

    function do_reg() {
        $data = post();
        $nama_keluarga = post('nama_keluarga');
        $ttl_keluarga = post('ttl_keluarga');
        $pddk_keluarga = post('pddk_keluarga');
        $jabatan_keluarga = post('jabatan_keluarga');
        $institusi_keluarga = post('institusi_keluarga');

        $nama_saudara = post('nama_saudara');
        $ttl_saudara = post('ttl_saudara');
        $pddk_saudara = post('pendidikan_saudara');
        $jabatan_saudara = post('jabatan_saudara');
        $institusi_saudara = post('institusi_saudara');

        $nama_anak = post('nama_anak');
        $ttl_anak = post('ttl_anak');
        $pddk_anak = post('pendidikan_anak');
        $jabatan_anak = post('jabatan_anak');
        $institusi_anak = post('institusi_anak');


        $img                    = new Securimage();
        $response               = [];

        $data['create_at']              = date('Y-m-d H:i:s');
        $data['is_active']              = 1;
        $data['terdaftar_sejak']        = date('Y-m-d H:i:s');
        $data['is_pendaftar']           = 1;

        if($img->check(post('ct_captcha'))) {
            $cek_npwp1  = get_data('tbl_m_pelamar',[
                'where' => [
                    '__m'  => "npwp ='". $data['npwp']."' or alamat_email ='". $data['alamat_email']."'"
                ],
                ])->row();

            if(isset($cek_npwp1->id)) {
                $response   = [
                    'status'    => 'failed',
                    'message'   => lang('npwp_ini_sudah_pernah_mendaftar')
                ];
            } else {
            //     debug($data) ;die;
                // debug($data['alamat_email']);die;
                // $cek_email_cp1  = get_data('tbl_m_pelamar','alamat_email',$data['alamat_email'])->row();
                // if(isset($cek_email_cp1->id)) {
                //     $response   = [
                //         'status'    => 'failed',
                //         'message'   => lang('email_kontak_person_sudah_digunakan')
                //     ];
                // } else {

                    $res            = save_data('tbl_m_pelamar',$data,post(':validation'),true);
                    

                    $password       = $this->generate_password();
                    if($res['status'] == 'success') {

                        $pelamar     = get_data('tbl_m_pelamar','id',$res['id'])->row_array();
                        $user       = [
                            'id_group'              => 99,
                            'kode'                  => $pelamar['kode_pelamar'],
                            'nama'                  => $pelamar['nama'],
                            'username'              => $pelamar['kode_pelamar'],
                            'password'              => c_password($password),
                            'email'                 => $pelamar['alamat_email'],
                            'id_pelamar'            => $pelamar['id'],
                            'is_active'             => 1,
                            'create_at'             => date('Y-m-d H:i:s'),
                            'change_password_at'    => date('Y-m-d H:i:s'),
                            'create_by'             => 'Pendaftaran'
                        ];
                        $check      = get_data('tbl_user','kode',$pelamar['kode_pelamar'])->row();
                        if(isset($check->id)) {
                            update_data('tbl_user',$user,'id',$check->id);
                            $user_id    = $check->id;
                        } else {
                            $user_id    = insert_data('tbl_user',$user);
                        }
                        $username   = $pelamar['kode_pelamar'];


                        // kirim email ke calon vendor
                        send_mail([
                            'to'        => $data['alamat_email'],
                            'subject'   => 'Pendaftaran '.setting('title').' '.setting('company'),
                            'pelamar'    => $pelamar,
                            'username'  => $username,
                            'password'  => $password
                        ]);

                        // // kirim notifikasi ke user persetujuan
                        // $user_persetujuan = get_data('tbl_user',[
                        //     'where'     => [
                        //         'is_active' => 1,
                        //         'id_group'  => id_group_access('calon_karyawan','additional')
                        //     ]
                        // ])->result();
                        // foreach($user_persetujuan as $u) {
                        //     $link               = base_url().'recruitment/form_lamaran?i='.encode_id([$res['id'],rand()]);
                        //     $desctiption        = 'Pendaftaran calon karyawan atas nama <strong>'.$data['nama'].'</strong>';
                        //     $data_notifikasi    = [
                        //         'title'         => 'Pendaftaran calon karyawan',
                        //         'description'   => $desctiption,
                        //         'notif_link'    => $link,
                        //         'notif_date'    => date('Y-m-d H:i:s'),
                        //         'notif_type'    => 'info',
                        //         'notif_icon'    => 'fa-users',
                        //         'id_user'       => $u->id,
                        //         'transaksi'     => 'pendaftaran_rekanan',
                        //         'id_transaksi'  => $res['id']
                        //     ];
                        //     insert_data('tbl_notifikasi',$data_notifikasi);
                        // }

                        $response = [
                            'status'    => 'success',
                            'message'   => lang('registrasi_berhasil')
                        ];
                    }else{
                        $response = $res;
                    }
                }
            // }
        } else {
            $response   = [
                'status'    => 'failed',
                'message'   => lang('captcha_tidak_valid')
            ];
        }
        render($response,'json');
    }

     function securimage() {
        $img = new Securimage();
        $img->show();
    }

    function securimage_audio() {
        $bahasa             = setting('language') == 'id' ? 'id' : 'en';
        $img                = new Securimage();
        $img->audio_path    = $img->securimage_path . '/audio/'.$bahasa.'/';
        $img->outputAudioFile(null);
    }

}