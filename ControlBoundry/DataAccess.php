<?php
include_once("header.php");
/**
 * DataAccess Class : Used to SELECT, INSERT, UPDATE, DELETE data from 
 * the database 
 *
 * @author Lincoln
 */
class DataAccess 
{
    private $host =  "localhost";
    private $user = "root";
    private $password = "";
    private $database = "wcheck";
    private $con;
    
    public function __construct()
    {
        $this->con = new mysqli($this->host, $this->user, $this->password
                , $this->database);
        if (mysqli_connect_errno($this->con))
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    public function getCon(){ return $this->con; }
    
    public function addUser($insert_sql)
    {
      mysqli_query($this->con, $insert_sql);
    }
}

?>
