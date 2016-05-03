<?php
session_start();
include "Header.php";
include "php/connexion.php";

if (isset($_POST)
    && isset($_POST['etat'])
    && isset($_POST['prix'])
    && isset($_POST['dateAchat']))
{
    if (!empty($_POST['etat'])
        && !empty($_POST['prix'])
        && !empty($_POST['dateAchat']))
    {
        $ma_commande_SQL = "UPDATE EXEMPLAIRE
                            SET etatExemplaire = \"" . htmlentities($_POST['etat']) . "\",
                             dateAchatExemplaire = \"". htmlentities($_POST['dateAchat']) . "\",
                             prixExemplaire = \"" . htmlentities($_POST['prix']) . "\"
                            WHERE idExemplaire = \"". htmlentities($_POST['exemplaire']) . "\";";

        if($ma_connexion_mysql!= NULL)
        {
            $nb_lignes_affectes=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $adresse = 'location: exemplaireGestion.php?oeuvre='.$_POST['oeuvre'];
        $_SESSION['message'] = 	"L'exemplaire a bien été mis a jour !";
        header($adresse);
    }
    else{ ?>
    <div data-alert class="alert-box alert">
        Merci de saisir tous les champs !
        <a href="#" class="close">&times;</a>
    </div>
    <?php }
}
if (isset($_GET['exemplaire'])):

    if (!empty($_GET['exemplaire'])):


        $ma_commande_SQL = "SELECT *, OEUVRE.titreOeuvre
                    FROM EXEMPLAIRE
                    JOIN OEUVRE ON EXEMPLAIRE.idOeuvre = OEUVRE.idOeuvre
                    WHERE idExemplaire = \"" . htmlentities($_GET['exemplaire']) . "\";";

        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        ?>
        <h1>Exemplaire</h1>
        <section>
            <div class="row">
                <article class="panel large-12 medium-12 small-12 columns" >
                    <form action="exemplaireUpdate.php?exemplaire=<?php echo $_GET['exemplaire']; ?>" method="post">
                        <div class="row">
                            <?php foreach ($donnees as $row ): ?>
                            <h2>Modifier l'exemplaire <?php echo $row['idExemplaire']; ?> du livre "<?php echo $row['titreOeuvre'];?>"</h2>
                            <div class="large-4 medium-4 small-4 columns">
                                <select name="etat" id="etat">
                                    <?php
                                    $etatActuel = $row['etatExemplaire'];

                                    if($etatActuel == "EXCELLENT")
                                        $excellent = "selected";
                                    else if($etatActuel == "BON")
                                        $bon = "selected";
                                    else if($etatActuel == "MOYEN")
                                        $moyen = "selected";
                                    else if($etatActuel == "MAUVAIS")
                                        $mauvais = "selected";
                                    ?>

                                    <option value="EXCELLENT" <?php if(isset($_POST['etat']) && !empty($_POST['etat']) && $_POST['etat']=="EXCELLENT") echo "selected"; else echo $excellent; ?>>EXCELLENT</option>
                                    <option value="BON" <?php if(isset($_POST['etat']) && !empty($_POST['etat']) && $_POST['etat']=="BON") echo "selected"; echo $bon; ?>>BON</option>
                                    <option value="MOYEN" <?php if(isset($_POST['etat']) && !empty($_POST['etat']) && $_POST['etat']=="MOYEN") echo "selected"; echo $moyen; ?>>MOYEN</option>
                                    <option value="MAUVAIS" <?php if(isset($_POST['etat']) && !empty($_POST['etat']) && $_POST['etat']=="MAUVAIS") echo "selected"; echo $mauvais; ?>>MAUVAIS</option>
                                </select>
                            </div>
                            <div class="large-4 medium-4 small-4 columns">
                                <input type="text" placeholder="Prix" id="prix" name="prix" value="<?php if(isset($_POST['prix']) && !empty($_POST['prix'])) echo $_POST['prix']; else echo $row['prixExemplaire']; ?>">
                            </div>
                            <div class="large-4 medium-4 small-4 columns">
                                <input type="date" placeholder="Date d'achat" id="dateAchat" name="dateAchat" value="<?php if(isset($_POST['dateAchat']) && !empty($_POST['dateAchat'])) echo $_POST['dateAchat']; else echo $row['dateAchatExemplaire']; ?>">
                            <div>
                                <input type="hidden" value="<?= $row['idOeuvre'] ?>" id="oeuvre" name="oeuvre">
                            </div>
                            <div>
                                <input type="hidden" value="<?= $_GET['exemplaire'] ?>" id="exemplaire" name="exemplaire">
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