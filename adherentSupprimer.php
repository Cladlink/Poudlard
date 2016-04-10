<?php
if (isset($_GET['adherent']))
{

    if (!empty($_GET['adherent']))
    {
        include "php/connexion.php";


        $ma_commande_SQL = "DELETE FROM ADHERENT
                            WHERE idAdherent = \"" . htmlentities($_GET['adherent']) . "\";";
        if($ma_connexion_mysql!= NULL)
        {
            $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $message = 	"l'adherent " . htmlentities($_POST['nomAdherent']) . " a bien été créé !";
        header('location: adherentGestion.php');
    }
}