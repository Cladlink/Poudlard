<?php

/**
 * TODO ne pas oublié de :
 *      prendre en compte le fait que pour supprimer un adherent, il faut vérifier si il a des emprunts en cours
 *      vérifier si les champs sont saisie (sauf pour la recherche)
 *      éviter l'injection
 *      BONUS : message de confirmation
 *      BONUS : recherche à affichage dynamique
 *      BONUS : retravailler le bouton rajouter
 *
 */
?>

<?php include "Header.php";?>

<?php if(isset($message)): ?>
    <div data-alert class="alert-box success radius">
        <?php echo $message; ?>
        <a href="#" class="close">&times;</a>
    </div>
<?php endif ?>
<section>
    <h1>Gestion des adherents</h1>
    <div class="row">
        <article class="panel large-12 medium-12 small-12 columns" >
            <h2>Rechercher un adhérent</h2>
            <form action="adherentGestion.php" method="post">
                <div class="row">
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="text" placeholder="Nom de l'adherent" id="nomAdherent" name="nomAdherent">
                    </div>
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="text" placeholder="Adresse de l'adhérent" id="adresseAdherent" name="adresseAdherent">
                    </div>
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="date" placeholder="Date Adhésion" id="dateAdhesion" name="dateAdhesion" value="<?=date("Y-m-d")?>">
                    </div>
                </div>
                <button class="arrondi" type="submit">Rechercher</button>
            </form>
        </article>
    </div>
</section>

    <section>
        <div class="row">
            <article class=" panel large-12 medium-12 small-12 columns">
                <a href="adherentAdd.php"><img class="imagePlus" src="img/ajouter.png" alt="plus sur fond vert"/></a>
                <h2 >Liste des adhérents</h2>
                <?php
                if(isset($_POST)
                    && isset($_POST['nomAdherent'])
                    && isset($_POST['adresseAdherent'])
                    && isset($_POST['dateAdhesion']))
                {

                    if(!empty($_POST['nomAdherent'])
                        || !empty($_POST['adresseAdherent']))
                    {
                        $where = "WHERE ";
                        if(!empty($_POST['nomAdherent']))
                            $where = $where . "ADHERENT.nomAdherent like \"%" . $_POST['nomAdherent'] . "%\" ";

                        if(!empty($_POST['adresseAdherent']))
                        {
                            if ($where == "WHERE ")
                                $where = $where . "ADHERENT.adresseAdherent like \"%" . $_POST['adresseAdherent'] . "%\" ";
                            else
                                $where = $where . "AND ADHERENT.adresseAdherent like \"%" . $_POST['adresseAdherent'] . "%\" ";
                        }
                        if(!empty($_POST['dateAdhesion']))
                        {
                            if ($where == "WHERE ")
                                $where = $where . "ADHERENT.datePaimentAdherent like \"%" . $_POST['dateAdhesion'] . "%\" ";
                            else
                                $where = $where . "AND ADHERENT.datePaimentAdherent like \"%" . $_POST['dateAdhesion'] . "%\" ";
                        }

                    }
                    include "php/connexion.php";


                    $ma_commande_SQL = "SELECT  ADHERENT.idAdherent,
                                                ADHERENT.nomAdherent,
                                                ADHERENT.adresseAdherent,
                                                ADHERENT.datePaiementAdherent
                                        FROM    ADHERENT
                                ". $where;
                    echo $ma_commande_SQL;
                }
                else
                {
                    $ma_commande_SQL = "SELECT  ADHERENT.idAdherent,
                                                ADHERENT.nomAdherent,
                                                ADHERENT.adresseAdherent,
                                                ADHERENT.datePaiementAdherent
                                        FROM    ADHERENT";
                }

                include "php/connexion.php";
                    $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
                    $donnees = $reponse->fetchAll();?>
                    <table>
                        <thead>
                        <th>ID Adherent</th>
                        <th>Nom Adherent</th>
                        <th>Adresse Adherent</th>
                        <th>Date de paiement</th>
                        <th>modifier</th>
                        <th>supprimer</th>
                        </thead>
                        <?php foreach ($donnees as $row) :
                            $addrUpdate = "adherentUpdate.php?adherent=" . $row['idAdherent'];
                            $addrDelete = "adherentSupprimer.php?adherent=" . $row['idAdherent'];
                            ?><tr>
                            <td><?= $row['idAdherent'] ?></td>
                            <td><?= $row['nomAdherent']; ?></td>
                            <td><?= $row['adresseAdherent']?></td>
                            <td><?= $row['datePaiementAdherent']?></td>
                            <td><a href="<?= $addrUpdate?>"><img class="icone" src="img/modifier.png" alt="icone modifier"></a></td>
                            <td><a href="<?= $addrDelete?>"><img class="icone" src="img/supprimer.png" alt="croix rouge"></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
            </article>
        </div>
    </section>
<?php include "Footer.php";