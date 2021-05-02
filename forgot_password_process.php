<?php
session_start();
require('connect.php');
?>

<?php
 $email = $_POST['email'];

 $check_email = "SELECT username FROM admin WHERE username = '$email'";
 $result = mysqli_query($conn, $check_email);

 $pass_array = array();
 $pass_sql = "SELECT password FROM admin ORDER BY admin_id DESC";
 $result_pass = mysqli_query($conn, $pass_sql);
 if($result_pass) {
     while($pass_row = mysqli_fetch_assoc($result_pass)) {
		 $password_array[] = $pass_row["password"];
     }

     $password = $password_array[0];
 }

 if($result){

    	echo ("<script LANGUAGE='JavaScript'>
				    window.alert('Your password is: . $password .');
				    window.location.href='index_admin.php';
				    </script>");
	
 }


?>