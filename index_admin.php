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
</script>
</html>