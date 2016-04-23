<?php include "Header.php";
session_start();

if(isset($_POST)
    && isset($_POST['titreLivre'])
    && isset($_POST['nomAuteur'])
    && isset($_POST['dateParution'])):

    if(!empty($_POST['titreLivre'])
        && !empty($_POST['nomAuteur'])
        && !empty($_POST['dateParution'])):

        include "php/connexion.php";

        $idAuteur = "SELECT AUTEUR.idAuteur
                     FROM AUTEUR
                     WHERE nomAuteur
                     LIKE \"" . htmlentities($_POST['nomAuteur']) . "\";";

        $ma_commande_SQL = "INSERT INTO OEUVRE VALUES (NULL, " . htmlentities($idAuteur)
            . ", \"" . htmlentities($_POST['titreLivre'])
            . "\", \"" . htmlentities($_POST['dateParution'])
            . "\";";

        echo $ma_commande_SQL;

        if($ma_connexion_mysql!= NULL)
        {
            $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $message = 	"Le livre \"" . htmlentities($_POST['titreLivre']) . "\" a bien été créé !";
        header('location: livreGestion.php');

    else: ?>
    <div data-alert class="alert-box alert">
        Merci de saisir tous les champs !
        <a href="#" class="close">&times;</a>
    </div>
    <?php
    endif;
endif; ?>

<h1>Ajouter un livre</h1>
    <div class="row">
        <article class="panel large-12 medium-12 small-12 columns" >
            <form action="livreAdd.php" method="post">
                <div class="row">
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="text" placeholder="Titre du livre" id="titreLivre" name="titreLivre">
                    </div>
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="text" placeholder="Nom de l'auteur" id="nomAuteur" name="nomAuteur">
                    </div>
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="date" placeholder="Date de parution" id="dateParution" name="dateParution">
                    </div>
                </div>
                <button class="arrondi" type="submit">Ajouter</button>
            </form>
        </article>
    </div>

<?php include "Footer.php"; ?>