<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {

    public function index() {
        if ($this->session->userdata('logged') === TRUE) {
            redirect(base_url('welcome'));
        } else {
            $this->load->view('public/register');
        }
    }
	
	public function salvar(){
        $this->load->model('UserModel');
        $user = new UserModel();
		
		$username = $this->input->post('username');
		$usercpf = $this->input->post('usercpf');
		$useremail = $this->input->post('useremail');
		$userphone = $this->input->post('userphone');
		$userpassword = $this->input->post('userpassword');
		
		if($this->existingcpf($usercpf)){
			$message = array(
				"class" => "danger",
				"message" => "O CPF digitado já existe em nossa base de dados.");

			$msg = array("message" => $message);
			
            $this->load->view('public/register', $msg);
			return false;
		} else {
			if($this->existingemail($useremail)){
				$message = array(
					"class" => "danger",
					"message" => "O E-mail digitado já existe em nossa base de dados.");

				$msg = array("message" => $message);
				
				$this->load->view('public/register', $msg);
				return false;
				
			} else {
				$userdata['userid'] = null;
				$userdata['username'] = $username;
				$userdata['usercpf'] = $usercpf;
				$userdata['useremail'] = $useremail;
				$userdata['userphone'] = $userphone;
				$userdata['userphone'] = md5($userphone);
				$userdata['userstatus'] = 1;
				
				if($user->save($userdata)){
					$message = array(
						"class" => "success",
						"message" => "Cadastro efetuado com sucesso!");

					$msg = array("message" => $message);
					
					$this->load->view('public/register', $msg);
					
					return true;
				}
			}
		}
	}
	
	function existingcpf($usercpf = null) {
        $this->load->model('UserModel');
        $user = new UserModel();
        
        if($cartola->searchcpf($usercpf)){
            return true;
        }
    }
	
	function existingemail($useremail = null) {
        $this->load->model('UserModel');
        $user = new UserModel();
        
        if($cartola->searchemail($useremail)){
            return true;
        }
    }
}