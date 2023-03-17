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
	echo "<h1>Jaunvārdotājs</h1>";
	echo "<br><br>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
  
  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <title>addWord</title>

<link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">

</head><body>
<form method="post" action="addWordAction.php" name="addWord">V&#257;rda garums (Ievadiet skaitli no 1 -2, kur 1 - &#299;sa, 2 - gara)<br>
  <input maxlength="1" size="1" name="garums" required><br>
  <br>
  <input value="&#290;ener&#275;t" type="submit"><br>
</form>
<br>
<a id='spiedSeit' href='index.php'>Atpakaļ</a>
<br><br>
<?php if (isset($_GET['error']) && $_GET['error'] == "neeksiste"): ?>
  <span style="font-weight: bold;">addWordAction.php vēl neko nedara (šo jānoņem after completion)</span>
<?php endif; ?>
</body></html>