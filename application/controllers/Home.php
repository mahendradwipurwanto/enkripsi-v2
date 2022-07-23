<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_home', 'M_admin']);

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
        // $this->session->unset_userdata('keranjang');
        $this->add_pengunjung();
        if($this->input->get('cari')){
            $data['produk'] = $this->M_home->get_produkHome($this->input->get('cari'));
        }else{
            $data['produk'] = $this->M_home->get_produkHome();
        }
        $this->templatefront->view('home/home', $data);
    }

    public function add_pengunjung(){
        $device = $this->agent->agent_string();
        $this->M_home->add_pengunjung($device);
    }

    public function add_cartWish(){
        if ($this->session->userdata('logged_in') == false || !$this->session->userdata('logged_in')) {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            
            // send to login first, then continued activities
            $this->session->set_userdata('redirect', $uri);
            $this->session->set_flashdata('error', "Harap login ke akun anda, untuk melanjutkan");
            redirect('login');
        }

        if ($this->M_home->cek_aktivasi($this->session->userdata('user_id')) == true) {
            $this->session->set_flashdata('warning', "Harap melakukan aktivasi akun terlebih dahulu!");
            redirect(site_url('aktivasi-akun'));
        }

        // OTP REQUIRE
        if (($this->session->userdata('otp') == false || !$this->session->userdata('otp')) && $this->session->userdata('role') == 2) {
            $this->session->set_flashdata('warning', "Harap melakukan proses OTP !");
            redirect(site_url('otp'));
        }

        if($this->M_home->get_produk($this->input->post('id'), $this->input->post('jumlah')) == true){
            $cart = $this->session->userdata('keranjang') ? $this->session->userdata('keranjang') : [];
            

            $produk_id = $this->input->post('id');
            $produk = $this->input->post('produk');
            $gambar = $this->input->post('gambar');
            $jumlah = $this->input->post('jumlah');

            $new_cart = [
                'produk_id' => $produk_id,
                'produk' => $produk,
                'gambar' => $gambar,
                'jumlah' => $jumlah
            ];

            array_push($cart, $new_cart);

            $this->M_home->updateJumlahProduk($produk_id, $jumlah);
            
            $this->session->set_userdata(['keranjang' => $cart]);
            // ej($this->session->userdata('keranjang'));
            $this->session->set_flashdata('notif_success', 'Berhasil menambahkan produk ke keranjang anda !');
            redirect($this->agent->referrer());
        }else{
            $this->session->set_flashdata('notif_warning', 'Jumlah permintaan anda melebihi stok yang tersedia !');
            redirect($this->agent->referrer());

        }

    }

    public function tambah_checkout(){
        if ($this->session->userdata('logged_in') == false || !$this->session->userdata('logged_in')) {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            
            // send to login first, then continued activities
            $this->session->set_userdata('redirect', $uri);
            $this->session->set_flashdata('error', "Harap login ke akun anda, untuk melanjutkan");
            redirect('login');
        }

        if ($this->M_home->cek_aktivasi($this->session->userdata('user_id')) == true) {
            $this->session->set_flashdata('warning', "Harap melakukan aktivasi akun terlebih dahulu!");
            redirect(site_url('aktivasi-akun'));
        }

        // OTP REQUIRE
        if (($this->session->userdata('otp') == false || !$this->session->userdata('otp')) && $this->session->userdata('role') == 2) {
            $this->session->set_flashdata('warning', "Harap melakukan proses OTP !");
            redirect(site_url('otp'));
        }

        if ($this->M_home->tambah_checkout() == true) {
            $this->session->unset_userdata('keranjang');
            $this->session->set_flashdata('notif_success', 'Berhasil menambahkan produk ke checkout anda');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'terjadi kesalahan, saat mencoba menambahkan produk ke checkout anda. Coba lagi nanti !');
            redirect($this->agent->referrer());
        }
    }
}
