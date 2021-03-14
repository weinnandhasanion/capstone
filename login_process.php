<?php
session_start();
include 'connect.php';
date_default_timezone_set('Asia/Manila');
?>
<?php
$user = $_POST['username'];
$pass  = $_POST['password'];

    $auth = "SELECT * FROM `admin` WHERE username = '$user'";
    $result = mysqli_query($conn,$auth);
    $row =  mysqli_fetch_assoc($result);
    
    $username = $row['username'];

    if($username != $user){
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Username does not exist');
        window.location.href='./index_admin.php';
        </script>");
    }else{
        if(password_verify($pass, $row['password'])){
            $_SESSION['admin_id'] = $row['admin_id'];
            echo "Success";
            header('Location: /PROJECT/DASHBOARD/dashboard.php?success');
                $id = $_SESSION['admin_id'];
                $sql1 =  "INSERT INTO logtrail(admin_id,first_name,last_name,dateandtime_login)
                VALUES('".$row["admin_id"]."','".$row["first_name"]."','".$row["last_name"]."','".date("Y-m-d H:i:s")."')";
                $query_run1 = mysqli_query($conn, $sql1); 
        }else{
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Incorrect password');
            window.location.href='./index_admin.php';
            </script>");
        }
    }
?>