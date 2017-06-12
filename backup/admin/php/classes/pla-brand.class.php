<?php

class brand {
    private $db;
    private $b_idx;
    private $b_text;
    private $b_logo;


public function getIdx() {
    return $this->b_idx;
}    
    
public function setIdx($idx) {
    $this->b_idx = $idx;
}    
    
public function getText() {
    return $this->b_text;
}    
    
public function setText($text) {
    $this->b_text = $text;
}    
    
public function getLogo() {
    return $this->b_logo;
}    
    
public function setLogo($logo) {
    $this->b_logo = $logo;
}    
    
public function store() {
    $result = $this->db->query("
                UPDATE jes_brands 
                    SET b_text=\"".$this->b_text."\", b_logo=\"".$this->b_logo."\" 
                    WHERE b_idx=$this->b_idx
                ");
    if (!$result){
        die($this->db->error);
    }
}

public function newLogo($logo) {
    $this->setLogo($logo);
    $this->store();
}

public function updateMedia($type, $file) {
    switch ($type) {
        case "pic":
            $this->newLogo($file);
            break;
    }
}

private function create() {
    
    global $fs_brands_base;
    
    $this->b_idx = time();;
    $result = $this->db->query("INSERT INTO jes_brands (b_idx) VALUES (".$this->b_idx.")");
    if (!$result){
        die($this->db->error);
    }
    if (!mkdir($fs_brands_base . $this->b_idx, 0577, true)) {
        die('Failed to create folders...');
    }    
}

public function delete() {

    global $fs_brands_base;
    
    $result = $this->db->query("DELETE FROM jes_brands where b_idx=".$this->b_idx);
    if (!$result){
        die($this->db->error);
    }
    if (!rmdir($fs_brands_base . $this->b_idx)) {
        die('Failed to create folders...');
    }  }

/*
**********************************************
**                                          **
**        CONSTRUCTOR METHOD                **
**                                          **
********************************************** 
*/
    
    public function __construct($brandID) {
        
        global $db;
        $this->db = $db;
        
        if($brandID == -1) {
            $this->create();
        }
        else {
            $this->b_idx = $brandID;
        }
        
        $result = $this->db->query("
                    SELECT b.b_idx, b.b_text, b.b_logo
                    FROM jes_brands b
                    WHERE b.b_idx=$this->b_idx
                    ");
        if (!$result){
            die($this->db->error);
        }
        $record = $result->fetch_object();
        $this->b_text = $record->b_text;
        $this->b_logo = $record->b_logo;
        
    }
    
}

?>
