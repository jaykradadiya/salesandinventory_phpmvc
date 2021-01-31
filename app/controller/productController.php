<?php

class productController extends Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->model("product");
    }
    public function index()
    {
        // print_r($this->loadTablesData());
        $this->redirect->header("product\\display\\1");
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
            // $this->model("category");
            $result=$this->model->getSearchData($this->formData->post("e_search"),$pageno);
            foreach ($result[1] as $key => $value) {
                $this->download($value[7]);
            }

            $this->view("product\\display","product data",["row" => $result[1],"pages"=>$result[0]]);
            $this->view->render();
        }
        else
        {
            // $this->model("category");
            $result=$this->model->getdata($pageno);
            // print_r($result);
            foreach ($result[1] as $key => $value) {
                $this->download($value[7]);
            }

            $this->view("product\\display","product data",["row" => $result[1],"pages"=>$result[0]]);
            $this->view->render();
        }
    }

    public function addProduct()
    {
        $data=$this->loadTablesData();
        if($this->formData->post("addProduct")!=NULL)
        {
            try
            {
                echo $this->formData->post("addProduct");
                $this->form->post("product_pic",$this->formData->getfile("product_pic","tmp_name"));
                $this->form->validation("isempty");
                $result=$this->formvalidation();
                if($result!=NULL)
                {
                    $result["category"] = $data["category"];
                     $result["supplier"] = $data["supplier"];
                    $this->view("product\\add","Add Eror product data",$result);
                    $this->view->render();
                }
                else
                {
                    $file = $this->uploadFile($this->formData->post("product_name"),$this->formData->getfile("product_pic","tmp_name"));
                    if($file!=NULL)
                    {
                        if($this->model->addProductdata($this->formData->newpostAll(),$file))
                        {
                            $this->redirect->header("product");
                        }
                        else
                        {   
                            $this->deletefile($file);
                            $result["Error"]["product_name"]="product name is already used";
                            $result["category"] = $data["category"];
                            $result["supplier"] = $data["supplier"];
                            $this->view("product\\add","Add Eror product data",$result);
                            $this->view->render();
                        }
                    }
                    else
                    {
                        $result["Error"]["product_pic"]="file Not Uploades";
                        $result["category"] = $data["category"];
                        $result["supplier"] = $data["supplier"];
                        $this->view("product\\add","Add Eror product data",$result);
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
            $this->view("product\\add","Add product data",$data);
            $this->view->render();
        }
        // $this->view("employee\addEmp","Add Emp data");
        // $this->view->render();
    }

    public function edit($id)
    {
        $data=$this->loadTablesData();
        if($this->formData->post("updateProduct")!=NULL)
        {
            try
            {
                echo $this->formData->post("updateProduct");
                // $this->model("category");
                $this->form->post("product_id",$this->formData->post("product_id"));
                $this->form->validation("isempty");
            
                $resultForm =$this->formvalidation();
                if($resultForm!=NULL)
                {
                    // echo "<pre>";
                    // var_dump($resultForm);
                    // echo "</pre>";
                    if($result = $this->model->getDataById($id))
                    {
                        if($resultForm!=NULL)
                        $result["Error"]=$resultForm["Error"];
                        $result["category"] = $data["category"];
                        $result["supplier"] = $data["supplier"];
                        $this->view("product\\update","Add Error product data",$result);
                        $this->view->render();
                    }
                    else
                    {
                        $this->redirect->header("product");
                    }
                }
                else
                {
                    if($this->model->updateCategory($this->formData->newpostAll()))
                    {
                        $this->redirect->header("product");
    
                    }
                    else
                    { 
                         $result["category"] = $data["category"];
                        $result["supplier"] = $data["supplier"];
                        $result["Error"]["product_name"]="product name is already used";
                        $this->view("product\\stokeUpdate","Add Error product data",$result);
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
            // $this->model("category");   
            if($result = $this->model->getDataById($id))
            {
                $result["category"] = $data["category"];
                $result["supplier"] = $data["supplier"];
                $this->view("product\\update","Add product data",$result);
                $this->view->render();
            }
            else
            {
                $result="this product not found";
                $this->view("error\\e401","Error",$result);
                $this->view->render();
            }
        }
    }

    public function stokeUP($id)
    {
        $data=$this->loadTablesData();
        if($this->formData->post("updatestoke")!=NULL)
        {
            try
            {
                echo $this->formData->post("updatestoke");
                // $this->model("category");
                $this->form->post("product_id",$this->formData->post("product_id"));
                $this->form->validation("isempty");
                $this->form->post("productnewstoke",$this->formData->post("productnewstoke"));
                $this->form->validation("isempty");
            
                $resultForm =$this->formvalidation();
                if($resultForm!=NULL)
                {
                    // echo "<pre>";
                    // var_dump($resultForm);
                    // echo "</pre>";
                    if($result = $this->model->getDataById($id))
                    {
                        if($resultForm!=NULL)
                        $result["Error"]=$resultForm["Error"];
                        $result["category"] = $data["category"];
                        $result["supplier"] = $data["supplier"];
                        $this->view("product\\stokeUpdate","Add Error product data",$result);
                        $this->view->render();
                    }
                    else
                    {
                        echo "data not found";
                    }
                }
                else
                {
                    if($this->model->stokeUpData($this->formData->newpostAll()))
                    {
                        
                        $this->redirect->header("product");

                    }
                    else
                    {   
                        $result["category"] = $data["category"];
                        $result["supplier"] = $data["supplier"];
                        $this->view("product\\stokeUpdate","Add Error product data",$result);
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
            // $this->model("category");   
            if($result = $this->model->getDataById($id))
            {
                $result["category"] = $data["category"];
                $result["supplier"] = $data["supplier"];
                $this->view("product\\stokeUpdate","Add product data",$result);
                $this->view->render();
            }
            else
            {
                $result="this product not found";
                $this->view("error\\e401","Error",$result);
                $this->view->render();
            }
        }
    }

    public function delete($id)
    {
        // $this->model("category");   
        if($this->formData->post("delete")!=NULL)   
        {
          
         if($result = $this->model->getDataById($id))
            {
               if( $this->model->deleteProduct($id))
                {
                    $this->deletefile($result["product_pic"]);
                    $this->redirect->header("product");
                }
                else
                { 
                    $result="this product can not be deleted";
                    $this->view("error\\e401","Error",$result);
                    $this->view->render();
                }
            }
            else
            {
                $result="this product not found";
                $this->view("error\\e401","Error",$result);
                $this->view->render();
            }
        }
        else
        {
            $this->redirect->header("product");
        }
    }

    // <!-- product_id	
    // product_name
    // product_category
	// product_price
    // product_dis
    // product_stoke
    // product_supplier	
    // product_pic -->

    public function formvalidation()
    {
        $this->form->post("product_name",$this->formData->post("product_name"));
        $this->form->validation("isempty");
        $this->form->validation("username");
        $this->form->post("product_category",$this->formData->post("product_category"));
        $this->form->validation("isempty");
        $this->form->validation("integer");
        $this->form->post("product_price",$this->formData->post("product_price"));
        $this->form->validation("isempty");
        $this->form->validation("integer");
        $this->form->post("product_dis",$this->formData->post("product_dis"));
        $this->form->validation("isempty");
        
        $this->form->post("product_stoke",$this->formData->post("product_stoke"));
        $this->form->validation("isempty");
        $this->form->validation("integer");

        $this->form->post("product_supplier",$this->formData->post("product_supplier"));
        $this->form->validation("isempty");
        $this->form->validation("integer");

        
        return $this->form->submit();
    }

    public function loadTablesData()
    {
        $data["category"]=$this->model->getdataTable("category");
        $data["supplier"]=$this->model->getdataTable("supplier");
        return $data;
    }

}

?>