<?php

class Application
{
    protected $controller="";
    protected $action = "";
    protected $params = [];

    public function __construct()
    {
        // echo $_SERVER["REQUEST_URI"]; 
        $this->prepareURL(); 
        // echo $this->controller . "<br>". $this->action . "<br>";
        // print_r($this->params);
        if(file_exists(CONTROLLER . $this->controller .".php"))
        {
            $this->controller =new $this->controller;
            if(method_exists($this->controller,$this->action))
            {
                call_user_func_array([$this->controller,$this->action],$this->params);
            }
        }
        else
        {
            $error = new errorController();
            $error->index();
        }
    }
    
    protected function prepareURL()
    {
         $request = isset($_GET['url']) ? $_GET['url']:"home";
        // echo $request."<br>";
         if(!empty($request))
        {
            $url = explode('/',$request);
            // var_dump($url);
            $this->controller = isset($url[0]) ? $url[0]."Controller" : "homeController";
            $this->action = isset($url[1]) ? $url[1] : "index";
            unset($url[0],$url[1]);
            $this->params = !empty($url)?array_values($url) : [];
        }

        // var_dump($_GET);
    }
}

?>