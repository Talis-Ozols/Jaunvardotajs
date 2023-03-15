<meta charset=utf8>

<?php
	session_start();
	if (!isset($_SESSION['loggedin']))
	{
		header("Location: loginForm.html");
		exit;
	}
	session_destroy();
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
<br><br><br>
Vārds nomainīts veiksmīgi!
<br>
Jūs tikāt izrakstīs
<br><br>
<?php
	echo nl2br("\n");
	echo '<a id="spiedSeit" href="loginForm.html">Atgriezties</a><br>';
?>
</body></html>