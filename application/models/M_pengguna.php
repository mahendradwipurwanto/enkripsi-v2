<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pengguna extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // Dashboard
    public function get_dataPengguna($user_id){
        $this->db->select('*');
        $this->db->from('tb_auth a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id');
        $this->db->where('a.user_id', $user_id);
        return $this->db->get()->row();
    }
    public function get_checkoutPengguna($user_id)
    {
        // $this->db->select('a.*, b.nama, b.no_telp, b.profil, d.produk, d.gambar, d.harga, c.jumlah');
        // $this->db->from('tb_checkout a');
        // $this->db->join('tb_user b', 'a.user_id = b.user_id', 'left');
        // $this->db->join('tb_checkout_detail c', 'a.id = c.checkout_id', 'left');
        // $this->db->join('tb_produk d', 'c.produk_id = d.id', 'left');
        // $this->db->where([ 'a.is_deleted' => 0, 'a.user_id' => $user_id]);
        // $this->db->order_by('a.created_at DESC');
        
        $this->db->select('a.*, b.nama, b.no_telp, b.profil, a.metode, a.status, a.bukti_bayar');
        $this->db->from('tb_checkout a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id', 'left');
        $this->db->where([ 'a.is_deleted' => 0, 'a.user_id' => $user_id]);
        $this->db->order_by('a.created_at DESC');

        $checkout = $this->db->get()->result();

        if(empty($checkout)){
            return $checkout;
        }else{
            $arrProduk = [];
            foreach($checkout as $key => $val):

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
}
