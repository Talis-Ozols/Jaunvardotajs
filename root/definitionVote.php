<?php
session_start(); // Checks if session exists
if (!isset($_SESSION['loggedin'])) {
    header("Location: loginForm.php");
    exit;
}

// Connect to database
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = 'usbw';
$DATABASE_NAME = 'vardudb';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    exit('Error connecting to MySQL: ' . mysqli_connect_error());
}

// Query to get existing vote for the definition by the user
$sql = "SELECT vertiba FROM definicijuBalsis WHERE lietotajaID=".$_SESSION['id']." AND definicijasID=".$_GET['definicija'];
$result = $con->query($sql);

$value_pressed = $_GET['vertiba'];
$previous_value = "0";

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $previous_value = $row['vertiba'];
}

if ($result->num_rows > 0) {
    // Delete all existing votes
    $sql = "DELETE FROM definicijuBalsis WHERE lietotajaID=".$_SESSION['id']." AND definicijasID=".$_GET['definicija'];
    $result = $con->query($sql);
}

if ($value_pressed == "+" and ($previous_value == "0" or $previous_value == "-")) {
    // Add an upvote
    $sql = "INSERT INTO definicijuBalsis (`vertiba`, `lietotajaID`, `definicijasID`) VALUES ('+', ".$_SESSION['id'].", ".$_GET['definicija'].")";
    $result = $con->query($sql);
}

if ($value_pressed == "-" and ($previous_value == "0" or $previous_value == "+")) {
    // Add a downvote
    $sql = "INSERT INTO definicijuBalsis (`vertiba`, `lietotajaID`, `definicijasID`) VALUES ('-', ".$_SESSION['id'].", ".$_GET['definicija'].")";
    $result = $con->query($sql);
}
?>
