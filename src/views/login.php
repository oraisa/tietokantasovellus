<!DOCTYPE html>
<html lang='fi'>
<head>
	<title>Tietokantasovellus</title>
	<meta charset='utf-8'/>
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
</head>
<body>
	<div class='w3-row'>
		<form action='notes' method="post" class='w3-form w3-border w3-third'>
			<div class='w3-input-group'>
				<label for='username'>Käyttäjätunnus</label><br>
				<input id='username' class='w3-input w3-border w3-margin-10' type='text' name='username'/><br>
			</div>
			<div class='w3-input-group'>
				<label for='password'>Salasana</label><br>
				<input id='password' class='w3-input w3-border w3-margin-10' type='password' name='password'/><br>
			</div>
			<a href='http://oraisa.users.cs.helsinki.fi/tietokantasovellus/register'>Rekisteröidy</a><br><br>
			<input type='submit' value='Kirjaudu'/><br>
		</form>
	</div>
</body>
</html>
