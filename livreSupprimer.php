<?php
if (isset($_GET['oeuvre']))
{
    if (!empty($_GET['oeuvre']))
    {
        include "php/connexion.php";

        $ma_commande_SQL = "SELECT ";

        if($ma_connexion_mysql!= NULL)
        {
            $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $message = 	"Le livre " . htmlentities($_POST['titreLivre']) . " a bien été créé !";
        header('location:livreGestion.php');
    }
}