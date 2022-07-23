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

    function get_produkHome($cari = null){
        $this->db->select('a.*');
        $this->db->from('tb_produk a');
        $this->db->where('a.is_deleted', 0);
        if($cari != null){
            $this->db->like('produk', $cari);
        }
        $this->db->order_by('a.created_at DESC');

        return $this->db->get()->result();
    }

    function cek_produk($id){
        $cek = $this->db->get_where('tb_produk', ['is_deleted' => 0, 'id' => $id])->num_rows();
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

    function get_produk($id, $jumlah){
        $produk = $this->db->get_where('tb_produk', ['id' => $id])->row();

        if(isset($produk)){
            if($produk->stok >= $jumlah){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    function updateJumlahProduk($id, $jumlah){
        $produk = $this->db->get_where('tb_produk', ['id' => $id])->row();

        $stok_baru = $produk->stok-$jumlah;
        $this->db->where('id', $id);
        $this->db->update('tb_produk', ['stok' => $stok_baru]);
    }


    function tambah_checkout(){
        $this->db->trans_strict(false);

        $catatan = $this->input->post('catatan');

        $data = [
            'user_id' => $this->session->userdata('user_id'),
            'catatan' => $catatan,
            'created_at' => time()
        ];
        $this->db->trans_begin();
        $this->db->insert('tb_checkout', $data);
        $wish_id = $this->db->insert_id();

        foreach($this->session->userdata('keranjang') as $key => $val):
            $arrDetail = [
                'checkout_id' => $wish_id,
                'jumlah' => $val['jumlah'],
                'produk_id' => $val['produk_id']
            ];

            $this->db->insert('tb_checkout_detail', $arrDetail);
        endforeach;
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
    }
}
