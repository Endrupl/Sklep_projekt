<?php
	class NowaKategoria
	{
		public $nazwa;
		 
		 public function __construct($nazwa)
		 {
			 $this->nazwa = $nazwa;
		 }
		 
		 public function dodaj()
		 {
			 $baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			 $baza->query("SET CHARSET utf8");
			 $baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
			 $baza->exec("insert into Kategorie values (null, '".$this->nazwa."')");
		 }
	}
	
	class Kategoria extends NowaKategoria
	{
		public $id;
		public $nazwa;
		
		public function __construct($id)
		{
			$this->id = $id;
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
			$zapytanie = $baza->query("select * from Kategorie where idKategorii=".$id);
			foreach($zapytanie as $wiersz)
			{
				$this->nazwa = $wiersz['nazwa'];
			}
		}
		
		public static function wypiszKategorie()
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
			$kategoriaZapytanie = $baza->query("select * from Kategorie");
			foreach($kategoriaZapytanie as $wiersz)
			{
				echo '<li><a href="index.php?kategoria='.$wiersz['idKategorii'].'">'.$wiersz['nazwa'].'</a></li>';
			}
		}
		
		public static function wypiszKategorieAdministrator()
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
			$kategoriaZapytanie = $baza->query("select * from Kategorie");
			foreach($kategoriaZapytanie as $wiersz)
            {
				echo '<form action="aktualizuj_kategorie.php?id='.$wiersz['idKategorii'].'" method="post">';
				echo '<label>Kategoria: '.$wiersz['nazwa'].'</label><br>';
				echo '	<label>Nazwa</label>';
				echo '	<input type="text" value="'.$wiersz['nazwa'].'" class="form-control" name="nazwa"><br>';
                echo '  <div class="form-group">';
                echo '  <div class="col-xs-1">';
				echo '	<input type="submit" class="btn btn-warning" value="Zmień">';
                echo '</div>';
				echo '</form>';
				echo '<form action="usun_kategorie.php?id='.$wiersz['idKategorii'].'" method="post">';
                echo '  <div class="col-xs-1">';
				echo '	<input type="submit" class="btn btn-danger" value="Usuń">';
				echo '</div>';
				echo '</div>';
				echo '</form>';
                echo '<br>';
                echo '<br>';
                echo '<br>';
			}
		}
		
		public function aktualizujDane($nazwa)
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
			$baza->exec("update Kategorie set nazwa='".$nazwa."' where idKategorii=".$this->id);
		}
		
		public function usun()
		{
			$baza = new PDO('mysql:host=localhost;dbname=sklepinternetowy', 'root', '');
			$baza->query("SET CHARSET utf8");
			$baza->query("SET NAMES `utf8` COLLATE `utf8_polish_ci`"); 
			$baza->exec("delete from Kategorie where idKategorii=".$this->id);
		}
	}
?>