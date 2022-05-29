<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
        $data['wishlist'] = $this->M_pengguna->get_wishlistPengguna($this->session->userdata('user_id'));

        $this->templatefront->view('pengguna/dashboard', $data);
    }
}