<?php  

/*    session_start();
	if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==false))
	{
		header('Location: index.php');
		exit();
	}*/

?>	   
	  <div class="kontener">
		<div class="west">
			<main>		
			<aside>
			
				<nav>
					
					
					<h3>Moje konto</h3>
					
					<ul>
					
						<li><a href="akcjeuser.php?akcja_id=1" role="button" >Zmień hasło</a></li>
						<li><a href="akcjeuser.php?akcja_id=2" role="button" >Zmień e-mail</a></li>

					</ul>
				
					<h3>Produkty</h3>
					
					<ul>
						<li><a href="akcjeuser.php?akcja_id=3" role="button">Kupione</a></li>
					</ul>
					

				
				</nav>
				
			
			</aside>
					</main>
		
		</div>
		<div class="east">
		<article>
				
					<header>
					<?php
						echo '<h1>Witaj '.$_SESSION['login'].'!</h1>';
					?>
						<p>Jestes teraz w panelu użytkownika! Możesz tutaj zmienić swoje podstawowe dane lub przejrzeć historię swoich zakupów.</p>
					
					</header>
					<div id="malykontener">
					
					<?php
					if ($_SESSION['akcja']==0)
					{
						echo '<br /><p style="font-size:20px;">Wybierz jedną z opcji po lewej stronie!</p><br/>';
					}else
					{
						if ($_SESSION['akcja']==1)
					{
						if ($_SESSION['udanazmiana']==true)
						{
						echo '<br /><span style="color:green;font-size:22px;">Brawo! Hasło zostało zmienione!</span><br />';	
						}
						echo '<br /><p>Zmień swoje stare hasło na nowe :</p><br/>';
						echo '<form method="post" action="akcjeuser.php?akcja_id=1">';
						echo '<br /><input type="password" placeholder="Old password..." name="oldpass"/><br/>';
								if (isset($_SESSION['e_haslo']))
								{
									echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
									unset($_SESSION['e_haslo']);
								}

						echo '<br /> <input type="password" placeholder="New password..." name="npass1"/><br/>';
								if (isset($_SESSION['e_haslo2']))
								{
									echo '<div class="error">'.$_SESSION['e_haslo2'].'</div>';
									unset($_SESSION['e_haslo2']);
								}
						echo '<br /> <input type="password" placeholder="Repeat password..." name="npass2"/><br/>';
						echo '<input type="submit" value="Change Password">';
						echo '</form>';
					}else if ($_SESSION['akcja']==2)
					{
						if ($_SESSION['udanazmiana']==true)
						{
						echo '<br /><span style="color:green;font-size:22px;">Brawo! E-mail został zmieniony!</span><br />';	
						}
						echo '<br /><p>Zmień swoj stary email na nowy :</p><br/>';
						echo '<form method="post" action="akcjeuser.php?akcja_id=2">';
						echo '<br /><input type="text" placeholder="Old email..." name="oldemail"/><br/>';
								if (isset($_SESSION['e_oldemail']))
								{
									echo '<div class="error">'.$_SESSION['e_oldemail'].'</div>';
									unset($_SESSION['e_oldemail']);
								}

						echo '<br /> <input type="text" placeholder="New email..." name="neamil"/><br/>';
								if (isset($_SESSION['e_nemail']))
								{
									echo '<div class="error">'.$_SESSION['e_nemail'].'</div>';
									unset($_SESSION['e_nemail']);
								}
						echo '<input type="submit" value="Change Email">';
						echo '</form>';
					}else if ($_SESSION['akcja']==3)
						{
							
								echo '<br /><p>Poniżej znajdziesz listę swoich zakupów!</p><br/>';
								
								require_once "connect.php";
								mysqli_report(MYSQLI_REPORT_STRICT);

								$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
								$idkoszyka=$_SESSION['idkoszyk'];
								$polaczenie->query("SET CHARSET utf8");
								$polaczenie->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
								$dane =$polaczenie->query("SELECT * from produkty p right join zamowienia z on p.idProduktu=z.idProduktu where z.idKoszyka='$idkoszyka'");
								$ile_przedmiotow=$dane->num_rows;								
								
								
								if ($ile_przedmiotow>0)
								{																		
									while ($wiersz = $dane->fetch_array()){
										$sum=$wiersz['cena']*$wiersz['liczba'];
									echo '<div class="produkt">';
									echo '<div class="prodimg">';
									echo '<img src="'.$wiersz['Zdjecie'].'"></div>';
									echo '<div class="prodtekst"><b>'.$wiersz['nazwa'].'</b><br /> Id produktu: '.$wiersz['idProduktu'].'<br />';
									echo 'Nr. zamównienia: '.$wiersz['idZamowienia'].'| Data zamówienia: '.$wiersz['dataZamowienia'].'<br />';
									echo 'Ilość: '.$wiersz['liczba'].' | 	Suma zamówienia:<span style="font-size:18px;"> '.$sum.' zl</span> </div>';
									echo '</div><div style="clear:both;"></div>';
									
									}
									
									$dane->free_result();
								}
								else
								{
									echo '<br/><p style="font-size:20px;">Ups wygląda na to żę twoja historia zakupów jest pusta :( !</p>';
								}
								
								$polaczenie->close();									
						}

					}

					?>
					
					</div>
		</article>
		</div>
			
		<div style="clear:both;"></div>
	</div>
