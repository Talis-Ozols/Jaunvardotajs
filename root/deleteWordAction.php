<?php
    // Sets character set
    echo '<meta charset=utf8>';

    // Starts a session and checks if user is logged in
    session_start();
    if (!isset($_SESSION['loggedin'])) {
        header("Location: loginForm.php");
        exit;
    }

    // Connects to the database
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = 'usbw';
    $DATABASE_NAME = 'vardudb';
    $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
    if (mysqli_connect_errno()) {
        exit('Kļūda cenšoties pieslēgties MySQL: ' . mysqli_connect_error());
    }

    // Finds and deletes the selected word
    $count_sql = "SELECT vardaID FROM vardi WHERE vardaID = ".$_GET['vards']." AND lietotajaID = ".$_SESSION['id'];
    $count_result = $con->query($count_sql);
    if ($count_result->num_rows == 0) { // No word to delete
        header("Location: deleteWord.php?error=nav_varda_vai_lietotaja");
    } else { // Finds and deletes all definitions and votes associated with the word
        $definition_vote_delete_sql = "DELETE FROM definicijuBalsis WHERE definicijasID IN (SELECT definicijas.definicijasID FROM definicijas WHERE definicijas.definicijasID = definicijuBalsis.definicijasID AND definicijas.vardaID = ".$_GET['vards'].")";
        $con->query($definition_vote_delete_sql);
        $word_vote_delete_sql = "DELETE FROM varduBalsis WHERE vardaID = ".$_GET['vards'];
        $con->query($word_vote_delete_sql);
        $definition_delete_sql = "DELETE FROM definicijas WHERE vardaID = ".$_GET['vards'];
        $con->query($definition_delete_sql);
        $word_delete_sql = "DELETE FROM vardi WHERE vardaID = ".$_GET['vards']." AND lietotajaID = ".$_SESSION['id'];
        $con->query($word_delete_sql);
        echo "Vārds izdzēsts veiksmīgi";
        header("Location: deleteWord.php?veiksmigi");
    }
?>
