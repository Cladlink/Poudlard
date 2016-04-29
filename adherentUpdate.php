<?php
session_start();
include "Header.php";
include "php/connexion.php";

// requete ajouter adherent
if (isset($_POST['nomAdherent'])
    && isset($_POST['adresseAdherent'])
    && isset($_POST['dateAdhesion']))
{
    if (!empty($_POST['nomAdherent'])
        && !empty($_POST['adresseAdherent'])
        && !empty($_POST['dateAdhesion']))
    {

        $ma_commande_SQL = "UPDATE ADHERENT
                            SET nomAdherent = \"" . htmlentities($_POST['nomAdherent']) . "\",
                             adresseAdherent = \"". htmlentities($_POST['adresseAdherent']) . "\",
                             datePaiementAdherent = \"". htmlentities($_POST['dateAdhesion']) . "\"
                            WHERE idAdherent = \"". htmlentities($_GET['adherent']) . "\";";
        if($ma_connexion_mysql!= NULL)
        {
            $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $_SESSION['message'] = 	"l'adherent " . htmlentities($_POST['nomAdherent']) . " a bien été mis à jour !";
        header('location: adherentGestion.php');
    }
}
if (isset($_GET['adherent'])):

    if (!empty($_GET['adherent'])):


        $ma_commande_SQL = "SELECT  ADHERENT.nomAdherent,
                            ADHERENT.adresseAdherent,
                            ADHERENT.datePaiementAdherent
                    FROM    ADHERENT
                    WHERE   idAdherent = \"" . htmlentities($_GET['adherent']) . "\";";

        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        ?>
        <h1>Adherent</h1>
        <section>
            <div class="row">
                <article class="panel large-12 medium-12 small-12 columns" >
                    <h2>modifier un adhérent</h2>
                    <form action="adherentUpdate.php?adherent=<?=$_GET['adherent'] ?>" method="post">
                        <div class="row">
                            <?php foreach ($donnees as $row ): ?>
                            <div class="large-4 medium-4 small-4 columns">
                                <input type="text" placeholder="Nom de l'auteur" id="nomAdherent" name="nomAdherent" value="<?=$row['nomAdherent'] ?>">
                            </div>
                            <div class="large-4 medium-4 small-4 columns">
                                <input type="text" placeholder="Adresse" id="adresseAdherent" name="adresseAdherent" value="<?=$row['adresseAdherent'] ?>">
                            </div>
                            <div class="large-4 medium-4 small-4 columns">
                                <input type="date" placeholder="Date d'adhesion" id="dateAdhesion" name="dateAdhesion" value="<?=$row['datePaiementAdherent'] ?>">
                            </div>
                            <?php endforeach;?>
                        </div>
                        <button class="arrondi" type="submit">Ajouter</button>
                    </form>
                </article>
            </div>
        </section>
        <?php
    endif;
else:
{
    header('location: adherentGestion.php');
}
endif;
include "Footer.php";