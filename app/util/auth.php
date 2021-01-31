<?php

class Auth
{
    public static function checkLogged()
    {
        $logged = Session::get("EmpUser");
        if($logged == false)
        {
            Session::destroy();
            header("location".APP);
        }
        exit;
    }
}
?>