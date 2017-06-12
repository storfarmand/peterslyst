<?php

class item {
    private $db;
    private $i_id;
    private $i_title;
    private $i_text;
    private $i_pic;
    private $i_pdf;
    private $i_price;
    private $i_qty;
    private $i_active;
    private $i_cat;
    private $i_brand;


public function getId() {
    return $this->i_id;
}    
    
public function setId($id) {
    $this->i_id = $id;
}    
    
public function getTitle() {
    return $this->i_title;
}    
    
public function setTitle($title) {
    $this->i_title = $title;
}    
    
public function getText() {
    return $this->i_text;
}    
    
public function setText($text) {
    $this->i_text = $text;
}    
    
public function getPic() {
    return $this->i_pic;
}    
    
public function setPic($pic) {
    $this->i_pic = $pic;
}    
    
public function getPDF() {
    return $this->i_pdf;
}    
    
public function setPDF($pdf) {
    $this->i_pdf = $pdf;
}    
    
public function getPrice() {
    return $this->i_price;
}    
    
public function setPrice($price) {
    $this->i_price = $price;
}    

public function getQty() {
    return $this->i_qty;
}    
    
public function setQty($qty) {
    $this->i_qty = $qty;
}    

public function getActive() {
    return $this->i_active;
}    
    
public function setActive($active) {
    $this->i_active = $active;
}    

public function getCat() {
    return $this->i_cat;
}    
    
public function setCat($cat) {
    $this->i_cat = $cat;
}    

public function getBrand() {
    return $this->i_brand;
}    
    
public function setBrand($brand) {
    $this->i_brand = $brand;
}    

public function store() {
    $result = $this->db->query("
                UPDATE jes_items 
                    SET i_title=\"".$this->i_title."\", i_text=\"".$this->i_text."\", i_pic=\"".$this->i_pic."\", i_pdf=\"".$this->i_pdf."\", i_price=\"".$this->i_price."\", i_qty=\"".$this->i_qty."\", i_active=\"".$this->i_active."\", i_cat=\"".$this->i_cat."\", i_brand=\"".$this->i_brand."\"
                    WHERE i_id=$this->i_id
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

    global $fs_items_base;
    
    $result = $this->db->query("INSERT INTO jes_items (i_id, i_brand, i_cat) VALUES (".$this->i_id.", -1, -1)");
    if (!$result){
        die($this->db->error);
    }
    if (!mkdir($fs_items_base . $this->i_id, 0577, true)) {
        die('Failed to create folders...');
    } 
}

public function delete() {
    $result = $this->db->query("DELETE FROM jes_items where i_id=".$this->i_id);
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
    
    public function __construct($itemID) {
        
        global $db;
        $this->db = $db;
        
        if($itemID == -1) {
            $this->i_id = time();
            $this->create();
        }
        else {
            $this->i_id = $itemID;
        }
        
        $result = $this->db->query("
                    SELECT i.i_id, i.i_title, i.i_text, i.i_pic, i.i_pdf, i.i_price, i.i_qty, i.i_active, i.i_cat, i.i_brand 
                    FROM jes_items i
                    WHERE i.i_id=$this->i_id
                    ");
        if (!$result){
            die($this->db->error);
        }
        $record = $result->fetch_object();
        $this->i_title  = $record->i_title;
        $this->i_text   = $record->i_text;
        $this->i_pic    = $record->i_pic;
        $this->i_pdf    = $record->i_pdf;
        $this->i_price  = $record->i_price;
        $this->i_qty    = $record->i_qty;
        $this->i_active = $record->i_active;
        $this->i_cat    = $record->i_cat;
        $this->i_brand  = $record->i_brand;
        
    }
    
}

?>
