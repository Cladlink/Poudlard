<?php
session_start();
if (isset($_GET['auteur']))
{
    if (!empty($_GET['auteur']))
    {
        include "php/connexion.php";

        $ma_commande_SQL = "SELECT titreOeuvre
                            FROM oeuvre
                            WHERE idAuteur = " . htmlentities($_GET['auteur']) . "; ";
        echo $ma_commande_SQL;
        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        if(!$donnees)
        {
            $ma_commande_SQL = "DELETE FROM AUTEUR
                            WHERE idAuteur = \"" . htmlentities($_GET['auteur']) . "\";";
            if($ma_connexion_mysql!= NULL)
                $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
            $_SESSION['message'] = 	"l'auteur a bien été supprimé !";
        }
        else
        {
            $_SESSION['messageError'] = "L'auteur ne peut être supprimé car il y a encore des livres au nom de cet auteur! ";
        }
        header('location: auteurGestion.php');
    }
}