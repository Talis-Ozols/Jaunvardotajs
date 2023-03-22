<meta charset=utf8>

<?php
	session_start(); // Pārbauda vai sesija eksistē
	if (!isset($_SESSION['loggedin'])) {
		header("Location: loginForm.php");
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta content="text/html; charset=utf8" http-equiv="content-type">
	<title>Jaunvārdotājs | Mainīt paroli</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<br><br><br>
	<form method="post" action="changePassAction.php" name="changePassForm">
		Ievadiet jauno paroli<br>
		<input minlength="8" maxlength="64" size="40" name="sifretaParole" type="password" required><br>
		<br>
		<input value="Aptiprin&#257;t" type="submit"><br>
	</form>

	<br>
	<a id="spiedSeit" href="profils.php">Atpaka&#316;</a><br>
	<br>
</body>
</html>
