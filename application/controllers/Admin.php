<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH.'libraries/Aes.php');

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

        // if ($this->session->userdata('role') == 2) {
        //     $this->session->set_flashdata('warning', "Kamu tidak memiliki akses");
        //     redirect(base_url());
        // }
    }

    public function index()
    {
        $data['statistik'] = $this->M_admin->get_statistik();
        $data['checkout'] = $this->M_admin->get_checkout();

        $this->templateback->view('admin/dashboard', $data);
    }

    public function data_operator()
    {
        if($this->session->userdata('decrypt') == false){
            $this->session->unset_userdata('decrypt');
        }

        $pengguna = $this->M_admin->get_penggunaOperator();
        $data['pengguna'] = $pengguna;

        $this->templateback->view('admin/operator', $data);
    }

    public function data_pengguna()
    {
        if($this->session->userdata('decrypt') == false){
            $this->session->unset_userdata('decrypt');
        }

        $pengguna = $this->M_admin->get_pengguna();

        if($this->session->userdata('decrypt') == false){
            $aes = new Aes($this->M_admin->getSettingsValue('kode'));

            foreach ($pengguna as $key => $val) {
                $pengguna[$key]->nama       = bin2hex($aes->encrypt($val->nama));
                $pengguna[$key]->email      = bin2hex($aes->encrypt($val->email));
                $pengguna[$key]->no_telp    = bin2hex($aes->encrypt($val->no_telp));
                $pengguna[$key]->alamat     = bin2hex($aes->encrypt($val->alamat));
                $pengguna[$key]->pekerjaan  = bin2hex($aes->encrypt($val->pekerjaan));
                $pengguna[$key]->gaji       = bin2hex($aes->encrypt($val->gaji));
            }
        }

        $data['pengguna'] = $pengguna;

        $this->templateback->view('admin/pengguna', $data);
    }

    public function kelola_produk()
    {
        $data['produk'] = $this->M_admin->get_produk();
        $this->templateback->view('admin/produk', $data);
    }

    public function pengaturan()
    {
        $data['kode'] = $this->M_admin->getSettingsValue('kode');
        $this->templateback->view('admin/pengaturan', $data);
    }

    function tambah_produk(){
        if (isset($_FILES['image'])) {
            $path = "berkas/produk/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path);
            // ej($upload);
            if ($upload == true) {
                if ($this->M_admin->tambah_produk($upload['filename']) == true) {

                    $this->session->set_flashdata('notif_success', 'Berhasil menambahkan data produk');
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('notif_warning', 'terjadi kesalahan, saat mencoba menambahkan data produk. Coba lagi nanti !');
                    redirect(site_url('admin/kelola-produk'));
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect(site_url('admin/kelola-produk'));
            }
        } else {
            if ($this->M_admin->tambah_produk(null) == true) {
                $this->session->set_flashdata('notif_success', 'Berhasil menambahkan data produk');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('notif_warning', 'terjadi kesalahan, saat mencoba menambahkan data produk. Coba lagi nanti !');
                redirect(site_url('admin/kelola-produk'));
            }
        }
    }

    function edit_produk(){
        if (isset($_FILES['image'])) {
            $path = "berkas/produk/";
            $upload = $this->uploader->uploadImage($_FILES['image'], $path);
            // ej($upload);
            $file = isset($upload['filename']) ? $upload['filename'] : null;
            if ($upload == true) {
                if ($this->M_admin->edit_produk($file) == true) {

                    $this->session->set_flashdata('notif_success', 'Berhasil mengubah data produk');
                    redirect($this->agent->referrer());
                } else {
                    $this->session->set_flashdata('notif_warning', 'terjadi kesalahan, saat mencoba mengubah data produk. Coba lagi nanti !');
                    redirect(site_url('admin/kelola-produk'));
                }
            } else {
                $this->session->set_flashdata('notif_warning', $upload['message']);
                redirect(site_url('admin/kelola-produk'));
            }
        } else {
            if ($this->M_admin->edit_produk(null) == true) {
                $this->session->set_flashdata('notif_success', 'Berhasil menambahkan data produk');
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('notif_warning', 'terjadi kesalahan, saat mencoba mengubah data produk. Coba lagi nanti !');
                redirect(site_url('admin/kelola-produk'));
            }

        }
    }

    function hapus_produk(){
        if ($this->M_admin->hapus_produk() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil menghapus data produk');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'terjadi kesalahan, saat mencoba menghapus data produk. Coba lagi nanti !');
            redirect(site_url('admin/kelola-produk'));
        }
    }

    function ubah_pengguna(){
        if ($this->M_admin->ubah_pengguna() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil mengubah data pengguna');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'terjadi kesalahan, saat mencoba mengubah data pengguna. Coba lagi nanti !');
            redirect(site_url('admin/data-pengguna'));
        }
    }

    function ubah_pengaturanInfo(){
        if ($this->M_admin->ubah_pengaturanInfo() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil mengubah data pengaturan');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Anda tidak melakukan perubahan data pengaturan!');
            redirect(site_url('admin/pengaturan'));
        }
    }

    function ubah_pengaturan(){
        if ($this->M_admin->ubah_pengaturan() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil mengubah data pengaturan');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Anda tidak melakukan perubahan data pengaturan!');
            redirect(site_url('admin/pengaturan'));
        }
    }

    function bypass_otp($status){
        if ($this->M_admin->bypass_otp($status) == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil mengubah data pengaturan');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Anda tidak melakukan perubahan data pengaturan!');
            redirect(site_url('admin/pengaturan'));
        }
    }

    function decrypt(){
        if($this->input->post('kode') == $this->M_admin->getSettingsValue('kode')){
            if($this->session->userdata('decrypt') == true){
                $this->session->set_userdata(['decrypt' => false]);
                $kata = 'enkripsi';
            }else{
                $this->session->set_userdata(['decrypt' => true]);
                $kata = 'dekripsi';
            }
            $this->session->set_flashdata('success', "Berhasil melakukan proses {$kata} !");
            redirect(site_url('admin/data-pengguna'));
        }else{
            $this->session->set_flashdata('warning', "Kode yang anda masukan salah !");
            redirect(site_url('admin/data-pengguna'));
        }
    }

    function tambah_operator(){
        if ($this->M_admin->tambah_operator() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil menambahkan data operator');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan, saat menambahkan data operator!');
            redirect(site_url('admin/data-operator'));
        }
    }

    function ubah_operator(){
        if ($this->M_admin->ubah_operator() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil mengubah data operator');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan, saat mengubah data operator!');
            redirect(site_url('admin/data-operator'));
        }
    }

    function hapus_operator(){
        if ($this->M_admin->hapus_operator() == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil menghapus data operator');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan, saat menghapus data operator!');
            redirect(site_url('admin/data-operator'));
        }
    }

    function verifikasi_pembayaran($id){
        if ($this->M_admin->verifikasi_pembayaran($id) == true) {
            $this->session->set_flashdata('notif_success', 'Berhasil memverifikasi data transaksi');
            redirect($this->agent->referrer());
        } else {
            $this->session->set_flashdata('notif_warning', 'Terjadi kesalahan, saat memverifikasi data transaksi!');
            redirect(site_url('admin'));
        }
    }
}
