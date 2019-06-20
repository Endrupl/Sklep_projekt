<?php
	session_start();
	include_once('klasy/zamowienie.php');
	if ((!isset($_POST['nazwa'])) || (!isset($_POST['liczba'])))
	{
		header('Location: index.php');
		exit();
	}
	$zamowienie = new Zamowienie($_POST['nazwa'], $_POST['liczba']);
	$zamowienie->kup($_POST['nazwa'], $_POST['liczba'], $_SESSION['login']);
?>