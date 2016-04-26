<?php
session_start();
include "php/connexion.php";

if (isset($_GET['oeuvre']))
{
    if (!empty($_GET['oeuvre']))
    {
        $ma_commande_SQL = "SELECT *
                            FROM EXEMPLAIRE
                            WHERE EXEMPLAIRE.idOeuvre = " . htmlentities($_GET['oeuvre']) . ";";
        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        if(!$donnees)
        {
            $ma_commande_SQL = "DELETE FROM OEUVRE
                            WHERE OEUVRE.idOeuvre = \"" . htmlentities($_GET['oeuvre']) . "\";";

            if($ma_connexion_mysql!= NULL) {
                $nbr_lignes_affectees = $ma_connexion_mysql->exec($ma_commande_SQL);
            }
            $_SESSION['message'] = 	"Le livre a bien été supprimé !";
        }
        else
        {
            $_SESSION['messageError'] = "Ce livre ne peut pas être supprimé car des exemplaires existent ! ";
        }
        header('location: livreGestion.php');
    }
}