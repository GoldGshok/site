<?php
  //set output php errors
  //ini_set( "display_errors", true );
  
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
    
    private function getHost()
    {
      return $this->host;
    }
    
    private function getUser()
    {
      return $this->user;
    }
    
    private function getPass()
    {
      return $this->pass;
    }
    
    private function getDbName()
    {
      return $this->dbname;  
    }
    
    private function getCharset()
    {
      return $this->charset;  
    }
  }
?>
