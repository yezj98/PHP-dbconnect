<?php

class dbOperation {
    private $con;   

    function __construct (){
        require_once dirname(__FILE__).'/dbconnect.php'; // Get the result from dbconnect.php
        
        $db = new dbconnect(); // Create a constructor 

        $this ->con = $db -> connect(); // this.con = db.connect()
    }

    function createUser ($user_name, $pass, $email) {

        if ($this->checkUserExist($user_name, $email)) { // If user existing return 1 
            return 1;
        }
        
        else{
        $password = md5 ($pass); //hash the password
        $stmt = $this->con-> prepare("INSERT INTO `user_data` (`id`, `username`, `password`, `email`) VALUES (Null, ?, ?, ?)"); //Insert the sql query in database
        $stmt->bind_param ('sss', $user_name, $password, $email); // declare the parameters

            if ($stmt -> execute()){
                return 0;
            }
            else{
                return 2;
            }
        }
    }

    private function checkUserExist ($username, $email) {
        $s = $this->con -> prepare ("SELECT `id` FROM `user_data` WHERE `username` = ? OR `email` = ?"); // Insert the sql query in database
        $s->bind_param ('ss', $user_name, $email);  //bind the parameters 
        $s->execute(); // Run the query
        $s->store_result(); // Store the result

        return $s-> num_rows > 0; // If the number of rows greater than 0 return true 
    }

    public function userLogin ($email,$password) { // check the user login is existing or not
        $pass = md5 ($password); // hash the password
        $s = $this->con -> prepare ("SELECT `id` FROM `user_data` WHERE `email` = ? AND `password` = ?"); // insert sql query
        $s-> bind_param ('ss', $email, $pass);
        $s->execute();
        $s->store_result ();
        return $s-> num_rows >0;
    }

    public function getUser ($email){
        
        $s = $this->con->prepare ("SELECT * from `user_data` WHERE `email` = ?");
        $s->bind_param ('s', $email);
        $s-> execute(); 
        return $s-> get_result () -> fetch_assoc();
        
    }
}
?>