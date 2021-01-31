<?php 

class emp extends Model
{
    private $table_name="emp"; 
    public function getdata($pageno)
    {
     return $this->db->selectAll($this->table_name,$pageno,PDO::FETCH_NUM);   
    }

    public function getSearchData($value,$pageno)
    {
        echo $value;
        $concat="`empID`, `empEmail`, `empUsername`, `empPassword`, `empType`";
        return $this->db->searchAll($this->table_name,$concat,$value,$pageno,PDO::FETCH_NUM);
        // return $this->db->getemp serchdata($value);
    }

    public function getDataById($id)
    {
        $res =$this->db->selectById($this->table_name,["empID"=>$id]);
        if($res!=NULL)
        {
            return $res[0];
        }
        // return $this->db->selectById($this->table_name,["empID"=>$id])[0];
    }

    public function addEmployee($data,$file)
    {
        // echo "<pre>";
        // print_r($data);
        // print_r($file);
        // echo "</pre>";

        $inputData = [
            "empEmail"=>$data["employee_email"],
            "empUsername"=>$data["employee_username"],
            "empPassword"=>$data["emp_password"],
            "empType"=>$data["employee_type"],
            "pic"=>$file
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

    public function updateEmployee($data)
    {
        // echo "<pre>";
        // print_r($_POST);
        // print_r($data);
        // echo "</pre>";

        $inputData = [
            "empPassword"=>$data["empPassword"],
            "empType"=>$data["empType"]
        ];
        $whereData = [
            "empID"=>$data["empID"]
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

    public function deleteEmployee($id)
    {
        $whereData = [
            "empID"=>$id
        ];

        $delEmp=$this->getDataById($id);

        if($delEmp["empType"]!="1")
        {    if($this->db->delete($this->table_name,$whereData))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}
?>