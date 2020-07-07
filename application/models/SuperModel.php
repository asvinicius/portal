<?php
class SuperModel extends CI_Model{
    
    public function listing(){
        $this->db->select('*');
        return $this->db->get("super")->result();
    }
    
    public function getuser($superid){
        $this->db->where("superid", $superid);
        
        return $this->db->get("super")->row_array();
    }
}