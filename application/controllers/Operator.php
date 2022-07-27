<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH.'libraries/Aes.php');

class Operator extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_admin']);

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

        if ($this->session->userdata('role') == 2) {
            $this->session->set_flashdata('warning', "Kamu tidak memiliki akses");
            redirect(base_url());
        }
    }

    public function index()
    {
        $data['statistik'] = $this->M_admin->get_statistik();
        $data['checkout'] = $this->M_admin->get_checkout();

        $this->templateback->view('admin/dashboard', $data);
    }
}