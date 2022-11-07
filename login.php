<?php

require 'dbBroker.php';
require 'model/clan.php';

session_start();

if(isset($_POST['submit'])){

	$userName = $_POST['korisnicko_ime'];
	$pass = $_POST['lozinka'];

	$result = Clan::logIn($userName, $pass, $conn);

	if($result->num_rows != 0){

		echo '<script type="text/javascript">alert("Uspesno ste se prijavili")</script>';
		
		if($userName == 'admin'){
			$_SESSION['admin'] = $userName;
			header("Location: admin.php");
			exit();
		}else{
			$_SESSION['user'] = $userName;
			header("Location: home.php");
			exit();
		}
		
	}else{
		echo '<script type="text/javascript">alert("Netacna lozinka ili korisnicko ime")</script>';
	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/login_css.css">
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Prijavite se!</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form method="post" action="">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input name = "korisnicko_ime" type="text" class="form-control" required placeholder="username">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input name = "lozinka" type="password" class="form-control" required placeholder="password">
					</div>
					
					<div class="form-group">
						<input type="submit" name = "submit" value="Login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Niste registrovani? <a href="register.php">Registrujte se</a>
				</div>
				
			</div>
		</div>
	</div>
</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>