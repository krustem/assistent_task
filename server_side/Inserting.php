<?php 
include('Helpers/database.php');
require_once('Helpers/Validation.php');

$name = $email = $text = $comment = $website = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $text = $_POST['text'];

    // var_dump($email, $name, $text);

    $val = new Validation();
    $val->name('email')->value($email)->pattern('email')->required();
    $val->name('name')->value($name)->pattern('alphanum')->required();
    $val->name('text')->value($text)->pattern('text')->required();


    // FILE UPLOADING not finished
    $target_dir = "uploads/";
    $target_file = basename($_FILES["fileToUpload"]["name"]);
    // var_dump($target_file);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    
    $path = __DIR__; 
    // $location = $target_dir. $_FILES['fileToUpload']['name']; 
    
    var_dump($imageFileType);
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    
    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    //  // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    } 
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        var_dump(__DIR__.$target_file);
        if ( move_uploaded_file($_FILES['fileToUpload']['tmp_name'], __DIR__.$target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    if($val->isSuccess()){
        // echo "Validation ok!";
        
        $sql = "INSERT INTO otziv (username, email, text)
        VALUES ('$name','$email', '$text')";

        if ($conn->query($sql) === TRUE) {
            // if (isset($_SERVER["HTTP_REFERER"])) {
            //     header("Location: " . $_SERVER["HTTP_REFERER"]);
            //     exit();
            // }
            return ['message'=>"New record created successfully"];
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else{
        echo "Validation error!";
        var_dump($val->getErrors());
    }     
    
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
}


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

mysqli_close($conn);
?>