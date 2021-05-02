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

	if($count > 0){
		echo ("<script LANGUAGE='JavaScript'>
				    window.alert('Username is already taken. Please use another username.');
				    window.location.href='index_admin.php';
				    </script>");
		return false;
    }else if($count1 > 0){
		echo ("<script LANGUAGE='JavaScript'>
				    window.alert('your first name and last name is already taken');
				    window.location.href='index_admin.php';
			</script>");
			return false;
	}else if(strlen($fname) > 20){
    			echo ("<script LANGUAGE='JavaScript'>
    			window.alert('Invalid first name. Maximum of 20 letters only');
    			window.location.href='index_admin.php';
    			</script>");
	}else if(strlen($lname) > 20){
    			echo ("<script LANGUAGE='JavaScript'>
    			window.alert('Invalid last name. Maximum of 20 letters only');
    			window.location.href='index_admin.php';
    			</script>");
	}else if(strlen($pass) > 40){
    			echo ("<script LANGUAGE='JavaScript'>
    			window.alert('Invalid password. Maximum of 40 letters only');
    			window.location.href='index_admin.php';
    			</script>");
	}else if(strlen($user) > 40){
    			echo ("<script LANGUAGE='JavaScript'>
    			window.alert('Invalid email address. Maximum of 40 letters only');
    			window.location.href='index_admin.php';
    			</script>");
    }else if (preg_match($fullnameRegex, $fname, $match)){
        echo ("<script LANGUAGE='JavaScript'>
            		window.alert('Your first name has numbers.. please check your inputs.');
            		window.location.href='index_admin.php';
            </script>");
			return false;
	}else if (preg_match($fullnameRegex, $lname, $match)){
        echo ("<script LANGUAGE='JavaScript'>
           			window.alert('Your last name has numbers.. please check your inputs.');
            		window.location.href='index_admin.php';
            </script>");
			return false;
	}else{
       /*Inserting the Data inputed*/
		$passw=password_hash($pass, PASSWORD_DEFAULT);
		$sql = "INSERT INTO `admin` (first_name,last_name,username,password,code)
				VALUES ('$fname', '$lname', '$user', '$passw', ".intval(rand(10000, 99999)).")";
		$query_run = mysqli_query($conn, $sql);
		if($query_run){
			echo ("<script LANGUAGE='JavaScript'>
				    window.alert('You are now Registered.');
				    </script>");
		}else{	
			echo "failure to register";	
		};
	}
	
?>


