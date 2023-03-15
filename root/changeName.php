<meta charset=utf8>

<?php
	session_start();
	if (!isset($_SESSION['loggedin']))
	{
		header("Location: loginForm.html");
		exit;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>

  
  <meta content="text/html; charset=utf8" http-equiv="content-type"><title>changeName</title>
  

  <link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">
  
  </head><body><br>
<br>
<br>
<form method="post" action="changeNameAction.php" name="changeNameForm">Ievadiet jauno lietot&#257;jv&#257;rdu<br>
  <input maxlength="50" size="40" name="lietotajvards"><br>
  <br>
  <input value="Aptiprin&#257;t" type="submit"><br>
</form>


<br>
<a id="spiedSeit" href="profils.php">Atpaka&#316;</a><br>
</body></html>
