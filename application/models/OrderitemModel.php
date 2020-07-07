<?php
class OrderitemModel extends CI_Model{
    
    protected $orderitemid;
    protected $orderitemrequest;
    protected $orderitemproduct;
    protected $orderitemteam;
    
    function __construct() {
        parent::__construct();
        $this->setOrderitemid(null);
        $this->setOrderitemrequest(null);
        $this->setOrderitemproduct(null);
        $this->setOrderitemteam(null);
    }
    
    public function save($data = null) {
        if ($data != null) {
            if ($this->db->insert('orderitem', $data)) {
                return true;
            }
        }
    }
    public function update($data = null) {
        if ($data != null) {
            $this->db->where("orderitemid", $data['orderitemid']);
            if ($this->db->update('orderitemid', $data)) {
                return true;
            }
        }
    }
    public function delete($orderitemid) {
        if ($orderitemid != null) {
            $this->db->where("orderitemid", $orderitemid);
            if ($this->db->delete("orderitem")) {
                return true;
            }
        }
    }
    
    public function listing() {
        $this->db->select('*');
        $this->db->order_by("orderitemid", "asc");
        return $this->db->get("orderitem")->result();
    }
    
    public function search($orderitemid) {
        if ($orderitemid != null) {
			$this->db->where("orderitemid", $orderitemid);
			return $this->db->get("orderitem")->row_array();
		}
    }

    function getOrderitemid() {
        return $this->orderitemid;
    }

    function getOrderitemrequest() {
        return $this->orderitemrequest;
    }

    function getOrderitemproduct() {
        return $this->orderitemproduct;
    }

    function getOrderitemteam() {
        return $this->orderitemteam;
    }

    function setOrderitemid($orderitemid) {
        $this->orderitemid = $orderitemid;
    }

    function setOrderitemrequest($orderitemrequest) {
        $this->orderitemrequest = $orderitemrequest;
    }

    function setOrderitemproduct($orderitemproduct) {
        $this->orderitemproduct = $orderitemproduct;
    }

    function setOrderitemteam($orderitemteam) {
        $this->orderitemteam = $orderitemteam;
    }


}