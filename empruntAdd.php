<?php
session_start();
include "Header.php";
include "php/connexion.php";

// requete ajouter adherent
if (isset($_POST)
    && isset($_POST['idAdherent'])
    && isset($_POST['titreOeuvre'])):

    if (!empty($_POST['idAdherent'])
        && !empty($_POST['titreOeuvre'])):

        $ma_commande_SQL = "SELECT nomAdherent, count(*) as compte
                            FROM emprunt
                              JOIN adherent
                              ON adherent.idAdherent = emprunt.idAdherent
                            WHERE emprunt.idAdherent = " . $_POST['idAdherent'] . "
                              AND emprunt.dateRendu IS NULL
                            GROUP BY emprunt.idAdherent
                            HAVING compte < 2;";
        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        if(!$donnees)
        {
            $_SESSION['messageError'] = "Ne peut emprunter de nouveaux livres car deux sont déjà en cours ! ";

        }
        else
        {

        }


        /*$ma_commande_SQL = "INSERT INTO  VALUES (null, \""
            . htmlentities($_POST['nomAdherent'])
            . "\", \""
            . htmlentities($_POST['adresseAdherent'])
            . "\", \""
            . htmlentities($_POST['dateAdhesion'])
            . "\");";*/
        /*if($ma_connexion_mysql!= NULL)
        {
            $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
        }*/

        /*$_SESSION['message'] = 	"l'adherent " . htmlentities($_POST['nomAdherent']) . " a bien été créé !";
        header('location: adherentGestion.php');*/

    else:
        $_SESSION['messageError'] = "Merci de saisir tous les champs !";
    endif;
endif;?>

<?php

if(isset( $_SESSION['messageError'])): ?>
    <div data-alert class="alert-box alert success radius">
        <?php echo $_SESSION['messageError'];?>
        <a href="#" class="close">&times;</a>
    </div>
<?php
    unset( $_SESSION['messageError']);
    endif;
?>
    <h1>Emprunts</h1>
    <section>
        <div class="row">
            <article class="panel large-12 medium-12 small-12 columns" >
                <h2>Prêt d'un livre</h2>
                <form action="empruntAdd.php" method="post">
                    <div class="row">
                        <div class="large-4 medium-4 small-4 columns">
                            <label for="idAdherent">nom de l'adherent</label>
                            <select name="idAdherent" id="idAdherent">
                                <?php
                                $ma_commande_SQL = "SELECT idAdherent, nomAdherent FROM adherent;";
                                $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
                                $donnees = $reponse->fetchAll();
                                foreach($donnees as $row): ?>
                                    <option value="<?= $row['idAdherent']?>"><?= $row['nomAdherent']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <label for="titreOeuvre">Titre du livre</label>
                            <input type="text" placeholder="Titre du livre" id="titreOeuvre" name="titreOeuvre">
                        </div>
                    </div>
                    <button class="arrondi" type="submit">Ajouter</button>
                </form>
            </article>
        </div>
    </section>
<?php include "Footer.php";