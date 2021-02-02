<?php
session_start();
include 'connect.php';
?>

<?php
$user = $_POST['username'];
$pass  = $_POST['password'];
    $auth = "SELECT * FROM `admin` WHERE username = '$user'";
    $result = mysqli_query($conn,$auth);
    
    if($row = mysqli_fetch_array($result)){
        if(password_verify($pass, $row['password'])){
            $_SESSION['admin_id'] = $row['admin_id'];
            echo "Success";
            header('Location: /PROJECT/DASHBOARD/dashboard.php?success');

                $id = $_SESSION['admin_id'];

                $sql1 =  "INSERT INTO logtrail(admin_id,first_name,last_name)
                SELECT admin_id,first_name,last_name
                FROM admin
                WHERE admin_id = $id";
                $query_run1 = mysqli_query($conn, $sql1);

                
                
        }else{
            echo "failed";
            header('Location: index.php?account does not exist');
        }
    }else{
        echo "ACCOUNT DOESN'T EXIST";
        
    }
?>