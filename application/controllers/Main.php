<?php
class Main extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model("main_model");
        $this->load->library('session');
        if(!$this->main_model->isLogin()) redirect(site_url());
    }

    public function supplier(){
        $data['suppliers'] = $this->main_model->getSupplier();
        $this->load->view("html/supplier", $data);
    }

    public function lap_penjualan(){
        $this->load->view("html/laporan-penjualan");
    }

    public function lap_stok(){
        $this->load->view("html/laporan-stok");
    }

    public function peng_pengguna(){
        $data['users'] = $this->main_model->getUser();
        $this->load->view("html/pengaturan-pengguna", $data);
    }

    public function logout(){
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('discount');
        $this->session->unset_userdata('purchase');
        $this->session->unset_userdata('seller');
        redirect(base_url());
    }
}
?>
