<?php
class ProductModel extends CI_Model{
    
    protected $requestid;
    protected $requestuser;
    protected $requestprice;
    protected $requestattachment;
    protected $requeststatus;
    
    function __construct() {
        parent::__construct();
        $this->setRequestid(null);
        $this->setRequestuser(null);
        $this->setRequestprice(null);
        $this->setRequestattachment(null);
        $this->setRequeststatus(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('request', $data)) {
                return true;
            }
        }
    }
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("requestid", $data['requestid']);
            if ($this->db->update('request', $data)) {
                return true;
            }
        }
    }
    public function delete($requestid) {
        if ($requestid != null) {
            $this->db->where("requestid", $requestid);
            if ($this->db->delete("request")) {
                return true;
            }
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->order_by("requestid", "asc");
        return $this->db->get("request")->result();
    }
    
    public function search($requestid) {
        if ($requestid != null) {
			$this->db->where("requestid", $requestid);
			return $this->db->get("request")->row_array();
		}
    }

    function getRequestid() {
        return $this->requestid;
    }

    function getRequestuser() {
        return $this->requestuser;
    }

    function getRequestprice() {
        return $this->requestprice;
    }

    function getRequestattachment() {
        return $this->requestattachment;
    }

    function getRequeststatus() {
        return $this->requeststatus;
    }

    function setRequestid($requestid) {
        $this->requestid = $requestid;
    }
	
    function setRequestuser($requestuser) {
        $this->requestuser = $requestuser;
    }
	
    function setRequestprice($requestprice) {
        $this->requestprice = $requestprice;
    }
	
    function setRequestattachment($requestattachment) {
        $this->requestattachment = $requestattachment;
    }
	
    function setRequeststatus($requeststatus) {
        $this->requeststatus = $requeststatus;
    }

}