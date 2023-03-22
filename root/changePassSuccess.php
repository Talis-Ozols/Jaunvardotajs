<meta charset=utf8>

<?php
session_start(); // Pārbauda vai sesija eksistē un atslēdz lietotāju

if (!isset($_SESSION['loggedin'])) {
    header("Location: loginForm.php");
    exit;
}

session_destroy();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Jaunvārdotājs | Veiksmīgi mainīta parole</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <br><br><br>
        Parole nomainīta veiksmīgi!
        <br>
        Jūs tikāt izrakstīts
        <br><br>
        <?php
        echo nl2br("\n");
        echo '<a id="spiedSeit" href="loginForm.php">Atgriezties</a><br>';
        ?>
    </body>
</html>
