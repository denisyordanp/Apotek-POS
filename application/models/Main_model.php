<?php

class Main_model extends CI_Model
{
    private $users = "users";
    private $supplier = "supplier";
    private $product = "produk";
    private $pembelianProduct = "pembelian_produk";
    private $golongan = "golongan_obat";
    private $satuan = "satuan_obat";
    private $company = "perusahaan";

    public function login($username){
        $this->db->where('username', $username);
		return $this->db->get($this->users)->row();
    }

    public function getSupplier(){
		  return $this->db->get($this->supplier)->result();
    }

    public function getCompany(){
        return $this->db->get($this->company)->result();
  }

    public function getStock(){
      $this->db->select('*');
      $this->db->from($this->pembelianProduct);
      $this->db->join($this->product, 'pembelian.id_produk = produk.id_produk');
      $this->db->join($this->golongan, 'produk.id_golongan = golongan_obat.id_golongan');
      $this->db->join($this->satuan, 'produk.id_satuan = satuan_obat.id_satuan');
      return $this->db->get()->result();
    }

    public function isLogin(){
        return $this->session->userdata('user')!=null;
    }

    public function updateLastLogin($user_id){
        $sql = "UPDATE {$this->users} SET last_login=now() WHERE user_id={$user_id}";
        $this->db->query($sql);
    }

}
