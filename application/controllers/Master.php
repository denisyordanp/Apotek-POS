<?php
class Master extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model("main_model");
        $this->load->model("MMaster");
        if(!$this->main_model->isLogin()) redirect(site_url());
    }

    public function product(){
        $data['product'] = $this->MMaster->getProduct();
        $data['unit'] = $this->MMaster->getUnit();
        $data['category'] = $this->MMaster->getCategory();
        $this->load->view("html/peng-master-produk", $data);
    }

    public function category(){
        $data['category'] = $this->MMaster->getCategory();
        $this->load->view("html/peng-master-golongan", $data);
    }

    public function unit(){
        $data['product'] = $this->MMaster->getProduct();
        $data['unit'] = $this->MMaster->getUnit();
        $data['category'] = $this->MMaster->getCategory();
        $this->load->view("html/peng-master-satuan", $data);
    }

    public function company(){
        $data['company'] = $this->MMaster->getCompany();
        $this->load->view("html/peng-master-perusahaan", $data);
    }

    public function saveCompany(){
        $post = $this->input->post();
        if($this->MMaster->saveCompany($post)){
            $this->session->set_flashdata('success','Berhasil menyimpan data perusahaan');
            redirect(site_url('master/company'));
        }else{
            $this->session->set_flashdata('error','Terjadi kesalahan, coba lagi');
            redirect(site_url('master/company'));
        }
    }

    public function addProduct(){
        $post = $this->input->post();
        if($this->MMaster->checkProduct($post['name'])){
            $add = $this->MMaster->addProduct($post['name'], $post['category'], $post['jual'], $post['beli'], $post['unit']);
            if($add){
                $this->session->set_flashdata('success','Berhasil menambah produk');
                redirect(site_url('master/product'));
            }else{
                $this->session->set_flashdata('error','Terjadi kesalahan, silahkan ulangi lagi');
                redirect(site_url('master/product'));
            }
        }else{
            $this->session->set_flashdata('error','Nama produk sudah ada, coba lagi');
            redirect(site_url('master/product'));
        }
    }

    public function editProduct(){
        $post = $this->input->post();
        if($this->MMaster->checkEditProduct($post['id_produk'], $post['name'])){
            $edit = $this->MMaster->editProduct($post['id_produk'], $post['name'], $post['category'], $post['jual'], $post['beli'], $post['unit']);
            if($edit){
                $this->session->set_flashdata('success','Berhasil merubah produk');
                redirect(site_url('master/product'));
            }else{
                $this->session->set_flashdata('error','Terjadi kesalahan, silahkan ulangi lagi');
                redirect(site_url('master/product'));
            }
        }else{
            $this->session->set_flashdata('error','Nama produk sudah ada, coba lagi');
            redirect(site_url('master/product'));
        }
    }

    public function deleteProduct(){
        $result = $this->MMaster->deleteProduct($this->input->post("id_produk"));
        if($result==1){
            $this->session->set_flashdata('success','Berhasil mengghapus produk');
            redirect(site_url('master/product'));
        }elseif($result==1451){
            $this->session->set_flashdata('error','Tidak dapat menghapus produk ini karena sudah terikat pada data Pembelian/Penjualan');
            redirect(site_url('master/product'));
        }else{
            $this->session->set_flashdata('error','Terjadi kesalahan, coba lagi');
            redirect(site_url('master/product'));
        }
    }

    public function addUnit(){
        $post = $this->input->post();
        if($this->MMaster->checkUnit($post['name'])){
            $add = $this->MMaster->addUnit($post['name']);
            if($add){
                $this->session->set_flashdata('success','Berhasil menambah satuan');
                redirect(site_url('master/unit'));
            }else{
                $this->session->set_flashdata('error','Terjadi kesalahan, silahkan ulangi lagi');
                redirect(site_url('master/unit'));
            }
        }else{
            $this->session->set_flashdata('error','Nama satuan sudah ada, coba lagi');
            redirect(site_url('master/unit'));
        }
    }

    public function deleteUnit(){
        $result = $this->MMaster->deleteUnit($this->input->post("id_satuan"));
        if($result==1){
            $this->session->set_flashdata('success','Berhasil mengghapus satuan');
            redirect(site_url('master/unit'));
        }elseif($result==1451){
            $this->session->set_flashdata('error','Satuan ini sudah terikat pada produk, silahkan hapus produk yang menggunakan satuan ini terlebih dahulu');
            redirect(site_url('master/unit'));
        }else{
            $this->session->set_flashdata('error','Terjadi kesalahan, coba lagi');
            redirect(site_url('master/unit'));
        }
    }

    public function addCategory(){
        $post = $this->input->post();
        if($this->MMaster->checkCategory($post['name'])){
            $add = $this->MMaster->addCategory($post['name']);
            if($add){
                $this->session->set_flashdata('success','Berhasil menambah golongan');
                redirect(site_url('master/category'));
            }else{
                $this->session->set_flashdata('error','Terjadi kesalahan, silahkan ulangi lagi');
                redirect(site_url('master/category'));
            }
        }else{
            $this->session->set_flashdata('error','Nama golongan sudah ada, coba lagi');
            redirect(site_url('master/category'));
        }
    }

    public function deleteCategory(){
        $result = $this->MMaster->deleteCategory($this->input->post("id_golongan"));
        if($result==1){
            $this->session->set_flashdata('success','Berhasil mengghapus golongan');
            redirect(site_url('master/category'));
        }elseif($result==1451){
            $this->session->set_flashdata('error','Golongan ini sudah terikat pada produk, silahkan hapus produk yang menggunakan golongan ini terlebih dahulu');
            redirect(site_url('master/category'));
        }else{
            $this->session->set_flashdata('error','Terjadi kesalahan, coba lagi');
            redirect(site_url('master/category'));
        }
    }
}
?>
