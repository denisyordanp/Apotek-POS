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
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Pembelian / Riwayat</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="index.html">List riwayat pembelian produk</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

            <?php $this->load->view("main/message.php") ?>

            <?php 
                $modal = 1;
                $total = 0;
                foreach($purchase as $index){
                    $idThis = $index->id_pembelian;

                    echo '<div id="modal'.$modal.'" class="modal fade" tabindex="-1" role="dialog"
                            aria-labelledby="fullWidthModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-full-width">
                                <div class="modal-content">
            
                                    <div class="modal-body">
                                        <div class="text-center mt-2 mb-4">
                                            <h3>Faktur pembelian</h3>
                                        </div>
            
                                        <div class="text-left mt-2 mb-4">
                                            <h5>No: <b>'.$idThis.'</b></h5>
                                        </div>

                                            <table class="table mb-0">
                                                <tbody>
                    ';

                    $no = 1;
                    foreach($purchaseProduct as $product){
                        if($product->id_pembelian==$idThis){
                            $total = $total + ($product->pembelian*$product->harga_beli);
                            echo '
                                <tr>
                                    <th scope="row">'.$no.'</th>
                                    <td>'.$product->nama_produk.'</td>
                                    <td>Rp. '.number_format($product->harga_beli).'</td>
                                    <td>'.$product->pembelian.' '.$product->satuan.'</td>
                                    <td>Rp. '.number_format($product->harga_beli*$product->pembelian).'</td>
                                </tr>
                            ';
                            $no++;
                        }
                        
                    }

                    echo '
                                    <tr>
                                        <th scope="row" colspan="4">Total pembelian</th>
                                        <th>Rp. '.number_format($total).'</th>
                                    </tr>
                                    </tbody>
                                    </table>

                                    <div class="form-group">
                                        <label for="name">Supplier</label>
                                        <input class="form-control" type="text" id="name" name="name" value="'.$index->nama_supplier.'" disabled>
                                    </div>

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

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="purchase" class="table table-striped table-bordered no-wrap table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>No. Pembelian</th>
                                            <th>Tanggal</th>
                                            <th>Supplier</th>
                                            <th>Oleh</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            $total = 0;
                                            foreach($purchase as $index){
                                                $idThis = $index->id_pembelian;

                                                foreach($purchaseProduct as $product){
                                                    if($product->id_pembelian==$idThis){
                                                        $total = $total + ($product->pembelian*$product->harga_beli);
                                                    }
                                                }

                                                echo "<tr class='clickable-row' data-toggle='modal' data-target='#modal".$no."'>
                                                    <td>".$no.".</td>
                                                    <td>".$index->id_pembelian."</td>
                                                    <td>".date("d/m/Y", strtotime($index->tanggal_pembelian))."</td>
                                                    <td>".$index->nama_supplier."</td>
                                                    <td>".$index->nama_user."</b></td>
                                                    <td>Rp. ".number_format($total)."</td>
                                                    </tr>
                                                    ";
                                                $no++;
                                                $total = 0;
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

            <?php $this->load->view("main/footer.php") ?>

        </div>
        <?php $this->load->view("main/js/main-js.php") ?>
        <?php $this->load->view("main/js/data-tables-js.php") ?>
        <?php $this->load->view("main/js/modal-message-js.php") ?>
        
</body>

</html>