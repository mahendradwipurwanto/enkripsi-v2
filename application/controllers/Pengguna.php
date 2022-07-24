<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH.'libraries/Aes.php');

class Pengguna extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();

        // cek apakah user sudah login
        if ($this->session->userdata('logged_in') == false || !$this->session->userdata('logged_in')) {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            $this->session->set_userdata('redirect', $uri);
            $this->session->set_flashdata('notif_warning', "Harap login ke akun anda untuk melanjutkan");
            redirect('login');
        }
        $this->load->model(['M_home', 'M_admin', 'M_pengguna']);
        $this->load->library('encryption');

        if ($this->session->userdata('logged_in') == true || $this->session->userdata('logged_in')) {
            // OTP REQUIRE
            if (($this->session->userdata('otp') == false || !$this->session->userdata('otp')) && $this->session->userdata('role') == 2) {
                $this->session->set_flashdata('warning', "Harap melakukan proses OTP !");
                redirect(site_url('otp'));
            }
        }
    }

    public function index()
    {
        $data['checkout'] = $this->M_pengguna->get_checkoutPengguna($this->session->userdata('user_id'));
        $user = $this->M_pengguna->get_dataPengguna($this->session->userdata('user_id'));

        // if($this->session->userdata('decrypt') == false){
        //     $aes = new Aes(randomString(16));

        //     $user->nama     = bin2hex($aes->encrypt($user->nama));
        //     $user->email    = bin2hex($aes->encrypt($user->email));
        //     $user->no_telp  = bin2hex($aes->encrypt($user->no_telp));
        //     $user->alamat   = bin2hex($aes->encrypt($user->alamat));
        // }

        $data['user'] = $user;

        $this->templatefront->view('pengguna/dashboard', $data);
    }

    function decrypt(){
        if($this->session->userdata('decrypt') == true){
            $this->session->set_userdata(['decrypt' => false]);
            $kata = 'enkripsi';
        }else{
            $this->session->set_userdata(['decrypt' => true]);
            $kata = 'dekripsi';
        }
        $this->session->set_flashdata('success', "Berhasil melakukan proses {$kata} !");
        redirect(site_url('pengguna'));
    }
}
