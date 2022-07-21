<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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

        $data['wishlist'] = $this->M_admin->get_wishlist();

        $this->templatefront->view('admin/dashboard', $data);
    }

    public function data_pengguna()
    {
        $data['pengguna'] = $this->M_admin->get_pengguna();
        $this->templatefront->view('admin/pengguna', $data);
    }

    public function kelola_produk()
    {
        $data['sayur'] = $this->M_admin->get_sproduk);
        $this->templatefront->view('admin/sayur', $data);
    }

    function tambah_produk(){
        if (isset($_FILES['image'])) {
            $path = "berkas/sayur/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path);
            // ej($upload);
            if ($upload == true) {
                if ($this->M_admin->tambah_produk($upload['filename']) == true) {

                    $this->session->set_flashdata('notif_success', 'Berhasil menambahkan data sayur');
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('notif_warning', 'terjadi kesalahan, saat mencoba menambahkan data sayur. Coba lagi nanti !');
                    redirect(site_url('admin/kelola-sayur'));
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect(site_url('admin/kelola-sayur'));
            }
        } else {
            if ($this->M_admin->tambah_produk(null) == true) {
                $this->session->set_flashdata('notif_success', 'Berhasil menambahkan data sayur');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('notif_warning', 'terjadi kesalahan, saat mencoba menambahkan data sayur. Coba lagi nanti !');
                redirect(site_url('admin/kelola-sayur'));
            }
        }
    }

    function edit_produk(){
        if (isset($_FILES['image'])) {
            $path = "berkas/sayur/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path);
            // ej($upload);
            if ($upload == true) {
                if ($this->M_admin->edit_produk($upload['filename']) == true) {

                    $this->session->set_flashdata('notif_success', 'Berhasil mengubah data sayur');
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('notif_warning', 'terjadi kesalahan, saat mencoba mengubah data sayur. Coba lagi nanti !');
                    redirect(site_url('admin/kelola-sayur'));
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect(site_url('admin/kelola-sayur'));
            }
        } else {
            if ($this->M_admin->edit_produk(null) == true) {
                $this->session->set_flashdata('notif_success', 'Berhasil menambahkan data sayur');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('notif_warning', 'terjadi kesalahan, saat mencoba mengubah data sayur. Coba lagi nanti !');
                redirect(site_url('admin/kelola-sayur'));
            }

        }
    }

    function hapus_produk(){
        if ($this->M_admin->hapus_produk() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil menghapus data sayur');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'terjadi kesalahan, saat mencoba menghapus data sayur. Coba lagi nanti !');
            redirect(site_url('admin/kelola-sayur'));
        }
    }
}
