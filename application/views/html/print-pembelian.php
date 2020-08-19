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

        <div class="page-wrapper" style="margin-left: 0px; padding-top: 0px">

            <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <button class="btn btn-primary" type="button"  onclick="goBack()"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</button>
                            <button class="btn btn-primary" type="button" onclick="printDiv('print')"><i class="fas fa-print"></i> Print</button>   
                        </div>
                    </div>
                </div>
            </div>

                <div id="print" class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div style="text-align:center;">
                                    <h2><?php echo $company['0']->nama_perusahaan?></h2>
                                    <h5><?php echo $company['0']->alamat_perusahaan?></h5>
                                    <h5>Telp. <?php echo $company['0']->telp_perusahaan?></h5>
                                </div>
                                <hr></hr>
                                <h3 style="text-align:center;"><b>Laporan Pembelian Obat Periode</b></h3>
                                <h4 style="text-align:center;"><b><?php echo $date['date_from'].' Sampai '.$date['date_until']?> </b></h4>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>No. Pembelian</th>
                                                <th>Tanggal</th>
                                                <th>Supplier</th>
                                                <th>Nama</th>
                                                <th>Jumlah</th>
                                                <th>Harga beli</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no = 1;
                                                $id = 0;
                                                $total = 0;
                                                foreach($purchase as $index){                                                    
                                                    echo "
                                                        <tr>
                                                            <td>".$no.".</td>
                                                            <td>".$index->id_pembelian."</td>
                                                            <td>".date('d/m/Y', strtotime($index->tanggal_pembelian))."</td>
                                                            <td>".$index->nama_supplier."</td>
                                                            <td>".$index->nama_produk."</td>
                                                            <td><b>".$index->pembelian." ".$index->satuan."</b></td>
                                                            <td>Rp. ".number_format($index->harga_beli)."</td>
                                                            <td>Rp. ".number_format($index->harga_beli * $index->pembelian)."</td>
                                                        </tr>
                                                    ";
                                                    $no++;
                                                    $total = $total + ($index->harga_beli * $index->pembelian);
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
                                <hr></hr>
                                <div style="text-align:right;">
                                    <h5><?php echo $company['0']->kota_perusahaan.', '.date('d/m/Y')?></h5>
                                    <h5>Penanggung jawab</h5>
                                    <br><br><br>
                                    <h5><?php echo $company['0']->penanggung_jawab?></h5>
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

            function goBack() {
                window.history.back();
            }
        </script>

</body>

</html>