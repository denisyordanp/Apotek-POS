<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <?php $this->load->view("main/header.php") ?>

    <script type="text/javascript">
        window.onload = function () {
            document.getElementById("password").onchange = validatePassword;
            document.getElementById("repassword").onchange = validatePassword
            <?php 
                foreach($users as $index){
                    echo '
                        document.getElementById("'.$index->username.'password").onchange = validate'.$index->username.';
                        document.getElementById("'.$index->username.'repassword").onchange = validate'.$index->username.';
                    ';
                }
            ?>
        }

        function validatePassword(){
            var pass2=document.getElementById("password").value;
            var pass1=document.getElementById("repassword").value;
            if(pass1!=pass2)
                document.getElementById("repassword").setCustomValidity("Password Tidak Sama, Coba Lagi");
            else
                document.getElementById("repassword").setCustomValidity('');
        }

        <?php 
            foreach($users as $index){
                echo '
                    function validate'.$index->username.'(){
                        var pass2=document.getElementById("'.$index->username.'password").value;
                        var pass1=document.getElementById("'.$index->username.'repassword").value;
                        if(pass1!=pass2)
                            document.getElementById("'.$index->username.'repassword").setCustomValidity("Password Tidak Sama, Coba Lagi");
                        else
                            document.getElementById("'.$index->username.'repassword").setCustomValidity("");
                    }
                ';
            }
        ?>
    </script>
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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Pengaturan / Pengguna</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html">Anda dapat menambah, menghapus, dan merubah pengguna sistem pada menu ini</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

                <?php $this->load->view("main/message.php") ?>

                <div id="user-modal" class="modal fade" tabindex="-1" role="dialog"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-body">
                                <div class="text-center mt-2 mb-4">
                                    <h3>Tambah pengguna</h3>
                                </div>

                                <form class="pl-3 pr-3" action="<?php echo base_url().'pengguna/add'?>" method="POST">

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input class="form-control" type="text" id="username" name="username"
                                            required="" placeholder="Masukan username">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Nama</label>
                                        <input class="form-control" type="text" id="name" name="name"
                                            required="" placeholder="Masukan Nama">
                                    </div>

                                    <div class="form-group">
                                        <label for="telephone">Telepon</label>
                                        <input class="form-control" type="text" name="telephone" required=""
                                            id="telephone" placeholder="Masukan telepon">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required=""
                                            id="password" name="password" placeholder="Masukan password">
                                    </div>

                                    <div class="form-group">
                                        <label for="repassword">Ulangi password</label>
                                        <input class="form-control" type="password" required=""
                                            id="repassword" placeholder="Ulangi password">
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
                    foreach($users as $index){
                        echo '
                            <div id="'.$index->username.'" class="modal fade" tabindex="-1" role="dialog"
                            aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
            
                                        <div class="modal-body">
                                            <div class="text-center mt-2 mb-4">
                                                <h3>Edit pengguna</h3>
                                            </div>
            
                                            <form class="pl-3 pr-3" action="'.base_url().'pengguna/edit" method="POST">

                                                <input type="hidden" id="user_id" name="user_id" value="'.$index->user_id.'">
            
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input class="form-control" type="text" id="username" name="username"
                                                        required="" placeholder="Masukan username" value="'.$index->username.'">
                                                </div>
            
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input class="form-control" type="text" id="name" name="name"
                                                        required="" placeholder="Masukan Nama" value="'.$index->nama_user.'">
                                                </div>
            
                                                <div class="form-group">
                                                    <label for="telephone">Telepon</label>
                                                    <input class="form-control" type="text" name="telephone" required=""
                                                        id="telephone" placeholder="Masukan telepon" value="'.$index->phone_user.'">
                                                </div>
            
                                                <div class="form-group text-center">
                                                    <button class="btn btn-danger" type="button" data-target="#hapus'.$index->username.'" data-toggle="modal"
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
                    foreach($users as $index){
                        echo '
                        <div id="hapus'.$index->username.'" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content modal-filled bg-danger">
                                    <div class="modal-body p-4">
                                        <div class="text-center">
                                            <i class="dripicons-wrong h1"></i>
                                            <h4 class="mt-2">Peringatan!</h4>
                                            <p class="mt-3">Anda yakin akan menghapus pengguna '.$index->nama_user.'?</p>
                                            
                                            <form action="'.base_url().'pengguna/hapus" method="POST">
                                                <input value="'.$index->user_id.'" name="user_id" hidden>
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
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#user-modal" style="float:right;">Tambah pengguna</button>
                                <div class="table-responsive">
                                    <table id="users" class="table table-striped table-bordered no-wrap table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Username</th>
                                                <th>Nama</th>
                                                <th>Nomor HP</th>
                                                <th>Terakhir login</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $no = 1;
                                                foreach($users as $index){
                                                    echo "<tr class='clickable-row' data-toggle='modal' data-target='#".$index->username."'>
                                                    <td>".$no.".</td>
                                                    <td>".$index->username."</td>
                                                    <td>".$index->nama_user."</td>
                                                    <td>".$index->phone_user."</td>
                                                    <td>".$index->last_login."</td>
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