<?php 

class product extends Model
{
    private $table_name="product"; 
    public function getdata($pageno)
    {
    //     `product_id`,`product_name`, `category_name`, `product_price`, `product_dis`, `product_stoke`, `supplier_name`,`product_pic`;
    //      FROM `product`,`category`,`supplier` WHERE
    //      product_category=category_id and product_supplier=supplier_id
         $table = ["product","category","supplier"];
         $field = ["product_id","product_name", "category_name", "product_price", "product_dis", "product_stoke", "supplier_name", "product_pic"];

         $where = [ "product_category"=>"category_id","product_supplier"=>"supplier_id"];
 
    return $this->db->select($table,$field,$where,$pageno,PDO::FETCH_NUM);

    

    //  return $this->db->selectAll($this->table_name,$pageno,PDO::FETCH_NUM);   
    }

    public function getdataTable($table)
    {
     return $this->db->selectAllData($table,PDO::FETCH_NUM);   
    }



    public function getSearchData($value,$pageno)
    {
        // echo $value;
        $concat="`product_id`, `product_name`, `product_category`, `product_price`, `product_dis`, `product_stoke`, `product_supplier`";
        return $this->db->searchAll($this->table_name,$concat,$value,$pageno,PDO::FETCH_NUM);
        // return $this->db->getemp serchdata($value);
    }

    public function getDataById($id)
    {
        $res =$this->db->selectById($this->table_name,["product_id"=>$id]);
        // print_r($res);
        if($res!=NULL)
        {
           
            return $res[0];
        }
        // return $this->db->selectById($this->table_name,["empID"=>$id])[0];
    }

    public function addProductdata($data,$file)
    {
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        $inputData = [
            "product_name"=>$data["product_name"],
            "product_category"=>$data["product_category"],
            "product_price"=>$data["product_price"],
            "product_dis"=>$data["product_dis"],
            "product_stoke"=>$data["product_stoke"],
            "product_supplier"=>$data["product_supplier"],
            "product_pic"=>$file
        ];
        // echo "<pre>";
        // print_r($inputData);
        // print_r($file);
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

    public function updateCategory($data)
    {
        // echo "<pre>";
        // print_r($_POST);
        // print_r($data);
        // echo "</pre>";

        $inputData = [
            "product_name"=>$data["product_name"],
            "product_category"=>$data["product_category"],
            "product_price"=>$data["product_price"],
            "product_dis"=>$data["product_dis"],
            "product_stoke"=>$data["product_stoke"],
            "product_supplier"=>$data["product_supplier"]
        ];
        $whereData = [
            "product_id"=>$data["product_id"]
        ];
        // echo "<pre>";
        // print_r($inputData);
        // print_r($whereData);
        // echo "</pre>";
        if($this->db->update($this->table_name,$inputData,$whereData))
        {
            return true;
        }
        else
        {
            return false;
        }


    }

    public function stokeUpData($data)
    {
        // echo "<pre>";
        // print_r($_POST);
        // print_r($data);
        // echo "</pre>";

        $inputData = [
            "product_stoke"=>($data["product_stoke"] + $data["productnewstoke"])
        ];
        $whereData = [
            "product_id"=>$data["product_id"]
        ];
        // echo "<pre>";
        // print_r($inputData);
        // print_r($whereData);
        // echo "</pre>";
        if($this->db->update($this->table_name,$inputData,$whereData))
        {
            return true;
        }
        else
        {
            return false;
        }


    }

    public function deleteProduct($id)
    {
        $whereData = [
            "product_id"=>$id
        ];

        if($this->db->delete($this->table_name,$whereData))
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