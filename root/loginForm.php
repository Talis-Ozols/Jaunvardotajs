<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Jaunvārdotājs | Pierakstīties</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<br>
	<h1>Jaunvārdotājs</h1>
	<br>
	<br>
	<h2>Pierakstīties</h2>
	<br>
	<br>
	<form action="noDBloginForm.php" method="post" name="loginForm">
		E-pasta adrese<br>
		<input size="40" maxlength="255" name="epastaAdrese" required><br>
		<br>
		Parole<br>
		<input minlength="8" size="40" maxlength="64" name="sifretaParole" type="password" required><br>
		<br>
		<input value="Pierakstīties" type="submit">
	</form>

	<?php // Check if there's an error message to display
	if (isset($_GET['error']) && $_GET['error'] == "nepareizi_dati"): ?>
		<span style="font-weight: bold;">Nepareiza E-pasta adrese vai parole!</span>
	<?php endif; ?>

	<br>
	<br>
	Vēl nav konta? <a id="spiedSeit" href="regForm.php">Spied šeit</a><br>
	<br>
</body>
</html>
