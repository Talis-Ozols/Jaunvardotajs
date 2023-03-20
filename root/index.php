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
<html><head><meta content="text/html; charset=utf8" http-equiv="content-type"><title>Jaunvārdotājs</title>

<link rel="stylesheet" type="text/css" rel="noopener" target="_blank" href="style.css">

</head><body>
<script type="text/javascript">
	function wordUpvotePressed(wordID) {
		upvoteBtns = document.getElementsByClassName("word_upvote_btn_"+wordID);
		downvoteBtns = document.getElementsByClassName("word_downvote_btn_"+wordID);
		upvoteCounts = document.getElementsByClassName("word_upvote_count_"+wordID);
		downvoteCounts = document.getElementsByClassName("word_downvote_count_"+wordID);
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
	function wordDownvotePressed(wordID) {
		upvoteBtns = document.getElementsByClassName("word_upvote_btn_"+wordID);
		downvoteBtns = document.getElementsByClassName("word_downvote_btn_"+wordID);
		upvoteCounts = document.getElementsByClassName("word_upvote_count_"+wordID);
		downvoteCounts = document.getElementsByClassName("word_downvote_count_"+wordID);
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
	function definitionUpvotePressed(definitionID) {
		upvoteBtns = document.getElementsByClassName("definition_upvote_btn_"+definitionID);
		downvoteBtns = document.getElementsByClassName("definition_downvote_btn_"+definitionID);
		upvoteCounts = document.getElementsByClassName("definition_upvote_count_"+definitionID);
		downvoteCounts = document.getElementsByClassName("definition_downvote_count_"+definitionID);
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
	function definitionDownvotePressed(definitionID) {
		upvoteBtns = document.getElementsByClassName("definition_upvote_btn_"+definitionID);
		downvoteBtns = document.getElementsByClassName("definition_downvote_btn_"+definitionID);
		upvoteCounts = document.getElementsByClassName("definition_upvote_count_"+definitionID);
		downvoteCounts = document.getElementsByClassName("definition_downvote_count_"+definitionID);
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
	
	// $sql = "SELECT vards, lietotajaID FROM vardi";
	$sql = "SELECT vards, lietotajaID FROM vardi ORDER BY ((SELECT count(*) FROM varduBalsis WHERE varduBalsis.vardaID = vardi.vardaID AND varduBalsis.vertiba = '+') - (SELECT count(*) FROM varduBalsis WHERE varduBalsis.vardaID = vardi.vardaID AND varduBalsis.vertiba = '-')) DESC"; // Atlasīt visus vārdus, sākot ar to, kuram ir vislabākās balsis (vislielākā starpība starp pozitīvajām un negatīvajām balsīm)
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
			
			// $sql2 = "SELECT definicija, definicijasID, lietotajaID FROM definicijas WHERE vardaID = " . $row3["vardaID"];
			$sql2 = "SELECT definicija, definicijasID, lietotajaID FROM definicijas WHERE vardaID = " . $row3["vardaID"] . " ORDER BY ((SELECT count(*) FROM definicijuBalsis WHERE definicijuBalsis.definicijasID = definicijas.definicijasID AND definicijuBalsis.vertiba = '+') - (SELECT count(*) FROM definicijuBalsis WHERE definicijuBalsis.definicijasID = definicijas.definicijasID AND definicijuBalsis.vertiba = '-')) DESC"; // Atlasīt visus vārdus, sākot ar to, kuram ir vislabākās balsis (vislielākā starpība starp pozitīvajām un negatīvajām balsīm)
			$result2 = $con->query($sql2);
			while($row2 = $result2->fetch_assoc())
			{
				// Find whether the current user upvoted or downvoted the current word
				$word_vote_sql = "SELECT vertiba FROM varduBalsis WHERE lietotajaID=".$_SESSION['id']." AND vardaID=".$row3["vardaID"];
				$word_vote_result = $con->query($word_vote_sql);
				$word_upvote_pressed_or_unpressed_class = "unpressed_vote";
				$word_downvote_pressed_or_unpressed_class = "unpressed_vote";
				if ($word_vote_result->num_rows == 1) {
					$word_vote_value = $word_vote_result->fetch_assoc()["vertiba"];
					if ($word_vote_value == "+") {
						$word_upvote_pressed_or_unpressed_class = "pressed_vote";
					}
					elseif ($word_vote_value == "-") {
						$word_downvote_pressed_or_unpressed_class = "pressed_vote";
					}
				}
				
				// Find whether the current user upvoted or downvoted the current definition
				$definition_vote_sql = "SELECT vertiba FROM definicijuBalsis WHERE lietotajaID=".$_SESSION['id']." AND definicijasID=".$row2["definicijasID"];
				$definition_vote_result = $con->query($definition_vote_sql);
				$definition_upvote_pressed_or_unpressed_class = "unpressed_vote";
				$definition_downvote_pressed_or_unpressed_class = "unpressed_vote";
				if ($definition_vote_result->num_rows == 1) {
					$definition_vote_value = $definition_vote_result->fetch_assoc()["vertiba"];
					if ($definition_vote_value == "+") {
						$definition_upvote_pressed_or_unpressed_class = "pressed_vote";
					}
					elseif ($definition_vote_value == "-") {
						$definition_downvote_pressed_or_unpressed_class = "pressed_vote";
					}
				}
				
				// Find the total number of upvotes and downvotes of the current word
				$word_upvote_count_sql = "SELECT COUNT(lietotajaID) FROM varduBalsis WHERE vardaID=".$row3["vardaID"]." AND vertiba='+'";
				$word_upvote_count_result = $con->query($word_upvote_count_sql)->fetch_assoc()["COUNT(lietotajaID)"];
				$word_downvote_count_sql = "SELECT COUNT(lietotajaID) FROM varduBalsis WHERE vardaID=".$row3["vardaID"]." AND vertiba='-'";
				$word_downvote_count_result = $con->query($word_downvote_count_sql)->fetch_assoc()["COUNT(lietotajaID)"];
				
				$word_upvote_btn_class = "word_upvote_btn_".$row3["vardaID"];
				$word_downvote_btn_class = "word_downvote_btn_".$row3["vardaID"];
				$word_delete_btn_class = "word_delete_btn_".$row3["vardaID"];
				$word_upvote_count_class = "word_upvote_count_".$row3["vardaID"];
				$word_downvote_count_class = "word_downvote_count_".$row3["vardaID"];
				$word_upvote_form = "<form method='get' action='wordVote.php' name='upvoteWord' target='dummy_iframe' style='display: inline'>
				<input type='hidden' name='vards' value='".$row3["vardaID"]."'>
				<input type='hidden' name='vertiba' value='+'>
				<input name='patik' value='👍' type='submit' onclick='wordUpvotePressed(".$row3["vardaID"].")' class='vote_btn upvote_btn $word_upvote_btn_class $word_upvote_pressed_or_unpressed_class'>
				</form>";
				$word_downvote_form = "<form method='get' action='wordVote.php' name='downvoteWord' target='dummy_iframe' style='display: inline'>
				<input type='hidden' name='vards' value='".$row3["vardaID"]."'>
				<input type='hidden' name='vertiba' value='-'>
				<input name='nepatik' value='👎' type='submit' onclick='wordDownvotePressed(".$row3["vardaID"].")' class='vote_btn downvote_btn $word_downvote_btn_class $word_downvote_pressed_or_unpressed_class'>
				</form>";
				$word_delete_form = "";
				if ($row['lietotajaID'] == $_SESSION['id']) {
					$word_delete_form = "<form method='get' action='deleteWord.php' name='deleteWord' style='display: inline'>
						<input type='hidden' name='vards' value='".$row3["vardaID"]."'>
						<input name='dzest' value='🗑️' type='submit' class='vote_btn delete_btn $word_delete_btn_class'>
					</form>";
				}
				$word_vote_container = "<div class='vote_container'> " . $word_upvote_form . "<span class='$word_upvote_count_class'>$word_upvote_count_result</span>" . "&nbsp" . $word_downvote_form . "<span class='$word_downvote_count_class'>$word_downvote_count_result</span>" . $word_delete_form . " </div>";
				
				// Find the total number of upvotes and downvotes of the current definition
				$definition_upvote_count_sql = "SELECT COUNT(lietotajaID) FROM definicijuBalsis WHERE definicijasID=".$row2["definicijasID"]." AND vertiba='+'";
				$definition_upvote_count_result = $con->query($definition_upvote_count_sql)->fetch_assoc()["COUNT(lietotajaID)"];
				$definition_downvote_count_sql = "SELECT COUNT(lietotajaID) FROM definicijuBalsis WHERE definicijasID=".$row2["definicijasID"]." AND vertiba='-'";
				$definition_downvote_count_result = $con->query($definition_downvote_count_sql)->fetch_assoc()["COUNT(lietotajaID)"];
				
				$definition_upvote_btn_class = "definition_upvote_btn_".$row2["definicijasID"];
				$definition_downvote_btn_class = "definition_downvote_btn_".$row2["definicijasID"];
				$definition_delete_btn_class = "definition_delete_btn_".$row2["definicijasID"];
				$definition_upvote_count_class = "definition_upvote_count_".$row2["definicijasID"];
				$definition_downvote_count_class = "definition_downvote_count_".$row2["definicijasID"];
				$definition_upvote_form = "<form method='get' action='definitionVote.php' name='upvoteDefinition' target='dummy_iframe' style='display: inline'>
					<input type='hidden' name='definicija' value='".$row2["definicijasID"]."'>
					<input type='hidden' name='vertiba' value='+'>
					<input name='patik' value='👍' type='submit' onclick='definitionUpvotePressed(".$row2["definicijasID"].")' class='vote_btn upvote_btn $definition_upvote_btn_class $definition_upvote_pressed_or_unpressed_class'>
				</form>";
				$definition_downvote_form = "<form method='get' action='definitionVote.php' name='downvoteDefinition' target='dummy_iframe' style='display: inline'>
					<input type='hidden' name='definicija' value='".$row2["definicijasID"]."'>
					<input type='hidden' name='vertiba' value='-'>
					<input name='nepatik' value='👎' type='submit' onclick='definitionDownvotePressed(".$row2["definicijasID"].")' class='vote_btn downvote_btn $definition_downvote_btn_class $definition_downvote_pressed_or_unpressed_class'>
				</form>";
				$definition_delete_form = "";
				if ($row2['lietotajaID'] == $_SESSION['id']) {
					$definition_delete_form = "<form method='get' action='deleteDefinition.php' name='deleteDefinition' style='display: inline'>
					<input type='hidden' name='definicija' value='".$row2["definicijasID"]."'>
					<input name='dzest' value='🗑️' type='submit' class='vote_btn delete_btn $word_delete_btn_class'>
					</form>";
				}
				$definition_vote_container = "<div class='vote_container'> " . $definition_upvote_form . "<span class='$definition_upvote_count_class'>$definition_upvote_count_result</span>" . "&nbsp" . $definition_downvote_form . "<span class='$definition_downvote_count_class'>$definition_downvote_count_result</span>" . $definition_delete_form . " </div>";
				
				echo "<tr>\n
				<td style='width:20vw'>
					<form method='get' action='addDef.php' name='addWord' style='display:inline;'>
						<input name='definejamais_vards' value='".$row["vards"]."' type='submit' class='unstyled_submit_button'>
					</form> <br>" .
					$word_vote_container .
				"</td>
				<td style='width:40vw'>" .
					$row2["definicija"] . "<br>" .
					$definition_vote_container .
				"</td> <td style='width:40vw'>";
			
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
?>

</body></html>
