<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Spindetail extends CI_Controller {
    
    public function detail($spinid) {
        if ($this->isLogged()){
            $page = $this->getPage();
            $json = $this->getstatus();
            $pageid = array("page" => $page, "pagename" => "Rodada ".$spinid);
            
            $this->load->model('SpinModel');
            $this->load->model('RegistryModel');
            $this->load->model('UserModel');
            $reg = new RegistryModel();
            $spin = new SpinModel();
            $user = new UserModel();
            
            $spn = $spin->search($spinid);
            
            if($spn['status'] == 0){
                $this->load->model('SpinModel');
                $this->load->model('ContestrkModel');
                $spinmdl = new SpinModel();
                $contest = new ContestrkModel();

                $data = $contest->listing($json['temporada'], $spinid);
                $more = $reg->listing($spinid);
                $userlist = $user->listing();
                $balance = $reg->balance($spinid);

                $comp = $spinmdl->completed();
                $msg = array("teams" => $data, "pc" => $more, "users" => $userlist, "balance" => $balance, "spin" => $spinid, "spn" => $spn, "status" => $json['status_mercado'], "comp" => $comp);
                
                $this->load->view('template/super/menu', $pageid);
                $this->load->view('template/super/header', $pageid);
                $this->load->view('super/closedetail', $msg);
                $this->load->view('template/footer');
            }else{
                $data = $reg->listing($spinid);
                $balance = $reg->balance($spinid);
                $spindata = $spin->search($spinid);
                $userlist = $user->listing();

                $msg = array("teams" => $data, "spin" => $spinid, "spn" => $spindata, "users" => $userlist, "balance" => $balance);

                $this->load->view('template/super/menu', $pageid);
                $this->load->view('template/super/header', $pageid);
                $this->load->view('super/spindetail', $msg);
                $this->load->view('template/footer');
            }
        }else{
            redirect(base_url('login'));
        }
    }
    

    public function search() {
        if ($this->isLogged()){
            $spin = $this->input->post("spin");
            
            $page = $this->getPage();
            $pageid = array("page" => $page, "pagename" => "Rodada ".$spin);
            
            $this->load->model('RegistryModel');
            $this->load->model('SpinModel');
            $reg = new RegistryModel();
            $spinmdl = new SpinModel();
            
            $name = $this->input->post("searchtxt");
            
            $data = $reg->spin($name, $spin);
            
            $spindata = $spinmdl->search($spin);
            $msg = array("teams" => $data, "spin" => $spin, "spn" => $spindata);
            
            $this->load->view('template/super/menu', $pageid);
            $this->load->view('template/super/header', $pageid);
            $this->load->view('super/spindetail', $msg);
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
    
    public function admview($parameter) {
        if ($this->isLogged()){
            $page = $this->getPage();
            $json = $this->getstatus();
            
            $this->load->model('SpinModel');
            $this->load->model('RegistryModel');
            $this->load->model('UserModel');
            $reg = new RegistryModel();
            $spin = new SpinModel();
            $user = new UserModel();
            
            $exp = explode("-", $parameter);
            $spinid = $exp[0];
            $admin = $exp[1];
            
            $pageid = array("page" => $page, "pagename" => "Rodada ".$spinid);
            
            $spn = $spin->search($spinid);
            
            $data = $reg->listingadm($spinid, $admin);
            $balance = $reg->balance($spinid);
            $spindata = $spin->search($spinid);
            $userlist = $user->listing();
            $getuser = $user->getuser($admin);

            $msg = array("teams" => $data, "getuser" => $getuser, "spin" => $spinid, "spn" => $spindata, "users" => $userlist, "balance" => $balance);

            $this->load->view('template/super/menu', $pageid);
            $this->load->view('template/super/header', $pageid);
            $this->load->view('super/admview', $msg);
            $this->load->view('template/footer');
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
