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
      $host = 'eu-cdbr-azure-north-e.cloudapp.net';
      $user = 'bf020a4db22631';
      $pass = '2acecacf';
      $dbname = 'acsm_d4a0065602d66b1';
      $charset = 'cp1251';
    }
    
    public getHost()
    {
      return $this->$host;
    }
    
    public getUser()
    {
      return $this->$user;
    }
    
    public getPass()
    {
      return $this->$pass;
    }
    
    public getDbName()
    {
      return $this->$dbname;  
    }
    
    public getCharset()
    {
      return $this->$charset;  
    }
  }
?>
