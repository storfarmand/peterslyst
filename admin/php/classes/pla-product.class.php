<?php

class product {
    private $db;
    private $p_id;
    private $p_model;
    private $p_title;
    private $p_text;
    private $p_pic;
    private $p_pdf;
    private $p_active;


public function getId() {
    return $this->p_id;
}    
    
public function setId($id) {
    $this->p_id = $id;
}    
    
public function getModel() {
    return $this->p_model;
}    
    
public function setModel($model) {
    $this->p_model = $model;
}    
    
public function getTitle() {
    return $this->p_title;
}    
    
public function setTitle($title) {
    $this->p_title = $title;
}    
    
public function getText() {
    return $this->p_text;
}    
    
public function setText($text) {
    $this->p_text = $text;
}    
    
public function getPic() {
    return $this->p_pic;
}    
    
public function setPic($pic) {
    $this->p_pic = $pic;
}    
    
public function getPDF() {
    return $this->p_pdf;
}    
    
public function setPDF($pdf) {
    $this->p_pdf = $pdf;
}    
    
public function getActive() {
    return $this->p_active;
}    
    
public function setActive($active) {
    $this->p_active = $active;
}    

public function store() {
    $result = $this->db->query("
                UPDATE jes_products 
                    SET p_model=\"".$this->p_model."\", p_title=\"".$this->p_title."\", p_text=\"".$this->p_text."\", p_pic=\"".$this->p_pic."\", p_pdf=\"".$this->p_pdf."\", p_active=\"".$this->p_active."\" 
                    WHERE p_id=$this->p_id
                ");
    if (!$result){
        die($this->db->error);
    }
}

public function newPic($pic) {
    $this->setPic($pic);
    $this->store();
}

public function newPDF($pdf) {
    $this->setPDF($pdf);
    $this->store();
}

public function updateMedia($type, $file) {
    switch ($type) {
        case "pic":
            $this->newPic($file);
            break;
        case "pdf":
            $this->newPDF($file);
            break;
    }
}

private function create() {
    $result = $this->db->query("SELECT p_id FROM jes_products ORDER BY p_id DESC LIMIT 1");
    if (!$result){
        die($this->db->error);
    }
    $record = $result->fetch_object();
    $this->p_id = $record->p_id + 1;
    $result = $this->db->query("INSERT INTO jes_products (p_id) VALUES (".$this->p_id.")");
    if (!$result){
        die($this->db->error);
    }
}

public function delete() {
    $result = $this->db->query("DELETE FROM jes_products where p_id=".$this->p_id);
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
    
    public function __construct($prodID) {
        
        global $db;
        $this->db = $db;
        
        if($prodID == -1) {
            $this->create();
        }
        else {
            $this->p_id = $prodID;
        }
        
        $result = $this->db->query("
                    SELECT p.p_id, p.p_model, p.p_title, p.p_text, p.p_pic, p.p_pdf, p.p_active 
                    FROM jes_products p
                    WHERE p.p_id=$this->p_id
                    ");
        if (!$result){
            die($this->db->error);
        }
        $record = $result->fetch_object();
        $this->p_model = $record->p_model;
        $this->p_title = $record->p_title;
        $this->p_text = $record->p_text;
        $this->p_pic = $record->p_pic;
        $this->p_pdf = $record->p_pdf;
        $this->p_active = $record->p_active;
        
    }
    
}

?>
