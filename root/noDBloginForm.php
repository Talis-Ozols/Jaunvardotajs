<meta charset=utf8>

<?php
	session_start();
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = 'usbw';
	$DATABASE_NAME = 'vardudb';

	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if ( mysqli_connect_errno() )
	{
		exit('Kļūda cenšoties pielēgties MySQL: ' . mysqli_connect_error());
	}
	
	#if ( !isset($_POST['epastaAdrese'], $_POST['sifretaParole']) )
	#{
	#	exit('Lūdzu aizpildiet visus laukus!');
	#}
	
	
	if ($stmt = $con->prepare('SELECT lietotajaID, lietotajvards, sifretaParole FROM lietotaji WHERE epastaAdrese = ?'))
	{
		$stmt->bind_param('s', $_POST['epastaAdrese']);
		$stmt->execute();
		$stmt->store_result();
		
		if ($stmt->num_rows > 0)
		{
			$safePass = $_POST['sifretaParole'];
			for ($i = 0; $i < 20; $i++)
			{
				$safePass = md5($safePass);
			}
		
			$stmt->bind_result($lietotajaID, $lietotajvards, $sifretaParole);
			$stmt->fetch();
		
			if ($safePass === $sifretaParole)
			{
				session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['name'] = $lietotajvards;
				$_SESSION['id'] = $lietotajaID;
				header("Location: index.php");
			}
			else
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
?>
