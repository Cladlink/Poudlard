<?php
session_start();
if (isset($_GET['auteur']))
{
    if (!empty($_GET['auteur']))
    {
        include "php/connexion.php";

        $ma_commande_SQL = "SELECT OEUVRE.titreOeuvre, AUTEUR.nomAuteur
                            FROM OEUVRE
                            JOIN AUTEUR ON OEUVRE.idAuteur = AUTEUR.idAuteur
                            WHERE AUTEUR.idAuteur = " . htmlentities($_GET['auteur']) . "; ";
        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        if(!$donnees)
        {
            $ma_commande_SQL = "DELETE FROM AUTEUR
                            WHERE idAuteur = \"" . htmlentities($_GET['auteur']) . "\";";
            if($ma_connexion_mysql!= NULL)
                $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
            $_SESSION['message'] = 	"L'auteur a bien été supprimé !";
        }
        else
        {
            foreach($donnees as $row)
            {
                $auteur = $row['nomAuteur'];
                $livres[] = $row['titreOeuvre'];
                $nbLignes += 1;
            }
            $_SESSION['messageError'] = "L'auteur " . $auteur . " ne peut être supprimé car il y a encore des livres au nom de cet auteur : <br/>";
            for($i=0; $i<$nbLignes; $i++)
            {
                $_SESSION['messageError'] = $_SESSION['messageError'] . "Le livre \"" . $livres[$i] . "\" est un livre de cet auteur <br/>";
            }
        }
        header('location: auteurGestion.php');
    }
}