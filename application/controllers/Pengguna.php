<?php
class Pengguna extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model("main_model");
        $this->load->model("MPengguna");
        if(!$this->main_model->isLogin()) redirect(site_url());
    }

    public function index(){
        $data['users'] = $this->MPengguna->getUser();
        $this->load->view("html/pengaturan-pengguna", $data);
    }

    public function add(){
        $post = $this->input->post();
        if($this->MPengguna->checkUsername($post['username'], "")){
            if($this->MPengguna->checkTelephone($post['telephone'], "")){
                $add = $this->MPengguna->add($post['username'], $post['name'], $post['telephone'], $post['password']);
                if($add){
                    $this->session->set_flashdata('success','Berhasil menambah pengguna');
                    redirect(site_url('pengguna'));
                }else{
                    $this->session->set_flashdata('error','Terjadi kesalahan, silahkan ulangi lagi');
                    redirect(site_url('pengguna'));
                }
            }else{
                $this->session->set_flashdata('error','Telephone sudah digunakan, coba lagi');
                redirect(site_url('pengguna'));
            }
        }else{
            $this->session->set_flashdata('error','Username sudah digunakan, coba lagi');
            redirect(site_url('pengguna'));
        }
    }

    public function edit(){
        $post = $this->input->post();
        if($this->MPengguna->checkUsername($post['username'], $post['user_id'])){
            if($this->MPengguna->checkTelephone($post['telephone'], $post['user_id'])){
                $edit = $this->MPengguna->edit($post['user_id'], $post['username'], $post['name'], $post['telephone']);
                if($edit){
                    $this->session->set_flashdata('success','Berhasil merubah pengguna');
                    redirect(site_url('pengguna'));
                }else{
                    $this->session->set_flashdata('error','Terjadi kesalahan, silahkan ulangi lagi');
                    redirect(site_url('pengguna'));
                }
            }else{
                $this->session->set_flashdata('error','Telephone sudah digunakan, coba lagi');
                redirect(site_url('pengguna'));
            }
        }else{
            $this->session->set_flashdata('error','Username sudah digunakan, coba lagi');
            redirect(site_url('pengguna'));
        }
    }

    public function hapus(){
        $id = $this->input->post("user_id");
        if($id!=$this->session->userdata('user')->user_id){
            if($id==1){
                $this->session->set_flashdata('error','Tidak dapat menghapus akun Superadmin');
                redirect(site_url('pengguna'));
            }else{
                if($this->MPengguna->delete($id)){
                    $this->session->set_flashdata('success','Berhasil mengghapus pengguna');
                    redirect(site_url('pengguna'));
                }else{
                    $this->session->set_flashdata('error','Terjadi kesalahan, coba lagi');
                    redirect(site_url('pengguna'));
                }
            }
        }else{
            $this->session->set_flashdata('error','Tidak dapat menghapus akun anda sendiri');
            redirect(site_url('pengguna'));
        }
    }
}
?>
