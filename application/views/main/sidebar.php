<nav class="sidebar-nav">
    <ul id="sidebarnav">
        <li class="sidebar-item"> <a class="sidebar-link" href="<?php echo base_url()?>penjualan"
        aria-expanded="false"><i class="fas fa-shopping-bag"></i></i><span
            class="hide-menu">Penjualan</span></a></li>
        <li class="list-divider"></li>
        <li class="nav-small-cap"><span class="hide-menu">Gudang</span></li>
        <li class="sidebar-item"> <a class="sidebar-link" href="<?php echo base_url()?>supplier"
        aria-expanded="false"><i class="fas fa-warehouse"></i></i><span
            class="hide-menu">Suppllier</span></a></li>
        <li class="sidebar-item"> <a class="sidebar-link" href="<?php echo base_url()?>pembelian/pembelian"
        aria-expanded="false"><i class="fas fa-cart-plus"></i></i><span
            class="hide-menu">Pembelian</span></a></li>
        <li class="list-divider"></li>
        <li class="nav-small-cap"><span class="hide-menu">Manajemen</span></li>
        <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
                aria-expanded="false"><i class="fas fa-clipboard"></i><span
                    class="hide-menu">Laporan </span></a>
            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                <li class="sidebar-item"><a href="<?php echo base_url()?>laporan/pembelian" class="sidebar-link"><span
                            class="hide-menu"> Pembelian
                        </span></a>
                </li>
                <li class="sidebar-item"><a href="<?php echo base_url()?>laporan/penjualan" class="sidebar-link"><span
                            class="hide-menu"> Penjualan
                        </span></a>
                </li>
                <li class="sidebar-item"><a href="<?php echo base_url()?>laporan/stok" class="sidebar-link"><span
                            class="hide-menu"> Stok
                        </span></a>
                </li>
            </ul>
        </li>

        <?php if($this->session->userdata('user')->user_id==1){
            echo '
            <li class="sidebar-item"> <a class="sidebar-link has-arrow" href="javascript:void(0)"
            aria-expanded="false"><i class="fas fa-cogs"></i><span
            class="hide-menu">Pengaturan</span></a>
                <ul aria-expanded="false" class="collapse first-level base-level-line">
                    <li class="sidebar-item"> <a class="has-arrow sidebar-link" href="javascript:void(0)"
                            aria-expanded="false"><span class="hide-menu">Data master</span></a>
                        <ul aria-expanded="false" class="collapse second-level base-level-line">
                            <li class="sidebar-item"><a href="'.base_url().'master/product" class="sidebar-link"><span
                                        class="hide-menu"> Produk</span></a></li>
                            <li class="sidebar-item"><a href="'.base_url().'master/category" class="sidebar-link"><span
                                        class="hide-menu"> Golongan</span></a></li>
                            <li class="sidebar-item"><a href="'.base_url().'master/unit" class="sidebar-link"><span
                                        class="hide-menu"> Satuan</span></a></li>
                            <li class="sidebar-item"><a href="'.base_url().'master/company" class="sidebar-link"><span
                                        class="hide-menu"> Perusahaan</span></a></li>
                        </ul>
                    </li>
                    <li class="sidebar-item"><a href="'.base_url().'pengguna" class="sidebar-link"><span
                        class="hide-menu"> Pengguna
                            </span></a>
                    </li>
                </ul>
            </li>
            ';
        }?>
    </ul>
</nav>