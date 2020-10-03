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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Grafik Penjualan</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item">Anda dapat melihat grafik penjualan berdasarkan produk disini
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

            <?php 

                $date_from = $date['date_from'];
                $date_until = $date['date_until'];
                $from = $date['from'];
                $until = $date['until'];
            
            ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Filter Grafik</h5>
                                <form class="pl-3 pr-3" action="<?php echo base_url().'laporan/setGrafikPeriod'?>" method="POST">

                                    <div class="form-group">
                                        <label for="from">Dari</label>
                                        <input class="form-control" type="date" id="from" name="from" value="<?php echo $from?>" required="">
                                    </div>

                                    <div class="form-group">
                                        <label for="from">Sampai</label>
                                        <input class="form-control" type="date" id="until" name="until" value="<?php echo $until?>" required="">
                                    </div>

                                    <div class="form-group text-left">
                                        <button class="btn btn-primary" type="submit">Lihat grafik</button>
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
                                <h4 style="text-align:center;"><b><?php echo $date_from.' Sampai '.$date_until?> </b></h4>
                                <div>
                                    <canvas id="penjualan-chart" height="150"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <?php $this->load->view("main/footer.php") ?>

        </div>
        <?php $this->load->view("main/js/main-js.php") ?>
        <?php $this->load->view("main/js/chart-js.php") ?>
        <?php $this->load->view("main/helper/grafik-function.php") ?>
</body>

</html>