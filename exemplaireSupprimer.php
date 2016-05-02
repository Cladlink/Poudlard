<?php
session_start();
if (isset($_GET['exemplaire']))
{
    if (!empty($_GET['exemplaire']))
    {
        include "php/connexion.php";

        $ma_commande_SQL = "SELECT EXEMPLAIRE.idExemplaire, EMPRUNT.dateEmprunt
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
            $_SESSION['message'] = 	"L'exemplaire a bien été supprimé !";
        }
        else
        {
            foreach($donnees as $row)
            {
                $numExemplaire = $row['idExemplaire'];
                $dateEmprunt = $row['dateEmprunt'];
            }
            $_SESSION['messageError'] = "L'exemplaire numéro ". $numExemplaire ." ne peut être supprimé car il
            est emprunté depuis le ". $dateEmprunt ." et n'a pas encore été rendu";
        }
        $adresse = 'location: exemplaireGestion.php?oeuvre='.$_GET['oeuvre'];
        header($adresse);
    }
}