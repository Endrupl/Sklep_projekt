<?php

	session_start();
	if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==false))
	{
		header('Location: index.php');
		exit();
	}
	
	if (isset($_GET['akcja_id'])) $nrakcji=$_GET['akcja_id'];
	
	$_SESSION['akcja']=$nrakcji;
	$_SESSION['udanazmiana']=false;
	
	
	
	
	
	
	if($nrakcji==1){
		
		
				///////////////////////////////////////////////////////////////////             ZMIANA HASLA			/////////////////////////////////////////////////////////////
			if (isset($_POST['oldpass']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		$oldpass = $_POST['oldpass'];
		$oldpassMQ=$_SESSION['password'];
		if(!(password_verify($oldpass,$oldpassMQ)))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Old password is valid!";	
		}
		
		$haslo1 = $_POST['npass1'];
		$haslo2 = $_POST['npass2'];
		
		if ((strlen($haslo1)<8) || (strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo2']="Password must have between 8 and 20 characters!";
		}
		
		if ($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo2']="The entered passwords are not identical!";
		}	

		$haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);// ZAMIAST OSTRZEZEN TYTKO WYJATKI
		try
		{
			$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
			if($polaczenie->connect_errno!=0)
			{
			throw new Exception(mysqli_connect_errno());
			}
			else
			{	
				if($wszystko_OK==true)
				{	
					$zmienna=$_SESSION['iduser'];
					if($polaczenie->query("UPDATE uzytkownicy SET haslo='$haslo_hash' where idUzytkownika='$zmienna'"))
					{
						$_SESSION['udanazmiana']=true;
						header('Location: index.php?PageName=userpanel');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
				}else
				{
					header('Location: index.php?PageName=userpanel');
				}
				
				$polaczenie->close();
			}
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy :( ! Spróbuj później jeszcze raz</span>';
			echo '<br />Informacja developerska:'.$e;
		}
	}else
	{
		header('Location: index.php?PageName=userpanel');
	}
	}else if($nrakcji==2){
		
		
		///////////////////////////////////////////////////////////////////             ZMIANA EMAIL			/////////////////////////////////////////////////////////////
			if (isset($_POST['oldemail']))
	{
		//Udana walidacja? Załóżmy, że tak!
		$wszystko_OK=true;
		
		$oldemail=$_SESSION['email'];
		$oldemail2=$_POST['oldemail'];
		
		
		
		if ($oldemail!=$oldemail2)
		{
			$wszystko_OK=false;
			$_SESSION['e_oldemail']="This is not yout old e-mail!";
		}
		
		
		$nemail = $_POST['neamil'];
		$emailB = filter_var($nemail, FILTER_SANITIZE_EMAIL);
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$nemail))
		{
			$wszystko_OK=false;
			$_SESSION['e_nemail']="Provide a valid email address!";
		}
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);// ZAMIAST OSTRZEZEN TYTKO WYJATKI
		try
		{
			$polaczenie = new mysqli($host,$db_user,$db_password,$db_name);
			if($polaczenie->connect_errno!=0)
			{
			throw new Exception(mysqli_connect_errno());
			}
			else
			{	
				if($wszystko_OK==true)
				{	
					//git majonez
					$zmienna=$_SESSION['iduser'];
					if($polaczenie->query("UPDATE uzytkownicy SET email='$nemail' where idUzytkownika='$zmienna'"))
					{
						$_SESSION['udanazmiana']=true;
						header('Location: index.php?PageName=userpanel');
					}
					else
					{
						throw new Exception($polaczenie->error);
					}
				}else
				{
					header('Location: index.php?PageName=userpanel');
				}
				
				$polaczenie->close();
			}
		}
		catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy :( ! Spróbuj później jeszcze raz</span>';
			echo '<br />Informacja developerska:'.$e;
		}
	}else
	{
		header('Location: index.php?PageName=userpanel');
	}
	}else if($nrakcji==3){
		header('Location: index.php?PageName=userpanel');
	}

?>