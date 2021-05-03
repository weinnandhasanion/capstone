<?php
session_start();
include './connect.php';
date_default_timezone_set('Asia/Manila');

$user = $_POST['username'];
$pass  = $_POST['password'];

$auth = "SELECT * FROM `admin` WHERE username = '$user'";
$result = mysqli_query($conn,$auth);

if(!mysqli_num_rows($result) > 0){
    echo json_encode("Account does not exist");
}else{
    $row =  mysqli_fetch_assoc($result);

    if(password_verify($pass, $row['password'])){
        $_SESSION['admin_id'] = $row['admin_id'];
        $id = $_SESSION['admin_id'];
        $sql1 =  "INSERT INTO logtrail(admin_id,first_name,last_name,dateandtime_login)
        VALUES('".$row["admin_id"]."','".$row["first_name"]."','".$row["last_name"]."','".date("Y-m-d H:i:s")."')";
        $query_run1 = mysqli_query($conn, $sql1); 
        
        if($query_run1) {
            echo json_encode("success");
        } else {
            echo json_encode(mysqli_error($conn));
        }
    }else{
        echo json_encode("Incorrect password. Please try again.");
    }
}
?>