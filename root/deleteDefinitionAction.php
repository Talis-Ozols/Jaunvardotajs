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
		exit('Kļūda cenšoties pieslēgties MySQL: ' . mysqli_connect_error());
	}
	
	$count_sql = "SELECT definicijasID FROM definicijas WHERE definicijasID = ".$_GET['definicija']." AND lietotajaID = ".$_SESSION['id'];
	$count_result = $con->query($count_sql);
	if ($count_result->num_rows == 0)
	{
		//Nav definīcijas, ko dzēst
		header("Location: deleteDefinition.php?error=nav_definicijas_vai_lietotaja");
	}
	else
	{
		$definition_vote_delete_sql = "DELETE FROM definicijuBalsis WHERE definicijasID = ".$_GET['definicija'];
		$con->query($definition_vote_delete_sql);
		$definition_delete_sql = "DELETE FROM definicijas WHERE definicijasID = ".$_GET['definicija'];
		$con->query($definition_delete_sql);
		echo "Definīcija izdzēsta veiksmīgi";
		header("Location: deleteDefinition.php?veiksmigi");
	}
?>
