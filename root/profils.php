<?php
session_start(); //Pārbauda vai sesija eksistē
if (!isset($_SESSION['loggedin'])) {
    header("Location: loginForm.php");
    exit;
}

//Pieslēgšanās datu bāzei
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'usbw';
$DATABASE_NAME = 'vardudb';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Kļūda cenšoties pielēgties MySQL: ' . mysqli_connect_error());
}

//Paņem epasta adresi no datu bāzes
$stmt = $con->prepare('SELECT epastaAdrese FROM lietotaji WHERE lietotajaID = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($epastaAdrese);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jaunvārdotājs | Tavs profils</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div style="text-align: right;">
        <a id="spiedSeit" href="logout.php">Izrakstīties</a><br>
        <a id="spiedSeit" href="index.php">Atpakaļ</a><br>
    </div>

    <div style="text-align: center;">
        <p>Jūsu info:</p>
        <p>Lietotājvārds: <?= $_SESSION['name'] ?></p>
        <p>E-pasta adrese: <?= $epastaAdrese ?></p>
        <p>
            <a id="spiedSeit" href="changeName.php">Mainīt lietotājvārdu</a><br>
            <a id="spiedSeit" href="changePass.php">Mainīt paroli</a><br>
        </p>
    </div>
</body>
</html>
