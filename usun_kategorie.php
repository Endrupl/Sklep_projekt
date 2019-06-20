<?php
	include_once('klasy/kategoria.php');
	$kategoria = new Kategoria($_GET['id']);
	$kategoria->usun();
	header('Location: index.php?PageName=kategorie');
?>