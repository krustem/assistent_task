<?php 
// include('../server_side/Otziv.php');
include('../server_side/Helpers/database.php');

$db = $conn;
// var_dump($db);


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // var_dump('Salem');
    // var_dump($_GET);

    if($_GET['method_name'] === 'get_by_id' && $_GET['id'] !== null){
        $otziv_id = $_GET['id'];
        $sql = "SELECT * from otziv WHERE id = '$otziv_id'";
        $result = $db->query($sql);
        // $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        while($row = mysqli_fetch_array($result)){
            $id = $row['id'];
            $username = $row['username'];
            $email = $row['email'];
            $text = $row['text'];
            $changed_by = $row['changed_by'];
            $status_otziva = $row['status_otziva'];

        
            $return_arr[] = array(
                            "id" => $id,
                            "username" => $username,
                            "email" => $email,
                            "text" => $text,
                            "changed_by" => $changed_by,
                            "status_otziva" => $status_otziva
                            );
        }
        // var_dump($return_arr);

        
        // Encoding array in JSON format
        echo json_encode($return_arr);


    }

    
    
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($_POST['operation'] === 'update_otziv' && $_POST['id'] !== null){
        $otziv_id = $_POST['id'];
        $new_data = $_POST['new_data'];



        // main update statement
        $sql = "UPDATE otziv SET text='$new_data[text]', status_otziva = '$new_data[status_otziva]', changed_by=true WHERE id = $otziv_id";
        $result = $db->query($sql);

        var_dump($result);

        echo $result;


    }
}


mysqli_close($db);

?>