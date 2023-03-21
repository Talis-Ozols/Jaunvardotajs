<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Jaunvārdotājs | Pievienot definīciju</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php 
	session_start();
	if (!isset($_SESSION['loggedin'])) {
		header("Location: loginForm.php");
		exit;
	}
	?>
	<div style="text-align: right">
		<?php echo 'Sveicināti, ' . $_SESSION['name'] . '!'; ?>
		<br>
		<a href="profils.php">Profils</a>
	</div>
	<div style="text-align: center">
		<h1>Jaunvārdotājs</h1>
		<br><br>
	</div>
	<?php if (isset($_GET['generetais_vards'])): ?>
		<p>Vārds <?php echo $_GET['generetais_vards']; ?> veiksmīgi pievienots datubāzei! Varat tam uzreiz pievienot definīciju.</p>
		<br>
	<?php endif; ?>
	<form action="addDefAction.php" method="post" name="wordEditForm">
		Ierakstiet vārdu
		<span style="font-weight: bold;"><br>
			<input maxlength="50" size="40" name="vards" <?php if (isset($_GET['generetais_vards'])) { echo "value=".$_GET['generetais_vards']; } elseif (isset($_GET['definejamais_vards'])) { echo "value=".$_GET['definejamais_vards']; } ?> required>
			<br>
			<br>
		</span>
		Ierakstiet savu definīciju
		<br>
		<textarea name="definicija" rows="5" cols="40" required></textarea>
		<br>
		<br>
		<input value="Apstiprināt" type="submit">
		<br>
	</form>
	<br>
	<a id="spiedSeit" href="index.php">Atpakaļ</a>
	<br>
	<br>
	<?php if (isset($_GET['error']) && $_GET['error'] == "neeksiste"): ?>
		<span style="font-weight: bold;">Vārds neeksistē!</span>
	<?php endif; ?>
	<?php if (isset($_GET['success']) && $_GET['success'] == "ir"): ?>
		<span style="font-weight: bold;">Definīcija veiksmīgi pievienota!</span>
	<?php endif; ?>
</body>
</html>
