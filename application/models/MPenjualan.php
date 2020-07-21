<?php

class MPenjualan extends CI_Model
{
    private $product = "produk";
    private $golongan = "golongan_obat";
    private $satuan = "satuan_obat";
    private $penjualanProduct = "penjualan_produk";
    private $penjualan = "penjualan";
    private $users = "users";

    public function getProduct(){
      $this->db->select('*');
      $this->db->from($this->product);
      $this->db->join($this->golongan, 'produk.id_golongan = golongan_obat.id_golongan');
      $this->db->join($this->satuan, 'produk.id_satuan = satuan_obat.id_satuan');
      return $this->db->get()->result();
    }

    public function getSellesProduct(){
      $this->db->select('*');
      $this->db->from($this->penjualanProduct);
      $this->db->join($this->penjualan, 'penjualan.id_penjualan = penjualan_produk.id_penjualan');
      $this->db->join($this->users, 'users.user_id = penjualan.user_id');
      $this->db->join($this->product, 'penjualan_produk.id_produk = produk.id_produk');
      $this->db->join($this->golongan, 'produk.id_golongan = golongan_obat.id_golongan');
      $this->db->join($this->satuan, 'produk.id_satuan = satuan_obat.id_satuan');
      $this->db->order_by('penjualan.id_penjualan');
      return $this->db->get()->result();
    }

    public function getSellesProductPeriod($start, $end){
      $this->db->select('*');
      $this->db->from($this->penjualanProduct);
      $this->db->join($this->penjualan, 'penjualan.id_penjualan = penjualan_produk.id_penjualan');
      $this->db->join($this->users, 'users.user_id = penjualan.user_id');
      $this->db->join($this->product, 'penjualan_produk.id_produk = produk.id_produk');
      $this->db->join($this->golongan, 'produk.id_golongan = golongan_obat.id_golongan');
      $this->db->join($this->satuan, 'produk.id_satuan = satuan_obat.id_satuan');
      $this->db->where('tanggal_penjualan >=', $start);
      $this->db->where('tanggal_penjualan <', $end);
      $this->db->order_by('penjualan.id_penjualan');
      return $this->db->get()->result();
    }

    public function getSelles($date, $dateNext){
      $this->db->select('*');
      $this->db->from($this->penjualan);
      $this->db->join($this->users, 'users.user_id = penjualan.user_id');
      $this->db->where('tanggal_penjualan >=', $date);
      $this->db->where('tanggal_penjualan <', $dateNext);
      return $this->db->get()->result();
    }

    public function addSeller($id, $date, $user, $discount){
      if($discount!=null){
        $data = [
          'id_penjualan' => $id,
          'tanggal_penjualan' => $date,
          'user_id' => $user,
          'diskon' => $discount['diskon'],
          'tipe_diskon' => $discount['tipe']
        ];
      }else{
        $data = [
          'id_penjualan' => $id,
          'tanggal_penjualan' => $date,
          'user_id' => $user
        ];
      }
      return $this->db->insert($this->penjualan, $data);
  }

  public function addSellerProduct($id, $data){
      foreach($data as $index){
          $form_data[] = array(
              'id_penjualan' => $id,
              'id_produk' => $index['id_produk'],
              'penjualan' => $index['jumlah']
              );
      }
    return $this->db->insert_batch($this->penjualanProduct, $form_data);
  }

}
