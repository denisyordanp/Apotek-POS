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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Pengaturan / Data master / Produk</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html">Anda dapat menambah data master <b>Produk Obat</b> sebelum menggunakan sistem</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <?php $this->load->view("main/message.php") ?>

                <?php $this->load->view("main/helper/master.php") ?>

                <div id="produk-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                    <h3>Tambah produk</h3>
                                </div>

                                <form class="pl-3 pr-3" action="<?php echo base_url().'master/addProduct'?>" method="POST">

                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            required="" placeholder="Masukan nama obat">
                                    </div>

                                    <div class="form-group">
                                        <label for="categorySelect">Golongan</label>
                                        <select class="form-control" id="categorySelect" name="category" required>
                                            <option value="" selected>Pilih golongan obat ..</option>
                                            <?php 
                                                foreach($category as $index){
                                                    echo '
                                                        <option value="'.$index->id_golongan.'">'.$index->golongan.'</option>
                                                    ';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="beli">Harga beli</label>
                                        <input class="form-control" type="text" id="beli" name="beli"
                                            required="" placeholder="Masukan harga beli">
                                    </div>

                                    <div class="form-group">
                                        <label for="jual">Harga jual</label>
                                        <input class="form-control" type="text" name="jual" required=""
                                            id="jual" placeholder="Masukan harga jual">
                                    </div>

                                    <div class="form-group">
                                        <label for="unitSelect">Satuan</label>
                                        <select class="form-control" id="unitSelect" name="unit" required>
                                            <option value="" selected>Pilih satuan obat ..</option>
                                            <?php 
                                                foreach($unit as $index){
                                                    echo '
                                                        <option value="'.$index->id_satuan.'">'.$index->satuan.'</option>
                                                    ';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group text-center">
                                        <button class="btn btn-primary" type="submit">Tambah</button>
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
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#produk-modal" style="float:right;">Tambah produk</button>
                                <div class="table-responsive">
                                    <table id="productTable" class="table table-striped table-bordered no-wrap table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama</th>
                                                <th>Golongan</th>
                                                <th>Harga beli</th>
                                                <th>Harga jual</th>
                                                <th>Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no = 1;
                                                foreach($product as $index){
                                                    echo "<tr class='clickable-row' data-toggle='modal' data-target='#modal".$index->id_produk."'>
                                                    <td>".$no.".</td>
                                                    <td>".$index->nama_produk."</td>
                                                    <td>".$index->golongan."</td>
                                                    <td>Rp. ".$index->harga_beli."</td>
                                                    <td>Rp. ".$index->harga_jual."</td>
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
            <?php $this->load->view("main/footer.php") ?>
        </div>
        <?php $this->load->view("main/js/main-js.php") ?>
        <?php $this->load->view("main/js/data-tables-js.php") ?>
        <?php $this->load->view("main/js/modal-message-js.php") ?>
        
</body>

</html>