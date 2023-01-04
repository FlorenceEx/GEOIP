<?php
    $url_function = $_SERVER['REQUEST_URI'];
    error_403($url_function);

    //connexion à la base de données
    function Connexion()
    {
        $json = file_get_contents($_SERVER['CONTEXT_DOCUMENT_ROOT'].'/appsettings.json');
        $obj = json_decode($json);
        
        try
        {
            $dbh = new PDO('mysql:host='.$obj->Host.';dbname='.$obj->Dbname.';', $obj->User, $obj->Pass, array(PDO::MYSQL_ATTR_LOCAL_INFILE => true,PDO::FETCH_ASSOC => true));
        }
        catch (Exception $e)
        {
            exit("Erreur : Connexion à la base échouée.");
        }

        return $dbh;
    }

    //récupérer les informations de l'ip en base
    function Infos_IP($ip)
    {
        // Traitement de l'IP comme dans GitHub : Séparation de l'adresse IP en 4 parties qu'on multiplie chacune par le nombre de fois 256 demandé
        $test = explode(".",$ip);
        $ip = $test[3] + $test[2]*256 + $test[1]*256*256 + $test[0]*256*256*256;
        
        $dataResult = array();
        $error = '';
        $warning = '';
        $message = '';
        //départ
        $depart = microtime(true);
        $dbh = Connexion();
        $sql = "SELECT country_code, country_name, region_name, city_name, latitude, longitude FROM geoip WHERE ip_from <= :ip AND ip_to >= :ip";
        $stmt = $dbh->prepare($sql);
        if (!$stmt) {
            // Handle errors
            echo "erreur dans la matrice";
          }

        $stmt -> execute([':ip' => $ip]);
        $resultats= $stmt->fetch();

        $dataResult['Query'] = $resultats;
        $dataResult['error'] = $error;
        $dataResult['warning'] = $warning;
        $dataResult['message'] = $message;

          if($resultats['country_code'] != 'FR')
          {
            echo '<script>window.location.href="../Views/error_403.php"</script>';
          }
        $fin = microtime(true);

        $tpsExec = number_format((float) $fin - $depart, 5);
        $dataResult['time'] = $tpsExec;

        //gestion des erreurs
        if(empty($resultats))
        {
            $error = "Erreur lors de la récupération des informations de l\'ip";
            echo $error;
        }
        return $dataResult;
        $dbh = null;
    }

    function Temps_traitement()
    {
        $ip = rand(0, 255)+rand(0,255)*256+rand(0,255)*256*256+rand(0,255)*256*256*256;
        $dataResult = array();
        $error = '';
        $warning = '';
        $message = '';

        $depart = microtime(true);
        $dbh = Connexion();
        $sql = "SELECT country_code, country_name, region_name, city_name, latitude, longitude FROM geoip WHERE ip_from <= :ip AND ip_to >= :ip";
        $stmt = $dbh->prepare($sql);
        if (!$stmt) {
            // Handle errors
            echo "erreur dans la matrice";
          }
        $stmt -> execute([':ip' => $ip]);
        $resultats= $stmt->fetch(PDO::FETCH_ASSOC);

        $dataResult['Query'] = $resultats;
        $dataResult['Ip'] = $ip;
        $dataResult['error'] = $error;
        $dataResult['warning'] = $warning;
        $dataResult['message'] = $message;

        $fin = microtime(true);
        //echo'<br>';
        $tpsExec = number_format((float) $fin - $depart, 5).' <br>';
        $dataResult['time'] = $tpsExec;
        //return array($array,$resultats);
        return $dataResult;
    }

    //récupérer le nombre d'enregistrements de la base
    function nb_donnees()
    {
        
        $dbh = Connexion();
        $sql = "SELECT COUNT(*) AS total FROM geoip";
        $query = $dbh->query($sql); //execute la requête
        $resultats_donnees = $query->fetch();
        return $resultats_donnees;
        $dbh = null;
    }
    



    //gérer les messages d'erreur
    function warning($warning)
    {
        echo'<div class="warning">'.$warning.'</div>';
    }

?>