<?php
  class Config
  {
    protected $host = 'eu-cdbr-azure-north-e.cloudapp.net';
    protected $user = 'bf020a4db22631';
    protected $pass = '2acecacf';
    protected $dbname = 'acsm_d4a0065602d66b1';
    protected $charset = 'cp1251';
    
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
