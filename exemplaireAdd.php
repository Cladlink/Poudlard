<?php
session_start();
include "Header.php";
include "php/connexion.php";


if (isset($_POST)
    && isset($_POST['etat'])
    && isset($_POST['prix'])
    && isset($_POST['dateAchat'])
    && isset($_POST['oeuvre'])):

    if (!empty($_POST['etat'])
        && !empty($_POST['prix'])
        && !empty($_POST['dateAchat'])
        && !empty($_POST['oeuvre'])):

        $ma_commande_SQL = "INSERT INTO EXEMPLAIRE VALUES (NULL, \""
            . htmlentities($_POST['etat'])
            . "\", \""
            . htmlentities($_POST['dateAchat'])
            . "\", \""
            . htmlentities($_POST['prix'])
            . "\", \""
            . htmlentities($_POST['oeuvre'])
            . "\");";

        if($ma_connexion_mysql!= NULL)
        {
            $rbzrb=$ma_connexion_mysql->exec($ma_commande_SQL);
        }
        $adresse = 'location: exemplaireGestion.php?oeuvre='.$_POST['oeuvre'];
        $_SESSION['message'] = 	"L'exemplaire a bien été créé !";
        header($adresse);

    else: ?>
        <div data-alert class="alert-box alert">
            Merci de saisir tous les champs !
            <a href="#" class="close">&times;</a>
        </div>
        <?php
    endif;
endif;

if (isset($_GET['oeuvre'])):

    if (!empty($_GET['oeuvre'])):

        $ma_commande_SQL = "SELECT OEUVRE.titreOeuvre
        FROM OEUVRE
        WHERE idOeuvre = \"" . htmlentities($_GET['oeuvre']) . "\";";

        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
    ?>

    <h1>Exemplaire</h1>
    <section>
        <div class="row">
            <article class="panel large-12 medium-12 small-12 columns" >
                <?php foreach ($donnees as $row ): ?>
                <h2>Ajouter un exemplaire du livre "<?php echo $row['titreOeuvre']; ?>"</h2>
                <?php endforeach; ?>
                <form action="exemplaireAdd.php?oeuvre=<?php echo $_GET['oeuvre']; ?>" method="post">
                    <div class="row">
                        <div class="large-4 medium-4 small-4 columns">
                            <select name="etat" id="etat">
                                <option value="EXCELLENT">EXCELLENT</option>
                                <option value="BON">BON</option>
                                <option value="MOYEN">MOYEN</option>
                                <option value="MAUVAIS">MAUVAIS</option>
                            </select>
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="text" placeholder="Prix" id="prix" name="prix">
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="date" placeholder="Date d'achat" id="dateAchat" name="dateAchat" value="<?=date("Y-m-d")?>" >
                        </div>
                        <input type="hidden" value="<?php if (isset($_GET['oeuvre'])) echo $_GET['oeuvre']; ?>" id="oeuvre" name="oeuvre">

                    </div>
                    <button class="arrondi" type="submit">Ajouter</button>
                </form>
            </article>
        </div>
    </section>
        <?php
    endif;
endif;
include "Footer.php"; ?>