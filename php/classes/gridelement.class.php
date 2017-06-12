<?php

class gridElement {
    private $idx;
    private $link;
    private $type;
    private $name;
    private $title;
    private $desc;
    private $img;
    private $containerIdx;
    private $location;
    private $size;
    private $decorations;
    
    public function getIdx() {
        return $this->idx;
    }
    public function getLink() {
        return $this->link;
    }
    public function getType() {
        return $this->type;
    }
    public function getName() {
        return $this->name;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getDesc() {
        return $this->desc;
    }
    public function getImg() {
        return $this->img;
    }
    public function getContainerIdx() {
        return $this->containerIdx;
    }
    public function getLocation() {
        return $this->location;
    }
    public function getSize() {
        return $this->size;
    }
    public function getDecorations() {
        return $this->decorations;
    }
    public function getFooter() {
        return $this->footer;
    }

    public function setLink($val) {
        $this->link = $val;
    }
    public function setType($val) {
        $this->type = $val;
    }
    public function setName($val) {
        $this->name = $val;
    }
    public function setTitle($val) {
        $this->title = $val;
    }
    public function setDesc($val) {
        $this->desc = $val;
    }
    public function setImg($val) {
        $this->img = $val;
    }
    public function setContainerIdx($val) {
        $this->containerIdx = $val;
    }
    public function setLocation($val) {
        $this->location = $val;
    }
    public function setSize($val) {
        $this->size = $val;
    }
    public function setDecorations($val) {
        $this->decorations = $val;
    }
    public function setFooter($val) {
        $this->footer = $val;
    }

    public function isLinkable() {
        return strlen(trim($this->getLink())) > 0 ? true : false;
    }
    
    
    private function create() {

        $result = $this->db->query("INSERT INTO gridelements (idx, link, type, name, title, desc, img, containerIdx, location, size, footer) VALUES (".$this->idx.", '', '', '', '', '', '', 0, '', '', '', '')");
        if (!$result){
            die($this->db->error);
        }
    }
    
    public function delete() {
        $result = $this->db->query("DELETE FROM griditems where idx=".$this->idx);
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
                    SELECT gi.idx, gi.link, gi.type, gi.name, gi.title, gi.desc, gi.img, gi.containerIdx, gi.location, gi.size, gi.decorations, gi.footer
                    FROM gridelements gi
                    WHERE gi.idx=$this->idx
                    ");
        if (!$result){
            die($this->db->error);
        }
        
        $record = $result->fetch_object();
        $this->link         = $record->link;
        $this->type         = $record->type;
        $this->name         = $record->name;
        $this->title        = $record->title;
        $this->desc         = $record->desc;
        $this->img          = $record->img;
        $this->containerIdx = $record->containerIdx;
        $this->location     = $record->location;
        $this->size         = $record->size;
        $this->decorations  = $record->decorations;
        $this->footer       = $record->footer;
        
    }
    
}

?>