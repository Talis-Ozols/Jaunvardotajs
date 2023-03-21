<meta charset=utf8>

<?php
	session_start(); //Pārbauda vai sesija eksistē
	if (!isset($_SESSION['loggedin']))
	{
		header("Location: loginForm.php");
		exit;
	}
	
	//Pieslēgšanās datu bāzei
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = 'usbw';
	$DATABASE_NAME = 'vardudb';
	
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if ( mysqli_connect_errno() )
	{
		exit('Kļūda cenšoties pielēgties MySQL: ' . mysqli_connect_error());
	}
	
	//Paņem epasta adresi no datu bāzes
	$stmt = $con->prepare('SELECT epastaAdrese FROM lietotaji WHERE lietotajaID = ?');
	$stmt->bind_param('i', $_SESSION['id']);
	$stmt->execute();
	$stmt->bind_result($epastaAdrese);
	$stmt->fetch();
	$stmt->close();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><meta content="text/html; charset=utf8" http-equiv="content-type"><title>Jaunvārdotājs | Tavs profils</title>

<link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">

</head><body>
<?php
	echo "<div style='text-align:right'>";
	echo '<a id="spiedSeit" href="logout.php">Izrakstīties</a><br>';
	echo '<a id="spiedSeit" href="index.php">Atpakaļ</a><br>';
	echo "<div style='text-align:center'>";
	echo 'Jūsu info:';
	echo nl2br("\n");
	echo nl2br("\n");
	echo 'Lietotājvārds: ' . $_SESSION['name'];
	echo nl2br("\n");
	echo 'E-pasta adrese: ' . $epastaAdrese;
	
	echo nl2br("\n");
	echo nl2br("\n");
	echo '<a id="spiedSeit" href="changeName.php">Mainīt lietotājvārdu</a><br>';
	echo '<a id="spiedSeit" href="changePass.php">Mainīt paroli</a><br>';
?>

</body></html>
