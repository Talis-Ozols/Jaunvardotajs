<?php
	session_start(); // Checks if a session exists
	if (!isset($_SESSION['loggedin'])) {
		header("Location: loginForm.php"); // Redirects to login form
		exit;
	}

	// This code removes all unnecessary input to prevent users from entering HTML code in input fields
	$_POST['lietotajvards'] = trim($_POST['lietotajvards']);
	$_POST['lietotajvards'] = strip_tags($_POST['lietotajvards']);
	$_POST['lietotajvards'] = htmlentities($_POST['lietotajvards']);

	$kluda = "";
	if (!$_POST['lietotajvards']) {
		$kluda .= "Pietrūkst informācijas!<br>";
	}

	if (!$kluda) {
		// Connect to the database
		$DATABASE_HOST = 'localhost';
		$DATABASE_USER = 'root';
		$DATABASE_PASS = 'usbw';
		$DATABASE_NAME = 'vardudb';
		$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
		if (mysqli_connect_errno()) {
			exit('Kļūda cenšoties pielēgties MySQL: ' . mysqli_connect_error());
		}

		// Change the username
		$stmt = $con->prepare("UPDATE lietotaji SET lietotajvards = " . "'" . $_POST['lietotajvards'] . "'" . " WHERE lietotajaID = ?");
		$stmt->bind_param('i', $_SESSION['id']);
		$stmt->execute();
		$stmt->store_result();
		header("Location: changeNameSuccess.php"); // Redirect to success page
	} else {
		header("Location: fatalEror.php"); // Redirect to error page
	}
?>
