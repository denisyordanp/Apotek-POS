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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Pengaturan / Data master / Golongan</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html">Anda dapat menambah data master <b>Golongan Obat</b> sebelum menggunakan sistem</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <?php $this->load->view("main/message.php") ?>

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
            <?php $this->load->view("main/footer.php") ?>
        </div>
        <?php $this->load->view("main/js/main-js.php") ?>
        <?php $this->load->view("main/js/data-tables-js.php") ?>
        <?php $this->load->view("main/js/modal-message-js.php") ?>
        
</body>

</html>