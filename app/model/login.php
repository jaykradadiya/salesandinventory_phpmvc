<?php

class login extends Model
{
    // public function __construct()
    // {
    //  parent::__construct();  
    // }

    public function checkUser($data)
    {
        // print_r($data);

        $parsedata=
        [
            "empEmail" => $data["loginMail"]
       ];
       $result =  $this->db->selectById("emp",$parsedata);
       if($result != NULL)
       {
        $parsedata=
        [
            "empEmail" => $data["loginMail"]
            ,"empPassword" => $data["loginPassword"]
        ];
        $result =  $this->db->selectById("emp",$parsedata);
            if($result != NULL)
            {
                foreach ($result[0] as $key => $value) {
                    Session::set($key,$value);
                }
                
                return 1;
            }
            else {
                return "please check your pssword";
            }
          
       }
       else
       {
           return "user not found";
       }
    }

    
}

?>