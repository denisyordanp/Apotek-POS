<!DOCTYPE html>
<html dir="ltr" lang="en">

<style>
@page { size: auto;  margin: 0mm; }
</style>

<head>
    <?php $this->load->view("main/header.php") ?>
</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>

    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

        <header class="topbar" data-navbarbg="skin6">
            <?php $this->load->view("main/navbar.php") ?>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">

            <div class="scroll-sidebar" data-sidebarbg="skin6">

                <?php $this->load->view("main/sidebar.php") ?>

            </div>

        </aside>
        <div class="page-wrapper">

            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Laporan / Penjualan</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item">Anda dapat melihat laporan penjualan per Bulan dan mendownload file PDF Laporan Penjualan
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

            <?php $this->load->view("main/message.php") ?>

            <?php 

                $date_from = $date['date_from'];
                $date_until = $date['date_until'];
                $from = $date['from'];
                $until = $date['until'];
                $fillPenjualan = $date['penjualan'];
                $fillProduk = $date['produk'];
            
            ?>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Saring laporan</h5>
                            <form class="pl-3 pr-3" action="<?php echo base_url().'laporan/setPeriod'?>" method="POST">

                                <div class="form-group">
                                    <label for="from">Dari</label>
                                    <input class="form-control" type="date" id="from" name="from" value="<?php echo $from?>" required="">
                                </div>

                                <div class="form-group">
                                    <label for="until">Sampai</label>
                                    <input class="form-control" type="date" id="until" name="until" value="<?php echo $until?>" required="">
                                </div>

                                <div class="form-group">
                                        <label for="optpenjualan">Filter berdasarkan No. Penjualan</label>
                                        <select class="form-control" id="optpenjualan" name="optpenjualan">
                                            <option value="" <?php if(empty($fillPenjualan)){echo 'selected';}?>>Pilih No. Penjualan</option>
                                            <?php 
                                                foreach($seller as $index){
                                                    echo '<option value="'.$index->id_penjualan.'"';

                                                    if(!empty($fillPenjualan) && $index->id_penjualan == $fillPenjualan){ echo 'selected';}

                                                    echo '>'.$index->id_penjualan.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="optproduk">Filter berdasarkan Produk</label>
                                        <select class="form-control" id="optproduk" name="optproduk">
                                            <option value="" <?php if(empty($fillProduk)){echo 'selected';}?>>Pilih Produk</option>
                                            <?php 
                                                foreach($product as $index){
                                                    echo '<option value="'.$index->id_produk.'"';

                                                    if(!empty($fillProduk) && $index->id_produk == $fillProduk){ echo 'selected';}

                                                    echo '>'.$index->nama_produk.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                <div class="form-group text-left">
                                    <button class="btn btn-primary" type="submit">Lihat laporan</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div id="print" class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo base_url()?>laporan/printPenjualan" method="POST">
                                <input name="date_from" value="<?php echo $date_from?>" hidden>
                                <input name="date_until" value="<?php echo $date_until?>" hidden>
                                <input name="from" value="<?php echo $from?>" hidden>
                                <input name="until" value="<?php echo $until?>" hidden>
                                <input name="penjualan" value="<?php echo $fillPenjualan?>" hidden>
                                <input name="produk" value="<?php echo $fillProduk?>" hidden>
                                <button class="btn btn-primary" style="float:right; margin-bottom:15px;" type="submit" > Print</button>
                            </form>
                            <h3 style="text-align:center;"><b>Laporan Penjualan Obat Periode</b></h3>
                            <h4 style="text-align:center;"><b><?php echo $date_from.' Sampai '.$date_until?> </b></h4>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered no-wrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>No. Penjualan</th>
                                            <th>Tanggal</th>
                                            <th>Nama Obat</th>
                                            <th>Jumlah</th>
                                            <th>Harga jual</th>
                                            <th>Potongan</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            $id = 0;
                                            $total = 0;
                                            foreach($salles as $index){
                                                $potongan = 0;
                                                if($index->diskon!=0){
                                                    if($index->tipe_diskon=='persen'){
                                                        $potongan = (($index->harga_jual*$index->penjualan) * $index->diskon) / 100;
                                                    }else{
                                                        $potongan = $index->diskon;
                                                    }
                                                }
                                                
                                                $subtotal = ($index->harga_jual*$index->penjualan)-$potongan;
                                                
                                                echo "
                                                    <tr>
                                                        <td>".$no.".</td>
                                                        <td>".$index->id_penjualan."</td>
                                                        <td>".date('d/m/Y', strtotime($index->tanggal_penjualan))."</td>
                                                        <td>".$index->nama_produk."</td>
                                                        <td><b>".$index->penjualan." ".$index->satuan."</b></td>
                                                        <td>Rp. ".number_format($index->harga_jual)."</td>
                                                        <td>Rp. ".number_format($potongan)."</td>
                                                        <td>Rp. ".number_format($subtotal)."</td>
                                                    </tr>
                                                ";
                                                $no++;
                                                $total = $total + $subtotal;
                                            }

                                            echo "
                                                <tr>
                                                    <th colspan='7'>Total penjualan</td>
                                                    <th>Rp. ".number_format($total)."</td>
                                                </tr>
                                            ";
                                        ?>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <?php $this->load->view("main/footer.php") ?>

        </div>
        <?php $this->load->view("main/js/main-js.php") ?>
        <?php $this->load->view("main/js/data-tables-js.php") ?>
        <?php $this->load->view("main/js/modal-message-js.php") ?>

        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
        </script>

</body>

</html>