<?php

	session_start();
	include_once('klasy/towar.php');
	include_once('klasy/kategoria.php');
	include_once('klasy/administrator.php');
	
/*    if ((!isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==false))
	{
		header('Location: index.php');
		exit();
	}*/
	//roboczo
	//$_SESSION['zalogowany'] = false;
	//$_SESSION['login'] = 'andrzej';
	//roboczo

	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		$cel = "okienko-zalogowany";
		$koszyk = '<li><a href="index.php?PageName=koszyk">Koszyk</i></a></li>';
	}
	else
	{
		$cel = "okienko-niezalogowany";
		$koszyk = "";
		
	}
	if ((isset($_SESSION['brakTowaruException'])) && ($_SESSION['brakTowaruException']==true))
	{
		$komunikatBrakTowaru = '<h3 style="color: red">Towar w liczbie, jaką chcesz zamówić, jest niedostępny!</h3>';
	}
	else
	{
		$komunikatBrakTowaru = "";
	}
	if(isset($_SESSION['komunikatOPowodzeniuZakupu']) && ($_SESSION['komunikatOPowodzeniuZakupu']==true))
	{
		$komunikatOPowodzeniuZakupu = '<h3 style="color: green">Towar został dodany do koszyka!</h3>';
	}
	else
	{
		$komunikatOPowodzeniuZakupu = "";
	}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Sklep Internetowy</title>
	<meta charset="utf-8"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/app.css">
	<!--<link rel="stylesheet" type="text/css" href="css/registercss.css">-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>

<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Sklep Internetowy</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kategorie <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
				Kategoria::wypiszKategorie();
			?>
          </ul>
        </li>
        <li><a href="index.php?PageName=kontakt">Kontakt</a></li>
        <li>
            <?php
            if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true) 
                && isset($_SESSION['zalogowany']) && $_SESSION['admin']==1){
                    Administrator::wyswietlPanelAdministratora();
                }
            ?>
        </li>
      </ul>
      <form class="navbar-form navbar-left" action="index.php" method="post">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Szukaj" name="fraza">
        </div>
        <button type="submit" class="btn btn-default">Zatwierdź</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
	   <li><a href="index.php?PageName=koszyk">Koszyk <i class="fa fa-shopping-basket" aria-hidden="true"></i></a></li>
	   <li><a href="index.php?PageName=registration">Zarejestruj się <i class="fa fa-user-plus" aria-hidden="true"></i></a></li>
<?php      
                  
	  if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true)){
          echo '<li class="dropdown">';
          echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Witaj '.$_SESSION['login'].'!<span class="caret"></span></a>';
          echo '<ul class="dropdown-menu">';
	 
	      echo '<li><a href="index.php?PageName=userpanel" role="button" >Twój profil <i class="fa fa-user" aria-hidden="true"></i></a></li>';
          echo '<li><a href="logout.php" role="button">Wyloguj się <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>';
          echo '</ul>';
          echo '</li>';
	  }else 
          echo '<li><a role="button" data-toggle="modal" data-target="#myModal">Zaloguj się<i class="fa fa-user" aria-hidden="true"></i></a></li>';
   ?>
          
        <!-- Modal -->
		
        
		<div id="myModal" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Zamknij</span></button>
                <h4 class="modal-title" id="myModalLabel" style="color: black; text-align: center">Zaloguj się na swoje konto</h4>
              </div>
              <div class="modal-body">
        <form class="form-signin" action="login.php" method="post">
            <label for="inputEmail" class="sr-only">Adres Email</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adres Email" required autofocus>
            <label for="inputPassword" class="sr-only">Hasło</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Hasło" required>
            <div class="checkbox">
              <label style="color: black">
              </label>
                <?php
		          if(isset($_SESSION['blad'])) {
                      echo '<br />';
		              echo $_SESSION['blad'];
                  }

		        ?>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj się</button>
        </form>
              </div>
              <div class="modal-footer">
                <div class="login-help">
					<a href="index.php?PageName=registration">Rejestracja</a>
                  </div>
              </div>
            </div>
          </div>
        </div>
		
        <!-- Koniec Modala -->
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>    
    <!-- Skrypt do dynamicznej zawartości strony -->
                <?php 
                $PagesDirectory = 'klasy';
                if(!empty($_GET['PageName'])) {
                    
                    $PagesFolder = scandir($PagesDirectory, 0);
                    unset($PagesFolder[0], $PagesFolder[1]);
                    $PageName = $_GET['PageName'];
                    if(in_array($PageName.'.php', $PagesFolder)) {
                     include($PagesDirectory.'/'.$PageName.'.php');
                    } else {
                        echo '<div class="container">';
                        echo '<h1 id="request">Zgubiłeś się...</h1>';
                        echo '<img src="Zdjecia/photowrong.jpg" width="680" height="430">';
                        echo '<h2>Przepraszamy. Strona nie została odnaleziona</h2>';
                        echo '</div>';
                    } 
                } else {
                     include($PagesDirectory.'/home.php');
                }

                
                ?> 
<!--    <div class="row">
        <div class="col-lg-12">
            <div id="content">

            </div>
        </div>
    </div>-->
<!--    <div class="pages">
        <nav aria-label="...">
          <ul class="pagination">
            <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
            <li class="normal"><a href="#">2 <span class="sr-only"></span></a></li>
          </ul>
        </nav>
    </div>-->
	<div class="modal fade" id="okienko-niezalogowany" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<font color="black">Zakup nie powiódł się</font>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<div class="modal-body">
				<font color="black"><strong>Zaloguj się</strong>, aby kupić ten przedmiot.</font>
			</div>
			</div>
		</div>
	</div>
	<?php
		Towar::zapamietajTowar();
		if(isset($_SESSION['blad']))
		{
			echo '<script type="text/javascript">';
			echo "	$(window).on('load',function(){";
			echo "		$('#myModal').modal('show');";
			echo '	});';
			echo '</script>';
		}
	?>
    <div class="clear"></div>	
			<div class="modal fade" id="myModalr" role="dialog">
			<div class="modal-dialog modal-sm">
			  <div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Brawo!</h4>
						</div>
						<div class="modal-body">
						<p style="color:green;">Rejestracja zakończyła się sukcesem !</p>
						</div>
				<div class="modal-footer">
				 <a href="index.php" type="button" class="btn btn-default" data-dismiss="modal">Zamknij</a>
				</div>
			  </div>
			</div>
		  </div>
		</div>				
		<?php
		if(isset($_SESSION['udanarej']))
		{

			echo '<script type="text/javascript">';
			echo "	$(window).on('load',function(){";
			echo "		$('#myModalr').modal('show');";
			echo '	});';
			echo '</script>';
					unset($_SESSION['udanarej']);
		}
		
	?>
</body>
</html>