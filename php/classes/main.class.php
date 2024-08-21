<?php

class main {
    private $bizName;
    private $bizAddress;
    private $bizCity;
    private $bizZip;
    private $bizTele;
    private $bizEmail;
    private $bizCVR;
    private $db;
    
    public function getBizName() {
        return $this->bizName;
    }
    public function getBizAddress() {
        return $this->bizAddress;
    }
    public function getBizCity() {
        return $this->bizCity;
    }
    public function getBizZip() {
        return $this->bizZip;
    }
    public function getBizTele() {
        return $this->bizTele;
    }
    public function getBizTeleLink() {
        return "<a href=\"tel:$this->bizTele\">$this->bizTele</a>";
    }
    public function getBizEmail() {
        return $this->bizEmail;
    }
    public function getBizEmailLink() {
        return "<a href=\"mailto:$this->bizEmail\">$this->bizEmail</a>";
    }
    public function getBizCVR() {
        return $this->bizCVR;
    }

    public function setBizName($val) {
        $this->bizName = $val;
    }
    public function setBizAddress($val) {
        $this->bizAddress = $val;
    }
    public function setBizCity($val) {
        $this->bizCity = $val;
    }
    public function setBizZip($val) {
        $this->bizZip = $val;
    }
    public function setBizTele($val) {
        $this->bizTele = $val;
    }
    public function setBizEmail($val) {
        $this->bizEmail = $val;
    }
    public function setBizCVR($val) {
        $this->bizCVR = $val;
    }

/*
**********************************************
**                                          **
**        CONSTRUCTOR METHOD                **
**                                          **
********************************************** 
*/
    
    public function __construct() {
        
        global $db;
        $this->db = $db;
        
        $result = $this->db->query("
                    SELECT m.biz_name, m.biz_address, m.biz_city, m.biz_zip, m.biz_tele, m.biz_email, m.biz_cvr 
                    FROM main m
                    ");
        if (!$result){
            die($this->db->error);
        }
        $record = $result->fetch_object();
        $this->bizName      = $record->biz_name;
        $this->bizAddress   = $record->biz_address;
        $this->bizCity      = $record->biz_city;
        $this->bizZip       = $record->biz_zip;
        $this->bizTele      = $record->biz_tele;
        $this->bizEmail     = $record->biz_email;
        $this->bizCVR       = $record->biz_cvr;
    }
    
}

?>