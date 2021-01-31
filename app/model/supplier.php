<?php 

class supplier extends Model
{
    private $table_name="supplier"; 
    public function getdata($pageno)
    {
     return $this->db->selectAll($this->table_name,$pageno,PDO::FETCH_NUM);   
    }

    public function getSearchData($value,$pageno)
    {
        // echo $value;
        $concat="`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contect_no`";
        return $this->db->searchAll($this->table_name,$concat,$value,$pageno,PDO::FETCH_NUM);
        // return $this->db->getemp serchdata($value);
    }

    public function getDataById($id)
    {
        $res =$this->db->selectById($this->table_name,["supplier_id"=>$id]);
        // print_r($res);
        if($res!=NULL)
        {
            return $res[0];
        }
        // return $this->db->selectById($this->table_name,["empID"=>$id])[0];
    }

    public function addSupplierdata($data)
    {
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        $inputData = [
            "supplier_name"=>$data["supplier_name"],
            "supplier_address"=>$data["supplier_address"],
            "supplier_contect_no"=>$data["supplier_contect_no"]
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

    public function updateSupplier($data)
    {
        // echo "<pre>";
        // print_r($_POST);
        // print_r($data);
        // echo "</pre>";

        $inputData = [
            "supplier_name"=>$data["supplier_name"],
            "supplier_address"=>$data["supplier_address"],
            "supplier_contect_no"=>$data["supplier_contect_no"]
        ];
        $whereData = [
            "supplier_id"=>$data["supplier_id"]
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

    public function deleteSupplier($id)
    {
        $whereData = [
            "supplier_id"=>$id
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