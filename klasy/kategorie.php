<?php
	include_once('klasy/kategoria.php')
?>
<div class="container">
<div class="jumbotron">
		<h3>Dodaj nową kategorię</h3><br>
    
		<form action="dodaj_kategorie.php" method="post">
            
			<div class="form-group">
                 <label>Nazwa</label>
			     <input type="text" name="nazwa" class="form-control" placeholder="Wprowadź tekst">
            </div>
			<input type="submit" class="btn btn-success" value="Dodaj">
                
		</form>
    <br>
    
        <h3>Edytuj kategorie</h3>
    <br>
		<?php
			Kategoria::wypiszKategorieAdministrator();
		?>

</div>
</div>