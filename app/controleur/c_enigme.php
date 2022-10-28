<?php
$action = $_REQUEST['action'];
if (!isset($action)) {
    $action = '';
} else {

    echo $action;

    switch ($action) {
        case 'tabScore': {
                include("vues/v_home_profilebar.php");
                include("vues/v_tabScore.php");

                break;
            }
        case 'afficherEnigme': {
                $enigme = $pdo->getEnigme();
                $idEquipe = $_SESSION['id'];
                $nivActuel = $pdo->getNivActuel($idEquipe);

                include("vues/v_enigme.php");

                break;
            }
        default: {
                include("vues/v_connexion.php");
                break;
            }
    }
}
