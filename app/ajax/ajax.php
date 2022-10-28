<?php

switch ($_REQUEST['action']) {
    case 'tabScore': {
            $body = '';

            // conneicon bd 
            $pdo = new PDO('mysql:host=localhost;dbname=hackathon', 'root', '');


            $sql = "SELECT compopartie.* , equipe.nom from  compopartie inner join partie on partie_id = partie.id inner join equipe on equipe_id = equipe.id where partie_id=1 order by scoreActuel desc;";
            $res = $pdo->query($sql);
            // $lignes = $res->fetchAll();
            $i = 1;
            while ($ligne = $res->fetch()) {
                if ($i == 1) {
                    $color = '#70c17b';
                } else if ($i == 2) {
                    $color = '#f2e783';
                } else if ($i == 3) {
                    $color = '#fecb7e';
                } else {
                    $color = 'white';
                }
                $body .= '<tr style="background-color:' . $color . '">';
                $body .= '<td >' . $i . '</td>';
                $body .= '<td>' . $ligne['nom'] . '</td>';
                $body .= '<td>' . $ligne['scoreActuel'] . '</td>';
                $body .= '</tr>';
                $i++;
            }
            echo $body;
            break;
        }

    case 'testFlag': {
            $flag = $_REQUEST['flag'];
            $pdo = new PDO('mysql:host=localhost;dbname=hackathon', 'root', '');
            $sql = "SELECT * from enigme where flag='$flag';";
            $res = $pdo->query($sql);
            $lignes = $res->fetchAll();
            if (count($lignes) > 0) {
                echo 'true';
            } else {
                echo 'false';
            }
            break;
        }

    case 'addPoint': {
            $id = $_POST['idEnigme'];
            $idEquipe = $_POST['idEquipe'];
            // $equipe = $_request['equipe'];
            $pdo = new PDO('mysql:host=localhost;dbname=hackathon', 'root', '');
            $sql = "UPDATE compopartie SET enigme_id=enigme_id +1, scoreActuel=scoreActuel + (select point from enigme where id=$id) where equipe_id=" . $idEquipe . ";";
            echo $sql;

            $res = $pdo->exec($sql);
            // query sql avec gestion erreur
            if ($res) {
                echo 'true';
            } else {
                echo 'false';
            }
            break;
        }

    default: {
            // include("vues/v_connexion.php");
            // break;
        }
}
