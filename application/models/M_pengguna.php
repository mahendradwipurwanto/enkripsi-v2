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
        // $this->db->select('a.*, b.nama, b.no_telp, b.profil, d.sayur, d.gambar, d.harga, c.jumlah');
        // $this->db->from('tb_wishlist a');
        // $this->db->join('tb_user b', 'a.user_id = b.user_id', 'left');
        // $this->db->join('tb_wishlist_detail c', 'a.id = c.wishlist_id', 'left');
        // $this->db->join('tb_produk d', 'c.produk_id = d.id', 'left');
        // $this->db->where([ 'a.is_deleted' => 0, 'a.user_id' => $user_id]);
        // $this->db->order_by('a.created_at DESC');
        
        $this->db->select('a.*, b.nama, b.no_telp, b.profil');
        $this->db->from('tb_wishlist a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id', 'left');
        $this->db->where([ 'a.is_deleted' => 0, 'a.user_id' => $user_id]);
        $this->db->order_by('a.created_at DESC');

        $wishlist = $this->db->get()->result();

        if(empty($wishlist)){
            return $wishlist;
        }else{
            $arrProduk = [];
            foreach($wishlist as $key => $val):

                $this->db->select('a.wishlist_id, a.produk_id, a.jumlah, b.sayur, b.gambar');
                $this->db->from('tb_wishlist_detail a');
                $this->db->join('tb_produk b', 'a.produk_id = id', 'left');
                $this->db->where('a.wishlist_id', $val->id);
                $detailWishlist = $this->db->get()->result();

                $arrProduk[$key]['id'] = $val->id;
                $arrProduk[$key]['user_id'] = $val->user_id;
                $arrProduk[$key]['nama'] = $val->nama;
                $arrProduk[$key]['profil'] = $val->profil;
                $arrProduk[$key]['catatan'] = $val->catatan;
                $arrProduk[$key]['created_at'] = $val->created_at;
                $arrProduk[$key]['keranjang'] = $detailWishlist;
            endforeach;

            return $arrProduk;
        }
    }
}
