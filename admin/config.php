<?php
  class Config
  {
    protected $host;
    protected $user;
    protected $pass;
    protected $dbname;
    protected $charset;
    
    function __construct()
    {
      $this->host = 'eu-cdbr-azure-north-e.cloudapp.net';
      $this->user = 'bf020a4db22631';
      $this->pass = '2acecacf';
      $this->dbname = 'acsm_d4a0065602d66b1';
      $this->port = '3306';
      $this->charset = 'utf8';
    }
    
    public function getHost()
    {
      return $this->host;
    }
    
    public function getUser()
    {
      return $this->user;
    }
    
    public function getPass()
    {
      return $this->pass;
    }
    
    public function getDbName()
    {
      return $this->dbname;  
    }
    
    public function getCharset()
    {
      return $this->charset;  
    }
  }
?>
