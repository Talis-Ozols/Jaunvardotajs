<meta charset=utf8>

<?php
	session_start(); //Sesijas sākšana
	
	//Šis kods noņem visu lieko no ievades, lai, piemēram, nevarētu ievades vietās rakstīt html kodu
	$_POST['lietotajvards']=trim($_POST['lietotajvards']);
	$_POST['epastaAdrese']=trim($_POST['epastaAdrese']);
	
	$_POST['lietotajvards']=strip_tags($_POST['lietotajvards']);
	$_POST['epastaAdrese']=strip_tags($_POST['epastaAdrese']);
	
	$_POST['lietotajvards']=htmlentities($_POST['lietotajvards']);
	$_POST['epastaAdrese']=htmlentities($_POST['epastaAdrese']);

	$kluda="";
	if(!$_POST['lietotajvards']){$kluda.="Pietrūkst informācijas!<br>";}
	if(!$_POST['epastaAdrese']){$kluda.="Pietrūkst informācijas!<br>";}
	
	
	if(!$kluda)
    {
			//Pieslēgšanāš datu bāzei
			$DATABASE_HOST = 'localhost';
			$DATABASE_USER = 'root';
			$DATABASE_PASS = 'usbw';
			$DATABASE_NAME = 'vardudb';

			$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
			if ( mysqli_connect_errno() )
			{
				exit('Kļūda cenšoties pieslēgties MySQL: ' . mysqli_connect_error());
			}
			
			//Pārbaude vai epasta adrese jau eksistē
			if ($stmt = $con->prepare('SELECT lietotajaID, lietotajvards, sifretaParole FROM lietotaji WHERE epastaAdrese = ?'))
			{
				$stmt->bind_param('s', $_POST['epastaAdrese']);
				$stmt->execute();
				$stmt->store_result();
				
				if ($stmt->num_rows > 0) // Šis epasts jau ir reģistrēts
				{
					header("Location: regForm.php?error=adrese_jau_registreta");
					exit;
				}
			}
			
			//Paroles šifrēšana
			$safePass = $_POST['sifretaParole'];
			for ($i = 0; $i < 20; $i++)
			{
				$safePass = md5($safePass);
			}

			//Datu ievade mysql
			$link = mysql_connect("localhost", "root", "usbw");
			mysql_select_db("vardudb", $link);
			$tabula="lietotaji";
			$sql="INSERT INTO $tabula (lietotajvards, epastaAdrese, sifretaParole) values ( '".mysql_real_escape_string($_POST['lietotajvards'], $link)."', '".mysql_real_escape_string($_POST['epastaAdrese'], $link)."', '".mysql_real_escape_string($safePass, $link)."' )";
			mysql_query($sql, $link);
			header("Location: loginForm.php");
    }
	else // Nepilnīga informācija
	{
		header("Location: regForm.php?error=nepietiekama_informacija");
	}
?>
