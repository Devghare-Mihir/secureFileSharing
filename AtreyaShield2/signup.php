	<?php

session_start();
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "atreyashield";

#Create database connection
$db = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

try {
	if (isset($_POST['submit'])) {
		

		$name = $email = $password = $conpassword = "";

		$name = $_POST["regName"];
		$email = $_POST["regEmail"];
		$password = $_POST["regPass"];
		$conpassword = $_POST["regConPass"];
		date_default_timezone_set("Asia/Kolkata");
	   	$date= date('y-m-d h:i:sa');

		// Validate password strength
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@[^\w]@', $password);

		if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
    		echo "<html><head><title></title><body><h2 style='color: #CCFF00;'>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special!!</h2></body></head></html>";
		}
		else if ($password == $conpassword) {
			$sql = "INSERT into users (username, recovery_email, password, is_active, last_login) VALUES('$name', '$email', MD5('$password'), '1', '$date')";
			if (mysqli_query($db, $sql) == 1) {
				header("location:signup.php");
			}
		} else {
			echo "<html><head><title></title><body><h2 style='color: #CCFF00;'>Passwords do not match!!!</h2></body></head></html>";
		}
	}
} catch (Exception $e) {
	echo 'Message: ' . $e->getMessage();
}

try {
	if (isset($_POST['login'])) {
		


		$name = $email = $password= "";

		$email = $_POST["logEmail"];
		$password0 = $_POST["logPass"];
		$password1 = MD5($password0);

		if ($email=="" || $password0==""){
			echo "<html><head><title></title><body><h2 style='color: #CCFF00;'>Please Enter Credentials!!!</h2></body></head></html>";
		}
		else
		{

		$sql = $db->prepare("SELECT * FROM users WHERE recovery_email='$email'");
		$sql->execute();
		$result = $sql->get_result();
		$r = $result->fetch_array(MYSQLI_ASSOC);
		$dbpass=$r['password'];	
		$_SESSION['recovery_email']= $email;
		$_SESSION['id'] = $r['id'];
		$_SESSION['username'] = $r['username'];
		// echo $_SESSION['id'];

		 if ($dbpass == $password1) {
		 	header("location:myFiles.php");
		 } 
		 else if ($dbpass != $password1){
			echo "<html><head><title></title><body><h2 style='color: #CCFF00;'>Incorrect Password!!!</h2></body></head></html>";
		 }
		}
	}

} catch (Exception $e) {
	echo "<html><head><title></title><body><h2 style='color: #CCFF00;'>Unable to Login! Please try again.<h2></body></head></html>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login Page</title>
	<style>
		@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

		* {
			box-sizing: border-box;
		}

		body {
			background: #370f63;
			background-image: linear-gradient(to bottom right,#370f63,#301934);
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			font-family: 'Montserrat', sans-serif;
			height: 100vh;
			margin: -20px 0 50px;
		}

		h1 {
			font-weight: bold;
			margin: 0;
		}

		h2 {
			text-align: center;
		}

		p {
			font-size: 14px;
			font-weight: 100;
			line-height: 20px;
			letter-spacing: 0.5px;
			margin: 20px 0 30px;
		}

		span {
			font-size: 12px;
		}

		a {
			color: #333;
			font-size: 14px;
			text-decoration: none;
			margin: 15px 0;
		}

		button {
			border-radius: 20px;
			border: 1px solid #1f0838;
			background-color: #1f0838;
			color: #252525;
			font-size: 12px;
			font-weight: bold;
			padding: 12px 45px;
			letter-spacing: 1px;
			text-transform: uppercase;
			transition: transform 80ms ease-in;
		}

		button:active {
			transform: scale(0.95);
		}

		button:focus {
			outline: none;
		}

		button.ghost {
			background-color: transparent;
			border-color: #252525;
		}

		form {
			background-color: #FFFFFF;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			padding: 0 50px;
			height: 100%;
			text-align: center;
		}

		input {
			background-color: #eee;
			border: none;
			padding: 12px 15px;
			margin: 8px 0;
			width: 100%;
		}

		.container {
			background-color: #fff;
			border-radius: 10px;
			box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
				0 10px 10px rgba(0, 0, 0, 0.22);
			position: relative;
			overflow: hidden;
			width: 768px;
			max-width: 100%;
			min-height: 480px;
		}

		.form-container {
			position: absolute;
			top: 0;
			height: 100%;
			transition: all 0.6s ease-in-out;
		}

		.sign-in-container {
			left: 0;
			width: 50%;
			z-index: 2;
		}

		.container.right-panel-active .sign-in-container {
			transform: translateX(100%);
		}

		.sign-up-container {
			left: 0;
			width: 50%;
			opacity: 0;
			z-index: 1;
		}

		.container.right-panel-active .sign-up-container {
			transform: translateX(100%);
			opacity: 1;
			z-index: 5;
			animation: show 0.6s;
		}

		@keyframes show {

			0%,
			49.99% {
				opacity: 0;
				z-index: 1;
			}

			50%,
			100% {
				opacity: 1;
				z-index: 5;
			}
		}

		.overlay-container {
			position: absolute;
			top: 0;
			left: 50%;
			width: 50%;
			height: 100%;
			overflow: hidden;
			transition: transform 0.6s ease-in-out;
			z-index: 100;
		}

		.container.right-panel-active .overlay-container {
			transform: translateX(-100%);
		}

		.overlay {
			background: #1f0838;
			background: -webkit-linear-gradient(to right, #1f0838, #1f0838);
			background: linear-gradient(to right, #1f0838, #1f0838);
			background-repeat: no-repeat;
			background-size: cover;
			background-position: 0 0;
			color: #252525;
			position: relative;
			left: -100%;
			height: 100%;
			width: 200%;
			transform: translateX(0);
			transition: transform 0.6s ease-in-out;
		}

		.container.right-panel-active .overlay {
			transform: translateX(50%);
		}

		.overlay-panel {
			position: absolute;
			display: flex;
			align-items: center;
			justify-content: center;
			flex-direction: column;
			padding: 0 40px;
			text-align: center;
			top: 0;
			height: 100%;
			width: 50%;
			transform: translateX(0);
			transition: transform 0.6s ease-in-out;
		}

		.overlay-left {
			transform: translateX(-20%);
		}

		.container.right-panel-active .overlay-left {
			transform: translateX(0);
		}

		.overlay-right {
			right: 0;
			transform: translateX(0);
		}

		.container.right-panel-active .overlay-right {
			transform: translateX(20%);
		}
	</style>
</head>

<body>

	<div class="container" id="container">
		<div class="form-container sign-up-container">
			<form action="#" method="POST">
				<h1>Create Account</h1>
				<br>
				<input type="text" placeholder="Name" name="regName" required/>
				<input type="email" placeholder="Email" name="regEmail"  required/>
				<input type="password" placeholder="Password" inputmode="numeric" name="regPass" minlength="8" maxlength="12" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required autocomplete="off" />
				<input type="password" placeholder="Confirm Password" inputmode="numeric" name="regConPass" minlength="8" maxlength="12" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" required autocomplete="off" />
				<span><b>Password Requirements</b><br> Minimum 8 characters<br> At least one uppercase letter and lower case<br>One number and one special character<br><br></span>

				<button type="submit" name="submit" style="color: #FFFFFF;">Sign Up</button>
			</form>
		</div>
		<div class="form-container sign-in-container" style="color: #000000">
			<form action="#" method="POST">
				<h1>Sign in</h1>
				<br>
				<input type="email" placeholder="Email" name="logEmail" />
				<input type="password" placeholder="Password" name="logPass" />
				<a href="#">Forgot your password?</a>
				<button name="login" style="color: #FFFFFF;">Sign In</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left" >
					<h1 style="color: #FFFFFF">Welcome Back!</h1>
					<p style="color: #FFFFFF;">To keep connected with us please login with your personal info</p>
					<button class="ghost" id="signIn" style="background-color: #FFFFFF;">Sign In</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1 style="color: #FFFFFF">Hello, Friend!</h1>
					<p style="color: #FFFFFF">Enter your personal details and start journey with us</p>
					<button class="ghost" id="signUp" style="background-color: #FFFFFF; color:#1f0838;">Sign Up</button>
				</div>
			</div>
		</div>
	</div>

	<footer>

	</footer>
	<script>
		const signUpButton = document.getElementById('signUp');
		const signInButton = document.getElementById('signIn');
		const container = document.getElementById('container');

		signUpButton.addEventListener('click', () => {
			container.classList.add("right-panel-active");
		});

		signInButton.addEventListener('click', () => {
			container.classList.remove("right-panel-active");
		});
	</script>
</body>

</html>