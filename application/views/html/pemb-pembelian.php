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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Pembelian / Pembelian</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html">Anda dapat melakukan pembelian produk kepada supplier untuk menambah stok produk</a>
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

            <div id="produk-modal" class="modal fade" tabindex="-1" role="dialog"
                    aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-body">
                                    <div class="text-center mt-2 mb-4">
                                        <h3>Tambah produk</h3>
                                    </div>

                                    <form class="pl-3 pr-3" action="<?php echo base_url().'pembelian/addProduct'?>" method="POST">

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

                                        <div class="form-group">
                                            <label for="batch">No. Batch</label>
                                            <input class="form-control" type="text" id="batch" name="batch"
                                                required="" placeholder="Masukan No. Batch">
                                        </div>

                                        <div class="form-group">
                                            <label for="kadaluarsa">Kadaluarsa</label>
                                            <input class="form-control" type="date" id="kadaluarsa" name="kadaluarsa"
                                                required="" placeholder="Masukan tanggal kadaluarsa">
                                        </div>

                                        <div class="form-group text-center">
                                            <button class="btn btn-primary" type="submit">Tambah</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="hitung-modal" class="modal fade" tabindex="-1" role="dialog"
                                    aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full-width">
                            <div class="modal-content">

                                <div class="modal-body">
                                    <div class="text-center mt-2 mb-4">
                                        <h3>Faktur pembelian</h3>
                                    </div>

                                    <?php $noPurchase = date('ydmhms');?>

                                    <div class="text-left mt-2 mb-4">
                                        <h5>No: <b><?php echo $noPurchase;?></b></h5>
                                    </div>

                                    <form class="pl-3 pr-3" action="<?php echo base_url().'pembelian/purchase'?>" method="POST">
                                        <input class="form-control" name="id_pembelian" value="<?php echo $noPurchase; ?>" hidden>
                                        <table class="table mb-0">
                                            <tbody>
                                                <?php 
                                                $no = 1;
                                                $total = 0;
                                                    foreach($buy as $index){
                                                        $total = $total + ($index->harga_beli*$index->jumlah);
                                                        echo '
                                                        <tr>
                                                            <th scope="row">'.$no.'</th>
                                                            <td>'.$index->nama_produk.'</td>
                                                            <td>Rp. '.number_format($index->harga_beli).'</td>
                                                            <td>'.$index->jumlah.' '.$index->satuan.'</td>
                                                            <td>Rp. '.number_format($index->harga_beli*$index->jumlah).'</td>
                                                        </tr>
                                                        ';
                                                        $no++;
                                                    }
                                                    echo '
                                                        <tr>
                                                            <th scope="row" colspan="4">Total pembelian</th>
                                                            <th>Rp. '.number_format($total).'</th>
                                                        </tr>
                                                        ';
                                                ?> 
                                            </tbody>
                                        </table>

                                        <div class="form-group">
                                            <label for="tanggal">Tanggal pembelian</label>
                                            <input class="form-control" type="date" id="tanggal" name="tanggal"
                                                required="" placeholder="Masukan tanggal pembelian">
                                        </div>

                                        <div class="form-group">
                                            <label for="supplierSelect">Supplier</label>
                                            <select class="form-control" id="supplierSelect" name="supplier" required>
                                                <option value="" selected>Pilih supplier</option>
                                                <?php 
                                                    foreach($supplier as $index){
                                                        echo '
                                                            <option value="'.$index->id_supplier.'">'.$index->nama_supplier.'</option>
                                                        ';
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="oleh">Oleh</label>
                                            <input class="form-control" type="text" id="oleh" name="oleh"
                                                required="" value="<?php echo $this->session->userdata('user')->nama_user?>" disabled>
                                            <input class="form-control" type="text" name="user" value="<?php echo $this->session->userdata('user')->user_id?>" hidden>
                                        </div>

                                        <div class="form-group text-center">
                                            <button class="btn btn-primary" type="submit">Pembelian</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#produk-modal" style="float:right; margin: 10px">Tambah produk</button>
                        <form action="<?php base_url()?>reset">
                            <button type="submit" class="btn btn-primary" style="float:right; margin: 10px;">Reset</button>
                        </form>

                        <?php if(!empty($buy)){
                            echo '
                            <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kadaluarsa</th>
                                    <th scope="col">No. Batch</th>
                                    <th scope="col">Harga beli</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                            ';
                            $no = 1;
                            foreach($buy as $index){
                                echo '
                                    <tr>
                                        <td>'.$no.'</td>
                                        <td>'.$index->nama_produk.'</td>
                                        <td>'.$index->kadaluarsa.'</td>
                                        <td>'.$index->no_batch.'</td>
                                        <td>Rp. '.$index->harga_beli.'</td>
                                        <td>'.$index->jumlah.' '.$index->satuan.'</td>
                                    </tr>
                                ';
                            $no++;
                            }
                            echo '
                            </tbody>
                            </table>
                            ';
                        }?>
                            
                        </div>
                        <?php if(!empty($buy)){
                            echo '
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#hitung-modal">Hitung pembelian</button>
                            ';
                        }?>
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