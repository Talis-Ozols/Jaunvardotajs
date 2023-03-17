<meta charset=utf8>

<?php
	session_start();
	if (!isset($_SESSION['loggedin']))
	{
		header("Location: loginForm.php");
		exit;
	}
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = 'usbw';
	$DATABASE_NAME = 'vardudb';
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if ( mysqli_connect_errno() )
	{
		exit('Kļūda cenšoties pielēgties MySQL: ' . mysqli_connect_error());
	}
	
	
	$stmt = $con->prepare("UPDATE lietotaji SET lietotajvards = " . "'" . $_POST['lietotajvards'] . "'" . " WHERE lietotajaID = ?");
	$stmt->bind_param('i', $_SESSION['id']);
	$stmt->execute();
	$stmt->store_result();
	header("Location: changeNameSuccess.php");
?>
