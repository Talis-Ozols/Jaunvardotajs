<meta charset=utf8>

<?php
	session_start();
	session_destroy();
	header("Location: index.php");
?>