<?php

class MPengguna extends CI_Model
{
    private $users = "users";

    public function getUser(){
        return $this->db->get($this->users)->result();
    }

    public function checkUsername($username, $id){
        if(!empty($id)){
            $this->db->where('user_id !=', $id);
        }
        $this->db->where('username', $username);
        $data = $this->db->get($this->users)->row();
        return !count($data)>0;
    }

    public function checkTelephone($telephone, $id){
        if(!empty($id)){
            $this->db->where('user_id !=', $id);
        }
        $this->db->where('phone_user', $telephone);
        $data = $this->db->get($this->users)->row();
        return !count($data)>0;
    }

    public function add($username, $name, $telephone, $password){
        $data = [
            'username' => $username,
            'nama_user' => $name,
            'phone_user' => $telephone,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
		return $this->db->insert($this->users, $data);
    }

    public function edit($id, $username, $name, $telephone){
        $data = [
            'username' => $username,
            'nama_user' => $name,
            'phone_user' => $telephone
        ];
        $this->db->where('user_id', $id);
		return $this->db->update($this->users, $data);
    }

    public function delete($id){
        $this->db->where('user_id', $id);
        $this->db->delete($this->users);
        if($this->db->affected_rows() != 1)
            return false;
        else
            return true;
    }

}
