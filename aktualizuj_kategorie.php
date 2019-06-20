<?php
	include_once('klasy/kategoria.php');
	$kategoria = new Kategoria($_GET['id']);
	$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
	$baza->query("SET CHARSET utf8");
	$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
	$zapytanieDzialy = $baza->query("select * from Dzialy where nazwa='".$_POST['dzial']."'");
	foreach($zapytanieDzialy as $wiersz)
	{
		$idDzialu = $wiersz['idDzialu'];
	}
	$kategoria->aktualizujDane($_POST['nazwa']);
	header('Location: index.php?PageName=kategorie');
?>