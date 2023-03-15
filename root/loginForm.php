<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
  
  <meta content="text/html; charset=utf8" http-equiv="content-type">
  <title>loginForm</title>

  
  <link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">
  
</head><body>
<br>

<br>

<br>

<h1>Pierakstīties</h1>

<br>

<br>

<form action="noDBloginForm.php" method="post" name="loginForm">
E-pasta adrese<br>
  <input size="40" maxlength="255" name="epastaAdrese"><br>
  <br>
Parole<br>
  <input size="40" maxlength="64" name="sifretaParole" type="password"><br>
  <br>
  <input value="Pierakstīties" type="submit"></form>

<?php if (isset($_GET['error']) && $_GET['error'] == "nepareizi_dati"): ?>
  <span style="font-weight: bold;">Nepareiza E-pasta adrese vai parole!</span>
<?php endif; ?>

<br>

<br>

Vēl nav konta? <a id="spiedSeit" href="regForm.php">Spied šeit</a><br>

<br>
</body></html>
