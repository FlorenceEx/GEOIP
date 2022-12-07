<?php
//fichier des fonctions
include ($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/Controllers/function.php');

$resultats = Temps_traitement();
echo '<br>';
echo $resultats['country_name'].'<br>';
echo $resultats['country_code'].'<br>';
echo $resultats['city_name'].'<br>';
echo $resultats['region_name'].'<br>';
echo $resultats['latitude'].'<br>';
echo $resultats['longitude'].'<br>';


?>