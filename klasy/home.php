            <div id="content">
                <h1>Sklep Internetowy</h1>
                <h3>Najlepsze oferty znajdziesz właśnie tutaj</h3>
                <hr>
				<?php
					echo $komunikatBrakTowaru;
					echo $komunikatOPowodzeniuZakupu;
					$_SESSION['brakTowaruException'] = false;
					$_SESSION['komunikatOPowodzeniuZakupu'] = false;
				?>
            </div>    
        
		<?php
			if(isset($_GET['kategoria']))
			{
				Towar::wypiszTowaryZKategorii($cel, $_GET['kategoria']);
			}
			else
			{
				if(isset($_POST['fraza']))
				{
					Towar::szukajTowaru($cel, $_POST['fraza']);
				}
				else
				{
					Towar::wypiszTowary($cel);
				}
			}
		?>


             
    <div class="clear"></div>	