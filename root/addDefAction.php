<meta charset=utf8>

<?php
	session_start();
	if (!isset($_SESSION['loggedin'])) {
		header("Location: loginForm.php");
		exit;
	}

	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = 'usbw';
	$DATABASE_NAME = 'vardudb';

	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if ( mysqli_connect_errno() ) {
		exit('Kļūda cenšoties pieslēgties MySQL: ' . mysqli_connect_error());
	}

	$sql = "SELECT vardaID FROM vardi WHERE vards = '" . $_POST['vards'] . "' limit 1";		
	$result = $con->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();

		$link = mysql_connect("localhost", "root", "usbw");
		mysql_select_db("vardudb", $link);
		$tabula="definicijas";
		$sql="INSERT INTO $tabula (definicija, publicesanasLaiks, lietotajaID, vardaID) values ( '".mysql_real_escape_string($_POST['definicija'], $link)."', now(), " . $_SESSION['id'] . ", " . $row["vardaID"] . ")";
		mysql_query($sql, $link);
		header("Location: addDef.php?success=ir");
	} else {
		header("Location: addDef.php?error=neeksiste");
	}
?>
