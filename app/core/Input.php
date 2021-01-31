<?php

class Input
{
    protected $_postForm = NULL;
    protected $_getForm = array();  
    protected $_filesData =NULL;  
    public function __construct()
    {
        foreach ($_POST as $key => $value) {
            $this->_postForm[$key]=$value;
        }

        foreach ($_GET as $key => $value) {
            $this->_getForm[$key]=$value;
        }
        foreach ($_FILES as $key => $value) {
            $this->_filesData[$key]=$value;
            // $this->_postForm[$key]=$value;

        }
    //     echo "<pre> input start";
    //    var_dump($this);
    //    echo "end input</pre>";
    }


    public function post($key)
    {
        if(isset($this->_postForm[$key]))
        return $this->_postForm[$key];
    }

    public function newpostAll()
    {
    //     echo "<pre> input start";
    //    var_dump($_POST);
    //    echo "end input</pre>";
        if(isset($_POST))
        return $_POST;
    }

    public function file($name)
    {
        if(isset($_FILES[$name]))
        return $_FILES[$name];
    }

    public function get($key)
    {
        if(isset($this->_getForm[$key]))
        return $this->_getForm[$key];
    }

    public function getfile($key,$data)
    {
        if(isset($this->_filesData[$key][$data]))
        return $this->_filesData[$key][$data];
    }


}
?>