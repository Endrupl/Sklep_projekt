<?php
	//session_start();
	if (isset($_POST['email']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		//Sprawdź poprawność loginu
		$log = $_POST['log'];
		if ((strlen($log)<3) || (strlen($log)>15))
		{
			$wszystko_OK=false;
			$_SESSION['e_log']="Login musi posiadać od 3 do 15 znaków !";
		}
		
		if (ctype_alnum($log)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_log']="Login może posiadać tylko litery (bez polskich znaków) lub liczby";
		}
		
		
		//Sprawdź poprawność email
		$email = $_POST['email'];
		$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podany adres e-mail jest nie poprawny!";
		}
		
		//Sprawdź poprawność hasla
		$haslo1 = $_POST['pass1'];
		$haslo2 = $_POST['pass2'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków !";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są identyczne!";
		}	

		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
		//Sprawdź poprawność name
		$name = $_POST['name'];
		
		$pisownia = '/^[A-ZŁŚ]{1}+[a-ząęółśżźćń]+$/';
		//$pliczb = '/^[0-9]{1}+[-]+$/';

		if ((strlen($name)<2) || (strlen($name)>30))
		{
			$wszystko_OK=false;
			$_SESSION['e_name']="Imię musi posiadać od 2 do 30 znaków !";
		}
		
		if(preg_match($pisownia, $name)==false) 
		{
			$wszystko_OK=false;
			$_SESSION['e_name']="Pole imię posiada nie właściwe znaki !";
		}
		
		//Sprawdź poprawność surname
		$nazwisko=$_POST['surname'];
		$pis_nazwisko = '/^[A-ZŁŚ]{1}+[a-ząęółśżźćń]+$/';
		if ((strlen($nazwisko)<2) || (strlen($nazwisko)>30))
		{
			$wszystko_OK=false;
			$_SESSION['e_surname']="Nazwisko musi posiadać od 2 do 30 znaków !";
		}
		
		if(preg_match($pis_nazwisko,$nazwisko)==false) 
		{
			$wszystko_OK=false;
			$_SESSION['e_surname']="Nazwisko posiada nie właściwe znaki !";
		}
		
		//Sprawdź poprawność miasta //////////////////////////////////
		$miasto=$_POST['city'];
	
		if ((strlen($miasto)<2) || (strlen($miasto)>30))
		{
			$wszystko_OK=false;
			$_SESSION['e_city']="Miasto musi posiadać od 2 do 30 znaków !";
		}
		
		if(preg_match($pisownia, $miasto)==false) 
		{
			$wszystko_OK=false;
			$_SESSION['e_city']="Nazwa miasta zawiera nie dozwolne znaki!";
		}
		
		
		//Sprawdź poprawność ULICY //////////////////////////////////////////////////
		$ul=$_POST['st'];
		if ((strlen($ul)<2) || (strlen($ul)>30))
		{
			$wszystko_OK=false;
			$_SESSION['e_ul']="Nazwa ulicy musi zawierać posiadać od 2 do 30 znaków !";
		}
		if(preg_match($pisownia, $ul)==false) 
		{
			$wszystko_OK=false;
			$_SESSION['e_ul']="Nazwa ulicy zawiera nie dozwolne znaki!";
		}
		
		
		//Sprawdź poprawność nr domu /////////////////////////////////////////////////
		$nrdomu=$_POST['nhouse'];
		if(strlen($nrdomu)>0)
		{
		if (ctype_alnum($nrdomu)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nrdomu']="Pole zawiera nie dozwolne znaki!";
		}
		}
		
		
		//Sprawdź poprawność nr mieszkania ///////////////////////////////////////////
		$nrmiesz=$_POST['nflat'];
		if(strlen($nrmiesz)>0)
		{
			if (ctype_alnum($nrmiesz)==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_nrmiesz']="Pole zawiera nie dozwolne znaki!";
		}			
		}

		
		//Sprawdź poprawność kodu pocztowego ///////////////////////////////////////////
		$zip=$_POST['zipcode'];
		$sprawdzzip='/^[0-9]{2}[-][0-9]{3}+$/';
		if (strlen($zip)>6 || strlen($zip)<6)
		{
			$wszystko_OK=false;
			$_SESSION['e_zip']="Kod pocztowy jest nie poprawny";
		}else
		{
			if(preg_match($sprawdzzip, $zip)==false) 
			{
				$wszystko_OK=false;
				$_SESSION['e_zip']="Kod pocztowy zawiera nie dozwolne znaki!";
			}			
		}
		
		//Czy zaakceptowano regulamin? //////////////////////////////////////		
		if (!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$_SESSION['e_regulamin']="Musisz potwierdzić regulamin!";
		}	

		
		//Bot or not? Oto jest pytanie! //////////////////////////////////////////
		$sekret = "6Lc8xToUAAAAAGDXydzxvMUnqftEhEpuDVhVKZ11";
		$sprawdz = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		
		$odpowiedz = json_decode($sprawdz);
		
		if ($odpowiedz->success==false)
		{
			$wszystko_OK=false;
			$_SESSION['e_bot']="Potwierdz ze nie jesteś botem!";
		}	

///////////////////////////// KOD ODPOWIEDZIALNY ZA DODANIE DO BAZY ////////////////////////////////////
	
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);// ZAMIAST OSTRZEZEN TYTKO WYJATKI
		

		try
		{
			$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
			$polaczenie->query("SET CHARSET utf8");
			$polaczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
			if($polaczenie->connect_errno!=0)
			{
			throw new Exception(mysqli_connect_errno());
			}
			else
			{

				$rezultat=$polaczenie->query("SELECT idUzytkownika FROM uzytkownicy WHERE email='$email'");
				if(!$rezultat)throw new Exception($polaczenie->error);
				
				$ile_takich_email=$rezultat->num_rows; //liczba wierszy z bazy
				
				//CZY EMAIL JUZ ISTNIEJE
				if($ile_takich_email>0)
				{
				$wszystko_OK=false;
				$_SESSION['e_email']="Istnieje juz taki adres !";
				}

				
				$rezultat=$polaczenie->query("SELECT login FROM uzytkownicy WHERE login='$log'");
				if(!$rezultat)throw new Exception($polaczenie->error);
				
				$ile_takich_nick=$rezultat->num_rows; //liczba wierszy z bazy
				
				if($ile_takich_nick>0)
				{
				$wszystko_OK=false;
				$_SESSION['e_log']="Istnieje juz taki login wybierz inny !";
				}
				
				
				if($wszystko_OK==true)
				{	
					//git majonez
					if($polaczenie->query("INSERT INTO uzytkownicy VALUES(NULL,'$log','$haslo_hash','$email','$nazwisko','$name','$ul','$nrmiesz','$nrdomu','$miasto','$zip',0,0)"))
					{
						
					if($rezultat=$polaczenie->query("SELECT * FROM uzytkownicy where email='$email'"))
					{
						$wiersz=$rezultat->fetch_assoc();
						$idu=$wiersz['idUzytkownika'];
						$polaczenie->query("INSERT INTO koszyki VALUES(NULL,'$idu')");
						$rezultat->free_result();
						$_SESSION['udanarej']=true;
						header('Location:index.php');
					}else
					{
						throw new Exception($polaczenie->error);
					}

					}
					else
					{
						throw new Exception($polaczenie->error);
					}
				}
				
				$polaczenie->close();
			}
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy :( ! Spróbuj później jeszcze raz</span>';
			echo '<br />Informacja developerska:'.$e;
		}

	}	
	?>

