<?php

/**
 * TODO ne pas oublié de :
 *      ajouter le bouton ajouter (+)
 *      prendre en compte le fait que pour supprimer un adherent, il faut vérifier si il a des emprunts en cours
 *      vérifier si les champs sont saisie (sauf pour la recherche)
 *      éviter l'injection
 *      BONUS : message de confirmation
 *      BONUS : recherche à affichage dynamique
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
                        <input type="date" placeholder="Date Adhésion" id="dateAdhesion" name="dateAdhesion">
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
                <img class="imagePlus" src="img/ajouter.png" alt="plus sur fond vert"/>
                <h2 >Liste des adhérents</h2>
                <?php
                if(isset($_POST)
                    && isset($_POST['nomAdherent'])
                    && isset($_POST['adresseAdherent']))
                {

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


                    $ma_commande_SQL = "SELECT  ADHERENT.idAdherent,
                                                ADHERENT.nomAdherent,
                                                ADHERENT.adresseAdherent,
                                                ADHERENT.datePaiementAdherent
                                        FROM    ADHERENT
                                ". $where;
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