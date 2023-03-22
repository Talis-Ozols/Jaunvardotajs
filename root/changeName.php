<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <meta charset="utf-8">
  <title>Jaunvārdotājs | Mainīt lietotājvārdu</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <?php
    session_start(); // Checks if a session exists
    if (!isset($_SESSION['loggedin'])) {
      header("Location: loginForm.php"); // Redirects to login form
      exit;
    }
  ?>

  <br>
  <br>
  <br>
  <form method="post" action="changeNameAction.php" name="changeNameForm">
    Ievadiet jauno lietotājvārdu<br>
    <input maxlength="50" size="40" name="lietotajvards" required><br>
    <br>
    <input value="Aptiprin&#257;t" type="submit"><br>
  </form>

  <br>
  <a id="spiedSeit" href="profils.php">Atpakaļ</a><br>
</body>
</html>
