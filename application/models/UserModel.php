<?php
class UserModel extends CI_Model{
    
    protected $userid;
    protected $username;
    protected $usercpf;
    protected $useremail;
    protected $userphone;
    protected $userpassword;
    protected $userstatus;
    
    function __construct() {
        parent::__construct();
        $this->setUserid(null);
        $this->setUsername(null);
        $this->setUsercpf(null);
        $this->setUseremail(null);
        $this->setUserphone(null);
        $this->setUserpassword(null);
        $this->setUserstatus(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('user', $data)) {
                return true;
            }
        }
    }
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("userid", $data['userid']);
            if ($this->db->update('user', $data)) {
                return true;
            }
        }
    }
    public function delete($userid) {
        if ($userid != null) {
            $this->db->where("userid", $userid);
            if ($this->db->delete("user")) {
                return true;
            }
        }
    }
    
    public function listing(){
        $this->db->select('*');
        $this->db->order_by("username", "asc");
        return $this->db->get("user")->result();
    }

    public function searchid($userid) {
        $this->db->where("userid", $userid);
        return $this->db->get("user")->row_array();
    }

    public function searchname($username) {
		$this->db->like("username", $username);
        $this->db->order_by("username", "asc");
        return $this->db->get("user")->result();
    }

    public function searchemail($useremail) {
        $this->db->where("useremail", $useremail);
        return $this->db->get("user")->row_array();
    }

    public function searchcpf($usercpf) {
        $this->db->where("usercpf", $usercpf);
        return $this->db->get("user")->row_array();
    }

    public function recover($useremail, $usercpf) {
        $this->db->where("useremail", $useremail);
        $this->db->where("usercpf", $usercpf);
        return $this->db->get("user")->row_array();
    }
    
    function getUserid() {
        return $this->userid;
    }

    function getUsername() {
        return $this->username;
    }

    function getUsercpf() {
        return $this->usercpf;
    }

    function getUseremail() {
        return $this->useremail;
    }

    function getUserphone() {
        return $this->userphone;
    }

    function getUserpassword() {
        return $this->userpassword;
    }

    function getUserstatus() {
        return $this->userstatus;
    }

    function setUserid($userid) {
        $this->userid = $userid;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setUsercpf($usercpf) {
        $this->usercpf = $usercpf;
    }

    function setUseremail($cartolaemail) {
        $this->cartolaemail = $cartolaemail;
    }

    function setUserphone($userphone) {
        $this->userphone = $userphone;
    }

    function setUserpassword($userpassword) {
        $this->userpassword = $userpassword;
    }

    function setUserstatus($userstatus) {
        $this->userstatus = $userstatus;
    }


}