<?php
	include_once('klasy/zamowienie.php');
	Zamowienie::finalizuj($_POST['zamowienie']);
	header('Location: index.php?PageName=zamowienia');
?>