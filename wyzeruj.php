<?php
	session_start();
	include_once('klasy/koszyk.php');
	Koszyk::wyzeruj($_SESSION['login']);
	header('Location: index.php?PageName=koszyk');
?>