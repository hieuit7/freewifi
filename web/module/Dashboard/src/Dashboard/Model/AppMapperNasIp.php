<?php
class AppMapperNasIp
{
    private $ip;
    private $id;
    private $nas;
    private $descriptions;
    
    
    public function setId($Id) {
        $this->id = $Id;
    }
    
    public function setIp($Ip) {
        $this->ip = $Ip;
    }
    public function setNas($Nas) {
        $this->nas = $Nas;
    }
    public function setDescriptions($Descriptions) {
        $this->descriptions = $Descriptions;
    }
    public function getIp() {
        return $this->ip;
    }
    public function getNas() {
        return $this->nas;
    }
    public function getDescriptions() {
        return $this->descriptions;
    }

}
