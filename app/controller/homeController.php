<?php

class homeController extends Controller
{
    public function index($id="",$name="")
    {
        // echo "i am in ". __CLASS__."and method :".__METHOD__."<br>";
        // echo "id is :".$id." name is :".$name;
        
        $this->view("home\index","this is Home Page",[
            'name' => $name,
            'id' => $id
        ]);
        $this->view->render();
        // var_dump($this); 
    }
    public function __call($name,$argv)
    {
        $this->redirect->header("error");
    }

    public function aboutus()
    {
        // echo "i am in ". __CLASS__."and method :".__METHOD__."<br>";
        $this->view("home\aboutus","this is about Page");
        $this->view->render();
        // var_dump($this);                                                      ; 
    }
}
?>