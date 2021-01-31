<?php

class errorController extends Controller
{
    public function index()
    {
        http_response_code(404);
        $this->view("error\\404","this is Error Page");
        $this->view->render(true);
    }
    public function __call($name,$argv)
    {
        $this->redirect->header("error");
    }
    public function e401($data="page NOT found")
    {
        http_response_code(401);
        $this->view("error\\401","this is Error Page");
        $this->view->render(true);
    }
   
}
?>