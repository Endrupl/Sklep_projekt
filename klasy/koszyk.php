<?php
	//session_start();
	include_once('klasy/zamowienie.php');
	if ((isset($_SESSION['komunikatOPotwierdzeniu'])) && ($_SESSION['komunikatOPotwierdzeniu']==true))
	{
		$komunikatPotwierdzenie = '<h3 style="color: green">Twoje zamówienia zostały potwierdzone!</h3>';
		$_SESSION['komunikatOPotwierdzeniu'] = false;
	}
	else
	{
		$komunikatPotwierdzenie = "";
	}
	class Koszyk
	{
		public static function wyzeruj($login)
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$koszykZapytanie = $baza->query("select * from Zamowienia where idKoszyka=(select idKoszyka from Koszyki where idKonta=(select idUzytkownika from Uzytkownicy where login='".$login."') ) and stanPotwierdzenia=0");
			foreach($koszykZapytanie as $wiersz)
			{
				$produktZapytanie = $baza->query("select * from Produkty where idProduktu=".$wiersz['idProduktu']);
				foreach($produktZapytanie as $wiersz2)
				{
					$liczba = $wiersz2['liczba'];
				}
				$liczbaNowa = $liczba+$wiersz['liczba'];
				$baza->exec("update Produkty set liczba=".$liczbaNowa." where idProduktu=".$wiersz['idProduktu']);
			}
			$baza->exec("delete from Zamowienia where idKoszyka=(select idKoszyka from Koszyki where idKonta=(select idUzytkownika from Uzytkownicy where login='".$login."')) and stanPotwierdzenia=0");
		}
	}
?>

		<?php
			echo $komunikatPotwierdzenie;
		?>
		<?php
			if(isset($_SESSION['login'])) Zamowienie::wypiszZamowienia($_SESSION['login']);
		?>
    <div class="container">
		<p>
			<a class="btn btn-primary" role="button" data-toggle="modal" data-target="#potwierdz-zakup">
				Potwierdź zakup
			</a>
		</p>
		<p>
			<a class="btn btn-primary" role="button" href="wyzeruj.php">
				Wyzeruj koszyk
			</a>
		</p>
    </div>
		<div class="modal fade" id="potwierdz-zakup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<font color="black">Czy chcesz potwierdzić zakup?</font>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<font color="black">
						Łączna kwota to <?php
						if(isset($_SESSION['login']))
						{
							$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
							$zamowieniaCenaWszystkiegoZapytanie = $baza->query("select sum(z.cena*z.liczba) as wszystko from Zamowienia z, Produkty p where idKoszyka=(select idKoszyka from Koszyki where idKonta=(select idUzytkownika from Uzytkownicy where login='".$_SESSION['login']."')) and z.idProduktu=p.idProduktu and stanPotwierdzenia=0");
							foreach($zamowieniaCenaWszystkiegoZapytanie as $wiersz)
							{
								$CenaWszystkiego = $wiersz['wszystko'];
							}
							echo $CenaWszystkiego;
						}
						else
						{
							echo '0';
						}
						?>
						<form action="potwierdz.php" method="post">
							<input type="submit" value="Potwierdź"/>
						</form>
						</font>
					</div>
				</div>
			</div>
		</div>		