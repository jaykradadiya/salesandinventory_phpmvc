<?php
/**
 * 
 * form fill ip
 * 
 * post to php
 * 
 * senetize
 * 
 * validata data 
 * return to data
 * write to database
 * 
 * 
 */
class Form
{
    private $_cuurentItem=NULL;
    private $_postData = array();
    private $_validation = NULL;
    private $_erro = array();


    public function __construct()
    {
     $this->_validation = new Validation();
    }

    public function post($field,$data)
    {
       $this->_postData[$field] = $data;
       $this->_cuurentItem= $field;
    //    echo "<pre> form start";
    //    var_dump($this);
    //    echo "end from</pre>";
       return $this;
    }
    
    public function fetch($fieldName=NULL)
    {
        if(isset($fieldName))
        {
            if(isset($this->_postData[$fieldName]))
            {return $this->_postData[$fieldName];}
            else
            {
                return false;
            }
        }
        else
        {
            return $this->_postData;
        }
    }

    /**
     * 
     * validation form
     */
    public function validation($typeOfValidation,$arg = NULL)
    {
        $result = NULL;
        if($arg == NULL)
        {
            
            $result = $this->_validation->$typeOfValidation($this->_cuurentItem,$this->_postData[$this->_cuurentItem]);
        }
        else
        {
            $result = $this->_validation->$typeOfValidation($this->_cuurentItem,$this->_postData[$this->_cuurentItem],$arg);
        }
       
        if($result)
        {
            if(!isset($this->_error[$this->_cuurentItem]))
            $this->_error[$this->_cuurentItem]= $result;
        }
    }


    public function submit()
    {
        if(empty($this->_error))
        {
            return NULL;
        }
        else
        {
            $errors = "";
            foreach ($this->_error as $key => $value) {
                $errors .= "$value </br>";
            }
            return  ["Error"=>$this->_error];
        }
        throw new Exception($errors);
    }

    public function fetchError($fieldName=NULL)
    {
        if(isset($fieldName))
        {
            if(isset($this->_error[$fieldName]))
            {return ["Error"=>$this->_error[$fieldName]];}
            else
            {
                return false;
            }
        }
        else
        {
            $errors = "";
            foreach ($this->_error as $key => $value) {
                $errors .= "$value </br>";
            }
            return ["Error"=>$errors];
        }
    }
}


?>