<?php
session_start();
include "Header.php";
include "php/connexion.php";

if (isset($_POST)
    || isset($_POST['etat'])
    || isset($_POST['prix'])
    || isset($_POST['dateAchat']))
{
    if (!empty($_POST['etat'])
        || !empty($_POST['prix'])
        || !empty($_POST['dateAchat']))
    {
        $ma_commande_SQL = "UPDATE EXEMPLAIRE
                            SET etatExemplaire = \"" . htmlentities($_POST['etat']) . "\",
                             dateAchatExemplaire = \"". htmlentities($_POST['dateAchat']) . "\",
                             prixExemplaire = \"" . $_POST['prix'] . "\"
                            WHERE idExemplaire = \"". htmlentities($_GET['exemplaire']) . "\";";

        if($ma_connexion_mysql!= NULL)
        {
            $nb_lignes_affectes=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $adresse = 'location: exemplaireGestion.php?oeuvre='.$_POST['oeuvre'];
        $_SESSION['message'] = 	"Le livre \"" . htmlentities($_POST['titreLivre']) . "\" a bien été créé !";
        header($adresse);
    }
}
if (isset($_GET['exemplaire'])):

    if (!empty($_GET['exemplaire'])):


        $ma_commande_SQL = "SELECT *
                    FROM EXEMPLAIRE
                    WHERE idExemplaire = \"" . htmlentities($_GET['exemplaire']) . "\";";

        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        ?>
        <h1>Exemplaire</h1>
        <section>
            <div class="row">
                <article class="panel large-12 medium-12 small-12 columns" >
                    <h2>Modifier un exemplaire</h2>
                    <form action="exemplaireUpdate.php?oeuvre=<?=$_GET['oeuvre'] ?>" method="post">
                        <div class="row">
                            <?php foreach ($donnees as $row ): ?>

                            <div class="large-4 medium-4 small-4 columns">
                                <input type="text" placeholder="<?= $row['etatExemplaire'] ?>" id="etat" name="etat" value="<?=$row['etatExemplaire'] ?>">
                            </div>
                            <div class="large-4 medium-4 small-4 columns">
                                <input type="text" placeholder="<?= $row['prixExemplaire'] ?>" id="prix" name="prix" value="<?=$row['prixExemplaire'] ?>">
                            </div>
                            <div class="large-4 medium-4 small-4 columns">
                                <input type="date" placeholder="<?=$row['dateAchatExemplaire'] ?>" id="dateAchat" name="dateAchat" value="<?=$row['dateAchatExemplaire'] ?>">
                            </div>
                                <input type="hidden" value="<?= $row['idOeuvre'] ?>" id="oeuvre" name="oeuvre">
                        </div>
                        <?php endforeach;?>
                        <button class="arrondi" type="submit">Modifier</button>
                    </form>
                </article>
            </div>
        </section>
        <?php
    endif;
endif;
include "Footer.php";