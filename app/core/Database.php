<?php

// echo dsn;
class Database extends PDO
{

    public function __construct()
    {
        $host="localhost";
        $user="root";
        $passwd="";
        // echo $dsn="mysql:host=$host;dbname=$dbname";
        parent::__construct("mysql:host=localhost;dbname=pos1",$user,$passwd);
    }

    public function getALlRows($table,$where=1,$mode = PDO::FETCH_ASSOC)
    {
        $sql = "SELECT COUNT(*) as row  FROM $table WHERE $where ";
        $statement = $this->prepare($sql);
        $statement->execute();
        return $statement->fetchAll($mode)[0]["row"];
    }

    public function select($table,$data= array(),$where = array(),$pageno=NULL,$mode = PDO::FETCH_ASSOC)
    {
        $result = $this->paginationData($this->getALlRows($table[0]),$pageno,5);
        $fieldName=NULL;
        $fieldName = implode('`,`',array_values($data));

        $tableName=NULL;
        $tableName = implode('`,`',array_values($table));
        // echo $tableName;
        $whereData =NULL;
        // foreach ($where as $key => $value) {
        //     $whereData .="`$key`=:$key AND ";
        // }
        // $whereData= rtrim($whereData,"AND ");

        foreach ($where as $key => $value) {
            $whereData .="`$key`=$value AND ";
        }
        $whereData= rtrim($whereData,"AND ");

         $sql = "SELECT `$fieldName` FROM `$tableName` WHERE $whereData";
          if((isset($result["limit"]) ) && ($result["limit"]!= NULL))
         {
             echo $result["limit"];
            $sql .= " LIMIT ".$result["limit"];
         }
        
         // select * from $table
        $statement = $this->prepare($sql);
        // foreach ($where as $key => $value) {
            
        //    echo $statement->bindValue(":$key",$value);
        //    echo "$value  </br>";
        // }

        $statement->execute();
        // print_r($statement);
                // $r=$statement->fetchAll($mode);
        // print_r($r);

        if((isset($result["limit"]) ) && ($result["limit"]!= NULL))
         {
             return [$result["pages"],$statement->fetchAll($mode)];
         }
         else {
            //  echo  "gg";
            return [$result["pages"]="",$statement->fetchAll($mode)];
         }
        
        
    }


    

    public function selectById($table,$id=array(),$limit=NULL,$mode = PDO::FETCH_ASSOC)
    {
        $whereData =NULL;
        foreach ($id as $key => $value) {
            $whereData .="`$key`=:$key AND";
        }
       $whereData= rtrim($whereData,"AND");

        $sql = "SELECT * FROM $table WHERE $whereData ";
        if($limit != NULL)
        {
           $sql .= " LIMIT $limit";
        }

        $statement = $this->prepare($sql);
        foreach ($id as $key => $value) {
            $statement->bindValue(":$key",$value);
        }
        $statement->execute();

        return $statement->fetchAll($mode);
        
    }

    public function selectAll($table,$pageno=NULL,$mode = PDO::FETCH_ASSOC)
    {
        $result = $this->paginationData($this->getALlRows($table),$pageno,5);
        $sql = "SELECT * FROM $table ";
        if((isset($result["limit"]) ) && ($result["limit"]!= NULL))
        {
           $sql .= " LIMIT ".$result["limit"];
        }
        $statement = $this->prepare($sql);
        $statement->execute();
        return [$result["pages"],$statement->fetchAll($mode)];
        
    }

    public function selectAllData($table,$mode = PDO::FETCH_ASSOC)
    {
        $sql = "SELECT * FROM $table ";
        $statement = $this->prepare($sql);
        $result = $statement->execute();
        return $statement->fetchAll($mode);
        
    }
    

