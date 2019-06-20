<?php
	
	session_start();
	//include_once('klasy/kategoria.php');
	include_once('klasy/wyswietlprodukt.php');	
	include_once('klasy/towar.php');
	
				if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
			{
				$cel = "okienko-zakupu";
			}
			else
			{
				$cel = "okienko-niezalogowany";
				
			}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Online Shop</title>
	<meta charset="utf-8"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/app.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/skrypt1.js"></script>
</head>


<body>
   
	  <div class="kontener">
		<main>

				

					<?php
					if (isset($_GET['produkt_id']))
					{
					 $idprod=$_GET['produkt_id'];
					Produkt::wypiszProdukt($idprod);
					}else
					{
						echo '<span style="margin-left:100px;font-size:25px;color:red;">Ups nie wybrałeś żadnego produktu lub coś poszło nie tak :( !</span>';
					}


					?>
					
		</main>
		</div>
 <div id="myModalmax" class="modal1">
  <span class="close1">&times;</span>
  <img class="modal-content1" id="img01">
  <div id="caption1"></div>
</div>

					<?php
					if (isset($_GET['produkt_id']))
					{
						$idprod2=$_GET['produkt_id'];
					if($cel == "okienko-zakupu"){
						Produkt::oknoZakupu($idprod2);		
					}else{
						Produkt::oknoZakupuNiezalogowany($cel);
					}	

					}else
					{
						echo '<span style="margin-left:100px;font-size:25px;color:red;">Ups nie wybrałeś żadnego produktu lub coś poszło nie tak :( !</span>';
					}


					?>
<script>
function lightbox(idx) {
var img=document.getElementById(''+idx+'');
var modal = document.getElementById('myModalmax');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption1");

    modal.style.display = "block";
    modalImg.src = img.src;
    captionText.innerHTML = img.alt;

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close1")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
    }

</script>
 </body>
</html>