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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Pengaturan / Data master / Perusahaan</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html">Anda dapat menambah data master <b>Perusahaan</b> sebelum menggunakan sistem</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <?php $this->load->view("main/message.php") ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="pl-3 pr-3" action="<?php echo base_url().'master/saveCompany'?>" method="POST">
                                    <div class="form-group">
                                        <label for="nama">Nama perusahaan</label>
                                        <input class="form-control" type="text" id="nama" name="nama"
                                            required="" placeholder="Masukan nama perusahaan" value="<?php echo $company[0]->nama_perusahaan?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="alamat">Alamat perusahaan</label>
                                        <input class="form-control" type="text" id="alamat" name="alamat"
                                            required="" placeholder="Masukan alamat perusahaan" value="<?php echo $company[0]->alamat_perusahaan?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="telp">Telp perusahaan</label>
                                        <input class="form-control" type="text" id="telp" name="telp"
                                            required="" placeholder="Masukan no telp perusahaan" value="<?php echo $company[0]->telp_perusahaan?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kota">Kota perusahaan</label>
                                        <input class="form-control" type="text" id="kota" name="kota"
                                            required="" placeholder="Masukan kota perusahaan" value="<?php echo $company[0]->kota_perusahaan?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="penanggung">Penanggung jawab perusahaan</label>
                                        <input class="form-control" type="text" id="penanggung" name="penanggung"
                                            required="" placeholder="Masukan penanggung jawab perusahaan" value="<?php echo $company[0]->penanggung_jawab?>">
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary" type="submit">Simpan</button>
                                    </div>
                                </form>
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