<?php

class gridContainer {
    private $idx;
    private $name;
    private $location;
    private $active;
    private $decorations;
    
    public function getIdx() {
        return $this->idx;
    }
    public function getName() {
        return $this->name;
    }
    public function getLocation() {
        return $this->location;
    }
    public function getActive() {
        return $this->active;
    }
    public function getDecorations() {
        return $this->decorations;
    }

    public function setName($val) {
        $this->name = $val;
    }
    public function setLocation($val) {
        $this->location = $val;
    }
    public function setActive($val) {
        $this->active = $val;
    }
    public function setImg($decorations) {
        $this->decorations = $val;
    }

    private function create() {

        $result = $this->db->query("INSERT INTO gridcontainers (idx, name, location, active, decorations) VALUES (".$this->idx.", '', 0, '', '')");
        if (!$result){
            die($this->db->error);
        }
    }
    
    public function delete() {
        $result = $this->db->query("DELETE FROM gridcontainers where idx=".$this->idx);
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
                    SELECT gc.idx, gc.name, gc.location, gc.active, gc.decorations
                    FROM gridcontainers gc
                    WHERE gc.idx=$this->idx
                    ");
        if (!$result){
            die($this->db->error);
        }
        
        $record = $result->fetch_object();
        $this->name        = $record->name;
        $this->location    = $record->location;
        $this->active      = $record->active;
        $this->decorations = $record->decorations;
        
    }
    
}

?>