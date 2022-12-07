<!--favicon-->
<link rel="icon" type="image/x-icon" href="../adresse-ip.ico"/>
<?php
//fichier des fonctions
include ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/Controllers/function.php');

$resultats = Temps_traitement();


?>
<!doctype html>
<html lang="fr">
<head>
    <link href="../style.css" rel="stylesheet" type="text/css">
</head>
<body class="Background">
    <?php 
        if($warning != '' && $warning != null)
        {
            warning($warning);
        }
    ?>
    <fieldset class="Fieldset">
        <!-- affichage du résultat de la requête -->
        <div class="Infos">
            <p>L'adresse IP viens de : <b><?php echo $resultats['Query']['country_name']; ?> (<?php echo $resultats['Query']['country_code']; ?>)</b></p>
            <p>Dans la ville de <b><?php echo $resultats['Query']['city_name'];?></b> en région <b><?php echo $resultats['Query']['region_name'];?></b></p>
            <p>Latitude : <?php echo $resultats['Query']['latitude'];?></p>
            <p>Longitude : <?php echo $resultats['Query']['longitude'];?></p>
            <p>Temps d'éxecution (en secondes) : <?php echo $resultats['time'];?></p>
            <form>
                <button onclick="window.location.href='Affichage_tester_ip.php'">Nouvel essai</button>
            </form>
            <form>
                <button type="button" onclick="window.location.href='../index.php'">RETOUR</button>
            </form>
        </div>
    </fieldset>

    
</body>
</html>