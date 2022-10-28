<?php
require_once("include/fct.inc.php");
require_once("include/pdo.php");
include("vues/v_entete.php");
session_start();
$pdo = PdoGsb::getPdoGsb();
$estConnecte = estConnecte();
if (!isset($_REQUEST['uc']) || !$estConnecte) {
    $_REQUEST['uc'] = 'connexion';
}
$uc = $_REQUEST['uc'];
echo $uc;
switch ($uc) {
    case 'connexion': {
            include("controleur/c_connexion.php");
            break;
        }
    case 'enigme': {
            include("controleur/c_enigme.php");
            break;
        }
    case 'partieStat': {
            include("controleur/c_stat.php.php");
            break;
        }
        break;
}
include("vues/v_pied.php");
