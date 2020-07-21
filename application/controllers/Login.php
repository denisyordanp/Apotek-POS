<?php
class Login extends CI_Controller{

    function __construct(){
        parent:: __construct();
        $this->load->model("main_model");
        $this->load->library('session');
        if($this->main_model->isLogin()) redirect('penjualan');
    }

    public function index(){
        $this->load->view('html/authentication-login');
    }

    function login(){
        $post = $this->input->post();
        $user = $this->main_model->login($post['username']);
        if($user){
            $isPassword = password_verify($post["password"], $user->password);
            if($isPassword){ 
                $userId = $user->user_id;
                $this->session->set_userdata(['user' => $user]);
                $this->main_model->updateLastLogin($userId);
                redirect(site_url('penjualan'));
            }else{
                $this->session->set_flashdata('error','Password tidak cocok, silahkan ulangi lagi');
                    redirect(site_url());
            }
        }else{
            $this->session->set_flashdata('error','Username tidak ditemukan. Jika belum terdaftar, silahkan hubungi admin untuk mendaftar');
                redirect(site_url());
        }
    }
}
?>
