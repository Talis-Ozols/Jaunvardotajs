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
	function upvotePressed(wordID) {
		upvoteBtns = document.getElementsByClassName("upvote_btn_"+wordID);
		downvoteBtns = document.getElementsByClassName("downvote_btn_"+wordID);
		upvoteCounts = document.getElementsByClassName("upvote_count_"+wordID);
		downvoteCounts = document.getElementsByClassName("downvote_count_"+wordID);
		// console.log(upvoteBtns[0]);
		if (upvoteBtns[0].classList.contains("pressed_vote")) { // Unpress the upvote buttons
			for (var btn of upvoteBtns) {
				btn.classList.remove("pressed_vote");
				btn.classList.add("unpressed_vote");
			}
			for (var div of upvoteCounts) {
				div.innerHTML--;
			}
		}
		else { // Press the upvote buttons
			for (var btn of upvoteBtns) {
				// console.log(btn);
				btn.classList.remove("unpressed_vote");
				btn.classList.add("pressed_vote");
			}
			for (var div of upvoteCounts) {
				div.innerHTML++;
			}
			if (downvoteBtns[0].classList.contains("pressed_vote")) { // Also unpress the downvote buttons
				for (var btn of downvoteBtns) {
					btn.classList.remove("pressed_vote");
					btn.classList.add("unpressed_vote");
				}
				for (var div of downvoteCounts) {
					div.innerHTML--;
				}
			}
		}
	}
	function downvotePressed(wordID) {
		upvoteBtns = document.getElementsByClassName("upvote_btn_"+wordID);
		downvoteBtns = document.getElementsByClassName("downvote_btn_"+wordID);
		upvoteCounts = document.getElementsByClassName("upvote_count_"+wordID);
		downvoteCounts = document.getElementsByClassName("downvote_count_"+wordID);
		if (downvoteBtns[0].classList.contains("pressed_vote")) { // Unpress the downvote buttons
			for (var btn of downvoteBtns) {
				btn.classList.remove("pressed_vote");
				btn.classList.add("unpressed_vote");
			}
			for (var div of downvoteCounts) {
				div.innerHTML--;
			}
		}
		else { // Press the downvote buttons
			for (var btn of downvoteBtns) {
				btn.classList.remove("unpressed_vote");
				btn.classList.add("pressed_vote");
			}
			for (var div of downvoteCounts) {
				div.innerHTML++;
			}
			if (upvoteBtns[0].classList.contains("pressed_vote")) { // Also unpress the upvote buttons
				for (var btn of upvoteBtns) {
					btn.classList.remove("pressed_vote");
					btn.classList.add("unpressed_vote");
				}
				for (var div of upvoteCounts) {
					div.innerHTML--;
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
				// Find whether the current user upvoted or downvoted the current word
				$word_vote_sql = "SELECT vertiba FROM varduBalsis WHERE lietotajaID=".$_SESSION['id']." AND vardaID=".$row3["vardaID"];
				$word_vote_result = $con->query($word_vote_sql);
				$upvote_pressed_or_unpressed = "unpressed_vote";
				$downvote_pressed_or_unpressed = "unpressed_vote";
				if ($word_vote_result->num_rows == 1) {
					$word_vote_value = $word_vote_result->fetch_assoc()["vertiba"];
					if ($word_vote_value == "+") {
						$upvote_pressed_or_unpressed = "pressed_vote";
					}
					elseif ($word_vote_value == "-") {
						$downvote_pressed_or_unpressed = "pressed_vote";
					}
				}
				
				// Find the total number of upvotes and downvotes of the current word
				
				$upvote_count_sql = "SELECT COUNT(lietotajaID) FROM varduBalsis WHERE vardaID=".$row3["vardaID"]." AND vertiba='+'";
				$upvote_count_result = $con->query($upvote_count_sql)->fetch_assoc()["COUNT(lietotajaID)"];
				$downvote_count_sql = "SELECT COUNT(lietotajaID) FROM varduBalsis WHERE vardaID=".$row3["vardaID"]." AND vertiba='-'";
				$downvote_count_result = $con->query($downvote_count_sql)->fetch_assoc()["COUNT(lietotajaID)"];
				
#				echo $row2["definicija"];
				$word_upvote_form_id = "upvote_btn_".$row3["vardaID"];
				$word_downvote_form_id = "downvote_btn_".$row3["vardaID"];
				$word_upvote_count_id = "upvote_count_".$row3["vardaID"];
				$word_downvote_count_id = "downvote_count_".$row3["vardaID"];
				$word_upvote_form = "<form method='get' action='wordVote.php' name='upvoteWord' target='dummy_iframe' style='display: inline'>
					<input type='hidden' name='vards' value='".$row3["vardaID"]."'>
					<input type='hidden' name='vertiba' value='+'>
					<input name='patik' value='👍' type='submit' onclick='upvotePressed(".$row3["vardaID"].")' class='vote_btn upvote_btn $word_upvote_form_id $upvote_pressed_or_unpressed'>
				</form>";
				$word_downvote_form = "<form method='get' action='wordVote.php' name='upvoteWord' target='dummy_iframe' style='display: inline'>
					<input type='hidden' name='vards' value='".$row3["vardaID"]."'>
					<input type='hidden' name='vertiba' value='-'>
					<input name='nepatik' value='👎' type='submit' onclick='downvotePressed(".$row3["vardaID"].")' class='vote_btn downvote_btn $word_downvote_form_id $downvote_pressed_or_unpressed'>
				</form>";
				echo "<tr>\n<td style='width:400px'>" . $row["vards"] . " <br> <div class='vote_container'> " . $word_upvote_form . "<span class='$word_upvote_count_id'>$upvote_count_result</span>" . "&nbsp" . $word_downvote_form . "<span class='$word_downvote_count_id'>$downvote_count_result</span>" . " </div> </td> <td style='width:700px'>" . $row2["definicija"] . "</td> <td style='width:570px'>";
			
				$sql1 = "SELECT lietotajvards FROM lietotaji WHERE lietotajaID = " . $row["lietotajaID"] . " limit 1";
				$result1 = $con->query($sql1);
				$row1 = $result1->fetch_assoc();
				
				$sql4 = "SELECT lietotajvards FROM lietotaji WHERE lietotajaID = " . $row2["lietotajaID"] . " limit 1";
				$result4 = $con->query($sql4);
				$row4 = $result4->fetch_assoc();
				
				echo $row1["lietotajvards"] . ", " . $row4["lietotajvards"] . "</td>\n</tr>";
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
