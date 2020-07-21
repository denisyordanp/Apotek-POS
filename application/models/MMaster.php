<?php

class MMaster extends CI_Model
{
    private $golongan = "golongan_obat";
    private $satuan = "satuan_obat";
    private $product = "produk";
    private $company = "perusahaan";

    public function getCategory(){
        return $this->db->get($this->golongan)->result();
    }

    public function getUnit(){
        return $this->db->get($this->satuan)->result();
    }

    public function getProduct(){
        $this->db->select('*');
        $this->db->from($this->product);
        $this->db->join($this->golongan, 'produk.id_golongan = golongan_obat.id_golongan');
        $this->db->join($this->satuan, 'produk.id_satuan = satuan_obat.id_satuan');
        return $this->db->get()->result();
    }

    public function getCompany(){
        return $this->db->get($this->company)->result();
    }

    public function saveCompany($post){
        $data = [
            'nama_perusahaan' => $post['nama'],
            'alamat_perusahaan' => $post['alamat'],
            'telp_perusahaan' => $post['telp'],
            'kota_perusahaan' => $post['kota'],
            'penanggung_jawab' => $post['penanggung']
        ];
        $this->db->where('id_perusahaan', '1');
        return $this->db->update($this->company, $data);
    }

    public function checkProduct($name){
        $this->db->where('nama_produk', $name);
        $data = $this->db->get($this->product)->row();
        return !count($data)>0;
    }

    public function checkEditProduct($id, $name){
        $this->db->where('id_produk !=', $id);
        $this->db->where('nama_produk', $name);
        $data = $this->db->get($this->product)->row();
        return !count($data)>0;
    }

    public function addProduct($name, $category, $sell, $buy, $unit){
        $data = [
            'nama_produk' => $name,
            'id_golongan' => $category,
            'id_satuan' => $unit,
            'harga_beli' => $buy,
            'harga_jual' => $sell
        ];
		return $this->db->insert($this->product, $data);
    }

    public function editProduct($id, $name, $category, $sell, $buy, $unit){
        $data = [
            'nama_produk' => $name,
            'id_golongan' => $category,
            'id_satuan' => $unit,
            'harga_beli' => $buy,
            'harga_jual' => $sell
        ];
        $this->db->where("id_produk", $id);
		return $this->db->update($this->product, $data);
    }

    public function deleteProduct($id){
        $this->db->where('id_produk', $id);
        $this->db->delete($this->product);
        if($this->db->affected_rows() != 1)
            return $this->db->error()['code'];
        else
            return 1;
    }

    public function checkCategory($name){
        $this->db->where('golongan', $name);
        $data = $this->db->get($this->golongan)->row();
        return !count($data)>0;
    }

    public function addCategory($name){
        $data = [
            'golongan' => $name
        ];
		return $this->db->insert($this->golongan, $data);
    }

    public function deleteUnit($id){
        $this->db->where('id_satuan', $id);
        $this->db->delete($this->satuan);
        if($this->db->affected_rows() != 1)
            return $this->db->error()['code'];
        else
            return 1;
    }

    public function checkUnit($name){
        $this->db->where('satuan', $name);
        $data = $this->db->get($this->satuan)->row();
        return !count($data)>0;
    }

    public function addUnit($name){
        $data = [
            'satuan' => $name
        ];
		return $this->db->insert($this->satuan, $data);
    }

    public function deleteCategory($id){
        $this->db->where('id_golongan', $id);
        $this->db->delete($this->golongan);
        if($this->db->affected_rows() != 1)
            return $this->db->error()['code'];
        else
            return 1;
    }

}
