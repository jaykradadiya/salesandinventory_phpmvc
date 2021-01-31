<?php

class Validation
{

    // public function __construct()
    // {
        
    // }

    public function __call($name,$data)
    {
        echo "hii";
        throw new Exception("$name does not exist in Class". __CLASS__);
    }

    public function isempty($name,$data)
    {
        if(empty($data))
        {
            return "Your $name field can not be empty";
        }
    }

    public function minLength($name,$data,$arg)
    {
        if(strlen($data) < $arg)
        {
            return "Your $name field reqired be $arg Char long";
        }
    }

    public function maxLength($name,$data,$arg) 
    {
        if(strlen($data) > $arg)
        {
            return "Your $name field can only be $arg Char long";
        }
    }

    public function integer($name,$data)
    {
        if(!filter_var($data,FILTER_VALIDATE_INT))
        {
            return "Your $name field must be contain digits only";
        }
    }

    public function email($name,$data)
    {
        if(!filter_var($data,FILTER_VALIDATE_EMAIL))
        {
            return "Your $name field is not proper mail address";
        }
    }


    public function username($name,$data)
    {
        if(!preg_match("/^[a-zA-z\_]{6,}$/", $data))
		{
			return "Your $name field is Only alphabets allowed with _";
        }
    }

    public function passwd($name,$data)
    {
        if(!preg_match("/^[A-Za-z@_0-9]{6,}$/", $data))
		{
			return "Your $name field is should be contain capital,small and special character";
        }
    }
    
}
?>