<meta charset=utf8>

<?php //Atslēdz lietotāju
	session_start();
	session_destroy();
	header("Location: index.php");
?>