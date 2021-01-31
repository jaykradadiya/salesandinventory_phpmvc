<?php

class categoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model("category");
    }

    public function __call($name,$argv)
    {
        $this->redirect->header("error");
    }
    public function index()
    {
        $this->redirect->header("category\\display\\1");
    }
    public function display($pageno=1)
    {
        if($this->formData->post("e_search")!=NULL)
        {
            echo $this->formData->post("e_search");
            // $this->model("category");
            $result=$this->model->getSearchData($this->formData->post("e_search"),$pageno);
            $this->view("category\\view","Category data",["row" => $result[1],"pages"=>$result[0]]);
            $this->view->render();
        }
        else
        {
            // $this->model("category");
            $result=$this->model->getdata($pageno);
            $this->view("category\\view","Category data",["row" => $result[1],"pages"=>$result[0]]);
            $this->view->render();
        }
    }

    public function addCategory()
    {
        if($this->formData->post("addCategory")!=NULL)
        {
            try
            {
                echo $this->formData->post("addCategory");
                // $this->model("category");
                $this->form->post("category_name",$this->formData->post("category_name"));
                $this->form->validation("isempty");
                $this->form->validation("username");
                $this->form->post("Category_desciption",$this->formData->post("Category_desciption"));
                $this->form->validation("isempty");
                $this->form->validation("minLength",6);

                
                $result = $this->form->submit();
                if($result!=NULL)
                {
                    $this->view("category\\add","Add category data",$result);
                    $this->view->render();
                }
                else
                {
                    if($this->model->addCategorydata($this->formData->newpostAll()))
                    {
                        $this->alert("category Inserted successfuly");
                        $this->redirect->header("category");
                    }
                    else
                    {   
                        $this->alert("Error in category data");
                        $this->view("category\\add","Add category data",$result);
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
            $this->view("category\\add","Add category data");
            $this->view->render();
        }
        
    }

    public function edit($id)
    {
        if($this->formData->post("updateCategory")!=NULL)
        {
            try
            {
                echo $this->formData->post("updateCategory");
                // $this->model("category");
                $this->form->post("category_name",$this->formData->post("category_name"));
                $this->form->validation("isempty");
                $this->form->validation("username");
                $this->form->post("Category_desciption",$this->formData->post("Category_desciption"));
                $this->form->validation("isempty");
                $this->form->validation("minLength",6);

                
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
                        $this->view("category\\update","Add Error Category data",$result);
                        $this->view->render();
                    }
                    else
                    {
                        $result="this Category not found";
                        $this->view("error\\e401","Error",$result);
                        $this->view->render();
                    }
                }
                else
                {
                    // $this->model->updateCategory($this->formData->newpostAll());
                    if($this->model->updateCategory($this->formData->newpostAll()))
                    {
                        $this->alert("categoty Updated");
                        $this->redirect->header("category");
                        
                    }
                    else
                    {   
                        if($result = $this->model->getDataById($id))
                        {
                            $result["Error"]["category_name"]="some technical reason supplier data not updated";
                            $this->view("supplier\\update","Add Error supplier data",$result);
                            $this->view->render();
                        }
                        else
                        {
                            $result="this category not found";
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
            // $this->model("category");   
            if($result = $this->model->getDataById($id))
            {
                $this->view("category\\update","Add category data",$result);
                $this->view->render();
            }
            else
            {
                $result="this category not found";
                $this->view("error\\e401","Error",$result);
                $this->view->render();
            }
        }
    }

    public function delete($id)
    {
       
            $this->model("category");
            if($this->formData->post("delete")!=NULL)   
            {
                if($result = $this->model->getDataById($id))
                {
                if($this->model->deleteCategory($id))
                    {
                        $this->alert("category is deleted");
                        $this->redirect->header("category");
                    }
                    else
                    {   
                        $result="this category can not be deleted";
                        $this->view("error\\e401","Error",$result);
                        $this->view->render();
                    }
                }
                else
                {
                    $result="this category can not be deleted";
                        $this->view("error\\e401","Error",$result);
                        $this->view->render();
                }
            }
            else
            {
                $this->redirect->back();
            }
    }
}

?>