<?php
	class Produkt
	{
		
		public static function oknoZakupu($idProdukt)
		{
			$idProdukt3 = $idProdukt;
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy;charset=utf8;', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 			
			$towary = $baza->query("select * from Produkty where idProduktu='$idProdukt3'");
			foreach($towary as $wiersz)
			{
				echo '<div class="modal fade" id="okienko-zakupu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
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
				public static function oknoZakupuNiezalogowany($cel)
		{
			$idmodal = $cel;

		echo '	<div class="modal fade" id="'.$idmodal.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
		echo '<div class="modal-dialog" role="document">';
		echo '	<div class="modal-content">';
		echo '		<div class="modal-header">';
		echo '			<font color="black">Zakup nie powiódł się</font>';
		echo '			<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
		echo '				<span aria-hidden="true">&times;</span>';
		echo '			</button>';
		echo '		</div>';
		echo '	<div class="modal-body">';
		echo '		<font color="black"><strong>Zaloguj się</strong>, aby kupić ten przedmiot.</font>';
		echo '	</div>';
		echo '	</div>';
		echo '</div>';
		echo '</div>';
		}
		public static function wypiszProdukt($idProdukt)
		{
			$idProdukt2 = $idProdukt;
			if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
			{
				$cel = "okienko-zakupu";
			}
			else
			{
				$cel = "okienko-niezalogowany";
				
			}
		try
		{	
			$polaczenie = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$polaczenie->query("SET CHARSET utf8");
			$polaczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
			$produkt = $polaczenie->query("select * from produkty where idProduktu='$idProdukt2'");			
			
			foreach($produkt as $wiersz)
			{

			echo '<div class= "produktinfo"><h3 style="padding-top:30px;">'.$wiersz['nazwa'].'</h3>';
				echo '<div class="produktimg"><a href="#" onclick="lightbox('.$wiersz['idProduktu'].')"><img id="'.$wiersz['idProduktu'].'" src="'.$wiersz['Zdjecie'].'" /></a></div>';
					echo '<div class="produkttekst">';
						echo  '<br />Cena: <b>'.$wiersz['cena'].' zł.</b>';
							
							if($wiersz['liczba']<=10)
							{
								echo  '<br />Dostępność: <span style="color:red;">'.$wiersz['liczba'].' szt.</span>';
								
							}else
							{
								echo  '<br />Dostępność: <b>'.$wiersz['liczba'].' szt.</b>';				
							}
							
								if($cel == "okienko-zakupu")
								{
										echo  '<a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#'.$cel.'">Dodaj do koszyka</a></div>';
								}
								else
								{
										echo  '<a href="#" type="button" class="btn btn-primary" data-toggle="modal" data-target="#'.$cel.'">Dodaj do koszyka</a></div>';
								}
			
				echo '<div class="produktopis"><h4>Opis produktu:</h4><p>'.$wiersz['opisSlowny'].'</p>';
			echo '</div>';
			}
		}catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy :( ! Spróbuj później jeszcze raz</span>';
				echo '<br />Informacja developerska:'.$e;
		}

			
		}
	}
?>