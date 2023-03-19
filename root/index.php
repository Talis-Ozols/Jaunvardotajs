<meta charset=utf8>

<?php
	session_start();
	if (!isset($_SESSION['loggedin']))
	{
		header("Location: loginForm.php");
		exit;
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html><head><meta content="text/html; charset=utf8" http-equiv="content-type"><title>Index</title>

<link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">

</head><body>
<script type="text/javascript">
	function upvotePressed(upvoteBtnID, downvoteBtnID) {
		upvoteBtns = document.getElementsByClassName(upvoteBtnID);
		downvoteBtns = document.getElementsByClassName(downvoteBtnID);
		// console.log(upvoteBtns[0]);
		if (upvoteBtns[0].classList.contains("pressed_vote")) { // Unpress the upvote buttons
			for (var btn of upvoteBtns) {
				btn.classList.remove("pressed_vote");
				btn.classList.add("unpressed_vote");
			}
		}
		else { // Press the upvote buttons
			for (var btn of upvoteBtns) {
				// console.log(btn);
				btn.classList.remove("unpressed_vote");
				btn.classList.add("pressed_vote");
			}
			if (downvoteBtns[0].classList.contains("pressed_vote")) { // Also unpress the downvote buttons
				for (var btn of downvoteBtns) {
					btn.classList.remove("pressed_vote");
					btn.classList.add("unpressed_vote");
				}
			}
		}
	}
	function downvotePressed(upvoteBtnID, downvoteBtnID) {
		upvoteBtns = document.getElementsByClassName(upvoteBtnID);
		downvoteBtns = document.getElementsByClassName(downvoteBtnID);
		if (downvoteBtns[0].classList.contains("pressed_vote")) { // Unpress the downvote buttons
			for (var btn of downvoteBtns) {
				btn.classList.remove("pressed_vote");
				btn.classList.add("unpressed_vote");
			}
		}
		else { // Press the downvote buttons
			for (var btn of downvoteBtns) {
				btn.classList.remove("unpressed_vote");
				btn.classList.add("pressed_vote");
			}
			if (upvoteBtns[0].classList.contains("pressed_vote")) { // Also unpress the upvote buttons
				for (var btn of upvoteBtns) {
					btn.classList.remove("pressed_vote");
					btn.classList.add("unpressed_vote");
				}
			}
		}
	}
</script>
<?php

	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = 'usbw';
	$DATABASE_NAME = 'vardudb';

	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if ( mysqli_connect_errno() )
	{
		exit('Kļūda cenšoties pielēgties MySQL: ' . mysqli_connect_error());
	}
	
	echo nl2br("\n");
	echo "<div style='text-align:right'>";
	echo 'Sveicināti, ' . $_SESSION['name'] . '!';
	echo nl2br("\n");
	echo '<a id="spiedSeit" href="profils.php">Profils</a><br>';
	echo "<div style='text-align:center'>";
	echo "<h1>Jaunvārdotājs</h1>";
	echo "<br><br>";
	
	$sql = "SELECT vards, lietotajaID FROM vardi";
	$result = $con->query($sql);
	
	if ($result->num_rows > 0)
	{
		echo "<iframe name='dummy_iframe' style='display:none;'></iframe>";// Ļauj nodot formu, nepārlādējot visu lapu
		echo "<table style='margin-left: auto; margin-right: auto; font-size:30px'>";
		echo "<tr> <th><a id='spiedSeit' href='addWord.php'>Jaunvārds</a></th> <th><a id='spiedSeit' href='addDef.php'>Definīcija</a></th> <th>Lietotājs (vārda radītājs, definīcjas radītājs)</th> </tr>";
		while($row = $result->fetch_assoc())
		{
			$sql3 = "SELECT vardaID FROM vardi WHERE vards = '" . $row["vards"] . "' limit 1";
			$result3 = $con->query($sql3);
			$row3 = $result3->fetch_assoc();
#			echo $row3["vardaID"];
			
			$sql2 = "SELECT definicija, lietotajaID FROM definicijas WHERE vardaID = " . $row3["vardaID"];
			$result2 = $con->query($sql2);
			while($row2 = $result2->fetch_assoc())
			{
#				echo $row2["definicija"];
				$word_upvote_form_id = "upvote_btn_".$row3["vardaID"];
				$word_downvote_form_id = "downvote_btn_".$row3["vardaID"];
				$word_upvote_form = "<form method='get' action='wordVote.php' name='upvoteWord' target='dummy_iframe' style='display: inline'>
					<input type='hidden' name='vards' value='".$row3["vardaID"]."'>
					<input type='hidden' name='vertiba' value='+'>
					<input name='patik' value='👍' type='submit' onclick='upvotePressed(\"$word_upvote_form_id\", \"$word_downvote_form_id\")' class='vote_btn upvote_btn $word_upvote_form_id unpressed_vote'>
				</form>";
				$word_downvote_form = "<form method='get' action='wordVote.php' name='upvoteWord' target='dummy_iframe' style='display: inline'>
					<input type='hidden' name='vards' value='".$row3["vardaID"]."'>
					<input type='hidden' name='vertiba' value='-'>
					<input name='nepatik' value='👎' type='submit' onclick='downvotePressed(\"$word_upvote_form_id\", \"$word_downvote_form_id\")' class='vote_btn downvote_btn $word_downvote_form_id unpressed_vote'>
				</form>";
				echo "<tr> <td style='width:400px'>" . $row["vards"] . " " . $word_upvote_form . $word_downvote_form . "</td> <td style='width:700px'>" . $row2["definicija"] . "</td> <td style='width:570px'>";
			
				$sql1 = "SELECT lietotajvards FROM lietotaji WHERE lietotajaID = " . $row["lietotajaID"] . " limit 1";
				$result1 = $con->query($sql1);
				$row1 = $result1->fetch_assoc();
				
				$sql4 = "SELECT lietotajvards FROM lietotaji WHERE lietotajaID = " . $row2["lietotajaID"] . " limit 1";
				$result4 = $con->query($sql4);
				$row4 = $result4->fetch_assoc();
				
				echo $row1["lietotajvards"] . ", " . $row4["lietotajvards"] . "</td> </tr>";
			}
		}
		echo "</table>";
		echo "</div>";
		
	}
	else
	{
		$link = mysql_connect("localhost", "root", "usbw");
		mysql_select_db("vardudb", $link);
		$tabula="vardi";
		$sql="INSERT INTO $tabula (vards, generesanasLaiks, lietotajaID) values ( 'viens', now(), " . $_SESSION['id'] . " )";
		mysql_query($sql, $link);
		$sql="INSERT INTO $tabula (vards, generesanasLaiks, lietotajaID) values ( 'divi', now(), " . $_SESSION['id'] . " )";
		mysql_query($sql, $link);
		
		$sql1 = "SELECT vardaID FROM vardi WHERE vards = '" . "viens" . "' limit 1";
		$result1 = $con->query($sql1);
		$row1 = $result1->fetch_assoc();
#		echo $row1["vardaID"];
		$sql2 = "SELECT vardaID FROM vardi WHERE vards = '" . "divi" . "' limit 1";
		$result2 = $con->query($sql2);
		$row2 = $result2->fetch_assoc();
#		echo $row2["vardaID"];
		
		$tabula="definicijas";
		$sql="INSERT INTO $tabula (definicija, publicesanasLaiks, lietotajaID, vardaID) values ( 'vienspirmaa', now(), " . $_SESSION['id'] . ", " . $row1["vardaID"] . ")";
		mysql_query($sql, $link);
		$sql="INSERT INTO $tabula (definicija, publicesanasLaiks, lietotajaID, vardaID) values ( 'divipirmaa', now(), " . $_SESSION['id'] . ", " . $row2["vardaID"] . ")";
		mysql_query($sql, $link);
		
		header("Location: index.php");
	}
	
#	include 'generator/generateWords.php';
#
#	// var_dump($word_array);
#
#	echo "<table style='margin-left: auto; margin-right: auto; font-size:20px'>";
#	echo "<tr> <th>npk</th> <th>jaunvārds</th> </tr>";
#	foreach ($word_array as $i => $word) {
#		echo "<tr> <td>$i</td> <td>$word</td> </tr>";
#	}
#	echo "</table>";
#
#	echo "</div>";
?>

</body></html>
