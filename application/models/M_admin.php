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
        $sayur = $this->db->get_where('tb_sayur', ['is_deleted' => 0])->num_rows();
        $wishlist = $this->db->get_where('tb_wishlist', ['is_deleted' => 0])->num_rows();
        $pengunjung = $this->db->get('tb_pengunjung')->num_rows();

        $arrStatistik['pengguna'] = $pengguna;
        $arrStatistik['sayur'] = $sayur;
        $arrStatistik['wishlist'] = $wishlist;
        $arrStatistik['pengunjung'] = $pengunjung;

        return $arrStatistik;
    }

    function get_wishlist(){
        $this->db->select('a.*, b.nama, b.no_telp, b.profil, c.sayur, c.gambar, c.harga');
        $this->db->from('tb_wishlist a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id', 'left');
        $this->db->join('tb_sayur c', 'a.sayur_id = c.id', 'left');
        $this->db->where('a.is_deleted', 0);
        $this->db->order_by('a.created_at DESC');

        return $this->db->get()->result();
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

    // Sayur
    function get_sayur(){
        return $this->db->get_where('tb_sayur', ['is_deleted' => 0])->result();    
    }

    function tambah_sayur($gambar){
        $sayur = $this->input->post('sayur');
        $harga = $this->input->post('harga');
        $keterangan = $this->input->post('keterangan');

        $data = [
            'sayur' => $sayur,
            'gambar' => $gambar == null ? 'assets/images/placeholder.png' : $gambar,
            'harga' => $harga,
            'keterangan' => $keterangan
        ];

        $this->db->insert('tb_sayur', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function edit_sayur($gambar){
        $id = $this->input->post('id');

        $sayur = $this->input->post('sayur');
        $harga = $this->input->post('harga');
        $keterangan = $this->input->post('keterangan');

        $data = [
            'sayur' => $sayur,
            'gambar' => $gambar == null ? 'assets/images/placeholder.png' : $gambar,
            'harga' => str_replace('.', '', $harga),
            'keterangan' => $keterangan
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_sayur', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }

    function hapus_sayur(){
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('tb_sayur', ['is_deleted' => 1]);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
