<?php
	class Uzytkownik
	{
		
		public static function wypiszUzytkownikow()
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy;charset=utf8;', 'root', '');
			$uzytkownicy = $baza->query('select * from uzytkownicy;');
			echo '<table class="table table-hover table-striped">'
				.'<thead><tr><th>e-mail</th><th>Nazwisko</th><th>Imie</th><th>Kod pocztowy</th><th>Miasto</th><th>Ulica</th><th>Nr mieszkania</th><th>Nr domu</th><th style="width: 100px;">Czy admin?</th></tr></thead><tbody>';
			foreach($uzytkownicy as $wiersz)
			{
				
				echo '<tr>'
					.'<td>'.$wiersz['email'].'</td>'
					.'<td>'.$wiersz['nazwisko'].'</td>'
					.'<td>'.$wiersz['imie'].'</td>'
					.'<td>'.$wiersz['kodPocztowy'].'</td>'
					.'<td>'.$wiersz['miasto'].'</td>'
					.'<td>'.$wiersz['ulica'].'</td>'
					.'<td>'.$wiersz['nrMieszkania'].'</td>'
					.'<td>'.$wiersz['nrDomu'].'</td>';
				if($wiersz['admin']==1)
				{
					echo '<td>Tak &nbsp;</td> <td><form method="post" action="index.php?PageName=uzytkownicy" style="float: left;">'
					.'<button class="btn btn-warning" name="usunadmin">Zmień</button>'
					.'<input type="hidden" name="iduzytkownika" value="'.$wiersz['idUzytkownika'].'"></input></form></td>';
				}
				else
				{
					echo '<td>Nie &nbsp
					</td> <td><form method="post" action="index.php?PageName=uzytkownicy" style="float: left;">'
					.'<button class="btn btn-warning" name="dodajadmin">Zmień</button>'
					.'<input type="hidden" name="iduzytkownika" value="'.$wiersz['idUzytkownika'].'"></input></form></td>';
				}
				if($wiersz['zablokowany']==0)
				{
					echo '<td><form method="post" action="index.php?PageName=uzytkownicy" style="float: left;">'
					.'<button class="btn btn-danger" name="zablokuj">Zablokuj</button>'
					.'<input type="hidden" name="iduzytkownika" value="'.$wiersz['idUzytkownika'].'"></input></form></td>';
				}
				else
				{
					echo '<td><form method="post" action="index.php?PageName=uzytkownicy" style="float: left;">'
					.'<button class="btn btn-danger" name="odblokuj">Odblokuj</button>'
					.'<input type="hidden" name="iduzytkownika" value="'.$wiersz['idUzytkownika'].'"></input></form></td>';
				}
				echo '</tr>';
			}
			echo '</tbody> </table>';
		}
		public static function ustawKolumneAdmin($iduzytkownika, $admin)
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy;charset=utf8;', 'root', '');
			$baza->exec('UPDATE uzytkownicy Set admin='.$admin.' Where idUzytkownika='.$iduzytkownika.';');
		}
		
		public static function ustawKolumneZablokowany($iduzytkownika, $zablokowany)
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy;charset=utf8;', 'root', '');
			$baza->exec('UPDATE uzytkownicy Set zablokowany='.$zablokowany.' Where idUzytkownika='.$iduzytkownika.';');
		}
		
	}
?>