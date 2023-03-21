<meta charset=utf8>

<?php
	session_start(); //Sesijas sākšana
	
	//Šis kods noņem visu lieko no ievades, lai, piemēram, nevarētu ievades vietās rakstīt html kodu
	$_POST['epastaAdrese']=trim($_POST['epastaAdrese']);
	$_POST['sifretaParole']=trim($_POST['sifretaParole']);
	
	$_POST['epastaAdrese']=strip_tags($_POST['epastaAdrese']);
	$_POST['sifretaParole']=strip_tags($_POST['sifretaParole']);
	
	$_POST['epastaAdrese']=htmlentities($_POST['epastaAdrese']);
	$_POST['sifretaParole']=htmlentities($_POST['sifretaParole']);


	$kluda="";
	if(!$_POST['epastaAdrese']){$kluda.="Pietrūkst informācijas!<br>";}
	if(!$_POST['sifretaParole']){$kluda.="Pietrūkst informācijas!<br>";}
	
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
				exit('Kļūda cenšoties pielēgties MySQL: ' . mysqli_connect_error());
			}
		
		
			
			if ($stmt = $con->prepare('SELECT lietotajaID, lietotajvards, sifretaParole FROM lietotaji WHERE epastaAdrese = ?'))
			{
				$stmt->bind_param('s', $_POST['epastaAdrese']);
				$stmt->execute();
				$stmt->store_result();
				
				//pārbauda epasta eksistenci
				if ($stmt->num_rows > 0)
				{
					$safePass = $_POST['sifretaParole'];
					for ($i = 0; $i < 20; $i++)
					{
						$safePass = md5($safePass);
					}
				
					$stmt->bind_result($lietotajaID, $lietotajvards, $sifretaParole);
					$stmt->fetch();
				
					if ($safePass === $sifretaParole) //Login success
					{
						session_regenerate_id();
						$_SESSION['loggedin'] = TRUE;
						$_SESSION['name'] = $lietotajvards;
						$_SESSION['id'] = $lietotajaID;
						header("Location: index.php");
					}
					else //Nepareiza parole vai epasts
					{
						header("Location: loginForm.php?error=nepareizi_dati");
					}
				}
				else // Ievadītā epasta adrese nav reģistrēta
				{
					header("Location: loginForm.php?error=nepareizi_dati");
				}

				$stmt->close();
			}
		}
		else
		{
			header("Location: fatalEror.php");
		}
?>
