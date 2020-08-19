<?php
class Pembelian extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->library('session');
        $this->load->model("main_model");
        $this->load->model("MPembelian");
        $this->load->model("MMaster");
        if(!$this->main_model->isLogin()) redirect(site_url());
    }

    public function pembelian(){
        $data['product'] = $this->MMaster->getProduct();
        $data['supplier'] = $this->main_model->getSupplier();

        $arr = [];
        $buy = $this->session->userdata('purchase');
        if(!empty($buy)){
            foreach($buy as $index){
                $list = $this->MPembelian->getProductById($index['id_produk']);
                $list->kadaluarsa = $index['kadaluarsa'];
                $list->no_batch = $index['no_batch'];
                $list->jumlah = $index['jumlah'];
                array_push($arr, $list);
            }
        }
        $data['buy'] = $arr;

        $this->load->view("html/pemb-pembelian", $data);
    }

    public function addProduct(){
        $post = $this->input->post();
        $arr = [];
        $old = $this->session->userdata('purchase');
        if(!empty($old)){
            $arr = $old;
        }
        $data = [
            'id_produk' => $post['product'],
            'jumlah' => $post['jumlah'],
            'kadaluarsa' => $post['kadaluarsa'],
            'no_batch' => $post['batch']
        ];
        array_push($arr, $data);

        $this->session->set_userdata(['purchase' => $arr]);
        
        redirect(site_url('pembelian/pembelian'));
    }

    public function purchase(){
        $post = $this->input->post();
        $id = $post['id_pembelian'];
        $add = $this->MPembelian->addPurchase($id, date("Y-m-d H:m:s", strtotime($post['tanggal'])), $post['supplier'], $post['user']);
        if($add==true){
            if($this->MPembelian->addPurchaseProduct($id, $this->session->userdata('purchase'))){
                $this->session->set_flashdata('success','Pembelian berhasil disimpan');
                $this->session->unset_userdata('purchase');
                redirect(site_url('pembelian/pembelian'));
            }else{
                $this->session->set_flashdata('error','Terjadi kesalahan produk, coba lagi');
                redirect(site_url('pembelian/pembelian'));
            }
        }else{
            $this->session->set_flashdata('error','Terjadi kesalahan pembelian, coba lagi');
            redirect(site_url('pembelian/pembelian'));
        }
    }

    public function reset(){
        $this->session->unset_userdata('purchase');
        redirect(site_url('pembelian/pembelian'));
    }
}
?>
