<?php 

class orderItem extends Model
{
    private $table_name="bill_items"; 
    public function getdata($pageno)
    {
     return $this->db->selectAll($this->table_name,$pageno,PDO::FETCH_NUM);   
    }

    public function getSearchData($value,$pageno)
    {
        echo $value;
        $concat="`bill_id`,`product_id`, `quantity`, `price`";
        return $this->db->searchAll($this->table_name,$concat,$value,$pageno,PDO::FETCH_NUM);
        // return $this->db->getemp serchdata($value);
    }

    public function getDataById($id,$pageno)
    {
        $result = $this->db->paginationData($this->db->getALlRows($this->table_name,"'bill_id'=$id"),$pageno,10);
        if(!isset($result["limit"]))
        {
            $result["limit"] = NULL;
        }
        $res =$this->db->selectById($this->table_name,["bill_id"=>$id],$result["limit"],PDO::FETCH_NUM);

        if($res!=NULL)
        {
            if(isset($result["limit"]))
            {
                return [$result["pages"],$res];
            }
            else
            {
                return [NULL,$res];
            }
            
        }
        // return $this->db->selectById($this->table_name,["empID"=>$id])[0];
    }
}
?>