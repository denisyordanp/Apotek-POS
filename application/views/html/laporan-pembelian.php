<!DOCTYPE html>
<html dir="ltr" lang="en">

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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Pembelian / Riwayat</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item">List riwayat pembelian produk
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
                $fillSupplier = $date['supplier'];
                $fillPembelian = $date['pembelian'];
            
            ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Saring laporan</h5>
                                <form class="pl-3 pr-3" action="<?php echo base_url().'laporan/setPeriodPembelian'?>" method="POST">

                                    <div class="form-group">
                                        <label for="from">Dari</label>
                                        <input class="form-control" type="date" id="from" name="from" value="<?php echo $from?>" required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="until">Sampai</label>
                                        <input class="form-control" type="date" id="until" name="until" value="<?php echo $until?>" required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="optpembelian">Filter berdasarkan No. Pembelian</label>
                                        <select class="form-control" id="optpembelian" name="optpembelian">
                                            <option value="" <?php if(empty($fillPembelian)){echo 'selected';}?>>Pilih No. Pembelian</option>
                                            <?php 
                                                foreach($purchase as $index){
                                                    echo '<option value="'.$index->id_pembelian.'"';

                                                    if(!empty($fillPembelian) && $index->id_pembelian == $fillPembelian){ echo 'selected';}

                                                    echo '>'.$index->id_pembelian.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="optsupplier">Filter berdasarkan Supplier</label>
                                        <select class="form-control" id="optsupplier" name="optsupplier">
                                            <option value="" <?php if(empty($fillSupplier)){echo 'selected';}?>>Pilih Supplier</option>
                                            <?php 
                                                foreach($supplier as $index){
                                                    echo '<option value="'.$index->id_supplier.'"';

                                                    if(!empty($fillSupplier) && $index->id_supplier == $fillSupplier){ echo 'selected';}

                                                    echo '>'.$index->nama_supplier.'</option>';
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?php echo base_url()?>laporan/printPembelian" method="POST">
                                    <input name="date_from" value="<?php echo $date_from?>" hidden>
                                    <input name="date_until" value="<?php echo $date_until?>" hidden>
                                    <input name="from" value="<?php echo $from?>" hidden>
                                    <input name="until" value="<?php echo $until?>" hidden>
                                    <input name="pembelian" value="<?php echo $fillPembelian?>" hidden>
                                    <input name="supplier" value="<?php echo $fillSupplier?>" hidden>
                                    <button class="btn btn-primary" style="float:right; margin-bottom:15px;" type="submit" > Print</button>
                                </form>
                                <h3 style="text-align:center;"><b>Laporan Pembelian Obat Periode</b></h3>
                                <h4 style="text-align:center;"><b><?php echo $date_from.' Sampai '.$date_until?> </b></h4>
                                <div class="table-responsive">
                                    <table id="" class="table table-striped table-bordered no-wrap table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>No. Pembelian</th>
                                                <th>Tanggal</th>
                                                <th>Supplier</th>
                                                <th>Nama</th>
                                                <th>Jumlah</th>
                                                <th>Harga Beli</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no = 1;
                                                $total = 0;
                                                foreach($purchaseProduct as $index){
                                                    $cal = $index->pembelian*$index->harga_beli;
                                                    echo "<tr>
                                                        <td>".$no.".</td>
                                                        <td>".$index->id_pembelian."</td>
                                                        <td>".date("d/m/Y", strtotime($index->tanggal_pembelian))."</td>
                                                        <td>".$index->nama_supplier."</td>
                                                        <td>".$index->nama_produk."</td>
                                                        <td>".$index->pembelian."</td>
                                                        <td>Rp. ".number_format($index->harga_beli)."</b></td>
                                                        <td>Rp. ".number_format($cal)."</td>
                                                        </tr>
                                                        ";
                                                    $no++;
                                                    $total = $total + $cal;
                                                }
                                                echo "
                                                <tr>
                                                    <th colspan='6'>Total Pembelian</td>
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
        
</body>

</html>