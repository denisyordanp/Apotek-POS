<?php
class Penjualan extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model("MPenjualan");
        $this->load->model("MPembelian");
        $this->load->model("MMaster");
        $this->load->model("main_model");
        $this->load->library('session');
        if(!$this->main_model->isLogin()) redirect(site_url());
    }

    public function index(){
        $data['stock'] = $this->calculateStock();
        $data['product'] = $this->MMaster->getProduct();
        $data['salles'] = $this->MPenjualan->getSelles(date('Y-m-d'), date('Y-m-d', strtotime(' +1 day')));
        $data['sallesProduct'] = $this->MPenjualan->getSellesProduct();
        $data['company'] = $this->main_model->getCompany();
        $arr = [];
        $sell = $this->session->userdata('seller');
        if(!empty($sell)){
            foreach($sell as $index){
                $list = $this->MPembelian->getProductById($index['id_produk']);
                $list->jumlah = $index['jumlah'];
                array_push($arr, $list);
            }
        }
        $data['sell'] = $arr;
        
        $this->load->view("html/penjualan", $data);
    }

    private function calculateStock(){
        $product = $this->MPenjualan->getProduct();
        $purchase = $this->MPembelian->getPurchaseProduct();
        $salles = $this->MPenjualan->getSellesProduct();
        foreach($product as $key => $index1){
            $id = $index1->id_produk;
            $total = 0;
            foreach($purchase as $index2){
                if($index2->id_produk==$id){
                    $total = $total + $index2->pembelian;
                }
            }
            foreach($salles as $index3){
                if($index3->id_produk==$id){
                    $total = $total - $index3->penjualan;
                }
            }
            $product[$key]->stok = $total;
        }
        return $product;
    }

    public function addProduct(){
        $post = $this->input->post();
        $arr = [];
        $old = $this->session->userdata('seller');
        if(!empty($old)){
            $arr = $old;
        }
        $data = [
            'id_produk' => $post['product'],
            'jumlah' => $post['jumlah']
        ];
        array_push($arr, $data);

        $this->session->set_userdata(['seller' => $arr]);
        
        redirect(site_url('penjualan'));
    }

    public function addDiscount(){
        $post = $this->input->post();
        $data = [
            'tipe_diskon' => $post['tipe_diskon'],
            'diskon' => $post['diskon']
        ];
        $this->session->unset_userdata('discount');
        $this->session->set_userdata(['discount' => $data]);
        
        redirect(site_url('penjualan'));
    }

    public function delDiscount(){
        $this->session->unset_userdata('discount');
        redirect(site_url('penjualan'));
    }

    public function seller(){
        $post = $this->input->post();
        $id = $post['id_penjualan'];
        if($this->session->userdata('discount')!=null){
            $discount = [
                'diskon' => $this->session->userdata('discount')['diskon'],
                'tipe' => $this->session->userdata('discount')['tipe_diskon']
            ];
        }
        $add = $this->MPenjualan->addSeller($id, date("Y-m-d H:m:s", strtotime($post['tanggal'])), $post['user'], $discount);
        if($add){
            if($this->MPenjualan->addSellerProduct($id, $this->session->userdata('seller'))){
                $this->session->set_flashdata('success','Penjualan berhasil disimpan');
                $this->session->unset_userdata('seller');
                $this->session->unset_userdata('discount');
                redirect(site_url('penjualan'));
            }else{
                $this->session->set_flashdata('error','Terjadi kesalahan produk, coba lagi');
                redirect(site_url('penjualan'));
            }
        }else{
            $this->session->set_flashdata('error','Terjadi kesalahan penjualan, coba lagi');
            redirect(site_url('penjualan'));
        }
    }

    public function reset(){
        $this->session->unset_userdata('seller');
        redirect(site_url('penjualan'));
    }
}
?>
