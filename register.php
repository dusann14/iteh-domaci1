<?php

require 'dbBroker.php';
require 'model/clan.php';

if(isset($_POST['submit'])){

	$userName = mysqli_real_escape_string($conn, $_POST['userName']);
	$ime = mysqli_real_escape_string($conn, $_POST['ime']);
	$prezime = mysqli_real_escape_string($conn, $_POST['prezime']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['lozinka']);
	$pass1 = mysqli_real_escape_string($conn, $_POST['ponovi_lozinku']);
	
	$result = Clan::check($userName, $conn);

	if(mysqli_num_rows($result) != 0){
		echo '<script type="text/javascript">alert("Korisnicko ime je zauzeto!")</script>';
	}else {
		Clan::add($userName, $ime, $prezime, $email, $pass, $conn);
		header("location: login.php");
	}

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="/css/register_css.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Marhey&display=swap" rel="stylesheet">
</head>

<body>
<form action = '', method = 'post' id = "registracija">
		<h1>Registracija korisnika</h1>
		<div>
			<label for="korisnicko_ime">Korisničko ime:</label>
			<input id="korisnicko_ime" type="text" name="userName" required placeholder="Korisnicko ime">
		</div>
		<div>
			<label for="ime">Ime:</label>
			<input id="ime" type="text" name="ime" required placeholder="Ime">
		</div>
		<div>
			<label for="prezime">Prezime:</label>
			<input id="prezime" type="text" name="prezime" required placeholder="Prezime">
		</div>
		<div>
			<label for="email">Email adresa:</label>
			<input id="email" type="text" name="email" required placeholder="someone@mail.com">
		</div>
		<div>
			<label for="lozinka">Lozinka:</label>
			<input id="lozinka" type="text" name="lozinka" required placeholder="*******">
		</div>
		<div>
			<label for="ponovi_lozinku">Ponovi lozinku:</label>
			<input id="ponovi_lozinku" type="text" name="ponovi_lozinku" required placeholder="*******">
		</div>
		<div>
			<input class = "sub" type="submit" name = "submit" value = "Registruj se">
		</div>
	</form>
	<br>
	<div style="border-radius: 20px; opacity: 0.9; background-color: black; display: flex; justify-content: center;"><a href="login.php" style= "color: #FFC312; text-decoration: underline;">Vec imate nalog?</a></div>

	<script src="/js/registration_js.js"></script>

</body>

</html>