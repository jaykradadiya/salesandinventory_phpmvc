<?php
class employeeController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model("emp");
    }
    public function __call($name,$argv)
    {
        // $this->redirect->header("error");
    }
    
    public function index()
    {
        $this->redirect->header("employee\\display\\1");
    }
    public function display($pageno=1)
    {
        // echo $pageno;
        if($this->formData->post("e_search")!=NULL)
        {
            // $this->model("emp");
            $result=$this->model->getSearchData($this->formData->post("e_search"),$pageno);
            foreach ($result[1] as $key => $value) {
                $this->download($value[5]);
            }

            $this->view("employee\index","Emp data",["row" => $result[1],"pages"=>$result[0]]);
            $this->view->render();
        }
        else
        {
            // $this->model("emp");
            $result=$this->model->getdata($pageno);
            foreach ($result[1] as $key => $value) {
                $this->download($value[5]);
            }
            $this->view("employee\index","Emp data",["row" => $result[1],"pages"=>$result[0]]);
            $this->view->render();
        }
    }
    public function addEmployee()
    {
        if($this->formData->post("addEmp")!=NULL)
        {
            try
            {
                $this->form->post("employee_email",$this->formData->post("employee_email"));
                $this->form->validation("isempty");
                $this->form->validation("email");
                $this->form->post("employee_username",$this->formData->post("employee_username"));
                $this->form->validation("isempty");
                $this->form->validation("minLength",6);
                $this->form->validation("username");
                $this->form->post("employee_type",$this->formData->post("employee_type"));
                $this->form->validation("isempty");
                $this->form->validation("integer");
                $this->form->post("emp_password",$this->formData->post("emp_password"));
                $this->form->validation("isempty");
                $this->form->validation("minLength",6);
                // $this->form->validation("passwd");
                $this->form->post("emp_pic",$this->formData->getfile("emp_pic","tmp_name"));
                $this->form->validation("isempty");

                
                $result = $this->form->submit();
                if($result!=NULL)
                {
                    $this->view("employee\addEmp","Add Emp data",$result);
                    $this->view->render();
                }
                else
                {
                    $file = $this->uploadFile($this->formData->post("employee_username"),$this->formData->getfile("emp_pic","tmp_name"));
                    if($file!=NULL)
                    {
                        if($this->model->addEmployee($this->formData->newpostAll(),$file))
                        {
                           
                            $this->redirect->header("employee");
                        }
                        else
                        {   
                            $this->deletefile($file);
                            $result["Error"]["employee_username"]="Username already takern";
                            $this->view("employee\addEmp","Add Emp data",$result);
                            $this->view->render();
                        }
                    }
                    else
                    {
                        $result["Error"]["emp_pic"]="file Not Uploades";
                        $this->view("employee\addEmp","Add Emp data",$result);
                        $this->view->render();
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
            $this->view("employee\addEmp","Add Emp data");
            $this->view->render();
        }
        // $this->view("employee\addEmp","Add Emp data");
        // $this->view->render();
    }

    public function edit($id)
    {
        if($this->formData->post("updateEmp")!=NULL)
        {
            try
            {
                
                $this->form->post("empType",$this->formData->post("empType"));
                $this->form->validation("isempty");
                $this->form->validation("integer");
                $this->form->post("empPassword",$this->formData->post("empPassword"));
                $this->form->validation("isempty");
                $this->form->validation("minLength",6);
                $this->form->validation("passwd");

                
                $resultForm = $this->form->submit();
                if($resultForm!=NULL)
                {
                    // echo "<pre>";
                    // var_dump($resultForm);
                    // echo "</pre>";
                    if($result = $this->model->getDataById($id))
                    {
                        if($resultForm!=NULL)
                        $result["Error"]=$resultForm["Error"];
                        $this->view("employee\\editEmp","Add Error Emp data",$result);
                        $this->view->render();
                    }
                    else
                    {
                        $this->redirect->header("employee");
                    }
                }
                else
                {
                    // $this->model->updateEmployee($this->formData->newpostAll());
                    if($this->model->updateEmployee($this->formData->newpostAll()))
                    {
                        // header("location:../../../public/employee"); 
                        $this->redirect->header("employee");
            
                    }
                    else
                    {    if($result = $this->model->getDataById($id))
                        {
                            $result["Error"]["empType"]="some technical reason Employee data not updated";
                            $this->view("employee\\editEmp","Add Error Emp data",$result);
                            $this->view->render();
                        }
                        else
                        {
                            $this->redirect->header("employee");
                        }
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
            // $this->model("emp");   
            if($result = $this->model->getDataById($id))
            {
                $this->view("employee\\editEmp","Add Emp data",$result);
                $this->view->render();
            }
            else
            {
                $result="this EMployee not found";
                $this->view("error\\e401","Error",$result);
                $this->view->render();
            }
        }
    }

    public function delete($id)
    {
        if($this->formData->post("delete")!=NULL)   
        {
            if($result = $this->model->getDataById($id))
            {         
               if(  $this->model->deleteEmployee($id))
                {
                    $this->deletefile($result["pic"]);
                    $this->redirect->header("employee");
                }
                else
                { 
                     $result="this employee can not be deleted";
                    $this->view("error\\e401","Error",$result);
                    $this->view->render();
                }
            }
            else
            {
                $result="this EMployee not found";
                $this->view("error\\e401","Error",$result);
                $this->view->render();
            }
        }
        else
        {
            $this->redirect->header("employee");
        }
        
    }

}

?>