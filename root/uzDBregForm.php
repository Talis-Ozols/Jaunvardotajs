<meta charset=utf8>

<?php
	session_start();
  $_POST['lietotajvards']=trim($_POST['lietotajvards']);
	$_POST['epastaAdrese']=trim($_POST['epastaAdrese']);
	$_POST['sifretaParole']=trim($_POST['sifretaParole']);
	
	$_POST['lietotajvards']=strip_tags($_POST['lietotajvards']);
	$_POST['epastaAdrese']=strip_tags($_POST['epastaAdrese']);
	$_POST['sifretaParole']=strip_tags($_POST['sifretaParole']);
	
	$_POST['lietotajvards']=htmlentities($_POST['lietotajvards']);
	$_POST['epastaAdrese']=htmlentities($_POST['epastaAdrese']);
	$_POST['sifretaParole']=htmlentities($_POST['sifretaParole']);


	$kluda="";
  if(!$_POST['lietotajvards']){$kluda.="Pietrūkst informācijas!<br>";}
	if(!$_POST['epastaAdrese']){$kluda.="Pietrūkst informācijas!<br>";}
	if(!$_POST['sifretaParole']){$kluda.="Pietrūkst informācijas!<br>";}
	
    if(!$kluda)
    {
			$DATABASE_HOST = 'localhost';
			$DATABASE_USER = 'root';
			$DATABASE_PASS = 'usbw';
			$DATABASE_NAME = 'vardudb';

			$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
			if ( mysqli_connect_errno() )
			{
				exit('Kļūda cenšoties pieslēgties MySQL: ' . mysqli_connect_error());
			}
			
			if ($stmt = $con->prepare('SELECT lietotajaID, lietotajvards, sifretaParole FROM lietotaji WHERE epastaAdrese = ?'))
			{
				$stmt->bind_param('s', $_POST['epastaAdrese']);
				$stmt->execute();
				$stmt->store_result();
				
				// Šis epasts jau ir reģistrēts
				if ($stmt->num_rows > 0)
				{
					header("Location: regFormError.php?error=adrese_jau_registreta");
					exit;
				}
			}
			
			
			
			$safePass = $_POST['sifretaParole'];
			for ($i = 0; $i < 20; $i++)
			{
				$safePass = md5($safePass);
			}


			$link = mysql_connect("localhost", "root", "usbw");
      mysql_select_db("vardudb", $link);
      $tabula="lietotaji";
      $sql="INSERT INTO $tabula (lietotajvards, epastaAdrese, sifretaParole) values ( '".mysql_real_escape_string($_POST['lietotajvards'], $link)."', '".mysql_real_escape_string($_POST['epastaAdrese'], $link)."', '".mysql_real_escape_string($safePass, $link)."' )";
      mysql_query($sql, $link);
			header("Location: loginForm.html");
    }
		else // Nepilnīga informācija
		{
			header("Location: regFormError.php?error=nepietiekama_informacija");
		}
?>
