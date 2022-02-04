<?php 
include('database.php');
$db = $conn;


class Otziv {
    // Properties
    public $name;
    public $email;
    public $text;


    // Methods
    function set_name($name) {
        $this->name = $name;
    }
    
    function poluchitOtzivPoId($id) {
        global $db;

        


    }
}

?>