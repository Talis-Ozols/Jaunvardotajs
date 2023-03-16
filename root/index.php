<meta charset=utf8>

<?php
	session_start();
	if (!isset($_SESSION['loggedin']))
	{
		header("Location: loginForm.php");
		exit;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><meta content="text/html; charset=utf8" http-equiv="content-type"><title>Index</title>

<link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">

</head><body>
<?php
	echo "<div style='text-align:right'>";
	echo 'Sveicināti, ' . $_SESSION['name'] . '!';
	echo nl2br("\n");
	echo '<a id="spiedSeit" href="profils.php">Profils</a><br>';
	echo "<div style='text-align:center'>";
	// echo "Šeit būs vārdi etc";
	
	include 'generator/generateWords.php';
	
	// var_dump($word_array);
	
	echo "<table style='margin-left: auto; margin-right: auto; font-size:20px'>";
	echo "<tr> <th>npk</th> <th>jaunvārds</th> </tr>";
	foreach ($word_array as $i => $word) {
		echo "<tr> <td>$i</td> <td>$word</td> </tr>";
	}
	echo "</table>";
	
	echo "</div>";
?>

</body></html>
