<?php 
    foreach($product as $index){
        echo '
            <div id="modal'.$index->id_produk.'" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-body">
                            <div class="text-center mt-2 mb-4">
                                <h3>Tambah produk</h3>
                            </div>

                            <form class="pl-3 pr-3" action="'.base_url().'master/editProduct" method="POST">

                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input name="id_produk" value="'.$index->id_produk.'" hidden>
                                    <input class="form-control" type="text" id="name" name="name"
                                        required="" placeholder="Masukan nama obat" value="'.$index->nama_produk.'">
                                </div>

                                <div class="form-group">
                                    <label for="categorySelect">Golongan</label>
                                    <select class="form-control" id="categorySelect" name="category" required>';

                                        foreach($category as $index2){
                                            echo '
                                                <option value="'.$index2->id_golongan.'"';
                                                if($index->id_golongan==$index2->id_golongan){
                                                    echo 'selected';
                                                }
                                            echo '>'.$index2->golongan.'</option>
                                            ';
                                        }
        echo '
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="beli">Harga beli</label>
                                    <input class="form-control" type="text" id="beli" name="beli"
                                        required="" placeholder="Masukan harga beli" value="'.$index->harga_beli.'">
                                </div>

                                <div class="form-group">
                                    <label for="jual">Harga jual</label>
                                    <input class="form-control" type="text" name="jual" required=""
                                        id="jual" placeholder="Masukan harga jual" value="'.$index->harga_jual.'">
                                </div>

                                <div class="form-group">
                                    <label for="unitSelect">Satuan</label>
                                    <select class="form-control" id="unitSelect" name="unit" required>';
                                        foreach($unit as $index3){
                                            echo '
                                                <option value="'.$index3->id_satuan.'"';
                                                if($index->id_satuan==$index3->id_satuan){
                                                    echo 'selected';
                                                }
                                            echo '>'.$index3->satuan.'</option>
                                            ';
                                        }
        echo '
                                    </select>
                                </div>

                                <div class="form-group text-center">
                                    <button class="btn btn-danger" type="button" data-target="#hpProduct'.$index->id_produk.'" data-toggle="modal"
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
    foreach($product as $index){
        echo '
        <div id="hpProduct'.$index->id_produk.'" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-danger">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-wrong h1"></i>
                            <h4 class="mt-2">Peringatan!</h4>
                            <p class="mt-3">Anda yakin akan menghapus produk '.$index->nama_produk.'?</p>
                            
                            <form action="'.base_url().'master/deleteProduct" method="POST">
                                <input value="'.$index->id_produk.'" name="id_produk" hidden>
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


<?php 
    foreach($unit as $index){
        echo '
        <div id="hpUnit'.$index->id_satuan.'" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-danger">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-wrong h1"></i>
                            <h4 class="mt-2">Peringatan!</h4>
                            <p class="mt-3">Anda yakin akan menghapus satuan '.$index->satuan.'?</p>
                            
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

<?php 
    foreach($category as $index){
        echo '
        <div id="hpCategory'.$index->id_golongan.'" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-danger">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <i class="dripicons-wrong h1"></i>
                            <h4 class="mt-2">Peringatan!</h4>
                            <p class="mt-3">Anda yakin akan menghapus golongan '.$index->golongan.'?</p>
                            
                            <form action="'.base_url().'master/deleteCategory" method="POST">
                                <input value="'.$index->id_golongan.'" name="id_golongan" hidden>
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