<?php
class Laporan extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model("MPenjualan");
        $this->load->model("MPembelian");
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

    public function printStok(){
        $data['stok'] = $this->calculateStock();
        $data['company'] = $this->main_model->getCompany();
        $data['date'] = $this->getdate(date('m'), date('Y'));
        $this->load->view("html/print-stok", $data);
    }

    public function penjualan(){
        $data['date'] = [
            'date' => $this->getdate(date('m'), date('Y')),
            'period' => date('Y-m')
        ];
        $start = date('Y-m-01');
        $end = date('Y-m-01', strtotime(' +1 month'));
        if($this->session->flashdata('period')!=null){
            $period = $this->session->flashdata('period');
            $data['date'] = [
                'date' => $this->getDate(date('m', strtotime($period)), date('Y', strtotime($period))),
                'period' => date('Y-m', strtotime($period))
            ];
            $start = date('Y-m-01', strtotime($period));
            $end = date('Y-m-01', strtotime($period.'+1 month'));
        }
        $data['salles'] = $this->MPenjualan->getSellesProductPeriod($start, $end);
        $this->load->view("html/laporan-penjualan", $data);
    }

    public function setPeriod(){
        $post = $this->input->post();
        $this->session->set_flashdata('period',$post['bulan']);
        redirect(site_url('laporan/penjualan'));
    }

    public function printPenjualan(){
        $period = $this->input->post('period');
        $data['date'] = [
            'date' => $this->getDate(date('m', strtotime($period)), date('Y', strtotime($period))),
            'period' => date('Y-m', strtotime($period))
        ];
        $start = date('Y-m-01', strtotime($period));
        $end = date('Y-m-01', strtotime($period.'+1 month'));
        $data['salles'] = $this->MPenjualan->getSellesProductPeriod($start, $end);
        $data['company'] = $this->main_model->getCompany();
        $this->load->view("html/print-penjualan", $data);
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
