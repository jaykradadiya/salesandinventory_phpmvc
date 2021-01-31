<?php
//  echo "<pre>";
//  var_dump($this);
//  echo "</pre>";

class loginController extends Controller
{
    // protected $formData;
    // protected $form;
    // public function __construct()
    // {
    //     // parent::__construct();
    //     $this->formData=new Input();
    //     $this->form = new Form();
    // }
    public function __call($name,$argv)
    {
        $this->redirect->header("error");
    }
    public function index()
    {
        $this->model("login");
        
        // $this->logindata=new Input();
     
        if($this->formData->post("loginbtn")!="")
        {
            try
            {
                $this->form->post("loginMail",$this->formData->post("loginMail"));
                $this->form->validation("isempty");
                $this->form->validation("email");
                $this->form->post("loginPassword",$this->formData->post("loginPassword"));
                // print_r($this->form->fetch());
                $this->form->validation("isempty");
                $result = $this->form->submit();
                if($result != NULL)
                {
                    $this->view("login\index","Login Error Page",$result);
                    // $this->view->page_title=;
                    $this->view->render(true);
                }
                else
                {
                    $result = $this->form->fetch();
                    // echo "<pre>";
                    // print_r($result);
                    // echo "</pre>";
                    if(($error=$this->model->checkUser($result))==1)
                    {
                        $this->redirect->header("home");
                    }
                    else
                    {
                        $this->view("login\index","Login Error Page",['loginError' => $error ]);
                        // $this->view->page_title=;
                        $this->view->render(true);
                    }
                }
            }
            catch(Exception $e)
            {
                echo  $e->getMessage() ."<br/>";
            }
        }
        else
        {
            $this->view("login\index","Login Page","Login Page");
            // $this->view->page_title="Login Page";
            $this->view->render(true);
        }

    }

    public function logout()
    {
       
        if ($this->session->destroy()) {
            echo "doing";
            $this->redirect->header("home");
        } else {
           echo "error";
        }
        
        
    }


}


?>