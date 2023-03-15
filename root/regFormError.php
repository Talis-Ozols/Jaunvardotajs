<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head>
  
  <meta content="text/html; charset=utf8" http-equiv="content-type">
  <title>regFormError</title>

  
  <link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">
  
</head><body>
<div style="text-align: center;"><br>
<br>
<br>
<h1>Reģistrācija</h1>
<br>
<br>
</div>

<div style="text-align: center;">
<form action="uzDBregForm.php" method="post" name="regForm">Lietotājvārds<br>
  <input size="40" maxlength="50" name="lietotajvards"><br>
  <br>
E-pasta adrese<br>
  <input size="40" maxlength="255" name="epastaAdrese"><br>
  <br>
Parole<br>
  <input size="40" maxlength="64" name="sifretaParole" type="password"><br>
  <br>
  <input value="Reģistrēties" type="submit"><br>
</form>
</div>

<?php
if(isset($_GET['error'])){
  if($_GET['error'] == "nepietiekama_informacija"){
    echo '<span style="font-weight: bold;">Ievadītā informācija nav pietiekama!</span><br>';
  }
  elseif($_GET['error'] == "adrese_jau_registreta"){
    echo '<span style="font-weight: bold;">Ievadītā E-pasta adrese jau ir reģistrēta!</span><br>';
  }
  else {
    echo '<span style="font-weight: bold;">Gadījās nezināma kļūme!</span><br>';
  }
}
?>

<br>

Jau ir konts? <a id="spiedSeit" href="loginForm.html">Spied šeit</a><br>

<br>

</body></html>
