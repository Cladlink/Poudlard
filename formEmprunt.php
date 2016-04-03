<?php
include "../Header.php";
/**
 * Created by PhpStorm.
 * User: cladlink
 * Date: 29/03/16
 * Time: 09:44
 */

if(isset($_POST) && isset($_POST['nomAuteur']) && isset($_POST['titreOeuvre']) && isset($_POST['dateParution'])):

    if(!empty($_POST['nomAuteur']) || !empty($_POST['titreOeuvre']) || !empty($_POST['dateParution']))
    {

    }
    include "connexion.php";


    $ma_commande_SQL = "";
    $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
    $donnees = $reponse->fetchAll();?>
    <table><thead><td>Titre livre</td><td>Nom auteur</td><td>Prenom auteur</td><td>Date de parution</td><td>Quantité disponible</td></thead>
        <?php foreach ($donnees as $row) :

            ?><tr>
            <td><?= $row['titreOeuvre'] ?></td>
            <td><?= $row['nomAuteur']; ?></td>
            <td><?= $row['prenomAuteur']?></td>
            <td><?= $row['dateParutionOeuvre']?></td>
            <td><?= $row['exemplaire_Restant']?></td>
            </tr>
        <?php endforeach; ?>
    </table>


<?php endif;
include "../Footer.php";?>