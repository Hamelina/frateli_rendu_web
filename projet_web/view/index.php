<!DOCTYPE html>
<?php
	require_once('../controller/AcademieController.php');
	$controllerPage = new AcademieController();
?>
<html lang="en">
    <head>
        <meta charset="utf-8" / name="acceuil" content=" Tu es un fratélien ? Tu n'a jamais entendu parler de Fratéli mais tu veux en connaître d'avantage ? Viens, regarde les évènements qui sont proposées dans ta région.">
		<script src="cmap/jquery-1.11.1.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="boostrap/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

		<script src="boostrap/bootstrap.min.js" type="text/javascript"></script>
        <title>Acceuil</title>

    </head>
    <body>
    	<div id="bloc_page">
	    	<header>
	    		<div id="menuContainer">
					<?php
						$controllerPage->loadMenu();
					?>
	    		</div>
	    	</header>
	    	
		    <div class="presentation">
		    	<h1 class="titre"> Bienvenue ! </h1>
		    	<p> Tu es un fratélien ou tu ne sais pas encore ce qu'est <a href="https://www.frateli.org" title="N'hésitez surtout pas ! " target="_blank"> Frateli </a> ? Ici tu pourras voir les évènements fratélis organisés dans les différentes régions ... et pourquoi pas en proposer ! :) 
		    	</p>
		    </div>

	    	<div id="conteneur">
				<h2> Evènements à venir </h2>
				<div class="dropdownListContainer">
					<form method="post" action="index.php" style="display:inline-block">
						<?php
							$controllerPage->initPageAcademie();
						?>
						<button type="submit" class="btn btn-default">sélectionner</button>
					</form>
					<button class="btn btn-lg btn-primary btn-block btnLogin" data-toggle="modal" data-target="#myModalAddEvent">Créer un évènement</button>
				</div>

		    	<div class="mainContent">
					<?php
						if(isset($_POST["academySelection"])){
							$controllerPage->getEvtOfAcademy($_POST["academySelection"]);
						}
						else{
							$controllerPage->getEvtOfAcademy(0);
						}
					?>
		    	</div>

			</div>

			<footer>
			</footer>
		</div>
		<?php
			include("addFilleul.php");
			include("addEvent.php");
		?>
	</body>

</html>