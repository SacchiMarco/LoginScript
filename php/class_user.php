<?php
class User{
    private $usrid;
    private $nick;
    private $pwd;
    // ToDo Email, Name usw

    function __construct($usrid, $nick, $pwd){
        $this->usrid = $usrid;
        $this->nick = $nick;
        $this->pwd = $pwd;
    }

    /**
     * Get the value of usrid
     */ 
    public function getUsrid()
    {
        return $this->usrid;
    }

    /**
     * Set the value of usrid
     *
     * @return  self
     */ 
    public function setUsrid($usrid)
    {
        $this->usrid = $usrid;

        return $this;
    }

    /**
     * Get the value of nick
     */ 
    public function getNick()
    {
        return $this->nick;
    }

    /**
     * Set the value of nick
     *
     * @return  self
     */ 
    public function setNick($nick)
    {
        $this->nick = $nick;

        return $this;
    }

    /**
     * Get the value of pwd
     */ 
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set the value of pwd
     *
     * @return  self
     */ 
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }
}