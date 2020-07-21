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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Penjualan</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html">Anda dapat melakukan penjualan retail disini</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>Aug 19</option>
                                <option value="1">July 19</option>
                                <option value="2">Jun 19</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

            <?php $this->load->view("main/message.php") ?>

            <?php 
                $modal = 1;
                $total = 0;
                foreach($salles as $key => $index){
                    $idThis = $index->id_penjualan;

                    echo '
                        <div id="modal'.$modal.'" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-full-width">
                                    <div class="modal-content">
                
                                        <div class="modal-body">
                                            <div class="text-center mt-2 mb-4">
                                                <h3>Faktur penjualan</h3>
                                            </div>
                
                                            <div class="text-left mt-2 mb-4">
                                                <h5>No: <b>'.$idThis.'</b></h5>
                                                <h5>Tanggal: <b>'.date("d/m/Y", strtotime($index->tanggal_penjualan)).'</b></h5>
                                                <h5>Jam: <b>'.date("H:m", strtotime($index->tanggal_penjualan)).'</b></h5>
                                            </div>

                                                <table class="table mb-0">
                                                    <tbody>
                    ';

                    $no = 1;
                    foreach($sallesProduct as $productSel){
                        if($productSel->id_penjualan==$idThis){
                            $total = $total + ($productSel->penjualan*$productSel->harga_jual);
                            echo '
                                <tr>
                                    <th scope="row">'.$no.'</th>
                                    <td>'.$productSel->nama_produk.'</td>
                                    <td>Rp. '.number_format($productSel->harga_jual).'</td>
                                    <td>'.$productSel->penjualan.' '.$productSel->satuan.'</td>
                                    <td>Rp. '.number_format($productSel->penjualan*$productSel->harga_jual).'</td>
                                </tr>
                            ';
                            $no++;
                        }
                    }

                    if($index->diskon!=0){
                        echo '
                            <tr>
                                <th scope="row" colspan="4">Total penjualan</th>
                                <th>Rp. '.number_format($total).'</th>
                            </tr>
                        ';
                        if($index->tipe_diskon=='persen'){
                            $potongan = ($total * $index->diskon) / 100;
                            echo '
                                <tr>
                                    <th scope="row" colspan="4">Diskon</th>
                                    <th>'.$index->diskon.' %</th>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="4">Potongan</th>
                                    <th>Rp. '.number_format($potongan).'</th>
                                </tr>
                            ';
                        }else{
                            $potongan = $index->diskon;
                            echo '
                                <tr>
                                    <th scope="row" colspan="4">Diskon</th>
                                    <th>'.$index->diskon.' %</th>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="4">Potongan</th>
                                    <th>Rp. '.number_format($potongan).'</th>
                                </tr>
                            ';
                        }
                        $total = $total - $potongan;
                        
                    }

                    echo '
                                            <tr>
                                                <th scope="row" colspan="4">Total pembayaran</th>
                                                <th>Rp. '.number_format($total).'</th>
                                            </tr>
                                            </tbody>
                                            </table>

                                            <div class="form-group">
                                                <label for="name">Oleh</label>
                                                <input class="form-control" type="text" id="name" name="name" value="'.$index->nama_user.'" disabled>
                                            </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    ';
                    $total = 0;
                    $modal++;
                }
            ?>

            <?php 
                $noSeller = date('ydmhms');
                $tanggal = date('Y-m-d H:m:s');
                $oleh = $this->session->userdata('user')->user_id;
            ?>

            <div id="yakin-modal" class="modal fade" tabindex="-1" role="dialog"
                aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-information h1 text-info"></i>
                                <h4 class="mt-2">PERHATIAN!</h4>
                                <p class="mt-3">Mohon cek ulang terlebih dahulu produk pesanan. Apakah anda sudah yakin?</p>
                                <form action="<?php echo base_url().'penjualan/seller'?>" method="POST">
                                    <input name="id_penjualan" value="<?php echo $noSeller?>" hidden>
                                    <input name="tanggal" value="<?php echo $tanggal?>" hidden>
                                    <input name="user" value="<?php echo $oleh?>" hidden>
                                    <button type="button" class="btn btn-info my-2"data-dismiss="modal">Cek ulang</button>
                                    <button type="submit" class="btn btn-info my-2">Bayar</button>
                                </form>
                                   
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="produk-modal" class="modal fade" tabindex="-1" role="dialog"
                aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                    <h3>Tambah produk</h3>
                                </div>

                                <form class="pl-3 pr-3" action="<?php echo base_url().'penjualan/addProduct'?>" method="POST">

                                    <div class="form-group">
                                        <label for="productSelect">Produk</label>
                                        <select class="form-control" id="productSelect" name="product" required>
                                            <option value="" selected>Pilih produk</option>
                                            <?php 
                                                foreach($product as $index){
                                                    echo '
                                                        <option value="'.$index->id_produk.'">'.$index->nama_produk.'</option>
                                                    ';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah">Jumlah</label>
                                        <input class="form-control" type="number" id="jumlah" name="jumlah"
                                            required="" placeholder="Masukan jumlah pembelian">
                                    </div>

                                    <div class="form-group text-center">
                                        <button class="btn btn-primary" type="submit">Tambah</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div id="diskon-modal" class="modal fade" tabindex="-1" role="dialog"
                aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                    <h3>Diskon penjualan</h3>
                                </div>

                                <form class="pl-3 pr-3" action="<?php echo base_url().'penjualan/addDiscount'?>" method="POST">

                                    <div class="form-group">
                                        <label for="tipe_diskon">Tipe diskon</label>
                                        <select class="form-control" id="tipe_diskon" name="tipe_diskon" required>
                                            <option value="persen" selected>Persen</option>
                                            <option value="harga" selected>Harga</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="diskon">Diskon</label>
                                        <input class="form-control" type="text" id="diskon" name="diskon"
                                            required="" placeholder="Masukan jumlah diskon">
                                    </div>

                                    <div class="form-group text-center">
                                        <button class="btn btn-primary" type="submit">Masukan diskon</button>
                                    </div>

                                </form>
                                <form class="pl-3 pr-3" style="text-align:center" action="<?php echo base_url().'penjualan/delDiscount'?>" method="POST">
                                        <button class="btn btn-primary" type="submit">Hapus diskon</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">

                                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                    <li class="nav-item">
                                        <a href="#jual" data-toggle="tab" aria-expanded="false"
                                            class="nav-link rounded-0 active">
                                            <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Penjualan</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#stok" data-toggle="tab" aria-expanded="true"
                                            class="nav-link rounded-0">
                                            <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                            <span class="d-none d-lg-block">Lihat stok</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane show active" id="jual">

                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#produk-modal" style="float:left;">Tambah produk</button>

                                        <form action="<?php base_url()?>penjualan/reset">
                                            <button type="submit" class="btn btn-primary" style="float:left; margin-left: 10px;">Reset</button>
                                        </form>

                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#diskon-modal" style="margin-left:10px;">Diskon</button>

                                        <div id="cobaDisini">

                                            <div style="text-align:center;">
                                                <h3><?php echo $company['0']->nama_perusahaan?></h3>
                                                <h6><?php echo $company['0']->alamat_perusahaan?></h6>
                                                <h6>Telp. <?php echo $company['0']->telp_perusahaan?></h6>
                                            </div>

                                            <hr></hr>

                                            <div class="text-left mt-2 mb-4">
                                                <h5>Tanggal&ensp;: <b><?php echo date("d/m/Y", strtotime($tanggal))?></b></h5>
                                                <h5>Oleh&ensp;: <b><?php echo $this->session->userdata('user')->nama_user?></b></h5>
                                            </div>

                                            <table class="table mb-0">
                                                <tbody>
                                                <?php 
                                                    $no = 1;
                                                    $total = 0;
                                                    foreach($sell as $index){
                                                        $total = $total + ($index->harga_jual*$index->jumlah);
                                                        echo '
                                                        <tr>
                                                            <th scope="row">'.$no.'</th>
                                                            <td>'.$index->nama_produk.'</td>
                                                            <td>Rp. '.number_format($index->harga_jual).'</td>
                                                            <td>'.$index->jumlah.' '.$index->satuan.'</td>
                                                            <td>Rp. '.number_format($index->harga_jual*$index->jumlah).'</td>
                                                        </tr>
                                                        ';
                                                        $no++;
                                                    }
                                                    if($this->session->userdata('discount')!=null){
                                                        $diskon = $this->session->userdata('discount');
                                                        
                                                        if($diskon['tipe_diskon']=='persen'){
                                                            $potongan = ($total*$diskon['diskon']) / 100;
                                                            echo '
                                                                <tr>
                                                                    <th scope="row" colspan="4" style="text-align: right;">Total belanja</th>
                                                                    <th>Rp. '.$total.'</th>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" colspan="4" style="text-align: right;">Diskon</th>
                                                                    <th>'.$diskon['diskon'].' %</th>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" colspan="4" style="text-align: right;">Potongan</th>
                                                                    <th>Rp. '.number_format($potongan).'</th>
                                                                </tr>
                                                            ';
                                                        }else{
                                                            $potongan = $diskon['diskon'];
                                                            echo '
                                                                <tr>
                                                                    <th scope="row" colspan="4" style="text-align: right;">Total belanja</th>
                                                                    <th>Rp. '.$total.'</th>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row" colspan="4" style="text-align: right;">Potongan</th>
                                                                    <th>Rp. '.number_format($potongan).'</th>
                                                                </tr>
                                                            ';
                                                        }
                                                        $total = $total - $potongan;
                                                    }
                                                    echo '
                                                        <tr>
                                                            <th scope="row" colspan="4" style="text-align: right;">Total bayar</th>
                                                            <th>Rp. '.number_format($total).'</th>
                                                        </tr>
                                                        ';
                                                    ?> 
                                                </tbody>
                                            </table>

                                            <hr></hr>

                                        </div>

                                        <div class="form-group text-center">
                                            <?php 
                                                if($this->session->userdata('seller')!=null){
                                                    echo '
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#yakin-modal">Bayar</button>
                                                    ';
                                                }
                                            ?>
                                            <button class="btn btn-primary" type="button" onclick="printDiv('cobaDisini')">Print</button>
                                        </div> 

                                    </div>

                                    <div class="tab-pane" id="stok">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="stock" class="table table-striped table-bordered no-wrap">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>Nama</th>
                                                            <th>Golongan</th>
                                                            <th>Harga</th>
                                                            <th>Stok</th>
                                                            <th>Satuan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            $no = 1;
                                                            foreach($stock as $index){
                                                                echo "<tr>
                                                                <td>".$no.".</td>
                                                                <td>".$index->nama_produk."</td>
                                                                <td>".$index->golongan."</td>
                                                                <td>Rp. ".$index->harga_jual."</td>
                                                                <td><b>".$index->stok."</b></td>
                                                                <td>".$index->satuan."</td>
                                                                </tr>";
                                                                $no++;
                                                            }
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

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <?php 
                                    if($salles!=null){
                                        echo '
                                            <h4 class="card-title">Penjualan hari ini</h4>
                                            <h6 class="card-subtitle">Anda dapat melihat daftar penjualan hari ini pada tabel dibawah ini. Untuk riwayat penjualan hari lalu silahkan buka tab menu <b>Laporan.</b></h6>
                                            <div class="table-responsive">
                                                <table id="default_order" class="table table-striped table-bordered display no-wrap table-hover"
                                                    style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No.</th>
                                                            <th>No. Penjualan</th>
                                                            <th>Tanggal</th>
                                                            <th>Jam</th>
                                                            <th>Oleh</th>
                                                            <th>Total transaksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                        ';

                                        $no = 1;
                                        $total = 0;
                                        foreach($salles as $key => $index){
                                            $idThis = $index->id_penjualan;

                                            foreach($sallesProduct as $product){
                                                if($product->id_penjualan==$idThis){
                                                    $total = $total + ($product->penjualan*$product->harga_jual);
                                                }
                                            }

                                            if($index->diskon!=0){
                                                if($index->tipe_diskon=='persen'){
                                                    $potongan = ($total * $index->diskon) / 100;
                                                }else{
                                                    $potongan = $index->diskon;
                                                }
                                                $total = $total - $potongan;
                                            }

                                            echo "
                                                <tr class='clickable-row' data-toggle='modal' data-target='#modal".$no."'>
                                                <td>".$no.".</td>
                                                <td>".$index->id_penjualan."</td>
                                                <td>".date("d/m/Y", strtotime($index->tanggal_penjualan))."</td>
                                                <td>".date("H:m", strtotime($index->tanggal_penjualan))."</td>
                                                <td>".$index->nama_user."</b></td>
                                                <td>Rp. ".number_format($total)."</td>
                                                </tr>
                                            ";
                                            $no++;
                                            $total = 0;
                                        }
                                        echo '
                                                    </tbody>
                                                </table>
                                            </div>
                                        ';
                                    }else{
                                        echo '
                                            <h4 class="card-title">Belum ada penjualan hari ini</h4>
                                        ';
                                    }
                                    ?>
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