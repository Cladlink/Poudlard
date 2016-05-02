<?php
session_start();
include "php/connexion.php";

if (isset($_GET['oeuvre']))
{
    if (!empty($_GET['oeuvre']))
    {
        $ma_commande_SQL = "SELECT EXEMPLAIRE.idExemplaire, OEUVRE.titreOeuvre
                            FROM EXEMPLAIRE
                            JOIN OEUVRE ON EXEMPLAIRE.idOeuvre = OEUVRE.idOeuvre
                            WHERE OEUVRE.idOeuvre = " . htmlentities($_GET['oeuvre']) . ";";
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
            foreach($donnees as $row)
            {
                $titreLivre = $row['titreOeuvre'];
                $exemplaires[] = $row['idExemplaire'];
                $nbLignes += 1;
            }
            $_SESSION['messageError'] = "Le livre \"" . $titreLivre . "\" ne peut pas être supprimé car des exemplaires existent : <br/> ";
            for($i=0; $i<$nbLignes; $i++)
            {
                $_SESSION['messageError'] = $_SESSION['messageError'] . "L'exemplaire numéro " . $exemplaires[$i] . " existe <br/>";
            }
        }
        header('location: livreGestion.php');
    }
}