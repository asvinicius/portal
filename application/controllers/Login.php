<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
		if ($this->isLogged()){
            redirect(base_url('welcome'));
        } else {
            $this->load->view('public/login');
        }
    }
    
    public function signin() {
		if ($this->isLogged()){
			redirect(base_url('welcome'));
		} else {
			$this->load->model("LoginModel");
			$useremail = $this->input->post("useremail");
			$userpassword = md5($this->input->post("userpassword"));
			$user = $this->LoginModel->search($useremail, $userpassword);
			
			if($user){
				if($user['userstatus'] == '1'){
					$session = array(
						'userid' => $user["userid"],
						'username' => $user["username"],
						'logged' => TRUE
					);

					$this->session->set_userdata($session);

					redirect(base_url('login'));
				}else{
					$message = array(
						"class" => "warning",
						"message" => "Sinto muito!<br />Voca nao pode acessar o sistema neste momento.");

					$msg = array("message" => $message);
				
					$this->load->view('public/login', $msg);
				}
			}else {
				$message = array(
					"class" => "danger",
					"message" => "E-mail ou senha incorretos");
				
				$msg = array("message" => $message);
				
				$this->load->view('public/login', $msg);
			}
		}
    }
    
    public function signout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}