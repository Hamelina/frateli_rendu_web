<!DOCTYPE html>
<?php
	require_once('../controller/evtController.php');
	$controllerPage = new evtController();

?>
<html>
    <head>
        <meta charset="utf-8">
		<script src="cmap/jquery-1.11.1.min.js" type="text/javascript"></script>
		<link rel="stylesheet" href="boostrap/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="boostrap/bootstrap.min.js" type="text/javascript"></script>
        <title>Evenements</title>
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
			<div class="mainContent">
				<?php
					$controllerPage->getAllEvents();
				?>
			</div>
	    </div>
		<?php
			include("addFilleul.php");
			include("addEvent.php");
		?>
   	</body>


</html>