<?php
class Main extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model("main_model");
        $this->load->library('session');
        if(!$this->main_model->isLogin()) redirect(site_url());
    }

    public function index(){
        // $data['stock'] = $this->main_model->getStock();
        // $this->load->view("html/penjualan", $data);
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
        redirect(base_url());
    }
}
?>
