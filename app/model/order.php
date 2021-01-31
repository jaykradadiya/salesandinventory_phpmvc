<?php 

class order extends Model
{
    private $table_name="BILL"; 
    public function getdata($pageno)
    {
     return $this->db->selectAll($this->table_name,$pageno,PDO::FETCH_NUM);   
    }

    public function getSearchData($value,$pageno)
    {
        echo $value;
        $concat="`bill_id`, `customerName`, `customerEmail`, `bill_counter`, `date`, `total`";
        return $this->db->searchAll($this->table_name,$concat,$value,$pageno,PDO::FETCH_NUM);
        // return $this->db->getemp serchdata($value);
    }

    public function getdataTable($table)
    {
     return $this->db->selectAllData($table,PDO::FETCH_NUM);   
    }
    public function getdataByIdTable($table,$id)
    {
     return $this->db->selectById($table,["product_id"=>$id],PDO::FETCH_NUM)[0];   
    }
    
    public function getDataById($id)
    {
        $res =$this->db->selectById($this->table_name,["bill_id"=>$id]);
        if($res!=NULL)
        {
            return $res[0];
        }
        // return $this->db->selectById($this->table_name,["empID"=>$id])[0];
    }

    public function addNewBill($data)
    {
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        $inputData = [
            "customerName"=>$data["customerName"],
            "customerEmail"=>$data["customerEmail"],
            "bill_counter"=>"admin",//temporaly
            "date"=>$data["date"],
            "total"=>$data["total"]
        ];
        // echo "<pre>";
        // print_r($inputData);
        // echo "</pre>";


        if($this->db->insert($this->table_name,$inputData))
        {
            return true;
        }
        else
        {
            return false;
        }

    }


    public function addBillDetail($data)
    {
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // `bill_id`, `product_id`, `quantity`, `price`
        $inputData = [
            "bill_id"=>$data["bill_id"],
            "product_id"=>$data["product_id"],
            "quantity"=>$data["quantity"],
            "price"=>$data["price"]
        ];
        // echo "<pre>";
        // print_r($inputData);
        // echo "</pre>";


        if($this->db->insert("bill_items",$inputData))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
   
}
?>