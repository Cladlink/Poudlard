<?php
session_start();
include "Header.php";
include "php/connexion.php";

echo $_GET['oeuvre'] . " ok";

if (isset($_POST)
    && isset($_POST['etat'])
    && isset($_POST['prix'])
    && isset($_POST['dateAchat'])
    && isset($_GET['oeuvre'])):

    echo "coucou";

    if (!empty($_POST['etat'])
        && !empty($_POST['prix'])
        && !empty($_POST['dateAchat'])
        && !empty($_GET['oeuvre'])):

        $ma_commande_SQL = "INSERT INTO EXEMPLAIRE VALUES (NULL, \""
            . htmlentities($_POST['etat'])
            . "\", \""
            . htmlentities($_POST['dateAchat'])
            . "\", \""
            . htmlentities($_POST['prix'])
            . "\", \""
            . htmlentities($_GET['oeuvre'])
            . "\");";

        echo $ma_commande_SQL;

        if($ma_connexion_mysql!= NULL)
        {
            $rbzrb=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $_SESSION['message'] = 	"Le livre \"" . htmlentities($_POST['titreLivre']) . "\" a bien été créé !";
        header('location: exemplaireGestion.php');

    else: ?>
        <div data-alert class="alert-box alert">
            Merci de saisir tous les champs !
            <a href="#" class="close">&times;</a>
        </div>
        <?php
    endif;
endif; ?>
    <h1>Exemplaire</h1>
    <section>
        <div class="row">
            <article class="panel large-12 medium-12 small-12 columns" >
                <h2>Ajouter un exemplaire</h2>
                <form action="exemplaireAdd.php" method="post">
                    <div class="row">
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="text" placeholder="Etat" id="etat" name="etat">
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="text" placeholder="Prix" id="prix" name="prix">
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="date" placeholder="Date d'achat" id="dateAchat" name="dateAchat" value="<?=date("Y-m-d")?>" >
                        </div>
                    </div>
                    <button class="arrondi" type="submit">Ajouter</button>
                </form>
            </article>
        </div>
    </section>
<?php include "Footer.php";