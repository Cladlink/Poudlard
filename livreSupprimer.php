<?php
session_star();
if (isset($_GET['oeuvre']))
{
    if (!empty($_GET['oeuvre']))
    {
        include "php/connexion.php";

        $ma_commande_SQL = "SELECT EXEMPLAIRE.idExemplaire
                            FROM EMPRUNT
                            JOIN EXEMPLAIRE ON EMPRUNT.idExemplaire = EXEMPLAIRE.idExemplaire
                            WHERE EMPRUNT.dateRendu IS NULL
                            AND EXEMPLAIRE.idOeuvre = " . htmlentities($_GET['oeuvre']) . ";";
        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        if(!$donnees)
        {
            $ma_commande_SQL = "DELETE FROM EXEMPLAIRE
                            WHERE EXEMPLAIRE.idOeuvre = \"" . htmlentities($_GET['oeuvre']) . "\";";

            if($ma_connexion_mysql!= NULL) {
                $nbr_lignes_affectees = $ma_connexion_mysql->exec($ma_commande_SQL);
            }
            $_SESSION['message'] = 	"Le livre et ses exemplaires ont bien été supprimés !";
        }
        else
        {
            $_SESSION['messageError'] = "Ne peut être supprimé car des emprunts sont encore en cours ! ";
        }


        header('location: livreGestion.php');
    }
}