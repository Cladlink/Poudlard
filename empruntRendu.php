<?php
session_start();
if (isset($_GET['adherent'])
    && isset($_GET['exemplaire'])
    && isset($_GET['dateEmprunt']))
{

    if (!empty($_GET['adherent'])
        || !empty($_GET['exemplaire'])
        || !empty($_GET['dateEmprunt'])
        )
    {
        include "php/connexion.php";

            $ma_commande_SQL = "UPDATE EMPRUNT
                            SET EMPRUNT.dateRendu = now()
                            WHERE EMPRUNT.idAdherent = \"". $_GET['adherent'].
                            "\" AND EMPRUNT.idExemplaire = \"" . $_GET['exemplaire'].
                            "\" AND EMPRUNT.dateEmprunt = \"" . $_GET['dateEmprunt']. "\";";

            if($ma_connexion_mysql!= NULL)
                $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
            $_SESSION['message'] = 	"le livre a bien été rendu!";

        header('location: empruntGestion.php');
    }
}