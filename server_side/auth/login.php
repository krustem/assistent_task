<?php 
include('../Helpers/database.php');
include('../Helpers/Validation.php');

session_start();

$db=$conn;


$username=$password="";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
    
    $val = new Validation();
    $val->name('username')->value($myusername)->pattern('alphanum')->required();


    
    $param_password = password_hash($mypassword, PASSWORD_DEFAULT); // Creates a password hash


    $sql = "SELECT pswd FROM polzovateli WHERE username = '$myusername'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    
    $count = mysqli_num_rows($result);
    // var_dump($param_password);

    // var_dump($row['pswd']);
    // var_dump($val->isSuccess());
    // If result matched $myusername and $mypassword, table row must be 1 row
    
    if($count == 1 && $val->isSuccess() && password_verify($mypassword, $row['pswd'])) {

        // $_SESSION"myusername");

        $_SESSION['login_user'] = $myusername;
        // var_dump($_SESSION['login_user']);
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }
    }else {

        $error = "Your Login Name or Password is invalid";
        echo $error;
        if (isset($_SERVER["HTTP_REFERER"])) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        }


    }


    // $val->name('password')->value($password)->pattern('password')->required();



}

?>