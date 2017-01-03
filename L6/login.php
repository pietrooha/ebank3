<?php
	session_start();

	if((!isset($_POST['identyfikator'])) || (!isset($_POST['klucz'])))
	{
		header('Location: index.php');
		exit();
	}
		require_once "connect.php";
		$connect = @new mysqli($host, $db_user, $db_password, $db_name);

	if ($connect->connect_errno!=0)
	{
		echo "Error: ".$connect->connect_errno;
	}
	else
	{
		$identyfikator = $_POST['identyfikator'];
		$klucz = $_POST['klucz'];



		$zapytanie = "select count(*) from uzytkownik where identyfikator = '$identyfikator' and klucz = '$klucz'";
		$zapytanieImie = "select imie from klient join uzytkownik on klient.id_uzytkownik = uzytkownik.id_uzytkownik where identyfikator = '$identyfikator'";
		$zapytanieNazwisko = "select nazwisko from klient join uzytkownik on klient.id_uzytkownik = uzytkownik.id_uzytkownik where identyfikator = '$identyfikator'";
		$zapytanieImieNazwisko = "select imie, nazwisko from klient join uzytkownik on klient.id_uzytkownik = uzytkownik.id_uzytkownik where identyfikator = '$identyfikator'";
		
/*		$klucz_z_bazy_zapyt = "select klucz from uzytkownik where identyfikator = '$identyfikator'";
		$klucz_z_bazy_wynik = mysqli_query($connect, $klucz_z_bazy_zapyt);
		$klucz_baza = mysqli_fetch_row($klucz_z_bazy_wynik);
		$klucz_baza_t = $klucz_baza[0];

		if(password_verify($klucz, $klucz_baza))
		{*/
			$wynik = mysqli_query( $connect, $zapytanie );
			$wynikImie = mysqli_query( $connect, $zapytanieImie );
			$wynikNazwisko = mysqli_query( $connect, $zapytanieNazwisko );
	        $wynikImieNazwisko = mysqli_query( $connect, $zapytanieImieNazwisko );

			if(!$wynik)
			{
				echo 'Nie można wykonać zapytania.';
				exit;
			}

			$wiersz = mysqli_fetch_row( $wynik );
			$wiersz2 = mysqli_fetch_row( $wynikImie );
			$wiersz3 = mysqli_fetch_row( $wynikNazwisko );
			$ile = $wiersz[0];
			$imie = $wiersz2[0];
			$nazwisko = $wiersz3[0];

			
			if(!$wynik)
			{
				echo 'Nie można wykonać zapytania.';
				exit;
			}

			//echo $ile;
			
			//if ( $ile > 0 )
			//{
				$row = mysqli_fetch_array($wynikImieNazwisko, MYSQLI_BOTH);
				$_SESSION['logged_in'] = true;
		 		$_SESSION['imie'] = $imie;
		 		$_SESSION['nazwisko'] = $nazwisko;
		 		//echo $imie;
					if($identyfikator == 'Admin')
					{
						header('Location: transfer_validate.php');
					}
					else
					{
						header('Location: home.php');
					}
			//}
		}
		
		$connect->close();
//	}
?>
