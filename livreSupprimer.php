<?php
session_start();
if (isset($_GET['oeuvre']))
{
    if (!empty($_GET['oeuvre']))
    {
        include "php/connexion.php";

        $ma_commande_SQL = "SELECT OEUVRE.titreOeuvre
                            FROM EMPRUNT
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
            $_SESSION['message'] = 	"l'adherent a bien été supprimé !";
        }
        else
        {
            $_SESSION['messageError'] = "Ne peut être supprimé car des emprunts sont encore en cours ! ";
        }


        header('location: adherentGestion.php');
    }
}