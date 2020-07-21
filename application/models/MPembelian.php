<?php

class MPembelian extends CI_Model
{
    private $golongan = "golongan_obat";
    private $satuan = "satuan_obat";
    private $product = "produk";
    private $pembelian = "pembelian";
    private $pembelianProduk = "pembelian_produk";
    private $users = "users";
    private $supplier = "supplier";

    public function getPurchase(){
        $this->db->select('*');
        $this->db->from($this->pembelian);
        $this->db->join($this->supplier, 'supplier.id_supplier = pembelian.id_supplier');
        $this->db->join($this->users, 'users.user_id = pembelian.user_id');
        return $this->db->get()->result();
    }

    public function getPurchaseProduct(){
        $this->db->select('*');
        $this->db->from($this->pembelianProduk);
        $this->db->join($this->pembelian, 'pembelian.id_pembelian = pembelian_produk.id_pembelian');
        $this->db->join($this->supplier, 'supplier.id_supplier = pembelian.id_supplier');
        $this->db->join($this->users, 'users.user_id = pembelian.user_id');
        $this->db->join($this->product, 'pembelian_produk.id_produk = produk.id_produk');
        $this->db->join($this->golongan, 'produk.id_golongan = golongan_obat.id_golongan');
        $this->db->join($this->satuan, 'produk.id_satuan = satuan_obat.id_satuan');
        $this->db->order_by('pembelian.id_pembelian');
        return $this->db->get()->result();
    }

    public function getProductById($id){
        $this->db->select('*');
        $this->db->from($this->product);
        $this->db->join($this->golongan, 'produk.id_golongan = golongan_obat.id_golongan');
        $this->db->join($this->satuan, 'produk.id_satuan = satuan_obat.id_satuan');
        $this->db->where('id_produk', $id);
        return $this->db->get()->row();
    }

    public function addPurchase($id, $date, $supplier, $user){
        $data = [
            'id_pembelian' => $id,
            'tanggal_pembelian' => $date,
            'id_supplier' => $supplier,
            'user_id' => $user
        ];
        return $this->db->insert($this->pembelian, $data);
    }

    public function addPurchaseProduct($id, $data){
        foreach($data as $index){
            $form_data[] = array(
                'id_pembelian' => $id,
                'id_produk' => $index['id_produk'],
                'pembelian' => $index['jumlah'],
                'expire_date' => $index['kadaluarsa'],
                'no_batch' => $index['no_batch']
                );
        }
		return $this->db->insert_batch($this->pembelianProduk, $form_data);
    }

}
