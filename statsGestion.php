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

foreach($donnees as $row)
    $nbEmprunts = $row['nbrLocation'];
?>

<!--Affichage-->
<section>
    <h1>Statistiques</h1>
    <div class="row">
        <article class="panel large-12 medium-12 small-12 columns" >
            <h2>Les emprunts</h2>
                <ul>
                    <li>Il y a actuellement <?php echo $nbEmprunts; ?> emprunts en cours.</li>
                </ul>
        </article>
    </div>
</section>

<?php include "Footer.php";