<?php

class cat {
    private $db;
    private $cat_idx;
    private $cat_name;
    private $cat_owner;


public function getIdx() {
    return $this->cat_idx;
}    
    
public function setIdx($idx) {
    $this->cat_idx = $idx;
}    
    
public function getName() {
    return $this->cat_name;
}    
    
public function setName($name) {
    $this->cat_name = $name;
}    
    
public function getOwner() {
    return $this->cat_owner;
}    
    
public function setOwner($owner) {
    $this->cat_owner = $owner;
}    
    
public function store() {
    $result = $this->db->query("
                UPDATE jes_cats 
                    SET cat_name=\"".$this->cat_name."\", cat_owner=".$this->cat_owner." 
                    WHERE cat_idx=$this->cat_idx
                ");
    if (!$result){
        die($this->db->error);
    }
}

private function create() {
    $result = $this->db->query("INSERT INTO jes_cats (cat_idx) VALUES (".$this->cat_idx.")");
    if (!$result){
        die($this->db->error);
    }
}

public function delete() {
    $result = $this->db->query("DELETE FROM jes_cats where cat_idx=".$this->cat_idx);
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
    
    public function __construct($catID) {
        
        global $db;
        $this->db = $db;
        
        if($catID == -1) {
            $this->cat_idx = time();
            $this->create();
        }
        else {
            $this->cat_idx = $catID;
        }
        
        $result = $this->db->query("
                    SELECT c.cat_idx, c.cat_name, c.cat_owner
                    FROM jes_cats c
                    WHERE c.cat_idx=$this->cat_idx
                    ");
        if (!$result){
            die($this->db->error);
        }
        $record = $result->fetch_object();
        $this->cat_name = $record->cat_name;
        $this->cat_owner = $record->cat_owner;
        
    }
    
}

?>
