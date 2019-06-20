<?php
//session_start();
require('klasy/uzytkownik.php');
		if ((isset($_SESSION['zalogowany'])==false) || ($_SESSION['zalogowany']==false) 
			|| isset($_SESSION['zalogowany'])==false || $_SESSION['admin']==0){
				header('Location: index.php');
				die();
			}
if(isset ($_POST['usunadmin']))
{
	Uzytkownik::ustawKolumneAdmin($_POST['iduzytkownika'],0);
}
else if(isset($_POST['dodajadmin']))
{
	Uzytkownik::ustawKolumneAdmin($_POST['iduzytkownika'],1);
}
if(isset ($_POST['zablokuj']))
{
	Uzytkownik::ustawKolumneZablokowany($_POST['iduzytkownika'],1);
}
else if(isset($_POST['odblokuj']))
{
	Uzytkownik::ustawKolumneZablokowany($_POST['iduzytkownika'],0);
}	
?>

<div class="container">
<?php
Uzytkownik::wypiszUzytkownikow();
?>    
</div>
