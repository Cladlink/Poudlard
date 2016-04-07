<?php include "Header.php"; ?>

    <section>
        <h1>Liste des adhérents</h1>
        <div class="row">
            <article class="panel large-12 medium-12 small-12 columns">
                <?php
                if(isset($_POST)
                    && isset($_POST['nomAdherent'])
                    && isset($_POST['adresseAdherent'])):

                    if(!empty($_POST['nomAdherent'])
                        || !empty($_POST['adresseAdherent']))
                    {
                        $where = "WHERE ";
                        if(!empty($_POST['nomAdherent']))
                                $where = $where . "ADHERENT.nomAdherent like \"%" . $_POST['nomAdherent'] . "%\" ";

                        if(!empty($_POST['adresseAdherent']))

                            if ($where == "WHERE")
                                $where = $where . "ADHERENT.adresseAdherent like \"%" . $_POST['adresseAdherent'] . "%\" ";
                            else
                                $where = $where . "AND ADHERENT.nomAdherent like \"%" . $_POST['nomAdherent'] . "%\" ";
                    }
                    include "php/connexion.php";


                    $ma_commande_SQL = "SELECT ADHERENT.idAdherent,
                                            ADHERENT.nomAdherent,
                                            ADHERENT.adresseAdherent,
                                            ADHERENT.datePaiementAdherent
                                FROM ADHERENT
                                ". $where;
                    $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
                    $donnees = $reponse->fetchAll();?>
                    <table>
                        <thead>
                        <th>ID Adherent</th>
                        <th>Nom Adherent</th>
                        <th>Adresse Adherent</th>
                        <th>Date de paiement</th>
                        </thead>
                        <?php foreach ($donnees as $row) :

                            ?><tr>
                            <td><?= $row['idAdherent'] ?></td>
                            <td><?= $row['nomAdherent']; ?></td>
                            <td><?= $row['adresseAdherent']?></td>
                            <td><?= $row['datePaiementAdherent']?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </article>
        </div>
    </section>
<?php include "Footer.php";?>