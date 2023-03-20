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
	
	echo nl2br("\n");
	echo "<div style='text-align:right'>";
	echo 'Sveicināti, ' . $_SESSION['name'] . '!';
	echo nl2br("\n");
	echo '<a id="spiedSeit" href="profils.php">Profils</a><br>';
	echo "<div style='text-align:center'>";
	echo "<h1>Jaunvārdotājs</h1><br><br>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
  
  <meta content="text/html; charset=utf8" http-equiv="content-type">
  <title>Jaunvārdotājs | Dzēst vārdu</title>
	
<link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">

</head><body>
	<?php
		if (isset($_GET['vards'])) {
			$varda_sql = "SELECT vards FROM vardi WHERE vardaID=".$_GET['vards'];
			$vards = $con->query($varda_sql)->fetch_assoc()['vards'];
			// $definiciju_sql = "SELECT definicija FROM definicijas WHERE vardaID=".$_GET['vards'];
			// $definicijas = $con->query($definiciju_sql);
			echo "<p>Vai esat pārliecināts, ka vēlaties dzēst vārdu <b>\"$vards\"</b> un visas tā definīcijas?</p>";
			echo "<form action='deleteWordAction.php' method='get' name='wordDeleteForm'>
				<input type='hidden' name='vards' value='".$_GET['vards']."'>
				<input value='Dzēst' type='submit' class='unstyled_submit_button'>
			</form><br>";
		}
		elseif (isset($_GET['error'])) {
			if ($_GET['error'] == "nav_varda_vai_lietotaja") {
				echo "<p>Vārdu neizdevās izdzēst, jo tas neeksistē vai arī Jūs neesat tā radītājs</p>";
			}
			else {
				echo "<p>Vārdu neizdevās dzēst</p>";
			}
		}
		elseif (isset($_GET['veiksmigi'])) {
			echo "<p>Vārds izdzēsts veiksmīgi!</p>";
		}
	?>
	<a id='spiedSeit' href='index.php'>Atpakaļ</a>
</body></html>
