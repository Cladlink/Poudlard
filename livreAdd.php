<?php
session_start();
include "Header.php";
include "php/connexion.php";

if(isset($_POST)
    && isset($_POST['titre'])
    && isset($_POST['idAuteur'])
    && isset($_POST['dateParution'])):

    if(!empty($_POST['titre'])
        && !empty($_POST['idAuteur'])
        && !empty($_POST['dateParution'])):

        $ma_commande_SQL = "INSERT INTO OEUVRE VALUES (NULL, \""
            . htmlentities($_POST['titre'])
            . "\", \"" . htmlentities($_POST['dateParution'])
            . "\", \"" . htmlentities($_POST['idAuteur'])
            . "\");";

        echo $ma_commande_SQL;

        if($ma_connexion_mysql!= NULL)
        {
            $rbzrb=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $_SESSION['message'] = 	"Le livre \"" . htmlentities($_POST['titre']) . "\" a bien été créé !";
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
                        <input type="text" placeholder="Titre du livre" id="titre" name="titre" <?php if(isset($_POST['titre']) && !empty($_POST['titre'])) echo "value=".$_POST['titre']; ?>>
                    </div>
                    <div class="large-4 medium-4 small-4 columns">
                        <select name="idAuteur" id="idAuteur">
                            <option value="">Choisir un auteur</option>
                            <?php
                            $ma_commande_SQL = "SELECT AUTEUR.nomAuteur, AUTEUR.idAuteur FROM AUTEUR ORDER BY AUTEUR.nomAuteur;";
                            $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
                            $donnees = $reponse->fetchAll();
                            foreach($donnees as $row):
                                $nomAuteur = $row['nomAuteur'];
                                ?>
                                <option value="<?= $row['idAuteur']?>" <?php if(isset($_POST['idAuteur']) && !empty($_POST['idAuteur']) && $row['idAuteur']==$_POST['idAuteur']) echo "selected"; ?>><?= $nomAuteur ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="date" placeholder="Date de parution" id="dateParution" name="dateParution" <?php if(isset($_POST['dateParution']) && !empty($_POST['dateParution'])) echo "value=".$_POST['dateParution']; ?>>
                    </div>
                </div>
                <button class="arrondi" type="submit">Ajouter</button>
            </form>
        </article>
    </div>

<?php include "Footer.php"; ?>