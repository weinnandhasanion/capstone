<?php
session_start();
require('connect.php');
?>

<?php
 
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $user = $_POST['username'];
    $pass = $_POST['password'];

    /*check if username has duplicate*/
    $check_duplicate_username = "SELECT username FROM admin WHERE username= '$user'";
	$result = mysqli_query($conn, $check_duplicate_username);
	$count = mysqli_num_rows($result);

	if($count > 0){
		echo ("<script LANGUAGE='JavaScript'>
				    window.alert('Username is already taken. Please use another username.');
				    window.location.href='index.php';
				    </script>");
		return false;
    }
    /*check if first name and last name are the same*/
    $check_duplicate_fullname = "SELECT first_name,last_name FROM admin WHERE first_name= '$fname' && last_name='$lname'";
	$result1 = mysqli_query($conn, $check_duplicate_fullname);
	$count1 = mysqli_num_rows($result1);
    
	if($count1 > 0){
		echo ("<script LANGUAGE='JavaScript'>
				    window.alert('your first name and last name is already taken');
				    window.location.href='index.php';
				    </script>");
		return false;
    }

       /*Inserting the Data inputed*/
		$passw=password_hash($pass, PASSWORD_DEFAULT);
		$sql = "INSERT INTO `admin` ( admin_id,first_name,last_name,username,password)
				VALUES ('$admin_id', '$fname', '$lname', '$user', '$passw')";
		$query_run = mysqli_query($conn, $sql);
		if($query_run){
			echo ("<script LANGUAGE='JavaScript'>
				    window.alert('You are now Registered.');
				    window.location.href='index.php';
				    </script>");
		}else{	
			echo "failure to register";	
		};
	
?>

	