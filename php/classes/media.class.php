<?php

class mediaItem {
    private $idx;
    private $type;
    private $name;
    private $xidx;
    
    public function getIdx() {
        return $this->idx;
    }
    public function getType() {
        return $this->type;
    }
    public function getName() {
        return $this->name;
    }
    public function getXidx() {
        return $this->xidx;
    }
    
    public function setType($val) {
        $this->type = $val;
    }
    
    public function setName($val) {
        $this->name = $val;
    }
    
    public function setXidx($val) {
        $this->xidx = $val;
    }

    private function create() {

        global $fs_media_base;
    
        $result = $this->db->query("INSERT INTO media (idx, type, name, xidx) VALUES (".$this->idx.", -1, -1, -1)");
        if (!$result){
            die($this->db->error);
        }
        if (!mkdir($fs_items_base . $this->idx, 0577, true)) {
            die('Failed to create folders...');
        } 
    }
    
    public function delete() {
        $result = $this->db->query("DELETE FROM media where idx=".$this->idx);
        if (!$result){
            die($this->db->error);
        }
    }
    
/*
**********************************************
**                                          **
**        CONSTRUCTOR METHOD                **
**                                          **
********************************************** 
*/
    
    public function __construct($idx) {
        
        global $db;
        $this->db = $db;
        
        if($idx == -1) {
            $this->idx = time();
            $this->create();
        }
        else {
            $this->idx = $idx;
        }
        
        $result = $this->db->query("
                    SELECT m.idx, m.type, m.name, m.xidx
                    FROM media m
                    WHERE m.idx=$this->idx
                    ");
        if (!$result){
            die($this->db->error);
        }
        $record = $result->fetch_object();
        $this->type   = $record->type;
        $this->name   = $record->name;
        $this->idx    = $record->xidx;
        
    }
    
}

?>