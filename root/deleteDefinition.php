<meta charset=utf8>

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

echo nl2br("\n");
echo "<div style='text-align:right'>";
echo 'Sveicināti, ' . $_SESSION['name'] . '!';
echo nl2br("\n");
echo '<a id="spiedSeit" href="profils.php">Profils</a><br>';
echo "<div style='text-align:center'>";
echo "<h1>Jaunvārdotājs</h1><br><br>";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta content="text/html; charset=utf8" http-equiv="content-type">
    <title>Jaunvārdotājs | Dzēst definīciju</title>

    <link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">
</head>

<body>
    <?php
    if (isset($_GET['definicija'])) {
        $definicijas_sql = "SELECT definicija FROM definicijas WHERE definicijasID=" . $_GET['definicija'];
        $definicija = $con->query($definicijas_sql)->fetch_assoc()['definicija'];
        echo "<p>Vai esat pārliecināts, ka vēlaties dzēst definīciju <b>\"$definicija\"</b>?</p>";
        echo "<form action='deleteDefinitionAction.php' method='get' name='definitionDeleteForm'>
				<input type='hidden' name='definicija' value='" . $_GET['definicija'] . "'>
				<input value='Dzēst' type='submit' class='unstyled_submit_button'>
			</form><br>";
    } elseif (isset($_GET['error'])) {
        if ($_GET['error'] == "nav_definicijas_vai_lietotaja") {
            echo "<p>Definīciju neizdevās izdzēst, jo tā neeksistē vai arī Jūs neesat tās radītājs</p>";
        } else {
            echo "<p>Definīciju neizdevās dzēst</p>";
        }
    } elseif (isset($_GET['veiksmigi'])) {
        echo "<p>Definīcija izdzēsta veiksmīgi!</p>";
    }
    ?>
    <a id='spiedSeit' href='index.php'>Atpakaļ</a>
</body>

</html>
