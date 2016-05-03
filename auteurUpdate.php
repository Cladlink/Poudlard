<?php
session_start();
include "Header.php";
include "php/connexion.php";

// requete ajouter auteur
if (isset($_POST['nomAuteur'])
    && isset($_POST['prenomAuteur']))
{
    if (!empty($_POST['nomAuteur'])
        && !empty($_POST['prenomAuteur']))
    {

        $ma_commande_SQL = "UPDATE AUTEUR
                            SET nomAuteur = \"" . htmlentities($_POST['nomAuteur']) . "\",
                             prenomAuteur = \"". htmlentities($_POST['prenomAuteur']) . "\"
                            WHERE idAuteur = \"". htmlentities($_GET['auteur']) . "\";";
        if($ma_connexion_mysql!= NULL)
        {
            $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $_SESSION['message'] = 	"L'auteur " . htmlentities($_POST['nomAuteur']) . " a bien été mis à jour !";
        header('location: auteurGestion.php');
    }
    else{ ?>
        <div data-alert class="alert-box alert">
            Merci de saisir tous les champs !
            <a href="#" class="close">&times;</a>
        </div>
    <?php }
}
if (isset($_GET['auteur'])):

    if (!empty($_GET['auteur'])):


        $ma_commande_SQL = "SELECT  Auteur.nomAuteur,
                            AUTEUR.prenomAuteur
                    FROM    AUTEUR
                    WHERE   idAuteur = \"" . htmlentities($_GET['auteur']) . "\";";

        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        ?>
        <h1>Auteur</h1>
        <section>
            <div class="row">
                <article class="panel large-12 medium-12 small-12 columns" >
                    <h2>modifier un auteur</h2>
                    <form action="auteurUpdate.php?auteur=<?=$_GET['auteur'] ?>" method="post">
                        <div class="row">
                            <?php foreach ($donnees as $row ): ?>
                                <div class="large-4 medium-4 small-4 columns">
                                    <input type="text" placeholder="Nom de l'auteur" id="nomAuteur" name="nomAuteur" value="<?php if(isset($_POST['nomAuteur']) && !empty($_POST['nomAuteur'])) echo $_POST['nomAuteur']; else echo $row['nomAuteur']; ?>">
                                </div>
                                <div class="large-4 medium-4 small-4 columns">
                                    <input type="text" placeholder="Prenom de l'auteur" id="prenomAuteur" name="prenomAuteur" value="<?php if(isset($_POST['prenomAuteur']) && !empty($_POST['prenomAuteur'])) echo $_POST['prenomAuteur']; else echo $row['prenomAuteur']; ?>">
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
    header('location: auteurGestion.php');
}
endif;
include "Footer.php";