<main>
    
	<div class="container">
        <div class="jumbotron center1">
	
	<br /><br/>
	<p>Informacje o koncie</p>
	<form method="POST">
	
	<br /> <input type="text" placeholder="Login..." name="log"/><br/>
	<?php
			if (isset($_SESSION['e_log']))
			{
				echo '<div class="error">'.$_SESSION['e_log'].'</div>';
				unset($_SESSION['e_log']);
			}
		?>
		
		
	<br /> <input type="text" placeholder="Podaj E-mail..." name="email"/><br/>
		<?php
			if (isset($_SESSION['e_email']))
			{
				echo '<div class="error">'.$_SESSION['e_email'].'</div>';
				unset($_SESSION['e_email']);
			}
		?>
		
		
	<br /> <input type="password" placeholder="Hasło..." name="pass1"/><br/>
		<?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
		?>
		<br /> <input type="password" placeholder="Powtórz Hasło..." name="pass2"/><br/>
	
	<br/>	<br/>
	
	
	
	
	<p>Dane adresowe</p>
	<br /> <input type="text" placeholder="Twoje imię..." name="name"/><br/>
			<?php
			if (isset($_SESSION['e_name']))
			{
				echo '<div class="error">'.$_SESSION['e_name'].'</div>';
				unset($_SESSION['e_name']);
			}
		?>
		
	<br /> <input type="text" placeholder="Twoje nazwisko..." name="surname"/><br/>
			<?php
			if (isset($_SESSION['e_surname']))
			{
				echo '<div class="error">'.$_SESSION['e_surname'].'</div>';
				unset($_SESSION['e_surname']);
			}
		?>
		
		

	<br /> <input type="text" placeholder="Miasto.." name="city" style="width:170px;height:40px;"/>

	<input type="text" placeholder="Ulica.." name="st"  style="width:150px;height:40px;"/><br/>
		<?php
			if (isset($_SESSION['e_city']))
			{
				echo '<div class="error">'.$_SESSION['e_city'].'</div>';
				unset($_SESSION['e_city']);
			}
		?>
		<?php
			if (isset($_SESSION['e_ul']))
			{
				echo '<div class="error">'.$_SESSION['e_ul'].'</div>';
				unset($_SESSION['e_ul']);
			}
		?>
	<br /><input  style="width:100px;height:40px;" type="text" placeholder="Kod-pocztowy:" name="zipcode"  />
	
	 <input type="text" placeholder="Nr.Domu.." name="nhouse" style="width:80px;height:40px;"/>
	 
	 <input type="text" placeholder="Nr.Mieszkania.." name="nflat" style="width:80px;height:40px;"/><br/>
			<?php
			if (isset($_SESSION['e_zip']))
			{
				echo '<div class="error">'.$_SESSION['e_zip'].'</div>';
				unset($_SESSION['e_zip']);
			}
			if (isset($_SESSION['e_nrdomu']))
			{
				echo '<div class="error">'.$_SESSION['e_nrdomu'].'</div>';
				unset($_SESSION['e_nrdomu']);
			}
			if (isset($_SESSION['e_nrmiesz']))
			{
				echo '<div class="error">'.$_SESSION['e_nrmiesz'].'</div>';
				unset($_SESSION['e_nrmiesz']);
			}
		?>
	
	<br/>
		
	<label>
		<input type="checkbox" name="regulamin" /> Akceptuję regulamin
		</label>
		<?php
			if (isset($_SESSION['e_regulamin']))
			{
				echo '<div class="error">'.$_SESSION['e_regulamin'].'</div>';
				unset($_SESSION['e_regulamin']);
			}
		?>
		
	<div class="g-recaptcha" data-sitekey="6Lc8xToUAAAAAOISqJ9ZI0HstcvEYxO1JyM27xy8" style="display:table;margin-left:auto;margin-right:auto;padding-top:10px"></div>
			<?php
			if (isset($_SESSION['e_bot']))
			{
				echo '<div class="error">'.$_SESSION['e_bot'].'</div>';
				unset($_SESSION['e_bot']);
			}
		?>	
		<br />
	<input type="submit" value="Załóż konto">
	</form>
	</div>
    </div>
	</main>