<?php
	include_once('klasy/towar.php');
	$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
	$baza->query("SET CHARSET utf8");
	$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
	$podkategoriaZapytanie = $baza->query("select * from Kategorie where nazwa='".$_POST['kategoria']."'");
	foreach($podkategoriaZapytanie as $wiersz)
	{
		$kategoria = $wiersz['idKategorii'];
	}
	$towar = new Towar($_POST['nazwa'], $_POST['cena'], $_POST['liczba'], $_POST['opis'], $_POST['zdjecie'], $kategoria);
	$towar->dodaj();
	header('Location: index.php?PageName=towary');
?>