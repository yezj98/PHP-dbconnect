<?php

class location {
    private $con;

    function __construct () {
        require_once dirname (__FILE__). '/dbconnect.php';

        $db = new dbconnect ();

        $this->con = $db -> connect();

    }

    function storeLocation ($id, $longitude, $latitude) {
        
        $s = $this->con ->prepare ("INSERT INTO `user_location` (`id`,`latitude`, `longitude`) VALUES (?,?,?)");
        $s ->bind_param ('sss', $id, $latitude, $longitude);
        if ($s ->execute ()) {
            return true;
        }
        return false;
    }

    function overWrite ($id, $latitude, $longitude) {
        $s = $this->con -> prepare ("UPDATE `user_location` SET `latitude` = ?, `longitude` = ? WHERE `id` = ? ");
        $s ->bind_param ('sss', $latitude, $longitude, $id);
        if ($s -> execute ()) {
            return true;

        }
        return false;
    }
}

?>