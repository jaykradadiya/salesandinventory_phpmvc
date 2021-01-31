<?php
class orderController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model("order");
    }
    public function __call($name,$argv)
    {
        $this->redirect->header("error");
    }
    
    public function index()
    {
        $this->redirect->header("order\\display\\1");
    }
    public function display($pageno=1)
    {
        echo $pageno;
        if($this->formData->post("e_search")!=NULL)
        {
            echo $this->formData->post("e_search");
            // $this->model("emp");
            $result=$this->model->getSearchData($this->formData->post("e_search"),$pageno);
            $this->view("order\\view","order data",["row" => $result[1],"pages"=>$result[0]]);
            $this->view->render();
        }
        else
        {
            // $this->model("emp");
            $result=$this->model->getdata($pageno);
            $this->view("order\\view","order data",["row" => $result[1],"pages"=>$result[0]]);
            $this->view->render();
        }
    }
    public function OrderItems($id,$pageno=1)
    {
        if($this->formData->post("view")!=NULL)
        {
        if($id!=NULL)
        {
            echo $this->formData->post("e_search");
            $this->model("orderItem");
            $result=$this->model->getDataById($id,$pageno);
            $this->view("order\\orderItem\\view","order data",["row" => $result[1],"pages"=>$result[0]]);
            $this->view->render();
        }
        else
        {
            $this->display();
        }
        }
        else {
            $result="this bill data not found";
            $this->view("error\\e401","Error",$result);
            $this->view->render();
        }
    }

    public function chackOrder()
    {

        // print_r($this->formData->newpostAll());
        // print_r($_POST);
        try
            {
                // echo $this->formData->post("addorder");
                // $this->model("emp");
                $this->form->post("date",$this->formData->post("date"));
                $this->form->validation("isempty");
                $this->form->post("customerName",$this->formData->post("customerName"));
                $this->form->validation("isempty");
                $this->form->validation("minLength",6);
                $this->form->validation("username");
                $this->form->post("customerEmail",$this->formData->post("customerEmail"));
                $this->form->validation("isempty");
                $this->form->validation("email");
                $this->form->post("total",$this->formData->post("total"));
                $this->form->validation("isempty");
                $this->form->validation("integer");
                // $this->form->validation("passwd");
                $this->form->post("O_paid",$this->formData->post("O_paid"));
                $this->form->validation("isempty");

                foreach ($this->formData->post("product_id") as $key => $value) {
                    // echo "product_id$key  product_id as  $value <br>";
                    $this->form->post("product_id",$value);
                    $this->form->validation("isempty");
                }
                foreach ($this->formData->post("quantity") as $key => $value) {
                    // echo "$key  quantity as  $value <br>";
                    $this->form->post("quantity",$value);
                    $this->form->validation("isempty");
                }
                foreach ($this->formData->post("price") as $key => $value) {
                    // echo "$key price as  $value <br>";
                    $this->form->post("price",$value);
                    $this->form->validation("isempty");
                }
                
                $result = $this->form->submit();
                // echo "<pre>";
                // print_r($result["Error"]);
                // echo "</pre>";
                if($result!=NULL)
                {
?>
<script> 
<?php
foreach($result["Error"] as $key => $value) {
?>
var <?php echo $key;?>= "<?php echo $value;?>";
console.log(<?php echo $key;?>);
$("<?php echo "span#$key";?>").html(<?php echo $key;?>);
<?php
}

?>
</script>
<?php

                    // $this->view("order\add","Add order data",$result);
                    // $this->view->render(true);
                }
                else
                {
                    
                    // print_r($this->formData->newpostAll());
                    $this->model->db->beginTransaction();
                    $result =$this->formData->newpostAll();
                    if($this->model->addNewBill($result))
                    {
                        $data["bill_id"]= $this->model->db->lastInsertId();
                        echo$data["bill_id"];
                        for($i=0;$i<count($result["product_id"]);$i++)
                        {
                            // $data["bill_id"]=$bill_id;
                            $data["product_id"]=$result["product_id"][$i];
                            $data["quantity"]=$result["quantity"][$i];
                            $data["product_stoke"]=$result["product_stoke"][$i];
                            $data["price"]=$result["price"][$i];

                            if ($this->model->addBillDetail($data)) {
                                if ($this->model->stokeUpData($data)) {
                                   echo "done";
                                } else {
                                    $this->model->db->rollback();
                                    echo "fail";
                                    // print_r($data);
                                    return false;
                                }
                                
                            } else {
                                
                        $this->model->db->rollback();
                        echo "fail";
                        // print_r($data);
                        return false;
                            }
                            

                            
                            
                        }

                        if($this->model->db->commit())
                        $this->redirect->header("order");
                    }
                    else
                    {
                        $this->model->db->rollback();
                        echo "fail";
                        return false;
                    }


                
                }
            }
            catch(Exception $e)
            {
                echo  $e->getMessage() ."<br/>";
            }
    }

    public function addOrder()
    {
            $this->view("order\\add","Add order data");
            $this->view->render();
        // $this->view("employee\addEmp","Add Emp data");
        // $this->view->render();
    }

    public function sendData()
    {
       echo json_encode($this->model->getdataTable("product"));
    }
    public function sendDataById($id)
    {
        echo json_encode($this->model->getdataByIdTable("product",$id));
    }

}

?>