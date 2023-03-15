<meta charset=utf8>

<?php
	session_start();
	if (!isset($_SESSION['loggedin']))
	{
		header("Location: loginForm.html");
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
	$stmt = $con->prepare('SELECT epastaAdrese FROM lietotaji WHERE lietotajaID = ?');
	$stmt->bind_param('i', $_SESSION['id']);
	$stmt->execute();
	$stmt->bind_result($epastaAdrese);
	$stmt->fetch();
	$stmt->close();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><meta content="text/html; charset=utf8" http-equiv="content-type"><title>Index</title><style type="text/css">
body {
  border-style: none;
  font-size: 30px;
  text-align: center;
  font-family: "Times New Roman",Times,serif;
  line-height: 30px;
  background-color: #9d2235;
  color: white;
}
h1 {
  border-style: none;
  font-size: 60px;
  color: white;
  background-color: #9d2235;
  font-family: "Times New Roman",Times,serif;
  text-align: center;
  line-height: 30px;
}
#spiedSeit {
  line-height: 30px;
  font-size: 30px;
  color: white;
  font-family: "Times New Roman",Times,serif;
}

</style></head><body>
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