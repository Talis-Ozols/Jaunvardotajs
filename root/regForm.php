<!DOCTYPE html PUBLIC>
<html>
<head>
  <meta content="text/html; charset=utf8" http-equiv="content-type">
  <title>Jaunvārdotājs | Reģistrēties</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div style="text-align: center;"><br>
    <h1>Jaunvārdotājs</h1>
    <br>
    <br>
    <h2>Reģistrācija</h2>
    <br>
    <br>
  </div>

  <div style="text-align: center;">
    <form action="uzDBregForm.php" method="post" name="regForm">
      Lietotājvārds<br>
      <input size="40" maxlength="50" name="lietotajvards" required><br>
      <br>
      E-pasta adrese<br>
      <input type="email" size="40" maxlength="255" name="epastaAdrese" required><br>
      <br>
      Parole<br>
      <input minlength="8" size="40" maxlength="64" name="sifretaParole" type="password" required><br>
      <br>
      <input value="Reģistrēties" type="submit"><br>
    </form>
  </div>

  <?php
  if(isset($_GET['error'])){
    if($_GET['error'] == "nepietiekama_informacija"){
      echo '<span style="font-weight: bold;">Ievadītā informācija nav pietiekama!</span>';
    }
    elseif($_GET['error'] == "adrese_jau_registreta"){
      echo '<span style="font-weight: bold;">Ievadītā E-pasta adrese jau ir reģistrēta!</span>';
    }
    else {
      echo '<span style="font-weight: bold;">Gadījās nezināma kļūme!</span>';
    }
  }
  ?>

  <br>
  <br>

  Jau ir konts? <a id="spiedSeit" href="loginForm.php">Spied šeit</a><br>
  <br>
</body>
</html>
