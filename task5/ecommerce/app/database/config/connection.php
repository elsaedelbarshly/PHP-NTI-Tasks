<?php

namespace app\database\config;
use mysqli;

class connection 
{
    private $hostName = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'ecommerc_nti_php';
    protected $con;
    public function __construct() 
    {
        // connection
        $this->con = new mysqli($this->hostName,$this->username,$this->password,$this->database);
        // if ($this->con->connect_error) {
        //     die("Connection failed: " . $this->con->connect_error);
        // }
        // echo "Connected successfully";
    }

    // insert - update - delete
    public function runDML($query) :bool
    {
        $result = $this->con->query($query);
        if($result){
            return true;
        }else{
            return false;
        }
    }
    // SELECT
    public function runDQL($query)
    {
        return $this->con->query($query);
    }

    public function __destruct()
    {
        // end connection
        $this->con->close();
    }
}


