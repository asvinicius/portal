<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Novotime extends CI_Controller {

    public function index() {
        if ($this->isLogged()){
            $page = $this->getPage();
            $pageid = array("page" => $page, "pagename" => "Adicionar time");
            
            $this->load->view('template/super/menu', $pageid);
            $this->load->view('template/super/header', $pageid);
            $this->load->view('super/newteam');
            $this->load->view('template/footer');
        }else{
            redirect(base_url('login'));
        }
    }
    
    public function search() {
        if ($this->isLogged()){
            
            $page = $this->getPage();
            $pageid = array("page" => $page, "pagename" => "Adicionar time");
            $team = $this->input->post("team");
            $titulo_novo = preg_replace('/[ -]+/' , '%20' , $team);
            
            $json = $this->searchteams($titulo_novo);
            
            $msg = array("teams" => $json);
            
            $this->load->view('template/super/menu', $pageid);
            $this->load->view('template/super/header', $pageid);
            $this->load->view('super/newteam', $msg);
            $this->load->view('template/footer');
            
            
        }else{
            redirect(base_url('login'));
        }
    }
    
    public function searchteams($team=null) {
        
        $url = 'https://api.cartolafc.globo.com/times?q='.$team;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,[
          'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
          'Content-Type: application/json',
        ]);
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die(curl_error($ch));
        }
        
        curl_close($ch);
        
        $json = json_decode($result, true);
        
        return $json;
    }

    public function escolher($teamid = null) {
        if ($this->isLogged()){
            $this->load->model('TeamModel');
            $team = new TeamModel();
            
            $json = $this->select($teamid);
            $selected = $json['time'];
            
            $teamdata['teamid'] = $selected['time_id'];
            $teamdata['teamuser'] = $this->session->userdata('userid');
            $teamdata['teamname'] = $selected['nome'];
            $teamdata['teamcoach'] = $selected['nome_cartola'];
            $teamdata['teamslug'] = $selected['slug'];
            $teamdata['teamshield'] = $selected['url_escudo_svg'];
            $teamdata['teamstatus'] = 1;
            
            $restriction = $team->search($teamdata['teamid']);
            
            if($restriction == null){
                if($team->save($teamdata)){
					// time adicionado com sucesso!!
                    redirect(base_url('times'));
                }
            } else {
				if($restriction['teamuser'] == $this->session->userdata('userid')){
					if($team->update($teamdata)){
						// o time selecionado ja faz parte do seu esquadrão, atualizamos as informações
						redirect(base_url('times'));
					}
				} else {
					// infelizmente o time selecionado ja pertence a outro esquadrão
					redirect(base_url('times'));
				}
            }
        }else{
            redirect(base_url('login'));
        }
    }
    
    public function select($teamid=null) {
        
        $url = 'https://api.cartolafc.globo.com/time/id/'.$teamid;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER ,[
          'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.133 Safari/537.36',
          'Content-Type: application/json',
        ]);
        $result = curl_exec($ch);
        
        if ($result === FALSE) {
            die(curl_error($ch));
        }
        
        curl_close($ch);
        
        $json = json_decode($result, true);
        
        return $json;
    }

    public function getPage() {
        $current = array("id" => 1, "page" => "user");
        return array("current" => $current);
    }
}
