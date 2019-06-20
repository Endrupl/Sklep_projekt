<?php
	class Zamowienie
	{
		public $towar;
		public $liczbaDoKupienia;
		
		public function __construct($nazwa, $ile)
		{
			$towar = $nazwa;
			$liczbaDoKupienia = $ile;
		}
		//w wlonej chwili do poprawki, powinno być bez argumentów i odwoływać się do pól klasy
		public function kup($towarx, $liczbaDoKupieniax, $login)
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
			$liczbaZapytanie = $baza->query("select * from Produkty where nazwa='".$towarx."'");
			foreach($liczbaZapytanie as $wiersz)
			{
				$liczbaNaStanie = $wiersz['liczba'];
			}
			if($liczbaNaStanie<$liczbaDoKupieniax)
			{
				$_SESSION['brakTowaruException'] = true;
				header('Location: index.php');
				exit();
			}
			else
			{
				$_SESSION['komunikatOPowodzeniuZakupu'] = true;
			}
			$baza->exec("insert into Zamowienia values (null, (select idProduktu from Produkty where nazwa='".$towarx."'), CURDATE(), ".$liczbaDoKupieniax.", 0, 0, (select idKoszyka from Koszyki where idKonta=(select idUzytkownika from Uzytkownicy where login='".$login."')), (select cena from Produkty where nazwa='".$towarx."'))");
			$liczbaKoncowa = $liczbaNaStanie-$liczbaDoKupieniax;
			$baza->exec("update Produkty set liczba=".$liczbaKoncowa." where nazwa='".$towarx."'");
			header('Location: index.php');
		}
		
		public static function wypiszZamowienia($login)
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
			$zamowieniaZapytanie = $baza->query("select nazwa, z.liczba as liczba, z.cena as cena from Zamowienia z, Produkty p where idKoszyka=(select idKoszyka from Koszyki where idKonta=(select idUzytkownika from Uzytkownicy where login='".$login."')) and z.idProduktu=p.idProduktu and stanPotwierdzenia=0");
            echo '<div class="container">';
			echo '<table class="table table-hover table-striped">'
				.'<thead><tr><th>Nazwa</th><th>Liczba</th><th>Cena</th></tr></thead><tbody>';
			foreach($zamowieniaZapytanie as $wiersz)
			{
				
				echo '<tr>'
					.'<td>'.$wiersz['nazwa'].'</td>'
					.'<td>'.$wiersz['liczba'].'</td>'
					.'<td>'.$wiersz['liczba']*$wiersz['cena'].'</td>'
					.'</tr>';
			}
			echo '</tbody> </table>';
            echo '</div>';
			/*foreach($zamowieniaZapytanie as $wiersz)
			{
				echo '<div style="margin-left: 100px">';
				echo '	<h1>'.$wiersz['nazwa'].'</h1><br>';
				echo '	Liczba: '.$wiersz['liczba'].'<br>';
				echo '	Cena: '.$wiersz['liczba']*$wiersz['cena'];
				echo '</div>';
			}*/
		}
		
		public static function potwierdz($login)
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			//$zamowieniaZapytanie = $baza->query("select * from Zamowienia z where idKoszyka=(select idKoszyka from Koszyki where idKonta=(select idUzytkownika from Uzytkownicy where login='".$login."')) and stanPotwierdzenia=0");
			$baza->exec("update Zamowienia set stanPotwierdzenia=1 where stanPotwierdzenia=0 and idKoszyka=(select idKoszyka from Koszyki where idKonta=(select idUzytkownika from Uzytkownicy where login='".$login."'))");
		}
		
		public static function wypiszZamowieniaAdministrator()
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
			$zamowieniaZapytanie = $baza->query("select nazwa, z.liczba as liczba, z.cena as cena, imie, nazwisko, miasto, ifnull(ulica, miasto) as ulica, nrDomu, nrMieszkania, kodPocztowy, idZamowienia from Zamowienia z, Produkty p, Koszyki k, Uzytkownicy u where k.idKonta=u.idUzytkownika and z.idKoszyka=k.idKoszyka and z.idProduktu=p.idProduktu and stanPotwierdzenia=1 and stanRealizacji=0");
			foreach($zamowieniaZapytanie as $wiersz)
			{
                
  
                echo '<div class="container">';
                
				//echo '<div style="margin-left: 200px">';
                echo '<div class="panel panel-default">';
				echo '	<div class="panel-heading">'.$wiersz['nazwa'].'</div>';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
				echo '	<th>Liczba sztuk </th>';
				echo '	<th>Łączna kwota </th>';
				echo '	<th>Dla </th>';
				echo '	<th>Adres </th>';
                echo '  <th>Kod pocztowy </th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                echo '<tr>';
				echo '	<td>'.$wiersz['liczba'].'</td>';
				echo '	<td>'.$wiersz['liczba']*$wiersz['cena'].'</td>';
				echo '	<td>'.$wiersz['imie'].' '.$wiersz['nazwisko'].'</td>';
				if($wiersz['nrMieszkania'] != '')
				echo '	<td>'.$wiersz['miasto'].', '.$wiersz['ulica'].' '.$wiersz['nrDomu'].'/'.$wiersz['nrMieszkania']. '</td>';
				else
				echo '	<td>'.$wiersz['miasto'].', '.$wiersz['ulica'].' '.$wiersz['nrDomu'].'</td>';
				echo '	<td>'.$wiersz['kodPocztowy'].'</td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '<div class="panel-body">';
                echo '	<form action="realizuj.php" method="post">';
				echo '		<input type="hidden" value="'.$wiersz['idZamowienia'].'" name="zamowienie">';
				echo ' 		<input type="submit" class="btn btn-success" value="Potwierdź realizację"><br>';
				echo '	</form>';
				echo '</div>';
				echo '</div>';

                
				echo '</div>';
                
			}
		}
		
		public static function finalizuj($idZamowienia)
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
			$baza->exec("update Zamowienia set stanRealizacji=1 where idZamowienia=".$idZamowienia);
		}
	}
?>