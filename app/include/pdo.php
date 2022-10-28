<?php
class PdoGsb
{
    private static $serveur = 'mysql:host=localhost';
    // private static $serveur = 'mysql:host=172.18.156.100';
    private static $bdd = 'dbname=hackathon_2022';
    // private static $bdd = 'dbname=ap5_BDMEDOCLAB3';
    private static $user = 'root';
    // private static $user = 'gsb_dbuser3';
    private static $mdp = 'root';
    // private static $mdp = '239xc_w13';
    private static $monPdo;
    private static $monPdoGsb = null;
    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    private function __construct()
    {
        PdoGsb::$monPdo = new PDO(PdoGsb::$serveur . ';' . PdoGsb::$bdd, PdoGsb::$user, PdoGsb::$mdp);
        PdoGsb::$monPdo->query("SET CHARACTER SET utf8");
    }
    public function __destruct()
    {
        PdoGsb::$monPdo = null;
    }
    /**
     * Fonction statique qui crée l'unique instance de la classe
 
     * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
 
     * @return l'unique objet de la classe PdoGsb
     */
    public  static function getPdoGsb()
    {
        if (PdoGsb::$monPdoGsb == null) {
            PdoGsb::$monPdoGsb = new PdoGsb();
        }
        return PdoGsb::$monPdoGsb;
    }
    /**
     * Retourne les informations d'un comptable
 
     * @param $login 
     * @param $mdp
     * @return l'id, le nom et le prénom sous la forme d'un tableau associatif 
     */
    public function getInfosJoueur($login, $mdp)
    {
        $req = "select login, id from equipe where login='$login' and pwd='$mdp';";

        $rs = PdoGsb::$monPdo->query($req);
        $ligne = $rs->fetch();
        return $ligne;
    }

    public function getEnigme()
    {
        $req = "select * from enigme order by nom;";
        $rs = PdoGsb::$monPdo->query($req);
        $ligne = $rs->fetchAll();
        return $ligne;
    }

    public function getIdEquipe($nom)
    {
        $req = "select id from equipe where nom='$nom';";
        $rs = PdoGsb::$monPdo->query($req);
        $ligne = $rs->fetch();
        return $ligne;
    }

    public function getNivActuel($idEquipe)
    {
        $req = "select enigme_id from compopartie where equipe_id=$idEquipe;";
        // echo $req;
        $rs = PdoGsb::$monPdo->query($req);
        $ligne = $rs->fetch();
        return $ligne;
    }
}
