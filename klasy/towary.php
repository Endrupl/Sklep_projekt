<?php
	//session_start();
	include_once('klasy/towar.php');
?>
    <div class="container">
		<div class="jumbotron">
            <h2>Zarządzaj produktami w bazie</h2>
            <br>
            <br>
            <ul class="nav nav-pills">
                <li role="presentation"><button type="button" class="btn btn-primary" data-toggle="collapse" aria-pressed="false" autocomplete="off" data-target="#demo" value="dodaj-nowy">
                    Dodaj nowy produkt
                    </button></li>
                <li role="presentation"><button type="button" class="btn btn-primary" data-toggle="collapse" aria-pressed="false" autocomplete="off" data-target="#demo1">
                    Wyświetl produkty
                    </button></li>
            </ul>
            <div id="demo" class="collapse">
			<form id="dodaj-nowy-formularz" action="dodaj_towar.php" method="post">
                <div class="form-group">
                    <br>
                    <div class="col-xs-3">
                        <label for="ex2">Nazwa</label>
                        <input class="form-control" id="ex2" type="text" name="nazwa">
                    </div>
                    <div class="col-xs-3">
                        <label for="ex3">Cena</label>
                        <input class="form-control" id="ex3" type="text" name="cena">
                    </div>
                    <div class="col-xs-3">
                        <label for="ex4">Liczba</label>
                        <input class="form-control" id="ex4" type="text" name="liczba">
                    </div>
                    <div class="col-xs-3">
                        <label for="ex5">Opis</label>
                        <input class="form-control" id="ex5" type="text" name="opis">
                    </div>
                    <div class="col-xs-3">
                        <label for="ex6">URL zdjęcia</label>
                        <input class="form-control" id="ex6" type="text" name="zdjecie">
                    </div>
                    <div class="col-xs-6">
                    <label for="sel1">Kategoria:</label>
                    <select class="form-control" id="sel1" name="kategoria">
                    <?php
                    $baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
                    $baza->query("SET CHARSET utf8");
                    $baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 			
                    $podkategorieZapytanie = $baza->query("select * from Kategorie");
                    foreach($podkategorieZapytanie as $wiersz3)
                    {
                        echo '		<option>'.$wiersz3['nazwa'].'</option>';
                    }
                    ?>
                    </select>
                    </div>
                    <div class="col-xs-3">
                        <label for="ex7">Czy chcesz dodać produkt?</label>
                        <input type="submit" id="ex7" class="btn btn-success" value="Dodaj">
                    </div>
                    <br><br><br><br><br><br>
                    
                    
                </div>     
			</form>
            </div>
        
            <div id="demo1" class="collapse">
            <?php
                Towar::wypiszTowaryAdministrator();
            ?>
            </div>
        </div>
    </div>    
            
        
		<script src="js/edycja_towaru.js"></script>
	