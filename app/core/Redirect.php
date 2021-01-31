<?php

class Redirect
{
    public function header($data=NULL)
    {
        header("location:". URIROOT ."$data");
    }

    public function back($flag = false)
    {
        if(defined(BACKBUTTION))
        {
            if($flag == true)
            {
                echo "<button name='back' id='back' formaction=". BACKBUTTION ."> Back</button>";
            }
            else
            {
                header("location:". BACKBUTTION);
            }
        }
        else
        {
            $this->header();
        }
    }

}

?>