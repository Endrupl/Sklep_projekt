<?php
	class Towar
	{
		public $nazwa;
		public $cena;
		public $liczba;
		public $opis;
		public $zdjecie;
		public $idPodkategorii;
		
		public function __construct($nazwa, $cena, $liczba, $opis, $zdjecie, $idPodkategorii)
		{
			$this->nazwa = $nazwa;
			$this->cena = $cena;
			$this->liczba = $liczba;
			$this->opis = $opis;
			$this->zdjecie = $zdjecie;
			$this->idPodkategorii = $idPodkategorii;
		}
		
		public static function wypiszTowary($cel)
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy;charset=utf8;', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 			
			$maksZapytanie = $baza->query('select max(idProduktu) from Produkty');
			foreach($maksZapytanie as $wiersz)
			{
				$maks = $wiersz['max(idProduktu)'];
			}
			$towary = $baza->query('select * from Produkty');
			foreach($towary as $wiersz)
			{
				if($wiersz['liczba']>0)
				{
					echo '<div class="col-sm-6 col-md-4">';
					echo '	<div class="thumbnail" style="height: 600px">';
					echo '		<img src="'.$wiersz['Zdjecie'].'" alt="..." style="height: 400px">';
					echo '		<div class="caption" style="height: 200px">';
					echo '			<h3 style="height: 30px">'.$wiersz['nazwa'].'</h3>';
					echo '			<p style="height: 50px">Cena: '.$wiersz['cena'].'<br></p>';
					if($cel == "okienko-zalogowany")
					{
						echo '			<p style="height: 20px"><a href="#" class="btn btn-primary" role="button" data-toggle="modal" data-target="#'.$cel.$wiersz['idProduktu'].'" value="'.$wiersz['idProduktu'].'">Kup</a> <a href="opisproduktu.php?produkt_id='.$wiersz['idProduktu'].'" class="btn btn-default" role="button">Opis</a></p>';
					}
					else
					{
						echo '			<p style="height: 20px"><a href="#" class="btn btn-primary" role="button" data-toggle="modal" data-target="#'.$cel.'" value="'.$wiersz['idProduktu'].'">Kup</a><a href="opisproduktu.php?produkt_id='.$wiersz['idProduktu'].'" class="btn btn-default" role="button">Opis</a></p>';
					}
					echo '		</div>';
					echo '	</div>';
					echo '</div>';
				}
			}
		}
		
		public static function wypiszTowaryZKategorii($cel, $kategoria)
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy;charset=utf8;', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
			$towary = $baza->query('select Zdjecie, pr.nazwa as nazwa, opisSlowny, idProduktu, liczba, cena from Produkty pr, kategorie po where pr.idpodkategorii=po.idkategorii and idKategorii='.$kategoria);
			foreach($towary as $wiersz)
			{
				if($wiersz['liczba']>0)
				{
					echo '<div class="col-sm-6 col-md-4">';
					echo '	<div class="thumbnail" style="height: 600px">';
					echo '		<img src="'.$wiersz['Zdjecie'].'" alt="..." style="height: 400px">';
					echo '		<div class="caption" style="height: 200px">';
					echo '			<h3 style="height: 30px">'.$wiersz['nazwa'].'</h3>';
					echo '			<p style="height: 50px">Cena: '.$wiersz['cena'].'<br></p>';
					if($cel == "okienko-zalogowany")
					{
						echo '			<p style="height: 20px"><a href="#" class="btn btn-primary" role="button" data-toggle="modal" data-target="#'.$cel.$wiersz['idProduktu'].'" value="'.$wiersz['idProduktu'].'">Kup</a> <a href="opisproduktu.php?produkt_id='.$wiersz['idProduktu'].'" class="btn btn-default" role="button">Opis</a></p>';
					}
					else
					{
						echo '			<p style="height: 20px"><a href="#" class="btn btn-primary" role="button" data-toggle="modal" data-target="#'.$cel.'" value="'.$wiersz['idProduktu'].'">Kup</a><a href="opisproduktu.php?produkt_id='.$wiersz['idProduktu'].'" class="btn btn-default" role="button">Opis</a></p>';
					}
					echo '		</div>';
					echo '	</div>';
					echo '</div>';
				}
			}
		}
		
		public static function szukajTowaru($cel, $nazwa)
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy;charset=utf8;', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
			$towary = $baza->query("select * from Produkty where nazwa like '%".$nazwa."%'");
			foreach($towary as $wiersz)
			{
				if($wiersz['liczba']>0)
				{
					echo '<div class="col-sm-6 col-md-4">';
					echo '	<div class="thumbnail" style="height: 600px">';
					echo '		<img src="'.$wiersz['Zdjecie'].'" alt="..." style="height: 400px">';
					echo '		<div class="caption" style="height: 200px">';
					echo '			<h3 style="height: 30px">'.$wiersz['nazwa'].'</h3>';
					echo '			<p style="height: 50px">Cena: '.$wiersz['cena'].'<br></p>';
					if($cel == "okienko-zalogowany")
					{
						echo '			<p style="height: 20px"><a href="#" class="btn btn-primary" role="button" data-toggle="modal" data-target="#'.$cel.$wiersz['idProduktu'].'" value="'.$wiersz['idProduktu'].'">Kup</a> <a href="opisproduktu.php?produkt_id='.$wiersz['idProduktu'].'" class="btn btn-default" role="button">Opis</a></p>';
					}
					else
					{
						echo '			<p style="height: 20px"><a href="#" class="btn btn-primary" role="button" data-toggle="modal" data-target="#'.$cel.'" value="'.$wiersz['idProduktu'].'">Kup</a><a href="opisproduktu.php?produkt_id='.$wiersz['idProduktu'].'" class="btn btn-default" role="button">Opis</a></p>';
					}
					echo '		</div>';
					echo '	</div>';
					echo '</div>';
				}
			}
		}	
		
		public static function zapamietajTowar()
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy;charset=utf8;', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 			
			$towary = $baza->query('select * from Produkty');
			foreach($towary as $wiersz)
			{
				echo '<div class="modal fade" id="okienko-zalogowany'.$wiersz['idProduktu'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
				echo '	<div class="modal-dialog" role="document">';
				echo '		<div class="modal-content">';
				echo '			<div class="modal-header">';
				echo '				<font color="black">Wypełnij, aby dokończyć transakcji</font>';
				echo '				<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
				echo '					<span aria-hidden="true">&times;</span>';
				echo '				</button>';
				echo '			</div>';
				echo '			<div class="modal-body">';
				echo '				<form action="kup.php" method="post">';
				echo '					<font color="black">';
				echo '						<input type="hidden" value="'.$wiersz['nazwa'].'" name="nazwa">';
				echo '						'.$wiersz['nazwa'].'<br>';
				echo '						Liczba sztuk: <br>';
				echo '						<input type="text" name="liczba"/> z '.$wiersz['liczba'];
				echo '						<br>';
				echo '						<input type="submit" value="Potwierdź"/>';
				echo '					</font>';
				echo '				</form>';
				echo '			</div>';
				echo '		</div>';
				echo '	</div>';
				echo '</div>';
			}
		}
		
		public static function wypiszTowaryAdministrator()
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
			$produktyZapytanie = $baza->query("select * from Produkty");
			foreach($produktyZapytanie as $wiersz)
			{
                
				echo '<div style="margin-left: 25px; margin-top: 25px">';
				echo '	'.$wiersz['nazwa'].'<br>';
				echo '	<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#prod'.$wiersz['idProduktu'].'" value="prod'.$wiersz['idProduktu'].'">';
				echo '		Edytuj produkt';
				echo '	</button>';
                echo '  <div id="prod'.$wiersz['idProduktu'].'" class="collapse">';
				echo '	<form id="prod'.$wiersz['idProduktu'].'"  action="aktualizuj_towar.php" method="post">';
				echo '		<input type="hidden" value="'.$wiersz['idProduktu'].'" name="id"><br>';
				echo '		Nazwa<br>';
				echo '		<input type="text" value="'.$wiersz['nazwa'].'" name="nazwa"><br>';
				echo '		Cena<br>';
				echo '		<input type="text" value="'.$wiersz['cena'].'" name="cena"><br>';
				echo '		Liczba<br>';
				echo '		<input type="text" value="'.$wiersz['liczba'].'" name="liczba"><br>';
				echo '		Opis<br>';
				echo '		<input type="text" value="'.$wiersz['opisSlowny'].'" name="opis"><br>';
				echo '		URL zdjęcia<br>';
				echo '		<input type="text" value="'.$wiersz['Zdjecie'].'" name="zdjecie"><br>';
				echo '		Kategoria<br>';
				echo '		<select style="color: black" name="kategoria">';
				$podkategoriaProduktuZapytanie = $baza->query("select * from kategorie where idkategorii=".$wiersz['idPodkategorii']);
				foreach($podkategoriaProduktuZapytanie as $wiersz2)
				{
					$podkategoria = $wiersz2['nazwa'];
				}
				echo '			<option selected="selected">'.$podkategoria.'</option>';				
				$podkategorieZapytanie = $baza->query("select * from Kategorie");
				foreach($podkategorieZapytanie as $wiersz3)
				{
					if($wiersz3['nazwa'] == $podkategoria)
					{
						continue;
					}
					echo '		<option>'.$wiersz3['nazwa'].'</option>';
				}
				echo'		</select><br>';
				echo '		<input type="submit" value="Zmień">';
				echo '	</form>';
				echo '	<form id="usun-prod'.$wiersz['idProduktu'].'" action="usun_towar.php" method="post">';
				echo '		<input type="hidden" value="'.$wiersz['idProduktu'].'" name="id"><br>';
				echo '		<input type="submit" value="Usuń">';
				echo '	</form>';				
				echo '</div>';
				echo '</div>';
			}
		}
		
		public static function aktualizujDane($id, $nazwa, $cena, $liczba, $opis, $zdjecie, $podkategoria)
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
			$podkategoriaZapytanie = $baza->query("select * from kategorie where nazwa='".$podkategoria."'");
			foreach($podkategoriaZapytanie as $wiersz)
			{
				$idPodkategorii = $wiersz['idKategorii'];
			}
			$baza->exec("update Produkty set nazwa='".$nazwa."', cena=".$cena.", liczba=".$liczba.", opisSlowny='".$opis."', Zdjecie='".$zdjecie."', idPodkategorii=".$idPodkategorii." where idProduktu=".$id);
		}
		
		public function dodaj()
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
			$baza->exec("insert into Produkty values (null, '".$this->nazwa."', ".$this->cena.", ".$this->liczba.", '".$this->opis."', ".$this->idPodkategorii.", '".$this->zdjecie."')");
		}
		
		public static function usun($id)
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
			$baza->exec("delete from Produkty where idProduktu=".$id);
		}
	}
?>