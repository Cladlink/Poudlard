<?php
session_start();
include "Header.php";

// requete ajouter adherent
if (isset($_POST)
    && isset($_POST['nomAdherent'])
    && isset($_POST['adresseAdherent'])
    && isset($_POST['dateAdhesion'])):

    if (!empty($_POST['nomAdherent'])
        && !empty($_POST['adresseAdherent'])
        && !empty($_POST['dateAdhesion'])):


        include "php/connexion.php";

        $ma_commande_SQL = "INSERT INTO ADHERENT VALUES (null, \""
            . htmlentities($_POST['nomAdherent'])
            . "\", \""
            . htmlentities($_POST['adresseAdherent'])
            . "\", \""
            . htmlentities($_POST['dateAdhesion'])
            . "\");";
        if($ma_connexion_mysql!= NULL)
        {
            $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $_SESSION['message'] = 	"l'adherent " . htmlentities($_POST['nomAdherent']) . " a bien été créé !";
        header('location: adherentGestion.php');

    else: ?>
        <div data-alert class="alert-box alert">
            Merci de saisir tous les champs !
            <a href="#" class="close">&times;</a>
        </div>
    <?php
    endif;
endif; ?>
<h1>Adherent</h1>
<section>
    <div class="row">
        <article class="panel large-12 medium-12 small-12 columns" >
            <h2>Ajouter un adhérent</h2>
            <form action="adherentAdd.php" method="post">
                <div class="row">
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="text" placeholder="Nom de l'adherent" id="nomAdherent" name="nomAdherent" <?php if(isset($_POST['nomAdherent']) && !empty($_POST['nomAdherent'])) echo "value=".$_POST['nomAdherent']; ?>>
                    </div>
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="text" placeholder="Adresse de l'adhérent" id="adresseAdherent" name="adresseAdherent" <?php if(isset($_POST['adresseAdherent']) && !empty($_POST['adresseAdherent'])) echo "value=".$_POST['adresseAdherent']; ?>>
                    </div>
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="date" placeholder="Date Adhésion" id="dateAdhesion" name="dateAdhesion"  <?php if(isset($_POST['dateAdhesion']) && !empty($_POST['dateAdhesion'])) echo "value=".$_POST['dateAdhesion']; else echo "value=".date("Y-m-d");?>>
                    </div>
                </div>
                <button class="arrondi" type="submit">Ajouter</button>
            </form>
        </article>
    </div>
</section>
<?php include "Footer.php";