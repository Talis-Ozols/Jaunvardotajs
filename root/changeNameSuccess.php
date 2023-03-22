<meta charset=utf8>

<?php
	session_start(); // Pārbauda vai sesija eksistē un atslēdz lietotāju
	if (!isset($_SESSION['loggedin'])) {
		header("Location: loginForm.php");
		exit;
	}
	session_destroy();
?>

<!DOCTYPE html PUBLIC>
<html>
	<head>
		<meta content="text/html; charset=utf8" http-equiv="content-type">
		<title>Jaunvārdotājs | Veiksmīgi mainīts lietotājvārds</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<br><br><br>
		Vārds nomainīts veiksmīgi!
		<br>
		Jūs tikāt izrakstīts
		<br><br>
		<?php
			echo nl2br("\n");
			echo '<a id="spiedSeit" href="loginForm.php">Atgriezties</a><br>';
		?>
	</body>
</html>
