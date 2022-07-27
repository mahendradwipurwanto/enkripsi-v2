<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Dashboard
    function get_statistik(){

        $pengguna = $this->db->get_where('tb_auth', ['role' => 2, 'is_deleted' => 0])->num_rows();
        $produk = $this->db->get_where('tb_produk', ['is_deleted' => 0])->num_rows();
        $checkout = $this->db->get_where('tb_checkout', ['is_deleted' => 0])->num_rows();
        $pengunjung = $this->db->get('tb_pengunjung')->num_rows();

        $arrStatistik['pengguna'] = $pengguna;
        $arrStatistik['produk'] = $produk;
        $arrStatistik['checkout'] = $checkout;
        $arrStatistik['pengunjung'] = $pengunjung;

        return $arrStatistik;
    }

    public function getSettingsValue($key)
    {
        $query = $this->db->get_where('tb_settings', ['key' => $key]);
        return $query->row()->value;
    }

    function get_checkout(){
        // $this->db->select('a.*, b.nama, b.no_telp, b.profil, c.produk, c.gambar, c.harga');
        // $this->db->from('tb_checkout a');
        // $this->db->join('tb_user b', 'a.user_id = b.user_id', 'left');
        // $this->db->join('tb_produk c', 'a.produk_id = c.id', 'left');
        // $this->db->where('a.is_deleted', 0);
        // $this->db->order_by('a.created_at DESC');

        // return $this->db->get()->result();
        
        $this->db->select('a.*, b.nama, b.no_telp, b.profil, a.metode, a.status, a.bukti_bayar');
        $this->db->from('tb_checkout a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id', 'left');
        $this->db->where([ 'a.is_deleted' => 0]);
        $this->db->order_by('a.created_at DESC');

        $checkout = $this->db->get()->result();

        if (empty($checkout)) {
            return $checkout;
        } else {
            $arrProduk = [];
            foreach ($checkout as $key => $val):

            $this->db->select('a.checkout_id, a.produk_id, a.jumlah, b.produk, b.gambar');
            $this->db->from('tb_checkout_detail a');
            $this->db->join('tb_produk b', 'a.produk_id = id', 'left');
            $this->db->where('a.checkout_id', $val->id);
            $detailCheckout = $this->db->get()->result();

            $arrProduk[$key]['id'] = $val->id;
            $arrProduk[$key]['user_id'] = $val->user_id;
            $arrProduk[$key]['nama'] = $val->nama;
            $arrProduk[$key]['profil'] = $val->profil;
            $arrProduk[$key]['metode'] = $val->metode;
            $arrProduk[$key]['bukti_bayar'] = $val->bukti_bayar;
            $arrProduk[$key]['status'] = $val->status;
            $arrProduk[$key]['catatan'] = $val->catatan;
            $arrProduk[$key]['created_at'] = $val->created_at;
            $arrProduk[$key]['keranjang'] = $detailCheckout;
            endforeach;

            return $arrProduk;
        }

    }

    // Pengguna
    function get_pengguna(){
        $this->db->select('*');
        $this->db->from('tb_auth a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id');
        $this->db->where(['a.is_deleted' => 0, 'role' => 2]);
        $this->db->order_by('a.created_at DESC');

        return $this->db->get()->result();
    }

    function get_penggunaOperator(){
        $this->db->select('*');
        $this->db->from('tb_auth a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id');
        $this->db->where(['a.is_deleted' => 0, 'role' => 3]);
        $this->db->order_by('a.created_at DESC');

        return $this->db->get()->result();
    }

    // Produk
    function get_produk(){
        return $this->db->get_where('tb_produk', ['is_deleted' => 0])->result();    
    }

    function tambah_produk($gambar){
        $produk = $this->input->post('produk');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        $keterangan = $this->input->post('keterangan');

        $data = [
            'produk' => $produk,
            'gambar' => $gambar == null ? 'assets/images/placeholder.png' : $gambar,
            'harga' => $harga,
            'stok' => $stok,
            'keterangan' => $keterangan
        ];

        $this->db->insert('tb_produk', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function edit_produk($gambar){
        $id = $this->input->post('id');

        $produk = $this->input->post('produk');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        $keterangan = $this->input->post('keterangan');
        if($gambar == null){
            $data = [
                'produk' => $produk,
                'harga' => str_replace('.', '', $harga),
                'stok' => $stok,
                'keterangan' => $keterangan
            ];
        }else{
            $data = [
                'produk' => $produk,
                'gambar' => $gambar == null ? 'assets/images/placeholder.png' : $gambar,
                'harga' => str_replace('.', '', $harga),
                'stok' => $stok,
                'keterangan' => $keterangan
            ];
        }

        $this->db->where('id', $id);
        $this->db->update('tb_produk', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function hapus_produk(){
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('tb_produk', ['is_deleted' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function ubah_pengguna(){
        $user_id = $this->input->post('user_id');

        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $no_telp = $this->input->post('no_telp');
        $alamat = $this->input->post('alamat');
        $data = [
            'nama' => $nama,
            'no_telp' => $no_telp,
            'alamat' => $alamat
        ];

        $this->db->where('user_id', $user_id);
        $this->db->update('tb_user', $data);

        $data = [
            'email' => $email
        ];

        $this->db->where('user_id', $user_id);
        $this->db->update('tb_auth', $data);
        return true;
    }

    function ubah_pengaturanInfo()
    {
        $judul = $this->input->post('judul');
        $kode = $this->input->post('kode');
        $this->db->where('key', 'web_title');
        $this->db->update('tb_settings', ['value' => $judul]);
        $this->db->where('key', 'kode');
        $this->db->update('tb_settings', ['value' => $kode]);

        return true;

    }

    function ubah_pengaturan()
    {
        $value = $this->input->post('value');
        $desc = $this->input->post('desc');
        $key = $this->input->post('key');
        $this->db->where('key', $key);
        $this->db->update('tb_settings', ['value' => $value, 'desc' => $desc]);

        return ($this->db->affected_rows() != 1) ? false : true;

    }

    function bypass_otp($status)
    {
        $this->db->where('key', 'bypass_otp');
        $this->db->update('tb_settings', ['value' => $status]);

        return ($this->db->affected_rows() != 1) ? false : true;

    }

    function tambah_operator(){
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $data = [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'status' => 1,
            'role' => 3
        ];

        $this->db->insert('tb_auth', $data);
        
        $data = [
            'user_id'   => $this->db->insert_id(),
            'nama' => $nama
        ];

        $this->db->insert('tb_user', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function ubah_operator(){
        $user_id = $this->input->post('user_id');

        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        
        $data = [
            'nama' => $nama
        ];

        $this->db->where('user_id', $user_id);
        $this->db->update('tb_user', $data);

        if(isset($password) && $password !== ''){
            $data = [
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];
        }else{
            $data = [
                'email' => $email
            ];
        }

        $this->db->where('user_id', $user_id);
        $this->db->update('tb_auth', $data);

        return true;
    }

    function hapus_operator(){
        $user_id = $this->input->post('user_id');

        $this->db->where('user_id', $user_id);
        $this->db->update('tb_auth', ['is_deleted' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function verifikasi_pembayaran($id){

        $this->db->where('id', $id);
        $this->db->update('tb_checkout', ['status' => 2]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
