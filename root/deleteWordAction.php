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
		exit('Kļūda cenšoties pieslēgties MySQL: ' . mysqli_connect_error());
	}
	
	$count_sql = "SELECT vardaID FROM vardi WHERE vardaID = ".$_GET['vards']." AND lietotajaID = ".$_SESSION['id'];
	$count_result = $con->query($count_sql);
	if ($count_result->num_rows == 0) {
	  echo "Nav vārda, ko dzēst";
		header("Location: deleteWord.php?error=nav_varda_vai_lietotaja");
	}
	else {
		$definition_vote_delete_sql = "DELETE FROM definicijuBalsis WHERE definicijasID IN (SELECT definicijas.definicijasID FROM definicijas WHERE definicijas.definicijasID = definicijuBalsis.definicijasID AND definicijas.vardaID = ".$_GET['vards'].")";
		$con->query($definition_vote_delete_sql);
		$word_vote_delete_sql = "DELETE FROM varduBalsis WHERE vardaID = ".$_GET['vards'];
		$con->query($word_vote_delete_sql);
		$definition_delete_sql = "DELETE FROM definicijas WHERE vardaID = ".$_GET['vards'];
		$con->query($definition_delete_sql);
		$word_delete_sql = "DELETE FROM vardi WHERE vardaID = ".$_GET['vards']." AND lietotajaID = ".$_SESSION['id'];
		$con->query($word_delete_sql);
		echo "Vārds izdzēsts veiksmīgi";
		header("Location: deleteWord.php?veiksmigi");
	}
?>
