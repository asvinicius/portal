<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Spin extends CI_Controller {

    public function index() {
        if ($this->isLogged()){
            $page = $this->getPage();
            $pageid = array("page" => $page, "pagename" => "Gerenciamento de rodadas");
            
            $this->load->model('SpinModel');
            $spin = new SpinModel();
            
            $data = $spin->listing();
            $msg = array("spins" => $data);
            
            $this->load->view('template/super/menu', $pageid);
            $this->load->view('template/super/header', $pageid);
            $this->load->view('super/spin', $msg);
            $this->load->view('template/footer');
        }else{
            redirect(base_url('login'));
        }
    }
    public function detail($spinid) {
        if ($this->isLogged()){
            $page = $this->getPage();
            $pageid = array("page" => $page, "pagename" => "Rodada ".$spinid);
            
            $this->load->model('SpinModel');
            $this->load->model('RegistryModel');
            $spin = new SpinModel();
            $reg = new RegistryModel();
            
            $data = $reg->listing($spinid);
            $msg = array("teams" => $data, "spin" => $spin);
            
            $this->load->view('template/super/menu', $pageid);
            $this->load->view('template/super/header', $pageid);
            $this->load->view('super/spindetail', $msg);
            $this->load->view('template/footer');
        }else{
            redirect(base_url('login'));
        }
    }
    
    public function subscribeteam($data=null) {
        if ($this->isLogged()){
            $this->load->model('SpinModel');
            $this->load->model('RegistryModel');
            $spin = new SpinModel();
            $reg = new RegistryModel();
            
            $exp = explode("-", $data);
            $team = $exp[1];
            $spinid = $exp[0];
            
            $con = $reg->getreg($team, $spinid);
            
            if($con == null){

                $regdata['registryid'] = null;
                $regdata['team'] = $team;
                $regdata['spin'] = $spinid;
                $regdata['admin'] = $this->session->userdata('userid');

                if($reg->save($regdata)){
                    $spindata = $spin->search($spinid);
                    $spindata['numteams'] = $spindata['numteams']+1;

                    if($spin->update($spindata)){
                        redirect(base_url('team/subscribe/'.$team));
                    }
                }
            }else{
                redirect(base_url('spindetail/detail/'.$spinid));
            }
        }else{
            redirect(base_url('login'));
        }
    }
    
    public function subscribespin($data=null) {
        if ($this->isLogged()){
            $this->load->model('SpinModel');
            $this->load->model('RegistryModel');
            $spin = new SpinModel();
            $reg = new RegistryModel();
            
            $exp = explode("-", $data);
            $team = $exp[1];
            $spinid = $exp[0];
            
            $con = $reg->getreg($team, $spinid);
            
            if($con == null){

                $regdata['registryid'] = null;
                $regdata['team'] = $team;
                $regdata['spin'] = $spinid;
                $regdata['admin'] = $this->session->userdata('userid');

                if($reg->save($regdata)){
                    $spindata = $spin->search($spinid);
                    $spindata['numteams'] = $spindata['numteams']+1;

                    if($spin->update($spindata)){
                        redirect(base_url('spin/listgenerator/'.$spinid));
                    }
                }
            }else{
                redirect(base_url('spindetail/detail/'.$spinid));
            }
        }else{
            redirect(base_url('login'));
        }
    }
    
    public function unsubscribe($data=null) {
        if ($this->isLogged()){
            $this->load->model('SpinModel');
            $this->load->model('RegistryModel');
            $spin = new SpinModel();
            $reg = new RegistryModel();
            
            $exp = explode("-", $data);
            $team = $exp[1];
            $spinid = $exp[0];
            
            $regdata = $reg->getreg($team, $spinid);
            
            if($reg->delete($regdata['registryid'])){
                $spindata = $spin->search($spinid);
                $spindata['numteams'] = $spindata['numteams']-1;
                
                if($spin->update($spindata)){
                    redirect(base_url('spindetail/detail/'.$spinid));
                }
            }
        }else{
            redirect(base_url('login'));
        }
    }
    public function codegenerator($spinid) {
        if ($this->isLogged()){
            $page = $this->getPage();
            $pageid = array("page" => $page, "pagename" => "Gerenciamento de rodadas");
            
            $this->load->model('RegistryModel');
            $reg = new RegistryModel();
            
            $regdata = $reg->codelist($spinid);
            
            $code = "Bolão#".$spinid."=>";
        
	    $c = 0;
            foreach ($regdata as $simple) {
                if($c == 0){
                    $code = $code.$simple->team;
                }else{
                    $code = $code.";".$simple->team;
                }
                $c++;
            }           
            
            $msg = array("spin" => $spinid, "code" => $code);
            
            $this->load->view('template/super/menu', $pageid);
            $this->load->view('template/super/header', $pageid);
            $this->load->view('super/code', $msg);
            $this->load->view('template/footer');
        }else{
            redirect(base_url('login'));
        }
    }
    
    public function listgenerator($spinid) {
        if ($this->isLogged()){
            $page = $this->getPage();
            $pageid = array("page" => $page, "pagename" => "Gerenciamento de rodadas");
            
            $this->load->model('RegistryModel');
            $reg = new RegistryModel();
            
            $regdata = $reg->codelist($spinid);
            $status = $this->getstatus();
            
            if($status['fechamento']['dia'] > 10){
                $day = $status['fechamento']['dia'];
            }else{
                $day = "0".$status['fechamento']['dia'];
            }
            if($status['fechamento']['mes'] > 10){
                $month = $status['fechamento']['mes'];
            }else{
                $month = "0".$status['fechamento']['mes'];
            }
            
            $msg = array("spin" => $spinid, "regdata" => $regdata, "status" => $status, "day" => $day, "month" => $month);
            
            $this->load->view('template/super/menu', $pageid);
            $this->load->view('template/super/header', $pageid);
            $this->load->view('super/listround', $msg);
            $this->load->view('template/footer');
        }else{
            redirect(base_url('login'));
        }
    }

    public function search() {
        if ($this->isLogged()){
            $page = $this->getPage();
            $pageid = array("page" => $page, "pagename" => "Gerenciamento de times");
            
            $this->load->model('TeamModel');
            $team = new TeamModel();
            
            $name = $this->input->post("searchtxt");
            
            $data = $team->specific($name);
            $msg = array("teams" => $data);
            
            $this->load->view('template/super/menu', $pageid);
            $this->load->view('template/super/header', $pageid);
            $this->load->view('super/team', $msg);
            $this->load->view('template/footer');
        }else{
            redirect(base_url('login'));
        }
    }
    
    public function changestatus($newsid=null) {
        if ($this->isLogged()){
            $this->load->model('NewsModel');
            $news = new NewsModel();
            
            $data = $news->search($newsid);
            
            if($data['status'] == 0){
                $data['status'] = 1;
            }else{
                $data['status'] = 0;
            }
            
            if ($news->update($data)) {
                redirect(base_url('viewnews/index/' . $data['newsid']));
            }
        }else{
            redirect(base_url('login'));
        }
    }

    public function delete($newsid = null) {
        if ($this->isLogged()){
            $this->load->model('NewsModel');
            $news = new NewsModel();
            
            if ($news->delete($newsid)) {
                redirect(base_url('news'));
            }
            
        }else{
            redirect(base_url('login'));
        }
    }

    public function getPage() {
        $current = array("id" => 2, "page" => "user");
        return array("current" => $current);
    }
}
