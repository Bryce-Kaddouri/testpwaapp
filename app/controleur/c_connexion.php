<?php
/*
 * GSB Project 2022
*/
if (!isset($_REQUEST['action'])) {
    $_REQUEST['action'] = 'demandeConnexion';
}
$action = $_REQUEST['action'];
switch ($action) {
    case 'demandeConnexion': {
            include("vues/v_connexion.php");
            break;
        }
    case 'valideConnexion': {
            $login = $_REQUEST['login'];
            $mdp = $_REQUEST['mdp'];
            $joueur = $pdo->getInfosJoueur($login, $mdp);
            if (!is_array($joueur)) {
                ajouterErreur("Login ou mot de passe incorrect");
                include("vues/v_erreurs.php");
                include("vues/v_connexion.php");
                break;
            } else {
                $id = $joueur['id'];
                $nom = $joueur['login'];
                connecter($id, $nom);


                include("vues/v_home_profilebar.php");
                $enigme = $pdo->getEnigme();
                $idEquipe = $_SESSION['id'];
                $nivActuel = $pdo->getNivActuel($_SESSION['id']);
                include("vues/v_enigme.php");
                include("vues/v_pied.php");
                break;
            }
            break;
        }
    default: {
            include("vues/v_connexion.php");
            break;
        }
}
