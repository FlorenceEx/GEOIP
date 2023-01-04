<!--favicon-->
<link rel="icon" type="image/x-icon" href="adresse-ip.ico"/>
<?php
//fichier des fonctions
include ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/Controllers/function.php');


//traitement mauvais format d'ip
if(isset($_GET['di'])){
    $warning = "Mauvais format de l'ip";
}
$resultats_donnees = nb_donnees();
$total = number_format($resultats_donnees['total'],'0','.',' ');
?>


<!doctype html>
<html lang="fr">
<head> 
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body class="Background">
    <?php
    //message d'erreur
    if($warning != '' && $warning != null)
    {
        echo '<div class="warning">'.$warning.'</div>';
    }
    ?>
    <!-- formulaire de recherche -->
    <fieldset class="Fieldset" >
        <div class="Infos">
            <h1 class="Titre">Check my IP location</h1>
            <p>Nombre d'enregistrements : <?php echo $total; ?></p> 

            <h3 class="Titre">Rechercher une adresse IP</h3>
            <form class="form" action="Views/Affichage_infos.php" method="post">
                <input type="text" id="ip" name="ip" placeholder="0.0.0.0" required>
                <button type="submit" value="Envoyer">Envoyer</button>
            </form>
            <!-- formulaire de recherche de l'ip de sa machine -->
            <form method='post' action='Views/Affichage_infos.php'>
                <button class="form" type="submit">Chercher mon IP</button>
            </form>
            <form method='post' action='Views/Affichage_tester_ip.php'>
                <button class="form" type="submit">Tester des IPs</button>
            </form>
        </div>
    </fieldset>
    
</body>
</html>