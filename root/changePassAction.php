<meta charset=utf8>

<?php
	// Pārbauda vai sesija eksistē
	session_start();
	if (!isset($_SESSION['loggedin']))
	{
		header("Location: loginForm.php");
		exit;
	}
	
	// Pieslēgšanās datu bāzei
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = 'usbw';
	$DATABASE_NAME = 'vardudb';
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if (mysqli_connect_errno())
	{
		exit('Kļūda cenšoties pielēgties MySQL: ' . mysqli_connect_error());
	}
	
	$safePass = $_POST['sifretaParole'];
	for ($i = 0; $i < 20; $i++)
	{
		$safePass = md5($safePass);
	}
	
	$stmt = $con->prepare("UPDATE lietotaji SET sifretaParole = " . "'" . $safePass . "'" . " WHERE lietotajaID = ?");
	$stmt->bind_param('i', $_SESSION['id']);
	$stmt->execute();
	$stmt->store_result();
	
	// Pāreja uz veiksmīgas paroles maiņas lapu
	header("Location: changePassSuccess.php");
?>
