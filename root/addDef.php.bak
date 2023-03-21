<meta charset=utf8>

<?php
	session_start();
	if (!isset($_SESSION['loggedin']))
	{
		header("Location: loginForm.php");
		exit;
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
  <title>Jaunvārdotājs | Pievienot definīciju</title>

  
<link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">


</head><body>
	<?php if (isset($_GET['generetais_vards'])):
		echo "<p>Vārds ".$_GET['generetais_vards']." veiksmīgi pievienots datubāzei! Varat tam uzreiz pievienot definīciju.</p><br>\n";
	endif; ?>
	<form action="addDefAction.php" method="post" name="wordEditForm">Ierakstiet v&#257;rdu<span style="font-weight: bold;"><br>
  <input maxlength="50" size="40" name="vards"
	<?php
		if (isset($_GET['generetais_vards'])) {
  		echo "value=".$_GET['generetais_vards'];
		}
		elseif (isset($_GET['definejamais_vards'])) {
			echo "value=".$_GET['definejamais_vards'];
		}
	?>
	required><br>
  <br>
  </span>Ierakstiet savu defin&#299;ciju<br>
  <textarea name="definicija" rows="5" cols="40" required></textarea><br>
  <br>
  <input value="Apstiprin&#257;t" type="submit"><br>
</form>
<br>
<a id='spiedSeit' href='index.php'>Atpakaļ</a>
<br><br>
<?php if (isset($_GET['error']) && $_GET['error'] == "neeksiste"): ?>
  <span style="font-weight: bold;">Vārds neeksistē!</span>
<?php endif; ?>
<?php if (isset($_GET['success']) && $_GET['success'] == "ir"): ?>
  <span style="font-weight: bold;">Definīcija veiksmīgi pievienota!</span>
<?php endif; ?>
</body></html>
