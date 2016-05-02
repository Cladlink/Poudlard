<?php
session_start();
if (isset($_GET['adherent']))
{
    if (!empty($_GET['adherent']))
    {
        include "php/connexion.php";

        $ma_commande_SQL = "SELECT ADHERENT.nomAdherent, OEUVRE.titreOeuvre, EMPRUNT.dateEmprunt
                            FROM EMPRUNT
                            JOIN ADHERENT ON EMPRUNT.idAdherent = ADHERENT.idAdherent
                            JOIN EXEMPLAIRE ON EMPRUNT.idExemplaire = EXEMPLAIRE.idExemplaire
                            JOIN OEUVRE ON EXEMPLAIRE.idOeuvre = OEUVRE.idOeuvre
                            WHERE EMPRUNT.dateRendu IS NULL
                            AND adherent.idAdherent = " . htmlentities($_GET['adherent']) . "
                            ORDER BY ADHERENT.nomAdherent;
                            ";
        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        if(!$donnees)
        {
            $ma_commande_SQL = "DELETE FROM ADHERENT
                            WHERE idAdherent = \"" . htmlentities($_GET['adherent']) . "\";";
            if($ma_connexion_mysql!= NULL)
                $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
            $_SESSION['message'] = 	"L'adherent a bien été supprimé !";
        }

        else {
            foreach($donnees as $row)
            {
                $titre[] = $row['titreOeuvre'];
                $date[] = $row['dateEmprunt'];
                $nom = $row['nomAdherent'];
                $nbLigne += 1;
            }

            $_SESSION['messageError'] = $nom . " ne peut être supprimé car des emprunts sont encore en cours : <br/>";
            for($i=0; $i<$nbLigne; $i++)
            {
                $_SESSION['messageError'] = $_SESSION['messageError'] . "Le livre \"" . $titre[$i] . "\" emprunté le " . $date[$i] ."<br/>";
            }
        }
        header('location: adherentGestion.php');
    }
}