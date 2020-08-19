<?php

class MSupplier extends CI_Model
{
    private $supplier = "supplier";

    public function getSupplier(){
        return $this->db->get($this->supplier)->result();
    }

    public function addSupplier($name, $alamat, $telephone){
        $data = [
            'nama_supplier' => $name,
            'alamat' => $alamat,
            'phone' => $telephone
        ];
		return $this->db->insert($this->supplier, $data);
    }

    public function editSupplier($id, $name, $alamat, $telephone){
        $data = [
            'nama_supplier' => $name,
            'alamat' => $alamat,
            'phone' => $telephone
        ];
        $this->db->where('id_supplier', $id);
		return $this->db->update($this->supplier, $data);
    }

    public function deleteSupplier($id){
        $this->db->where('id_supplier', $id);
        $this->db->delete($this->supplier);
        if($this->db->affected_rows() != 1)
            return $this->db->error()['code'];
        else
            return 1;
    }

    public function checkSupplier($name, $id){
        if(!empty($id)){
            $this->db->where('id_supplier !=', $id);
        }
        $this->db->where('nama_supplier', $name);
        $data = $this->db->get($this->supplier)->row();
        return !count($data)>0;
    }
}
