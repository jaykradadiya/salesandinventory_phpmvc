<?php 

class category extends Model
{
    private $table_name="category"; 
    public function getdata($pageno)
    {
     return $this->db->selectAll($this->table_name,$pageno,PDO::FETCH_NUM);   
    }

    public function getSearchData($value,$pageno)
    {
        echo $value;
        $concat="`category_id`, `category_name`, `Category_desciption`";
        return $this->db->searchAll($this->table_name,$concat,$value,$pageno,PDO::FETCH_NUM);
        // return $this->db->getemp serchdata($value);
    }

    public function getDataById($id)
    {
        $res =$this->db->selectById($this->table_name,["category_id"=>$id]);
        // print_r($res);
        if($res!=NULL)
        {
           
            return $res[0];
        }
        // return $this->db->selectById($this->table_name,["empID"=>$id])[0];
    }

    public function addCategorydata($data)
    {
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        $inputData = [
            "category_name"=>$data["category_name"],
            "Category_desciption"=>$data["Category_desciption"]
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

    public function updateCategory($data)
    {
        // echo "<pre>";
        // print_r($_POST);
        // print_r($data);
        // echo "</pre>";

        $inputData = [
            "category_name"=>$data["category_name"],
            "Category_desciption"=>$data["Category_desciption"]
        ];
        $whereData = [
            "category_id"=>$data["category_id"]
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

    public function deleteCategory($id)
    {
        $whereData = [
            "category_id"=>$id
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