<?php
	session_start();
			if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
	header('Location: index.php');
	}
	require_once "connect.php"; //sposob dolaczenia -jezeli wystapi blad to nie polaczy
	mysqli_report(MYSQLI_REPORT_STRICT);// ZAMIAST OSTRZEZEN TYTKO WYJATKI
	
	try
		{
			$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
				
				$email = $_POST['email'];
				$haslo = $_POST['password'];

		if($rezultat=$polaczenie->query("SELECT * FROM uzytkownicy where email='$email'"))
		{
					$ilu_user=$rezultat->num_rows;
					
			if($ilu_user>0)
			{
				$wiersz=$rezultat->fetch_assoc();	
				if($wiersz['zablokowany']==1)
				{
					$_SESSION['blad']='<span style="color:red">Użytkownik zablokowany!</span>';
					header('Location: index.php');
					die();
				}					
				if(password_verify($haslo,$wiersz['haslo']))
				{
					
					$_SESSION['login']=$wiersz['login'];
					$_SESSION['iduser']=$wiersz['idUzytkownika'];
					$userid=$wiersz['idUzytkownika'];;
					$_SESSION['password']=$wiersz['haslo'];
					$_SESSION['email']=$wiersz['email'];
					$_SESSION['zalogowany']=true;
					$_SESSION['admin']=$wiersz['admin'];
					$_SESSION['akcja']=0;
					$koszyk=$polaczenie->query("SELECT idKoszyka FROM koszyki where idKonta='$userid'");
					$wiersz2=$koszyk->fetch_assoc();
					$_SESSION['idkoszyk']=$wiersz2['idKoszyka'];
					unset($_SESSION['blad']);
					$rezultat->free_result();
					$koszyk->free_result();
					header('Location: index.php');
					$polaczenie->close();
				}else
				{
					$_SESSION['blad']='<span style="color:red">Nieprawidlowy e-mail lub haslo!</span>';
					header('Location: index.php');
				}
			}else
				{
					$_SESSION['blad']='<span style="color:red">Nieprawidlowy e-mail lub haslo!</span>';
					header('Location: index.php');
				}
		}			
		}catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy :( ! Spróbuj później jeszcze raz</span>';
			echo '<br />Informacja developerska:'.$e;
		}
				?>