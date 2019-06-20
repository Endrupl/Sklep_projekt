<?php
	include_once('klasy/towar.php');
	try
	{
	Towar::aktualizujDane($_POST['id'], $_POST['nazwa'], $_POST['cena'], $_POST['liczba'], $_POST['opis'], $_POST['zdjecie'], $_POST['kategoria']);
	}
	catch(Exception $e)
	{
		$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
		$baza->query("SET CHARSET utf8");
		$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
		$baza->exec("insert into bledy values (null, ".$e->getMessage().")");
	}
	header('Location: index.php?PageName=towary');
?>