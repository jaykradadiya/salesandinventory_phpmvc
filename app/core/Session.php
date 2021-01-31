<?php

class Session
{
    public function __construct()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
        else
        {
            print_r($_SESSION);
        }
    }
    public function init()
    {
        if(!$_SESSION)
        {
            session_start();
        }

    }
    public function set($key,$val)
    {
        // $this->init();
        if(!isset($_SESSION))
        {
            session_start();
            $_SESSION[$key]=$val;
        }
        else
        {
        $_SESSION[$key]=$val;
        }

    }

    public function get($key)
    {
        if(!isset($_SESSION))
        {
            session_start();
            return $_SESSION[$key];
        }
        else
        {
        return $_SESSION[$key];
        }
    }
    public function destroy()
    {
        if(!isset($_SESSION))
        {
            return false;
        }
        else
        {
            unset($_SESSION);
            session_destroy();
            return true;
        }

    }
}


?>