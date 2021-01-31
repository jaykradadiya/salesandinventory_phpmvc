<?php

class Ftp 
{
    private $ftp_conn;
    public function __construct()
    {
        
        $ftp_server = "localhost";
        $ftp_username="pos";
        $ftp_userpass="";
       $login= $this->ftp_conn = ftp_connect($ftp_server,21,90) or die("Could not connect to $ftp_server");
       if($login)
        {
            echo "connected";
        }
        $login = ftp_login($this->ftp_conn, $ftp_username, $ftp_userpass);
        if($login)
        {
            echo "connected";
        }
        ftp_pasv($this->ftp_conn, true);

        
        if(ftp_chdir($this->ftp_conn, "/pic"))
        {
                echo "Current directory is now: " . ftp_pwd($this->ftp_conn) . "\n";
        }
        else
        {
            if(ftp_mkdir($this->ftp_conn, "pic"))
            {
                if(ftp_chdir($this->ftp_conn, "/pic"))
            {
                echo "Current directory is now: " . ftp_pwd($this->ftp_conn) . "\n";
            }
            else { 
                echo "Couldn't change directory\n";
            }
    
            }
        }
    }

    public function __destruct()
    {
        ftp_close($this->ftp_conn);
    }


    public function putfile($filename,$filepath)
    {
        echo $source_file=$filepath;
        echo $remote_file_path = time().$filename;
        if(!empty($filename))
        {
            $upload = ftp_put($this->ftp_conn,$remote_file_path, $source_file, FTP_BINARY); 
        if (!$upload) { 
        return NULL;
        } else {
        return $remote_file_path;
        }
    }
    }

    public function getfile($filename)
    {

        if(!empty($filename)&& (!file_exists("/sem5/mvc/public/pic/". $filename)))
        {
            $download = ftp_get($this->ftp_conn,APP."../public/pic/". $filename,$filename, FTP_BINARY); 
        if (!$download) { 
        return "fail";
        } else {
        return "success";
        }
        }
    }

    public function delpic($filename)
    {
        if(!empty($filename))
       {
        if (ftp_delete($this->ftp_conn, $filename)) {
            echo "$filename deleted successful\n";
           } else {
            echo "could not delete $filename\n";
           }
       }  
     }
}


// $ftp= new ftp();



?>
