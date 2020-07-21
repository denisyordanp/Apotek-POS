<?php 
    if($this->session->flashdata('error')){ 
        echo "<script>
        $('#error').modal('show');
        </script>";
    }elseif($this->session->flashdata('success')){
        echo "<script>
        $('#success').modal('show');
        </script>";
    }
?>