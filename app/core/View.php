<?php

class View
{
    protected $view_file;
    protected $view_data = array();
    protected $_postdata;
    protected $page_title;
    protected $auth;
    public function __construct($view_file,$page_title="",$view_data)
    {
        $this->view_file=$view_file;
        $this->page_title=$page_title;
        $this->view_data=$view_data;
        $this->_postdata=new Input();
        $this->auth=new Auth();
            // echo "<pre>";
            // var_dump($view_data);
            // echo "</pre>";
    }

    public function getdata($field)
    {
        if(isset($this->view_data[$field]))
        {
            return $this->view_data[$field];
        }
    }
    public function getdataError($field,$arrayName="Error")
    {
        if(isset($this->view_data[$arrayName][$field]))
        {
            return $this->view_data[$arrayName][$field];
        }
    }
    public function getFormdata($field)
    {
            return $this->_postdata->post($field);
   }

    public function render($noInclude = false)
    {
        if(file_exists(VIEW. $this->view_file.".php"))
        {
            
            if($noInclude == false)
            {
                include VIEW."header.php";        
                include VIEW. $this->view_file.".php";
                include VIEW."footer.php";
            }
            else
            {
                include VIEW. $this->view_file.".php";
            }
        }
        else
        {
            echo "file not found $this->view_file";
        }
    }

    public function getAction()
    {
       return (explode('\\',$this->view_file)[0]);
    }
}
?>