    public function searchAll($table,$concat,$value,$pageno=NULL,$mode = PDO::FETCH_ASSOC)
    {
        $result = $this->paginationData($this->getALlRows($table,"CONCAT($concat) LIKE '%$value%'"),$pageno,5);
    //    print_r($result);
        
         $sql = "SELECT * FROM `$table` WHERE CONCAT($concat) LIKE :val";
         if((isset($result["limit"]) ) && $result["limit"]!= NULL)
        {
           $sql .= " LIMIT ".$result["limit"];
        }
        $statement = $this->prepare($sql);
        $statement->bindValue(":val","%$value%");
        //    var_dump($statement);
           $statement->execute();
           return [$result["pages"],$statement->fetchAll($mode)];
    }

    public function insert($table,$data=array())
    {
        $fieldName=NULL;
        $fieldValue=NULL;
        $fieldName = implode('`,`',array_keys($data));
        $fieldValue= ":". implode(",:",array_keys($data));

        $statement = $this->prepare("INSERT INTO $table (`$fieldName`) VALUES ($fieldValue)");
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key",$value);
        }

         if($statement->execute())
         {
             return true;
         }
         else
         {
             return false;
         }

    }

    public function update($table,$data = array(),$where)
    {
        $fieldDetails=NULL;
        $whereData=NULL;
        foreach ($data as $key => $value) {
            $fieldDetails .="`$key`=:$key,";
        }
        $fieldDetails= rtrim($fieldDetails,",");

        foreach ($where as $key => $value) {
            $whereData .="`$key`=:$key,";
        }

        $whereData= rtrim($whereData,",");
        $statement = $this->prepare("UPDATE $table SET $fieldDetails WHERE $whereData");
        echo "<pre>";
        // print_r($statement);
        echo "</pre>";
        foreach ($data as $key => $value) {
            $statement->bindValue(":$key",$value);
        }

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key",$value);
        }
        // echo "<pre>";
        // print_r($statement);
        // echo "</pre>";
        if($statement->execute())
         {
             return true;
         }
         else
         {
             return false;
         }

    }
    
    public function delete($table,$where = array(),$limit=1)
    {
        $whereData=NULL;
        foreach ($where as $key => $value) {
            $whereData .="`$key`=:$key,";
        }
        $whereData= rtrim($whereData,",");
        $statement = $this->prepare("DELETE FROM $table WHERE $whereData LIMIT $limit");
        // echo "<pre>";
        // print_r($statement);
        // print_r($where);
        // echo "</pre>";

        foreach ($where as $key => $value) {
            $statement->bindValue(":$key",$value);
        }
        // echo "<pre>";
        // print_r($statement);
        // echo "</pre>";
        if($statement->execute())
         {
             return true;
         }
         else
         {
             return false;
         }

    }

        
    public function paginationData($totalRecords,$pageno,$n)
    {
        if($totalRecords>0)
        {
        $pageno = $pageno;
        $noOfRecodesPerPage = $n;

        $last = ceil($totalRecords / $noOfRecodesPerPage);
        $pagination = "";

        if($last != 1)
        {
            if($pageno>1)
            {
                $pagination .= "<a href='".($pageno-1)."' style='color:blacks;'> previous </a>";
            }
            for($i=$pageno - 5;$i< $pageno;$i++)
            {
                if($i>0)
                {
                    $pagination .= "<a href='$i'> $i </a>";
                }
            }
            
            $pagination .= "<a href='$pageno' style='color:blacks;'> $pageno </a>";

            for($i=$pageno + 1;$i <= $last;$i++)
            {
                if($i < ($pageno + 6))
                {
                    $pagination .= "<a href='$i'> $i </a>";
                }
            }

            if($pageno<$last)
            {
                $pagination .= "<a href='".($pageno+1)."' style='color:blacks;'> next </a>";
            }
            $limit = ($pageno-1)*$noOfRecodesPerPage.",".$noOfRecodesPerPage;
        $data = ["pages"=>$pagination,"limit"=>$limit];
        }
        else {
            $data= ["pages"=>""];
        }
        return $data;
        }
        
        
        
        
    }

}
?>