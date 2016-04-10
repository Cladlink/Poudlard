<?php
session_start();
if (isset($_GET['adherent']))
{

    if (!empty($_GET['adherent']))
    {
        include "php/connexion.php";

        $ma_commande_SQL = "SELECT ADHERENT.nomAdherent
                            FROM EMPRUNT
                            JOIN ADHERENT
                            ON EMPRUNT.idAdherent = ADHERENT.idAdherent
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
            $message = 	"l'adherent " . htmlentities($_POST['nomAdherent']) . " a bien été créé !";
        }
        else
        {
            echo "Ne peut être supprimé car des emprunts sont encore en cours ! ";
        }


        header('location: adherentGestion.php', true, 100);
    }
}