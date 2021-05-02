<?php
session_start();
if (isset($_SESSION["admin_id"])) {
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
	<link href="css/style.min.css" rel="stylesheet">
	<link rel="icon" href="./mobile/img/gym_logo.png">
	<link href="css/index.css" rel="stylesheet">
	<script src="js/prefixfree.min.js"></script>
	<link href="index_admin.css" rel="stylesheet">
	<link href="css/theme-colors.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">


</head>
<style>
	.jconfirm-content, .jconfirm-title {
		color: black;
	}

	.forget-div {
		width: 100%;
		display: flex;
		justify-content: center;
	}

	.forgetpasswordlink {
		font-size: .8rem;
		color: white;
		cursor: pointer;
	}

	.forgetpasswordlink:hover {
		color: white;
		text-decoration: underline;
	}

	.btn-green {
		background: #5cb85c;
	}

	.btn-red {
		background: #df4759;
	}

	.btn-orange {
		background: #DF3A01;
	}

	.register {
		position: absolute;
		top: calc(30% - 75px);
		left: calc(60% - 50px);
		height: 150px;
		width: 350px;
		padding: 10px;
		z-index: 2;
		display: none;
	}

	.login {
		position: absolute;
		top: calc(30% - 75px);
		left: calc(60% - 50px);
		height: 150px;
		width: 350px;
		padding: 10px;
		z-index: 2;
	}

	p {
		font-size: 15px;
	}

	.login input[type=text] {
		width: 350px;
		height: 50px;
		background: transparent;
		border: 1px solid rgba(255, 255, 255, 0.6);
		border-radius: 2px;
		color: #fff;
		font-family: 'Exo', sans-serif;
		font-size: 16px;
		font-weight: 400;
		padding: 4px;
	}

	.login input[type=text]:focus {
		outline: none;
		border: 1px solid rgba(255, 255, 255, 0.9);
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

		<div class="btn-group" role="group" aria-label="Basic example" style="position: relative; left: 152px; top: 30px; cursor: pointer; width: 203px;">
			<button type="button" id="sort-active" class="btn btn-sm btn-white">Sign In</button>
			<button type="button" onclick="register()" id="sort-inactive" class="btn btn-sm btn-outline-white">Sign Up</button>
		</div> <br><br><br>
		<!-- login process -->
		<form action="login_process.php" method="post">
			<input name="username" type="email" required placeholder="Email Address" class="input"><br>
			<input name="password" type="password" required placeholder="Password" class="input" data-type="password"><br>
			<input type="submit" value="Let me in">
		</form>
		<br>

		<div class="forget-div">
			<a href="#" class="forgetpasswordlink" id="forgot_password_text" onclick="forget_pass()">Forgot password?</a>
		</div>
		<div class="forgetpassword" style="display: none;" id="forgot_password">
			<p>Please enter your email to search for your account.</p>
			<input name="email" type="email" id="email-forgot" required class="input" placeholder="Enter your email address">
			<input type="submit" id="submit-forget" value="Submit">
		</div>
	</div>

	<div class="register" id="signup">
		<div class="header">
			<div><span>California</span></div>
			<div>Fitness Gym</div>
		</div>
		<div class="btn-group" role="group" aria-label="Basic example" style="position: relative; left: 152px; top: 30px; cursor: pointer; width: 203px;">
			<button type="button" id="sort-active" onclick="login()" class="btn btn-sm btn-outline-white">Sign In</button>
			<button type="button" id="sort-inactive" class="btn btn-sm btn-white">Sign Up</button>
		</div> <br><br><br>
		<!-- registration process -->
		<form action="register_process.php" method="post">
			<input name="first_name" type="text" required class="input" placeholder="Enter First name">
			<input name="last_name" id="lastname" type="text" required class="input" placeholder="Enter Last name"><br><br>
			<input name="username" type="email" required class="input" placeholder="Enter your Email address"><br>
			<input name="password" type="password" required class="input" placeholder="Create your password"><br>
			<input type="submit" value="Register">
		</form>
	</div>

	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script type="text/javascript" src="validation.js"></script>
  <script src="./../js/pagination.js"></script>
	<script>
		function register() {
			var x = document.getElementById("signup");
			var y = document.getElementById("signin");

			x.style.display = "block";
			y.style.display = "none";
		}

		function login() {
			var x = document.getElementById("signup");
			var y = document.getElementById("signin");

			x.style.display = "none";
			y.style.display = "block";
		}

		function forget_pass() {
			var x = document.getElementById("forgot_password");

			if (x.style.display == 'none') {
				x.style.display = 'block';
				document.getElementById("forgot_password_text").innerHTML = "Close"
			} else {
				x.style.display = 'none';
				document.getElementById('forgot_password_text').innerHTML = 'Forgot password?';
			}
		}

		$("#submit-forget").click(function () {
			$.confirm({
				closeIcon: true,
				theme: 'modern',
				buttons: {
					submit: {
						btnClass: 'btn-orange',
						action: function () {
							let code = $("#code-input").val();
							var successModal = $.confirm({
								lazyOpen: true,
								theme: 'modern',
								type: 'green',
								title: 'Success',
								content: `You have entered a valid code. You can now reset your password.
								<div style="height: 75px"></div>
								<label>Enter new password</label>
								<input type="password" id="new-password" class="form-control" />
								<br />
								<label>Confirm password</label>
								<input type="password" id="confirm-password" class="form-control" />`,
								buttons: {
									reset: {
										btnClass: 'btn-green',
										action: function () {
											let newPass = $("#new-password").val();
											let confirm = $("#confirm-password").val();

											if(newPass != confirm) {
												$.alert({
													title: '',
													type: 'red',
													content: 'Passwords do not match. Please try again.',
													buttons: {
														close: {
															btnClass: 'btn-red',
															action: function () {
																successModal.open();
															}
														}
													}
												});
											} else {
												$.post(
													"./reset_password.php",
													{
														new_pass: newPass, 
														confirm_pass: confirm,
														email: $("#email-forgot").val()
													},
													function (res) {
														console.log(res);
														if(JSON.parse(res) == "success") {
															$.alert({
																title: 'Success',
																type: 'green',
																backgroundDismiss: function () {
																	$("#forgot_password").css("display", "none");
																	$("#forgot_password_text").html("Forgot password?");
																},
																content: 'Password successfully changed. You can now log in.',
																buttons: {
																	ok: {
																		btnClass: 'btn-success',
																		action: function () {
																			$("#forgot_password").css("display", "none");
																			$("#forgot_password_text").html("Forgot password?");
																		}
																	}
																}
															});
														} else {
															$.alert({
																title: 'Error',
																type: 'red',
																content: JSON.parse(res),
																buttons: {
																	close: {
																		btnClass: 'btn-red',
																		action: function () {}
																	}
																}
															});
														}
													}
												);
											}
										}
									}
								}
							});
							
							$.get(`./check_code.php?code=${code}&email=${$("#email-forgot").val()}`, function (res) {
								if(JSON.parse(res) == "success") {
									successModal.open();
								} else {
									$.alert({
										backgroundDismiss: true,
										theme: 'modern',
										type: 'red',
										title: 'Invalid Code',
										content: 'You have entered an invalid code.',
										buttons: {
											close: {
												btnClass: 'btn-red',
												action: function () {}
											}
										}
									});
								}
							});
						}
					},
					close: {
						btnClass: 'btn-red',
						action: function () {}
					}
				},
				content: function () {
					var self = this;
					return $.get("./mail.php?email=" + $("#email-forgot").val(), function (res) {
						if(JSON.parse(res) == "success") {
							self.setTitle('Enter Code');
							self.setContent(`
									We have sent a code to your email. Please check your email and enter the code in the space provided below.
									<div class="form-group">
										<label>Enter code here:</label>
										<input type="text" class="form-control" id="code-input" />
									</div>
									`);
							self.buttons.close.hide();
						} else {
							self.setType('red');
							self.setTitle('Error');
							self.setContent(JSON.parse(res));
							self.buttons.submit.hide();
						}
					});
				}
			});
		});
	</script>
</body>

</html>