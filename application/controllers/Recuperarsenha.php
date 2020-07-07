<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recuperarsenha extends CI_Controller {

    public function index() {
		if ($this->isLogged()){
            redirect(base_url('welcome'));
        } else {
            $this->load->view('public/forgot');
        }
    }
    
    public function solicitar() {
		if ($this->isLogged()){
			redirect(base_url('welcome'));
		} else {
			$this->load->library('email');
			$this->load->model("UserModel");
			$user = new UserModel();
			
			$recoveremail = $this->input->post("recoveremail");
			$recovercpf = $this->input->post("recovercpf");
			
			$item = $user->recover($recoveremail, $recovercpf);
			
			if($item){
				if($item['userstatus'] == '1'){
					
					$token1 = md5($recovercpf);
					$token2 = md5($recoveremail);
					$token3 = md5($recovercpf."_".$recoveremail);
					$token4 = md5($token1."_".$token3."_".$token2);
					$finaltoken = base64_encode(date('d-m-Y H:m')."_".$token4);
					
					$subject = "Recuperação de senha";
					$message = "<p>Recebemos uma solicitação para recuperação de senha.</p>
								<p>O link abaixo te levará à página para recuperar sua senha. O token é válido por 30 minutos e caso expire, 
								você deverá fazer uma nova solicitação.</p>
								<p>http://192.168.100.26/portal/recuperarsenha/token/".$finaltoken."</p>
								
								<p>Caso você não tenha feito nenhuma solicitação, desconsidere esta mensagem.</p>";
					
					$this->email->from($recoveremail, 'no-reply');
					$this->email->to($recoveremail);
					$this->email->subject($subject);
					$this->email->message($message);
					
					if($this->email->send()){
						$this->load->view('public/forgotsend');
					} else {
						$message = array(
							"class" => "danger",
							"message" => "Não foi possível enviar sua mensagem");

						$msg = array("message" => $message);
					
						$this->load->view('public/forgot', $msg);
					}					
				}else{
					$message = array(
						"class" => "warning",
						"message" => "Sinto muito!<br />Você não pode executar esta ação neste momento.");

					$msg = array("message" => $message);
				
					$this->load->view('public/forgot', $msg);
				}
			}else {
				$message = array(
					"class" => "danger",
					"message" => "Os dados informados não foram encontrados no sistema");
				
				$msg = array("message" => $message);
				
				$this->load->view('public/forgot', $msg);
			}
		}
    }
    
    public function token($token) {
		if ($this->isLogged()){
			redirect(base_url('welcome'));
		} else {
			// quebrar token no underline;
			// pegar a primeira parte, de data e hora, e comparar com a data e hora de execução;
			// caso data e hora de execução for mais de 30min apos data de criação do token, exibir mensagem de token expirado;
			// caso token válido, carregar views enciando a segunda parte do token como input hidden no form;
			// form deve ter campo CPF, Nova senha e Conf nova senha;
			// ao submeter form, verificar cpf no bd e caso exista, criar um token de comparação com o token decriptado;
			// caso os tokens não sejam iguais, exibir mensagem de erro no processo;
			// caso o token seja válido, proceder p update do cadastro;
		}
    }
}