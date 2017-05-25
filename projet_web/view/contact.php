
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
        <div class="element">
            <h2> Devenir ambassadeur </h2>
            <p> Devenir <em> ambassadeur </em> c'est possible ! Tu peux dès à présent te renseigner auprès des ambassadeurs de ta région.
            </p>
        </div>
    </div>
</body>
</html>
