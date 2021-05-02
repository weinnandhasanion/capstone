<?php 
session_start();
if(isset($_SESSION["admin_id"])) {
	header("Location: ./DASHBOARD/dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
   <title>INDEX - California Fitness Gym</title>
   <link href="css/style.min.css" rel="stylesheet">
   <link href="css/theme-colors.css" rel="stylesheet">
   <!-- Bootstrap core CSS -->
   <link href="css/bootstrap.min.css" rel="stylesheet">
   <!-- Your custom styles (optional) -->
   <link href="css/mdb.min.css" rel="stylesheet">
   <link rel="icon" href="./mobile/img/gym_logo.png">
   <link href="css/index.css" rel="stylesheet">
   <script src="js/prefixfree.min.js"></script>
   <link href="index_admin.css" rel="stylesheet">


</head>
<style>
	h6{
		color: white;
		cursor: pointer;
		text-decoration: underline;
	}

	.register{
        position: absolute;
        top: calc(30% - 75px);
        left: calc(60% - 50px);
        height: 150px;
        width: 350px;
        padding: 10px;
        z-index: 2;
        display:none;
    }

	.login{
        position: absolute;
        top: calc(30% - 75px);
        left: calc(60% - 50px);
        height: 150px;
        width: 350px;
        padding: 10px;
        z-index: 2;
    }

	p{
		font-size: 15px;
	}

	.login input[type=text]{
        width: 350px;
        height: 50px;
        background: transparent;
        border: 1px solid rgba(255,255,255,0.6);
        border-radius: 2px;
        color: #fff;
        font-family: 'Exo', sans-serif;
        font-size: 16px;
        font-weight: 400;
        padding: 4px;
    }
	.login input[type=text]:focus{
        outline: none;
        border: 1px solid rgba(255,255,255,0.9);
    }
</style>
<body>
  <div class="body"></div>
		<div class="grad"></div><br>


		<div class="login" id="signin">
			<div class="header">
				<div><span>California</span></div>
				<div>Fitness Gym</div>
			</div>
			
			<div class="btn-group" role="group" aria-label="Basic example" 
				 style="position: relative; left: 152px; top: 30px; cursor: pointer; width: 203px;">
			  <button type="button" id="sort-active" class="btn btn-sm btn-white">Sign In</button>
				<button type="button" onclick="register()" id="sort-inactive" class="btn btn-sm btn-outline-white">Sign Up</button>
			</div> <br><br><br>
			<!-- login process -->
			<form action="login_process.php" method="post">
				<input name="username" type="email" required placeholder="Email Address" class="input"><br>
				<input name="password" type="password" required placeholder="Password"  class="input" data-type="password"><br>
				<input type="submit" value="Let me in">
			</form>
			<br>

			<h6 class="forgetpassword" id="forgot_password_text" onclick="forget_pass()" >Forgot password?</h6>
			<div class="forgetpassword" style="display: none;" id="forgot_password">
				<p>Please enter your email to search for your account.</p>
				<form action="forgot_password_process.php" method="post">
					<input name="email" type="email"  required  class="input" placeholder="Enter your email address">
					<input  type="submit" value="Submit">
				</form>	
			</div>

		</div>

		<div class="register" id="signup">
			<div class="header">
				<div><span>California</span></div>
				<div>Fitness Gym</div>
			</div>
			<div class="btn-group" role="group" aria-label="Basic example" 
				 style="position: relative; left: 152px; top: 30px; cursor: pointer; width: 203px;">
			  <button type="button" id="sort-active" onclick="login()" class="btn btn-sm btn-outline-white">Sign In</button>
				<button type="button" id="sort-inactive"class="btn btn-sm btn-white">Sign Up</button>
			</div> <br><br><br>
			<!-- registration process -->
			<form action="register_process.php" method="post">
				<input name="first_name" type="text"   required  class="input" placeholder="Enter First name">
				<input name="last_name" id="lastname" type="text"   required  class="input" placeholder="Enter Last name"><br><br>	
				<input name="username" type="email"  required  class="input" placeholder="Enter your Email address"><br>
				<input name="password" type="password"   required  class="input" placeholder="Create your password"><br>
				<input  type="submit" value="Register">
			</form>	
		</div>

		




</div>

</body>

<script>
	function register(){
		var x = document.getElementById("signup");
		var y = document.getElementById("signin");

		x.style.display = "block";
		y.style.display = "none";
	}

	function login(){
		var x = document.getElementById("signup");
		var y = document.getElementById("signin");

		x.style.display = "none";
		y.style.display = "block";
	}


	
	function forget_pass(){
		var x = document.getElementById("forgot_password");
		var codeText = document.getElementById("code_text");

    	if (x.style.display == 'none') {
      		x.style.display = 'block';
			codeText.style.display = 'none';
   	 	 	document.getElementById("forgot_password_text").innerHTML = "Close forgot password"
		}else{
     		x.style.display = 'none';
      		document.getElementById('forgot_password_text').innerHTML = 'Forgot password?';
    	}
	}




</script>
</html>