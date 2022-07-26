<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function log_time($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->update('tb_auth', ['modified_at' => time()]);
    }

    public function getSetting($key){
        $data = $this->db->get_where('tb_settings', ['key' => $key])->row()->value;
        if(isset($data)){
            return $data;
        }else{
            return false;
        }
    }

    public function cek_user($email)
    {
        $this->db->select('*');
        $this->db->from('tb_auth a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id');
        $this->db->where('a.email', $email);
        $query = $this->db->get();
    
        // jika hasil dari query diatas memiliki lebih dari 0 record
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_user($email)
    {
        $this->db->select('*');
        $this->db->from('tb_auth a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id');
        $this->db->where(['a.email' => $email, 'is_deleted' => 0]);
        $query = $this->db->get();
    
        // jika hasil dari query diatas memiliki lebih dari 0 record
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_userByID($user_id)
    {
        $this->db->select('*');
        $this->db->from('tb_auth a');
        $this->db->join('tb_user b', 'a.user_id = b.user_id');
        $this->db->where(['a.user_id' => $user_id, 'is_deleted' => 0]);
        
        $query = $this->db->get();
    
        // jika hasil dari query diatas memiliki lebih dari 0 record
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function add_user($data_auth)
    {
        $nama           = htmlspecialchars($this->input->post('nama'));
        $jk             = htmlspecialchars($this->input->post('jk'));
        $no_telp        = htmlspecialchars($this->input->post('no_telp'));
        $pekerjaan      = htmlspecialchars($this->input->post('pekerjaan'));
        $alamat         = htmlspecialchars($this->input->post('alamat'));
        $gaji           = $this->input->post('gaji');

        $this->db->insert('tb_auth', $data_auth);

        $data_user = array(
            'user_id'   => $this->db->insert_id(),
            'nama'      => $nama,
            'profil'    => 'assets/images/profile.png',
            'no_telp'   => $no_telp,
            'alamat'    => $alamat,
            'jk'        => $jk,
            'pekerjaan' => $pekerjaan,
            'gaji'      => $gaji
        );

        $this->db->insert('tb_user', $data_user);
        return $this->db->affected_rows() == true;
    }

    public function update_password($data_user, $where)
    {
        $this->db->where($where);
        $this->db->update('tb_auth', $data_user);
        return $this->db->affected_rows() == true;
    }
  
    // CODE 6 digit generator

    public function cek_kode($kode)
    {
        $kode = $this->db->escape($kode);
        $query = $this->db->query("SELECT * FROM tb_auth WHERE aktivasi = $kode || otp = $kode");
        return $query->num_rows();
    }

    public function create_kode()
    {
    
        // CREATE KODE
        $this->encryption->initialize(array('driver' => 'openssl'));

        do {
            $KODE = sprintf("%06d", mt_rand(1, 999999));
      
            // ENCRYPT KODE
            $ciphercode = $this->encryption->encrypt($KODE);
        } while ($this->cek_kode($KODE) > 0);

        return $ciphercode;
    }
  
    // OTP

    public function create_otp($user_id)
    {
        $this->db->where('user_id', $user_id);
        $this->db->update('tb_auth', array('otp' => $this->create_kode(), 'expired_otp' => time()));
        return $this->db->affected_rows() == true;
    }

    public function cekOtp_kode($kode_otp, $user_id)
    {
        $db_code = $this->encryption->decrypt($this->get_userByID($user_id)->otp);

        if ($kode_otp == $db_code) {
            return true;
        } else {
            return false;
        }
    }

    public function get_dataOTP($user_id)
    {
        $query = $this->db->get_where('tb_auth', array('user_id' => $user_id));
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
  
    // AKTIVASI

    public function get_aktivasi($user_id)
    {
        $user_id = $this->db->escape($user_id);
        $query = $this->db->query("SELECT * FROM tb_auth WHERE user_id = $user_id");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function aktivasi_kode($kode_aktivasi, $user_id)
    {
        $db_code = $this->encryption->decrypt($this->get_aktivasi($user_id)->aktivasi);

        if ($kode_aktivasi == $db_code) {
            return true;
        } else {
            return false;
        }
    }

    public function aktivasi_akun($user_id)
    {
        $data = array('status' => 1);

        $this->db->where('user_id', $user_id);
        $this->db->update('tb_auth', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
