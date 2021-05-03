<?php
session_start();
require('connect.php');
?>

<?php
 
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $user = $_POST['username'];
    $pass = $_POST['password'];

	$fullnameRegex = "/[0-9]/";
    /*check if username has duplicate*/
    $check_duplicate_username = "SELECT username FROM admin WHERE username= '$user'";
	$result = mysqli_query($conn, $check_duplicate_username);
	$count = mysqli_num_rows($result);

	/*check if first name and last name are the same*/
    $check_duplicate_fullname = "SELECT first_name,last_name FROM admin WHERE first_name= '$fname' && last_name='$lname'";
	$result1 = mysqli_query($conn, $check_duplicate_fullname);
	$count1 = mysqli_num_rows($result1);

	if($pass == "" || empty($pass)) {
		echo json_encode("Please enter a password.");
	}
	else if($count > 0){
		echo json_encode("Email is already taken. Please use another email.");
		return false;
	}else if($count1 > 0){
		echo json_encode("Your name is already taken. Please log in to your existing account.");
		return false;
	}else if(strlen($pass) > 20){
		echo json_encode("Password is too long. Maximum of 20 characters only.");
	}else if (preg_match($fullnameRegex, $fname, $match)){
		echo json_encode("Please enter a valid first name.");
		return false;
	}else if (preg_match($fullnameRegex, $lname, $match)){
		echo json_encode("Please enter a valid last name.");
		return false;
	}else{
       /*Inserting the Data inputed*/
		$passw=password_hash($pass, PASSWORD_DEFAULT);
		$sql = "INSERT INTO `admin` (first_name,last_name,username,password,code)
				VALUES ('$fname', '$lname', '$user', '$passw', ".intval(rand(10000, 99999)).")";
		$query_run = mysqli_query($conn, $sql);
		if($query_run){
			echo json_encode("success");
		}else{	
			echo json_encode(mysqli_error($conn));
		};
	}
	
?>


