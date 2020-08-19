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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Supplier</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item">Anda dapat melihat daftar supplier pada menu ini
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">

            <?php $this->load->view("main/message.php") ?>

            <div id="supplier-modal" class="modal fade" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                    <h3>Tambah supplier</h3>
                                </div>

                                <form class="pl-3 pr-3" action="<?php echo base_url().'supplier/add'?>" method="POST">

                                    <div class="form-group">
                                        <label for="name">Nama supplier</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            required="" placeholder="Masukan Nama">
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input class="form-control" type="text" name="alamat" required=""
                                            id="alamat" placeholder="Masukan alamat">
                                    </div>

                                    <div class="form-group">
                                        <label for="telepon">Nomor telepon</label>
                                        <input class="form-control" type="text" required=""
                                            id="telepon" name="telepon" placeholder="Masukan telepon">
                                    </div>

                                    <div class="form-group text-center">
                                        <button class="btn btn-primary" type="submit">Tambah</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <?php 
                    foreach($suppliers as $index){
                        echo '
                            <div id="edit'.$index->id_supplier.'" class="modal fade" tabindex="-1" role="dialog"
                            aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
            
                                        <div class="modal-body">
                                            <div class="text-center mt-2 mb-4">
                                                <h3>Edit Supplier</h3>
                                            </div>
            
                                            <form class="pl-3 pr-3" action="'.base_url().'supplier/edit" method="POST">

                                                <input type="hidden" id="user_id" name="id_supplier" value="'.$index->id_supplier.'">
            
                                                <div class="form-group">
                                                    <label for="name">Nama supplier</label>
                                                    <input class="form-control" type="text" id="name" name="name"
                                                        required="" placeholder="Masukan Nama" value="'.$index->nama_supplier.'">
                                                </div>

                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <input class="form-control" type="text" name="alamat" required=""
                                                        id="alamat" placeholder="Masukan alamat" value="'.$index->alamat.'">
                                                </div>

                                                <div class="form-group">
                                                    <label for="telepon">Nomor telepon</label>
                                                    <input class="form-control" type="text" required=""
                                                        id="telepon" name="telepon" placeholder="Masukan telepon" value="'.$index->phone.'">
                                                </div>
            
                                                <div class="form-group text-center">
                                                    <button class="btn btn-danger" type="button" data-target="#hapus'.$index->id_supplier.'" data-toggle="modal"
                                                    data-dismiss="modal">Hapus</button>
                                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                                </div>
            
                                            </form>
            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                ?>

                <?php 
                    foreach($suppliers as $index){
                        echo '
                        <div id="hapus'.$index->id_supplier.'" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content modal-filled bg-danger">
                                    <div class="modal-body p-4">
                                        <div class="text-center">
                                            <i class="dripicons-wrong h1"></i>
                                            <h4 class="mt-2">Peringatan!</h4>
                                            <p class="mt-3">Anda yakin akan menghapus supplier '.$index->nama_supplier.'?</p>
                                            
                                            <form action="'.base_url().'supplier/delete" method="POST">
                                                <input value="'.$index->id_supplier.'" name="id_supplier" hidden>
                                                <button type="button" class="btn btn-light my-2"
                                                data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-light my-2">Ya</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                ?>

                <div class="row">
                    <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="<?php echo base_url()?>laporan/printSupplier" method="POST">
                                        <button class="btn btn-primary" style="float:right; margin-left:15px;" type="submit" > Print</button>
                                    </form>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#supplier-modal" style="float:right;">Tambah supplier</button>
                                    <div class="table-responsive">
                                        <table id="supplier" class="table table-striped table-bordered no-wrap table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama supplier</th>
                                                    <th>Alamat</th>
                                                    <th>Nomor Telepon</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $no = 1;
                                                    foreach($suppliers as $index){
                                                        echo "<tr class='clickable-row' data-toggle='modal' data-target='#edit".$index->id_supplier."'>
                                                        <td>".$no.".</td>
                                                        <td>".$index->nama_supplier."</td>
                                                        <td>".$index->alamat."</td>
                                                        <td>".$index->phone."</td>
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
            <?php $this->load->view("main/footer.php") ?>
        </div>
        <?php $this->load->view("main/js/main-js.php") ?>
        <?php $this->load->view("main/js/data-tables-js.php") ?>
        <?php $this->load->view("main/js/modal-message-js.php") ?>
</body>

</html>