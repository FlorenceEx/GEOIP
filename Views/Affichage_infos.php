<!--favicon-->
<link rel="icon" type="image/x-icon" href="../adresse-ip.ico"/>
<?php
include ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/Controllers/function.php');

$uri = $SERVER['REQUEST_URI'];
//error_403($uri);

if(!empty($_POST)){
    if(!preg_match("/(\b25[0-5]|\b2[0-4][0-9]|\b[01]?[0-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)){3}/",$_POST['ip']))
    {
        $host  = $_SERVER['HTTP_HOST'];
        header("Location: http://$host/index.php?di=1");
        //header("Location: https://www.youtube.com/watch?v=p7YXXieghto");
    }
    $resultats = Infos_IP($_POST['ip']);

}
else{
    $resultats = Infos_IP($_SERVER['SERVER_ADDR']);
    if($resultats['Query']['country_name'] == '-' && $resultats['Query']['country_code'] == '-' && $resultats['Query']['city_name'] == '-' && $resultats['Query']['region_name'] == '-' && $resultats['Query']['latitude'] == 0 && $resultats['Query']['longitude'] == 0){
        $warning = 'Votre IP n\'est pas enregistrée dans la base';
    }
}

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
            <button onclick="window.location.href='../index.php'">Retour</button>
        </div>
    </fieldset>

    
</body>
</html>
