<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Dashboard\Model;

/*
 * 
 */
class RadAcct {
    
    protected $radacctid;
    protected $acctsessionid;
    protected $acctuniqueid;
    protected $username;
    protected $groupname;
    protected $realm;
    protected $nasipaddress;
    protected $nasportid;
    protected $nasporttype;
    protected $acctstarttime;
    protected $acctupdatetime;
    protected $acctstoptime;
    protected $acctinterval;
    protected $acctsessiontime;
    protected $acctauthentic;
    protected $connectinfo_start;
    protected $connectinfo_stop;
    protected $acctinputoctets;
    protected $acctoutputoctets;
    protected $calledstationid;
    protected $callingstationid;
    protected $acctterminatecause;
    protected $servicetype;
    protected $frameprotocol;
    protected $frameipaddress;
    
    public function exchangeArray($data) {
        $this->radacctid = (isset($data['radacctid']))?$data['radacctid']:'';
        $this->acctsessionid = (isset($data['acctsessionid']))?$data['acctsessionid']:'';
        $this->acctuniqueid = (isset($data['acctuniqueid']))?$data['acctuniqueid']:'';
        $this->username = (isset($data['username']))?$data['username']:'';
        $this->groupname = (isset($data['groupname']))?$data['groupname']:'';
        $this->realm = (isset($data['realm']))?$data['realm']:'';
        $this->nasipaddress = (isset($data['nasipaddress']))?$data['nasipaddress']:'';
        $this->nasporttype = (isset($data['nasporttype']))?$data['nasporttype']:'';
        $this->acctstarttime = (isset($data['acctstarttime']))?$data['acctstarttime']:'';
        $this->acctupdatetime = (isset($data['acctupdatetime']))?$data['acctupdatetime']:'';
        $this->acctstoptime = (isset($data['acctstoptime']))?$data['acctstoptime']:'';
        $this->acctinterval = (isset($data['acctinterval']))?$data['acctinterval']:'';
        $this->acctsessiontime = (isset($data['acctsessiontime']))?$data['acctsessiontime']:'';
        $this->acctauthentic = (isset($data['acctauthentic']))?$data['acctauthentic']:'';
        $this->connectinfo_start = (isset($data['connectinfo_start']))?$data['connectinfo_start']:'';
        $this->connectinfo_stop = (isset($data['connectinfo_stop']))?$data['connectinfo_stop']:'';
        $this->acctinputoctets = (isset($data['acctinputoctets']))?$data['acctinputoctets']:'';
        $this->acctoutputoctets = (isset($data['acctoutputoctets']))?$data['acctoutputoctets']:'';
        $this->calledstationid = (isset($data['calledstationid']))?$data['calledstationid']:'';
        $this->callingstationid = (isset($data['callingstationid']))?$data['callingstationid']:'';
        $this->acctterminatecause = (isset($data['acctterminatecause']))?$data['acctterminatecause']:'';
        $this->servicetype = (isset($data['servicetype']))?$data['servicetype']:'';
        $this->frameprotocol = (isset($data['frameprotocol']))?$data['frameprotocol']:'';
        $this->frameipaddress = (isset($data['frameipaddress']))?$data['frameipaddress']:'';
        $this->nasportid = (isset($data['nasportid']))?$data['nasportid']:'';
        
    }
    
