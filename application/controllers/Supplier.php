<?php
class Supplier extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model("main_model");
        $this->load->model("MSupplier");
        $this->load->library('session');
        if(!$this->main_model->isLogin()) redirect(site_url());
    }

    public function index(){
        $data['suppliers'] = $this->main_model->getSupplier();
        $this->load->view("html/supplier", $data);
    }

    public function add(){
        $post = $this->input->post();
        if($this->MSupplier->checkSupplier($post['name'], "")){
            $add = $this->MSupplier->addSupplier($post['name'], $post['alamat'], $post['telepon']);
            if($add){
                $this->session->set_flashdata('success','Berhasil menambah supplier');
                redirect(site_url('supplier'));
            }else{
                $this->session->set_flashdata('error','Terjadi kesalahan, silahkan ulangi lagi');
                redirect(site_url('supplier'));
            }
        }else{
            $this->session->set_flashdata('error','Nama supplier sudah ada, coba lagi');
            redirect(site_url('supplier'));
        }
    }

    public function edit(){
        $post = $this->input->post();
        if($this->MSupplier->checkSupplier($post['name'], $post['id_supplier'])){
            $edit = $this->MSupplier->editSupplier($post['id_supplier'], $post['name'], $post['alamat'], $post['telepon']);
            if($edit){
                $this->session->set_flashdata('success','Berhasil merubah supplier');
                redirect(site_url('supplier'));
            }else{
                $this->session->set_flashdata('error','Terjadi kesalahan, silahkan ulangi lagi');
                redirect(site_url('supplier'));
            }
        }else{
            $this->session->set_flashdata('error','Nama supplier sudah ada, coba lagi');
            redirect(site_url('supplier'));
        }
    }

    public function delete(){
        $result = $this->MSupplier->deleteSupplier($this->input->post("id_supplier"));
        if($result==1){
            $this->session->set_flashdata('success','Berhasil mengghapus supplier');
            redirect(site_url('supplier'));
        }elseif($result==1451){
            $this->session->set_flashdata('error','Supplier ini sudah terikat pada pembelian produk, silahkan hapus pembelian produk yang menggunakan supplier ini terlebih dahulu');
            redirect(site_url('supplier'));
        }else{
            $this->session->set_flashdata('error','Terjadi kesalahan, coba lagi');
            redirect(site_url('supplier'));
        }
    }
}
?>
