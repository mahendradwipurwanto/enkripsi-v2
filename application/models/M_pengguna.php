<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pengguna extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Dashboard
    public function get_wishlistPengguna($user_id)
    {
        $this->db->select('a.*, b.nama, b.no_telp, b.profil, c.sayur, c.gambar, c.harga');
        $this->db->from('tb_wishlist a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id', 'left');
        $this->db->join('tb_sayur c', 'a.sayur_id = c.id', 'left');
        $this->db->where([ 'a.is_deleted' => 0, 'a.user_id' => $user_id]);
        $this->db->order_by('a.created_at DESC');

        return $this->db->get()->result();
    }
}
