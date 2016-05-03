<?php
session_start();
include "Header.php";

// requete ajouter auteur
if (isset($_POST)
    && isset($_POST['nomAuteur'])
    && isset($_POST['prenomAuteur'])):

    if (!empty($_POST['nomAuteur'])
        && !empty($_POST['prenomAuteur'])):


        include "php/connexion.php";

        $ma_commande_SQL = "INSERT INTO AUTEUR VALUES (null, \""
            . htmlentities($_POST['nomAuteur'])
            . "\", \""
            . htmlentities($_POST['prenomAuteur'])
            . "\");";
        if($ma_connexion_mysql!= NULL)
        {
            $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $_SESSION['message'] = 	"l'auteur " . htmlentities($_POST['nomAuteur']) . " a bien été créé !";
        header('location: auteurGestion.php');

    else: ?>
        <div data-alert class="alert-box alert">
            Merci de saisir tous les champs !
            <a href="#" class="close">&times;</a>
        </div>
        <?php
    endif;
endif; ?>
    <h1>Auteur</h1>
    <section>
        <div class="row">
            <article class="panel large-12 medium-12 small-12 columns" >
                <h2>Ajouter un auteur</h2>
                <form action="auteurAdd.php" method="post">
                    <div class="row">
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="text" placeholder="Nom de l'auteur" id="nomAuteur" name="nomAuteur" <?php if(isset($_POST['nomAuteur']) && !empty($_POST['nomAuteur'])) echo "value=".$_POST['nomAuteur']; ?>>
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="text" placeholder="Prenom de l'auteur" id="prenomAuteur" name="prenomAuteur" <?php if(isset($_POST['prenomAuteur']) && !empty($_POST['prenomAuteur'])) echo "value=".$_POST['prenomAuteur']; ?>>
                        </div>
                    </div>
                    <button class="arrondi" type="submit">Ajouter</button>
                </form>
            </article>
        </div>
    </section>
<?php include "Footer.php";