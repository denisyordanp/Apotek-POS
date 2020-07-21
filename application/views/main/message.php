<div id="error" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-danger">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-wrong h1"></i>
                    <h4 class="mt-2">Maaf!</h4>
                    <?php 
                        if($this->session->flashdata('error')){ 
                            echo '<p class="mt-3">'.$this->session->flashdata('error').'</p>';
                        }
                    ?>
                    <button type="button" class="btn btn-light my-2"
                        data-dismiss="modal">Oke</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="success" class="modal fade" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content modal-filled bg-success">
            <div class="modal-body p-4">
                <div class="text-center">
                    <i class="dripicons-checkmark h1"></i>
                    <h4 class="mt-2">Selamat!</h4>
                    <?php 
                        if($this->session->flashdata('success')){ 
                            echo '<p class="mt-3">'.$this->session->flashdata('success').'</p>';
                        }
                    ?>
                    <button type="button" class="btn btn-light my-2"
                        data-dismiss="modal">Continue</button>
                </div>
            </div>
        </div>
    </div>
</div>