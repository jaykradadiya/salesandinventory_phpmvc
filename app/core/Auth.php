<?php

class Auth
{
    public static function checkLogged()
    {
        if(Session::get("empEmail"))
        {
            // return 
        }
        else
        {
            Session::destroy();
            header("location:" . URIROOT . "login");
            exit;
        }
    }
}
?>