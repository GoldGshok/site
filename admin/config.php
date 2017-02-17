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
      return $host;
    }
    
    public getUser()
    {
      return $user;
    }
    
    public getPass()
    {
      return $pass;
    }
    
    public getDbName()
    {
      return $dbname;  
    }
    
    public getCharset()
    {
      return $charset;  
    }
  }
?>
