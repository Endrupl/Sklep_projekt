<?php
	class Administrator
	{
		public static function wyswietlPanelAdministratora()
		{
			echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administrator <span class="caret"></span></a>';
			echo '<ul class="dropdown-menu">';
			echo '	<li><a href="index.php?PageName=zamowienia">Zamówienia</a></li>';
			echo '	<li><a href="index.php?PageName=towary">Towary</a></li>';
			echo '	<li><a href="index.php?PageName=uzytkownicy">Użytkownicy</a></li>';
			echo '	<li><a href="index.php?PageName=kategorie">Kategorie</a></li>';
			echo '</ul>';
		}
	}
?>