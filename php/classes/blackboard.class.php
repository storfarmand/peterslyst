<?php

class blackboardItem {
    private $idx;
    private $title;
    private $desc;
    
    public function getIdx() {
        return $this->idx;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getDesc() {
        return $this->desc;
    }

    public function setTitle($val) {
        $this->title = $val;
    }
    public function setDesc($val) {
        $this->desc = $val;
    }

    private function create() {

        $result = $this->db->query("INSERT INTO blackboard (idx, title, desc) VALUES (".$this->idx.", -1, -1)");
        if (!$result){
            die($this->db->error);
        }
    }
    
    public function delete() {
        $result = $this->db->query("DELETE FROM blackboard where idx=".$this->idx);
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
                    SELECT bb.idx, bb.title, bb.desc
                    FROM blackboard bb
                    WHERE bb.idx=$this->idx
                    ");
        if (!$result){
            die($this->db->error);
        }
        $record = $result->fetch_object();
        $this->title   = $record->title;
        $this->desc   = $record->desc;
        
    }
    
}

?>