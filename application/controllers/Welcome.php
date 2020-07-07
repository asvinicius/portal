<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index() {
        if ($this->isLogged()){
			$this->load->model('UserModel');
            $this->load->model('TeamModel');
			$user = new UserModel();
            $team = new TeamModel();
			
			// pegar notificações para enviar para as views
			
			// pegar info do usuário para enviar para a página
			$loggeduser = $user->searchid($this->session->userdata('userid'));
			
			// pegar status do mercado para enviar para a página
			$json = $this->getstatus();
			
			// pegar times vinculados ao usuário para enviar para a página
			// pegar informações do bolão para enviar para a página
            
            
            
            $msg = array("pagename" => "Inicio");
			$teams  = $team->listinguser($this->session->userdata('userid'));
			
            $content = array("loggeduser" => $loggeduser, "marketstatus" => $json, "teams" => $teams);
            
            $this->load->view('template/super/menu');
            $this->load->view('template/super/header', $msg);
            $this->load->view('super/welcome', $content);
            $this->load->view('template/footer');
        }else{
            redirect(base_url('login'));
        }
    }
}