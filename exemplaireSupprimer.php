<?php
session_start();
if (isset($_GET['exemplaire']))
{
    if (!empty($_GET['exemplaire']))
    {
        include "php/connexion.php";

        $ma_commande_SQL = "SELECT EXEMPLAIRE.idExemplaire
                            FROM EMPRUNT
                            JOIN EXEMPLAIRE
                            ON EMPRUNT.idExemplaire = EXEMPLAIRE.idExemplaire
                            WHERE EMPRUNT.dateRendu IS NULL
                            AND EXEMPLAIRE.idExemplaire = " . htmlentities($_GET['exemplaire']) . ";";
        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        if(!$donnees)
        {
            $ma_commande_SQL = "DELETE FROM EXEMPLAIRE
                            WHERE EXEMPLAIRE.idExemplaire = " . htmlentities($_GET['exemplaire']) . ";";
            if($ma_connexion_mysql!= NULL)
                $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
        }
        else
        {
            $_SESSION['messageError'] = "Ne peut être supprimé car l'exemplaire est emprunté ! ";
        }

        $adresse = 'location: exemplaireGestion.php?oeuvre='.$_GET['oeuvre'];
        $_SESSION['message'] = 	"L'exemplaire a bien été supprimé !";
        header($adresse);
    }
}