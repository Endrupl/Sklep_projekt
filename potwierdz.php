<?php
	session_start();
	include_once('klasy/zamowienie.php');
	Zamowienie::potwierdz($_SESSION['login']);
	$_SESSION['komunikatOPotwierdzeniu'] = true;
	header('Location: index.php?PageName=koszyk');
?>