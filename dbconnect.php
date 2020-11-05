<?php

class Dbconnect {
    private $con;

    function connect (){
        include_once dirname(__FILE__).'/constants.php'; //Get the informations from constants.php
        $this-> con = new mysqli (DB_host, DB_user, password, DB_name); //connect the sql database with constants.php informations
        
        if(mysqli_connect_errno()) { // If return error code 
            mysqli_connect_error(); //return the error description 
            echo "Failed to connect with database".mysqli_connect_error(); // return the error description
        }
        return $this->con; // return the connection
    }
}

?>