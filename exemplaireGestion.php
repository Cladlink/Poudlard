<?php include "Header.php" ?>

<section>
    <div class="row">
        <article class=" panel large-12 medium-12 small-12 columns">
            <?php $addrAdd = "exemplaireAdd.php?oeuvre=" . $_GET['oeuvre']; ?>
            <a href="<?= $addrAdd?>"><img class="imagePlus" src="img/ajouter.png" alt="plus sur fond vert"/></a>
            <h2 >Liste des exemplaires</h2>
            <?php
            if(isset($_GET['oeuvre'])):

                if(!empty($_GET['oeuvre'])):

                    $ma_commande_SQL = "SELECT EXEMPLAIRE.idExemplaire,
                                        EXEMPLAIRE.etatExemplaire,
                                        EXEMPLAIRE.dateAchatExemplaire,
                                        EXEMPLAIRE.prixExemplaire
                                        FROM EXEMPLAIRE
                                        WHERE EXEMPLAIRE.idOeuvre = " . htmlentities($_GET['oeuvre']) . "
                                        ORDER BY idExemplaire;";
                    include "php/connexion.php";
                    $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
                    $donnees = $reponse->fetchAll();?>
                    <table>
                        <thead>
                        <th>ID Exemplaire</th>
                        <th>Etat</th>
                        <th>Date d'achat</th>
                        <th>Prix</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                        </thead>
                        <?php foreach ($donnees as $row) :
                            $addrUpdate = "exemplaireUpdate.php?exemplaire=" . $row['idExemplaire'];
                            $addrDelete = "exemplaireSupprimer.php?exemplaire=" . $row['idExemplaire'] . "&oeuvre=" . $_GET['oeuvre'];
                            ?><tr>
                            <td><?= $row['idExemplaire'] ?></td>
                            <td><?= $row['etatExemplaire']; ?></td>
                            <td><?= $row['dateAchatExemplaire']?></td>
                            <td><?= $row['prixExemplaire']?></td>
                            <td><a href="<?= $addrUpdate?>"><img class="icone" src="img/modifier.png" alt="icone modifier"></a></td>
                            <td><a href="<?= $addrDelete?>"><img class="icone" src="img/supprimer.png" alt="croix rouge"></a></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            <?php endif; ?>
        </article>
    </div>
</section>
<?php include "Footer.php" ?>
