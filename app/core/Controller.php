<?php

class Controller 
{
    protected $view;
    protected $model;
    protected $formData;
    protected $form;
    protected $redirect;
    protected $error;
    protected $session;
    protected $ftp;
    public function __construct()
    {
        // parent::__construct();
        $this->formData=new Input();
        $this->form = new Form();
        $this->session = new Session();
        $this->error = new error();
        $this->redirect = new Redirect();
    }
    public function view($viewName,$viewTitle,$data=[])
    {
        $this->view=new view($viewName,$viewTitle,$data);
        return $this->view;
    }

    public function model($modelName,$data = [])
    {
        if(file_exists(MODEL.$modelName.".php"))
        {
            require_once MODEL.$modelName.".php";
            $this->model = new $modelName;
        }
    }
    public function alert($data)
    {
        ?>
        <script>
         alert("<?= $data;?>");
        </script>
        <?php
    }

    public function uploadFile($slat,$filename)
    {
        $ftp = new Ftp();
        $name=$ftp->putfile($slat,$filename);
        $ftp=NULL;
        return $name;
    }
    public function download($filename)
    {
        $ftp = new Ftp();
        $ftp->getfile($filename);
        $ftp=NULL;
    }
    public function deletefile($filename)
    {
        $ftp = new Ftp();
        $ftp->delpic($filename);
        $ftp=NULL;
    }

}

?>