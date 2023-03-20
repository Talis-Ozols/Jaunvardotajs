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
  <title>Jaunvārdotājs | Pievienot vārdu</title>

<link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">

</head><body>
<!-- <form method="get" action="addWordAction.php" name="addWord">V&#257;rda garums (Ievadiet skaitli no 1 -2, kur 1 - &#299;sa, 2 - gara)<br> -->
<!-- <iframe name="dummy_iframe" style="display:none;"></iframe> -->
<form method="get" action="addWord.php" name="generateWords">Izvēlieties, cik neparastus vārdus ģenerēt:<br>
	<input type="radio" id="html" name="virknes_garums" value="3" <?php if ((!isset($_GET['virknes_garums'])) or $_GET['virknes_garums'] == 3): echo 'checked'; endif; ?> >
	<label for="html">"Radoši"</label><br>
	<input type="radio" id="css" name="virknes_garums" value="4" <?php if (isset($_GET['virknes_garums']) and $_GET['virknes_garums'] == 4): echo 'checked'; endif; ?> >
	<label for="css">"Reālistiski"</label><br>
  <br>
  <input value="&#290;ener&#275;t" type="submit"><br>
</form>
<a id='spiedSeit' href='index.php'>Atpakaļ</a>
<br><br>

<?php
	
	include 'generator/generateWords.php';

	// var_dump($word_array);
	
	echo "<table style='margin-left: auto; margin-right: auto; font-size:30px'>";
	echo "<tr> <th>npk</th> <th>jaunvārds</th> </tr>";
	foreach ($word_array as $i => $word) {
		echo "<tr> <td style='width:10vw; vertical-align: top;'>".($i+1)."</td> <td style='width:70vw; vertical-align: top;'><form method='get' action='addWordAction.php' name='addWord'><input name='pievienojamais_vards' value='$word' type='submit' class='unstyled_submit_button'></form></td> </tr>";
	}
	echo "</table>";
	
	// $default_chunk_length
	
?>

</body></html>
