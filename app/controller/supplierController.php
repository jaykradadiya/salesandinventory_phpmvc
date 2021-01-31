<?php

class supplierController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model("supplier");
    }

    public function index()
    {
        $this->redirect->header("supplier\\display\\1");
    }
    public function __call($name,$argv)
    {
        $this->redirect->header("error");
    }
    
    public function display($pageno=1)
    {
        if($this->formData->post("e_search")!=NULL)
        {
            echo $this->formData->post("e_search");
            // $this->model("supplier");
            $result=$this->model->getSearchData($this->formData->post("e_search"),$pageno);
            $this->view("supplier\\view","supplier data",["row" => $result[1],"pages"=>$result[0]]);
            $this->view->render();
        }
        else
        {
            // $this->model("supplier");
            $result=$this->model->getdata($pageno);
            $this->view("supplier\\view","supplier data",["row" => $result[1],"pages"=>$result[0]]);
            $this->view->render();
        }
    }

    public function addSupplier()
    {
        if($this->formData->post("addSupplier")!=NULL)
        {
            try
            {
                echo $this->formData->post("addSupplier");
                // $this->model("supplier");
                $this->form->post("supplier_name",$this->formData->post("supplier_name"));
                $this->form->validation("isempty");
                $this->form->validation("username");
                $this->form->validation("minLength",6);
                $this->form->post("supplier_address",$this->formData->post("supplier_address"));
                $this->form->validation("isempty");
                $this->form->validation("minLength",6);
                $this->form->post("supplier_contect_no",$this->formData->post("supplier_contect_no"));
                $this->form->validation("isempty");
                $this->form->validation("minLength",10);
                $this->form->validation("integer");
                
                

                
                $result = $this->form->submit();
                if($result!=NULL)
                {
                    $this->view("supplier\\add","Add supplier data",$result);
                    $this->view->render();
                }
                else
                {
                    if($this->model->addSupplierdata($this->formData->newpostAll()))
                    {
                        $this->redirect->header("supplier");

                    }
                    else
                    {
                        $result["Error"]["supplier_name"]="Supplier name is already used";
                        $this->view("supplier\\add","Add supplier data",$result);
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
            $this->view("supplier\\add","Add supplier data");
            $this->view->render();
        }
        // $this->view("employee\addEmp","Add Emp data");
        // $this->view->render();
    }

    public function edit($id)
    {
        if($this->formData->post("updateSupplier")!=NULL)
        {
            try
            {
                echo $this->formData->post("updateSupplier");
                // $this->model("supplier");
                $this->form->post("supplier_name",$this->formData->post("supplier_name"));
                $this->form->validation("isempty");
                $this->form->validation("username");
                $this->form->validation("minLength",6);
                $this->form->post("supplier_address",$this->formData->post("supplier_address"));
                $this->form->validation("isempty");
                $this->form->validation("minLength",6);
                $this->form->post("supplier_contect_no",$this->formData->post("supplier_contect_no"));
                $this->form->validation("isempty");
                $this->form->validation("minLength",10);
                $this->form->validation("integer");


                
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
                        // echo "<pre>";
                        // var_dump($result);
                        // echo "</pre>";
                        $this->view("supplier\\update","Add Error supplier data",$result);
                        $this->view->render();
                    }
                    else
                    {
                        
                        $result="this supplier not found";
                        $this->view("error\\e401","Error",$result);
                        $this->view->render();
                    }
                }
                else
                {
                    // $this->model->updateCategory($this->formData->newpostAll());
                    if($this->model->updateSupplier($this->formData->newpostAll()))
                    {
                        $this->redirect->header("supplier");

                    }
                    else
                    { 
                         if($result = $this->model->getDataById($id))
                        {
                            $result["Error"]["supplier_name"]="some technical reason supplier data not updated";
                            $this->view("supplier\\update","Add Error supplier data",$result);
                            $this->view->render();
                        }
                        else
                        {
                            $result="this supplier not found";
                            $this->view("error\\e401","Error",$result);
                            $this->view->render();
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
            // $this->model("supplier");   
            if($result = $this->model->getDataById($id))
            {
                $this->view("supplier\\update","Add supplier data",$result);
                $this->view->render();
            }
            else
            {
               
                $result="this supplier not found";
                $this->view("error\\e401","Error",$result);
                $this->view->render();
            }
        }
    }

    public function delete($id)
    {
        // $this->model("supplier");   
        if($this->formData->post("delete")!=NULL)   
        {
            if($result = $this->model->getDataById($id))
            {
               if(  $this->model->deleteSupplier($id))
                {
                    $this->redirect->header("supplier");

                else
                { 
                       $result="this supplier can not be deleted";
                    $this->view("error\\e401","Error",$result);
                    $this->view->render();
                }
            }
            else
            {
                $result="this supplier can not be deleted";
                    $this->view("error\\e401","Error",$result);
                    $this->view->render();
            }
        }
        else
        {
            $this->redirect->header("supplier");
        }
        
    }
}

?>