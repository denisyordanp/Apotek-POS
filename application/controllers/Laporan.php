<?php
class Laporan extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model("MPenjualan");
        $this->load->model("MPembelian");
        $this->load->model("MSupplier");
        $this->load->model("MPengguna");
        $this->load->model("MMaster");
        $this->load->model("main_model");
        $this->load->library('session');
        if(!$this->main_model->isLogin()) redirect(site_url());
    }

    public function stok(){
        $data['stok'] = $this->calculateStock();
        $data['date'] = $this->getdate(date('m'), date('Y'));
        $this->load->view("html/laporan-stok", $data);
    }

    public function penjualan(){
        $penjualan = "";
        $produk = "";
        $period = $this->session->flashdata('period');
        if($period!=null){
            $from = $period['from'];
            $until = $period['until'];
            $penjualan = $period['penjualan'];
            $produk = $period['produk'];
            $data['date'] = [
                'date_from' => date('d', strtotime($from)).' '.$this->getdate(date('m', strtotime($from)), date('Y', strtotime($until))),
                'date_until' => date('d', strtotime($until)).' '.$this->getdate(date('m', strtotime($until)), date('Y', strtotime($until))),
                'from' => $from,
                'until' => $until,
                'penjualan' => $penjualan,
                'produk' => $produk
            ];
            $start = $from;
            $end = $until;
        }else{
            $now = date('Y-m-01');
            $data['date'] = [
                'date_from' => '01 '.$this->getdate(date('m'), date('Y')),
                'date_until' => '01 '.$this->getdate(date('m', strtotime('+1 month')), date('Y', strtotime('+1 month'))),
                'from' => $now,
                'until' => date('Y-m-01', strtotime($now.'+1 month')),
                'penjualan' => $penjualan,
                'produk' => $produk
            ];
            $start = $now;
            $end = date('Y-m-01', strtotime($now.' +1 month'));
        }
        $data['product'] = $this->MPenjualan->getProduct();
        $data['seller'] = $this->MPenjualan->getSelles("","");
        $data['salles'] = $this->MPenjualan->getSellesProductPeriod($start, $end, $produk, $penjualan);
        $this->load->view("html/laporan-penjualan", $data);
    }

    public function pembelian(){
        $pembelian = "";
        $supplier = "";
        $period = $this->session->flashdata('period');
        if($period!=null){
            $from = $period['from'];
            $until = $period['until'];
            $pembelian = $period['pembelian'];
            $supplier = $period['supplier'];
            $data['date'] = [
                'date_from' => date('d', strtotime($from)).' '.$this->getdate(date('m', strtotime($from)), date('Y', strtotime($until))),
                'date_until' => date('d', strtotime($until)).' '.$this->getdate(date('m', strtotime($until)), date('Y', strtotime($until))),
                'from' => $from,
                'until' => $until,
                'supplier' => $supplier,
                'pembelian' => $pembelian
            ];
            $start = $from;
            $end = $until;
        }else{
            $now = date('Y-m-01');
            $data['date'] = [
                'date_from' => '01 '.$this->getdate(date('m'), date('Y')),
                'date_until' => '01 '.$this->getdate(date('m', strtotime('+1 month')), date('Y', strtotime('+1 month'))),
                'from' => $now,
                'until' => date('Y-m-01', strtotime($now.'+1 month')),
                'supplier' => $supplier,
                'pembelian' => $pembelian
            ];
            $start = $now;
            $end = date('Y-m-01', strtotime($now.' +1 month'));
        }
        $data['purchase'] = $this->MPembelian->getPurchase("", "");
        $data['supplier'] = $this->MSupplier->getSupplier();
        $data['purchaseProduct'] = $this->MPembelian->getPurchaseProduct($start, $end, $supplier, $pembelian);
        $this->load->view("html/laporan-pembelian", $data);
    }

    public function setPeriod(){
        $post = $this->input->post();
        $data = [
            'from' => $post['from'],
            'until' => $post['until'],
            'penjualan' => $post['optpenjualan'],
            'produk' => $post['optproduk']
        ];
        $this->session->set_flashdata('period', $data);
        redirect(site_url('laporan/penjualan'));
    }

    public function setPeriodPembelian(){
        $post = $this->input->post();
        $data = [
            'from' => $post['from'],
            'until' => $post['until'],
            'pembelian' => $post['optpembelian'],
            'supplier' => $post['optsupplier']
        ];
        $this->session->set_flashdata('period', $data);
        redirect(site_url('laporan/pembelian'));
    }

    public function printPembelian(){
        $post = $this->input->post();
        $from = $post['from'];
        $until = $post['until'];
        $data['date'] = [
            'date_from' => $post['date_from'],
            'date_until' => $post['date_until']
        ];
        $data['purchase'] = $this->MPembelian->getPurchaseProduct($from, $until, $post['supplier'], $post['pembelian']);
        $data['company'] = $this->main_model->getCompany();
        $this->load->view("html/print-pembelian", $data);
    }

    public function printPenjualan(){
        $post = $this->input->post();
        $from = $post['from'];
        $until = $post['until'];
        $data['date'] = [
            'date_from' => $post['date_from'],
            'date_until' => $post['date_until']
        ];
        $data['salles'] = $this->MPenjualan->getSellesProductPeriod($from, $until, $post['produk'], $post['penjualan']);
        $data['company'] = $this->main_model->getCompany();
        $this->load->view("html/print-penjualan", $data);
    }

    public function printStok(){
        $data['stok'] = $this->calculateStock();
        $data['company'] = $this->main_model->getCompany();
        $data['date'] = $this->getdate(date('m'), date('Y'));
        $this->load->view("html/print-stok", $data);
    }

    public function printSupplier(){
        $data['supplier'] = $this->MSupplier->getSupplier();
        $data['company'] = $this->main_model->getCompany();
        $this->load->view("html/print-supplier", $data);
    }

    public function printProduct(){
        $data['product'] = $this->MMaster->getProduct();
        $data['company'] = $this->main_model->getCompany();
        $this->load->view("html/print-product", $data);
    }

    public function printCategory(){
        $data['category'] = $this->MMaster->getCategory();
        $data['company'] = $this->main_model->getCompany();
        $this->load->view("html/print-golongan", $data);
    }

    public function printUnit(){
        $data['unit'] = $this->MMaster->getUnit();
        $data['company'] = $this->main_model->getCompany();
        $this->load->view("html/print-satuan", $data);
    }

    public function printUser(){
        $data['user'] = $this->MPengguna->getUser();
        $data['company'] = $this->main_model->getCompany();
        $this->load->view("html/print-user", $data);
    }

    private function calculateStock(){
        $product = $this->MPenjualan->getProduct();
        $purchase = $this->MPembelian->getPurchaseProduct("","","","");
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

    private function getDate($m, $y){
        $month = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        $date = $month[$m].' '.$y;
        return $date;
    }

}
?>
