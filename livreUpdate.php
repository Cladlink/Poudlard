<?php
session_start();
include "Header.php";
include "php/connexion.php";

// requete ajouter adherent
if (isset($_POST['titreLivre'])
    && isset($_POST['nomAuteur'])
    && isset($_POST['dateParution']))
{
    if (!empty($_POST['titreLivre'])
        && !empty($_POST['nomAuteur'])
        && !empty($_POST['dateParution']))
    {
        $ma_commande_SQL = "UPDATE OEUVRE
                            SET titreOeuvre = \"" . htmlentities($_POST['titreLivre']) . "\",
                             dateParutionOeuvre = \"". htmlentities($_POST['dateParution']) . "\"
                            WHERE idOeuvre = \"". htmlentities($_GET['oeuvre']) . "\";";
        if($ma_connexion_mysql!= NULL)
        {
            $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $_SESSION['message'] = 	"Le livre " . htmlentities($_POST['titreLivre']) . " a bien été mis à jour !";
        header('location: livreGestion.php');
    }
}
if (isset($_GET['oeuvre'])):

    if (!empty($_GET['oeuvre'])):


        $ma_commande_SQL = "SELECT  Oeuvre.titreOeuvre,
                            Oeuvre.dateParutionOeuvre
                    FROM    OEUVRE
                    WHERE   idOeuvre = \"" . htmlentities($_GET['oeuvre']) . "\";";

        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        ?>
        <h1>Livre</h1>
        <section>
            <div class="row">
                <article class="panel large-12 medium-12 small-12 columns" >
                    <h2>Modifier un livre</h2>
                    <form action="livreUpdate.php?adherent=<?=$_GET['oeuvre'] ?>" method="post">
                        <div class="row">
                            <?php foreach ($donnees as $row ): ?>
                                <div class="large-4 medium-4 small-4 columns">
                                    <input type="text" placeholder="<?= $row['titreOeuvre'] ?>" id="titreLivre" name="titreLivre" value="<?=$row['titreOeuvre'] ?>">
                                </div>

                                <div class="large-4 medium-4 small-4 columns">
                                    <input type="date" placeholder="<?=$row['dateParutionOeuvre'] ?>" id="dateParution" name="dateParution" value="<?=$row['dateParutionOeuvre'] ?>">
                                </div>
                            <?php endforeach;?>
                        </div>
                        <button class="arrondi" type="submit">Modifier</button>
                    </form>
                </article>
            </div>
        </section>
        <?php
    endif;
else:
{
    header('location: livreGestion.php');
}
endif;
include "Footer.php";