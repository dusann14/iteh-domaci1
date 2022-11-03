<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="/css/register_css.css">
</head>

<body>
<form>
		<h1>Registracija korisnika</h1>
		<div>
			<label for="ime_prezime">Ime i prezime:</label>
			<input id="ime_prezime" type="text" name="ime_prezime" placeholder="Niko Nikolic">
		</div>
		<div>
			<label for="korisnicko_ime">Korisničko ime:</label>
			<input id="korisnicko_ime" type="text" name="korisnicko_ime" placeholder="niko.nikolic1">
		</div>
		<div>
			<label for="email">Email adresa:</label>
			<input id="email" type="text" name="email" placeholder="niko.nikolic@mail.com">
		</div>
		<div>
			<label for="lozinka">Lozinka:</label>
			<input id="lozinka" type="text" name="lozinka" placeholder="*******">
		</div>
		<div>
			<label for="ponovi_lozinku">Ponovi lozinku:</label>
			<input id="ponovi_lozinku" type="text" name="ponovi_lozinku" placeholder="*******">
		</div>
		<div>
			<button><a href="login.php">Registrujte se</a></button>
		</div>
	</form>


	<script src="/js/registration_js.js"></script>
</body>

</html>