    public function getradacctid() {
        return $this->radacctid;
    }
    public function getacctsessionid() {
        return $this->acctsessionid;
    }
    public function getacctuniqueid() {
        return $this->acctuniqueid;
    }
    public function getusername() {
        return $this->username;
    }
    public function getgroupname() {
        return $this->groupname;
    }
    public function getrealm() {
        return $this->realm;
    }
    public function getnasipaddress() {
        return $this->nasipaddress;
    }
    public function getnasportid() {
        return $this->nasportid;
    }
    public function getnasporttype() {
        return $this->nasporttype;
    }
    public function getacctstarttime() {
        return $this->acctstarttime;
    }
    public function getacctupdatetime() {
        return $this->acctupdatetime;
    }
    public function getacctstoptime() {
        return $this->acctstoptime;
    }
    public function getacctinterval() {
        return $this->acctinterval;
    }
    public function getacctsessiontime() {
        return $this->acctsessiontime;
    }
    public function getacctauthentic() {
        return $this->acctauthentic;
    }
    public function getconnectinfostop() {
        return $this->connectinfo_stop;
    }
    public function getconnectinfostart() {
        return $this->connectinfo_start;
    }
    public function getacctinputoctets() {
        return $this->acctinputoctets;
    }
    public function getacctoutputoctets() {
        return $this->acctoutputoctets;
    }
    public function getcalledstationid() {
        return $this->calledstationid;
    }
    public function getcallingstationid() {
        return $this->callingstationid;
    }
    public function getacctterminatecause() {
        return $this->acctterminatecause;
    }
    
    public function getServicetype() {
        return $this->Servicetype;
    }
    public function getFrameProtocal() {
        return $this->frameprotocal;
    }
    public function getFrameIpAddress() {
        return $this->frameipaddress;
    }
    
    public function setRadacctid($Radacctid) {
        $this->radacctid = $Radacctid;
    }
    public function setAcctSessionID($AcctSessionID) {
        $this->acctsessionid = $AcctSessionID;
    }
    public function setAcctUniqueId($AcctUniqueId) {
        $this->acctuniqueid = $AcctUniqueId;
    }
    public function setUserName($UserName) {
        $this->username = $UserName;
    }
    public function setGroupName($GroupName) {
        $this->groupname = $GroupName;
    }
    public function setRealm($Realm) {
        $this->realm = $Realm;
    }
    public function setNasIpAddress($NasIpAddress) {
        $this->nasipaddress = $NasIpAddress;
    }
    public function setNasPortType($NasPortType) {
        $this->nasporttype = $NasPortType;
    }
    public function setAcctStartTime($AcctStartTime) {
        $this->acctstarttime = $AcctStartTime;
    }
    public function setAcctUpdateTime($AcctUpdateTime) {
        $this->acctupdatetime = $AcctUpdateTime;
    }
    public function setAcctStopTime($AcctStopTime) {
        $this->acctstoptime = $AcctStopTime;
    }
    public function setAcctInterval($AcctInterval) {
        $this->acctinterval = $AcctInterval;
    }
    public function setAcctSessionTime($AcctSessionTime) {
        $this->acctsessiontime = $AcctSessionTime;
    }
    public function setAcctAuthentic($AcctAuthentic) {
        $this->acctauthentic = $AcctAuthentic;
    }
    public function setConnectinfoStart($ConnectinfoStart) {
        $this->connectinfo_start = $ConnectinfoStart;
    }
    public function setConnectInforStop($ConnectinforStop) {
        $this->connectinfor_stop = $ConnectinforStop;
    }
    public function setAcctInputOctets($AcctInputOctets) {
        $this->acctinputoctets = $AcctInputOctets;
    }
    public function setAcctOutputOctets($AcctOuputOctets) {
        $this->acctoutputoctets = $AcctOuputOctets;
    }
    public function setCalledStationId($CalledStationId) {
        $this->calledstationid = $CalledStationId;
    }
    public function setCallingStationId($CallingStationId) {
        $this->callingstationid = $CallingStationId;
    }
    public function setAcctterminate($Acctterminate) {
        $this->acctterminate = $Acctterminate;
    }
    public function setServiceType($ServiceType) {
        $this->servicetype = $ServiceType;
    }
    public function setFrameProtocol($FrameProtocol) {
        $this->frameprotocol = $FrameProtocol;
    }
    public function setFrameIpaddress($FrameIpaddress) {
        $this->frameipaddress = $FrameIpaddress;
    }
    
    
    
}

