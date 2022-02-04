<?php 
include('../Helpers/database.php');
include('../Helpers/Validation.php');

session_start();

$db=$conn;


$username=$password="";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
   
   
    if(session_destroy()) {
        // var_dump('Loged out');

        session_destroy();
        $_SESSION['login_user'] = null;
        // var_dump($_SESSION);
        // var_dump($_SESSION['login_user']);
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }
    }else {
        $error = "Your Login Name or Password is invalid";
    }


    // $val->name('password')->value($password)->pattern('password')->required();



}

?>