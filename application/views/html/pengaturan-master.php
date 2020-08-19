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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Pengaturan / Data master</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item">Anda dapat menambah data master sebelum menggunakan sistem dengan baik
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

                    <div id="satuan-modal" class="modal fade" tabindex="-1" role="dialog"
                    aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-body">
                                    <div class="text-center mt-2 mb-4">
                                        <h3>Tambah satuan</h3>
                                    </div>

                                    <form class="pl-3 pr-3" action="<?php echo base_url().'master/addUnit'?>" method="POST">

                                        <div class="form-group">
                                            <label for="name">Nama satuan</label>
                                            <input class="form-control" type="text" id="name" name="name"
                                                required="" placeholder="Masukan nama obat">
                                        </div>

                                        <div class="form-group text-center">
                                            <button class="btn btn-primary" type="submit">Tambah</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="golongan-modal" class="modal fade" tabindex="-1" role="dialog"
                    aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-body">
                                    <div class="text-center mt-2 mb-4">
                                        <h3>Tambah golongan</h3>
                                    </div>

                                    <form class="pl-3 pr-3" action="<?php echo base_url().'master/addCategory'?>" method="POST">

                                        <div class="form-group">
                                            <label for="name">Nama golongan</label>
                                            <input class="form-control" type="text" id="name" name="name"
                                                required="" placeholder="Masukan nama obat">
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

                            <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                <li class="nav-item">
                                    <a href="#product" data-toggle="tab" aria-expanded="false"
                                        class="nav-link rounded-0 active">
                                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">Produk</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#unit" data-toggle="tab" aria-expanded="true"
                                        class="nav-link rounded-0">
                                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">Satuan</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#category" data-toggle="tab" aria-expanded="true"
                                        class="nav-link rounded-0">
                                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                        <span class="d-none d-lg-block">Golongan</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                            <div class="tab-pane show active" id="product">
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

                                <div class="tab-pane" id="unit">
                                <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                    <div class="card-body">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#satuan-modal" style="float:right;">Tambah satuan</button>
                                        <div class="table-responsive">
                                            <table id="unitTable" class="table table-striped table-bordered no-wrap table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Satuan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $no = 1;
                                                        foreach($unit as $index){
                                                            echo "<tr class='clickable-row' data-toggle='modal' data-target='#hpUnit".$index->id_satuan."'>
                                                            <td>".$no.".</td>
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

                                <div class="tab-pane" id="category">
                                    <div class="card">
                                    <div class="card-body">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#golongan-modal" style="float:right;">Tambah golongan</button>
                                        <div class="table-responsive">
                                            <table id="category_table" class="table table-striped table-bordered no-wrap table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Golongan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        $no = 1;
                                                        foreach($category as $index){
                                                            echo "<tr class='clickable-row' data-toggle='modal' data-target='#hpCategory".$index->id_golongan."'>
                                                            <td>".$no.".</td>
                                                            <td>".$index->golongan."</td>
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
            </div>
        </div>
            <?php $this->load->view("main/footer.php") ?>
        </div>
        <?php $this->load->view("main/js/main-js.php") ?>
        <?php $this->load->view("main/js/data-tables-js.php") ?>
        <?php $this->load->view("main/js/modal-message-js.php") ?>
        
</body>

</html>