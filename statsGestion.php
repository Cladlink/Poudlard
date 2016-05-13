<?php
session_start();
include "Header.php";
include "php/connexion.php";

/*Requetes*/
$ma_commande_nb_emprunts = "SELECT count(*) as nbrLocation
                            FROM EMPRUNT
                            WHERE EMPRUNT.dateRendu IS NULL;";

$reponse = $ma_connexion_mysql->query($ma_commande_nb_emprunts);
$donnees = $reponse->fetchAll();
$nbEmprunts = $donnees[0]['nbrLocation'];

$ma_commande= "SELECT  count(DISTINCT adherent.idAdherent) as adh,
          count(DISTINCT exemplaire.idExemplaire) as exe,
          count(DISTINCT oeuvre.idOeuvre) as oeu,
          count(DISTINCT auteur.idAuteur) as aut
    FROM ADHERENT, exemplaire, oeuvre, auteur, emprunt;";

$reponse = $ma_connexion_mysql->query($ma_commande);
$donnees = $reponse->fetchAll();

$adh = $donnees[0]['adh'];
$exe = $donnees[0]['exe'];
$oeu = $donnees[0]['oeu'];
$aut = $donnees[0]['aut'];

?>

<!--Affichage-->
<section>
    <h1>Statistiques</h1>
    <div class="row">
        <article class="panel large-12 medium-12 small-12 columns" >
            <h2>Les emprunts</h2>
                <ul>
                    <li>Il y a <?php echo $nbEmprunts; ?> emprunts en cours.</li>
                    <li>Il y a <?php echo $adh; ?> adhérents.</li>
                    <li>Il y a <?php echo $exe; ?> exemplaires.</li>
                    <li>Il y a <?php echo $oeu; ?> oeuvres.</li>
                    <li>Il y a <?php echo $aut; ?> auteurs.</li>
                </ul>
        </article>
    </div>
</section>

<?php include "Footer.php";