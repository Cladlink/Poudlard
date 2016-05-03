<?php
session_start();
include "Header.php";
include "php/connexion.php";

if (isset($_POST)
    && isset($_POST['titreLivre'])
    && isset($_POST['idAuteur'])
    && isset($_POST['dateParution']))
{
    if (!empty($_POST['titreLivre'])
        && !empty($_POST['idAuteur'])
        && !empty($_POST['dateParution']))
    {
        $ma_commande_SQL = "UPDATE OEUVRE
                            SET titreOeuvre = \"" . htmlentities($_POST['titreLivre']) . "\",
                             dateParutionOeuvre = \"". htmlentities($_POST['dateParution']) . "\",
                             idAuteur = \"" . $_POST['idAuteur'] . "\"
                            WHERE idOeuvre = \"". htmlentities($_GET['oeuvre']) . "\";";

        if($ma_connexion_mysql!= NULL)
        {
            $nb_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $_SESSION['message'] = 	"Le livre \"" . htmlentities($_POST['titreLivre']) . "\" a bien été modifié.";
        header('location: livreGestion.php');
    }
    else{ ?>
        <div data-alert class="alert-box alert">
            Merci de saisir tous les champs !
            <a href="#" class="close">&times;</a>
        </div>
    <?php }
}
if (isset($_GET['oeuvre'])):

    if (!empty($_GET['oeuvre'])):


        $ma_commande_SQL = "SELECT  OEUVRE.titreOeuvre,
                            OEUVRE.dateParutionOeuvre,
                            OEUVRE.idAuteur
                            FROM OEUVRE
                            WHERE idOeuvre = \"" . htmlentities($_GET['oeuvre']) . "\";";

        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        ?>
        <h1>Livre</h1>
        <section>
            <div class="row">
                <article class="panel large-12 medium-12 small-12 columns" >
                    <h2>Modifier un livre</h2>
                    <form action="livreUpdate.php?oeuvre=<?=$_GET['oeuvre'] ?>" method="post">
                        <div class="row">
                            <?php foreach ($donnees as $row ): ?>
                                <div class="large-4 medium-4 small-4 columns">
                                    <input type="text" placeholder="Titre du livre" id="titreLivre" name="titreLivre" value="<?php if(isset($_POST['titreLivre']) && !empty($_POST['titreLivre'])) echo $_POST['titreLivre']; else echo $row['titreOeuvre']; ?>">
                                </div>
                                <div class="large-4 medium-4 small-4 columns">
                                    <input type="date" placeholder="Date de parution" id="dateParution" name="dateParution" value="<?php if(isset($_POST['dateParution']) && !empty($_POST['dateParution'])) echo $_POST['dateParution']; else echo $row['dateParutionOeuvre']; ?>">
                                </div>
                                <div class="large-4 medium-4 small-4 columns">
                                    <select name="idAuteur" id="idAuteur">
                                        <?php
                                        $ma_commande_SQL = "SELECT AUTEUR.nomAuteur, AUTEUR.idAuteur FROM AUTEUR ORDER BY AUTEUR.nomAuteur;";
                                        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
                                        $donnees = $reponse->fetchAll();
                                        foreach($donnees as $row2):
                                            $nomAuteur = $row2['nomAuteur'];
                                            if(isset($_POST['idAuteur']) && !empty($_POST['idAuteur']) && $_POST['idAuteur']==$row2['idAuteur'])
                                            { ?>
                                                <option value="<?= $row2['idAuteur']?>" selected><?= $nomAuteur ?></option>
                                            <?php
                                            }
                                            else if($row2['idAuteur'] == $row['idAuteur'])
                                            {
                                            ?>
                                                <option value="<?= $row2['idAuteur']?>" selected><?= $nomAuteur ?></option>
                                            <?php } else { ?>
                                            <option value="<?= $row2['idAuteur']?>"><?= $nomAuteur ?></option>
                                            <?php }
                                        endforeach; ?>
                                    </select>
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
endif;
include "Footer.php";