<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_home extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function add_pengunjung($device){
        $data = [
            'device' => $device,
            'created_at' => time()
        ];

        $this->db->insert('tb_pengunjung', $data);
    }

    function get_sayurHome($cari = null){
        $this->db->select('a.*');
        $this->db->from('tb_sayur a');
        $this->db->where('a.is_deleted', 0);
        if($cari != null){
            $this->db->like('sayur', $cari);
        }
        $this->db->order_by('a.created_at DESC');

        return $this->db->get()->result();
    }

    function cek_sayur($id){
        $cek = $this->db->get_where('tb_sayur', ['is_deleted' => 0, 'id' => $id])->num_rows();
        if($cek > 0){
            return true;
        }else{
            return false;
        }
    }

    function cek_aktivasi($id_user)
    {
        $query = $this->db->get_where('tb_auth', array('user_id' => $id_user))->row();
        if ($query->status == 0) {
            return true;
        } else {
            return false;
        }
    }


    function tambah_wishlist($id){
        $jumlah = $this->input->post('jumlah');
        $catatan = $this->input->post('catatan');

        $data = [
            'user_id' => $this->session->userdata('user_id'),
            'sayur_id' => $id,
            'jumlah' => $jumlah,
            'catatan' => $catatan,
            'created_at' => time()
        ];

        $this->db->insert('tb_wishlist', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
