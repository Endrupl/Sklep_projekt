<?php
	include_once('klasy/towar.php');
	Towar::usun($_POST['id']);
	header('Location: index.php?PageName=towary');
?>