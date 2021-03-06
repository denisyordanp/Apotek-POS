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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Pengaturan / Data master / Satuan</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item">Anda dapat menambah data master <b>Satuan Obat</b> sebelum menggunakan sistem
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <?php $this->load->view("main/message.php") ?>

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

                <?php 
                    foreach($unit as $index){
                        echo '
                        <div id="delete'.$index->id_satuan.'" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content modal-filled bg-danger">
                                    <div class="modal-body p-4">
                                        <div class="text-center">
                                            <i class="dripicons-wrong h1"></i>
                                            <h4 class="mt-2">Peringatan!</h4>
                                            <p class="mt-3">Anda yakin akan menghapus golongan '.$index->satuan.'?</p>
                                            
                                            <form action="'.base_url().'master/deleteUnit" method="POST">
                                                <input value="'.$index->id_satuan.'" name="id_satuan" hidden>
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
                                <form action="<?php echo base_url()?>laporan/printUnit" method="POST">
                                    <button class="btn btn-primary" style="float:right; margin-left:15px;" type="submit" > Print</button>
                                </form>
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
                                                    echo "<tr class='clickable-row' data-toggle='modal' data-target='#delete".$index->id_satuan."'>
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
        </div>
            <?php $this->load->view("main/footer.php") ?>
        </div>
        <?php $this->load->view("main/js/main-js.php") ?>
        <?php $this->load->view("main/js/data-tables-js.php") ?>
        <?php $this->load->view("main/js/modal-message-js.php") ?>
        
</body>

</html>