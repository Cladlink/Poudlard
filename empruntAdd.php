<?php
session_start();
include "Header.php";
include "php/connexion.php";

if (isset($_POST)
    && isset($_POST['idAdherent'])
    && isset($_POST['idExemplaire'])):

    if (!empty($_POST['idAdherent'])
        && !empty($_POST['idExemplaire'])):

        $ma_commande_SQL = "SELECT nomAdherent, count(*) as compte
                            FROM emprunt
                              JOIN adherent
                              ON adherent.idAdherent = emprunt.idAdherent
                            WHERE emprunt.idAdherent = " . htmlentities($_POST['idAdherent']) . "
                              AND emprunt.dateRendu IS NULL
                            GROUP BY emprunt.idAdherent
                            HAVING compte >= 2;";
        $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
        $donnees = $reponse->fetchAll();
        if($donnees)
        {
            $_SESSION['messageError'] = "Un adhérent ne peut emprunter plus de deux livres ! ";
        }
        else
        {
            $ma_commande_SQL = "SELECT ADHERENT.nomAdherent, EMPRUNT.dateEmprunt, ADDDATE(EMPRUNT.dateEmprunt, INTERVAL 45 DAY) as dateRenduMax
                                FROM EMPRUNT
                                  JOIN ADHERENT
                                    ON EMPRUNT.idAdherent = ADHERENT.idAdherent
                                WHERE EMPRUNT.dateRendu IS NULL
                                  AND adherent.idAdherent =". htmlentities($_POST['idAdherent']) ."
                                HAVING now() > dateRenduMax
                                ORDER BY ADHERENT.nomAdherent;";
            $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
            $donnees = $reponse->fetchAll();
            if($donnees)
            {
                $_SESSION['messageError'] = "Ne peut emprunter de nouveaux livres un livre emprunté depuis plus de 45 jours ! ";
            }
            else
            {
            $ma_commande_SQL = "INSERT INTO EMPRUNT VALUES (\""
            . htmlentities($_POST['idAdherent'])
            . "\", \""
            . htmlentities($_POST['idExemplaire'])
            . "\", now(), null);";
                if($ma_connexion_mysql!= NULL)
                {
                    $ma_connexion_mysql->exec($ma_commande_SQL);
                }

                $_SESSION['message'] = 	"Le prêt est bien enregistré !";
                header('location: empruntGestion.php');
            }
        }
    else:
        $_SESSION['messageError'] = "Merci de saisir tous les champs !";
    endif;
endif; ?>

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
                                <option value="">Choisir un adhérent</option>
                                <?php
                                $ma_commande_SQL = "SELECT idAdherent, nomAdherent FROM adherent;";
                                $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
                                $donnees = $reponse->fetchAll();
                                foreach($donnees as $row): ?>
                                    <option value="<?= $row['idAdherent']?>" <?php if(isset($_POST['idAdherent']) && !empty($_POST['idAdherent']) && $row['idAdherent']==$_POST['idAdherent']) echo "selected"; ?>><?= $row['nomAdherent']?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <label for="idExemplaire">Exemplaires disponible</label>
                            <select name="idExemplaire" id="idExemplaire">
                                <option value="">Choisir un exemplaire</option>
                                <?php
                                $ma_commande_SQL = "SELECT EXEMPLAIRE.idExemplaire, OEUVRE.titreOeuvre, exemplaire.idExemplaire, exemplaire.etatExemplaire
                                                    FROM EXEMPLAIRE
                                                      JOIN OEUVRE ON exemplaire.idOeuvre = oeuvre.idOeuvre
                                                    WHERE exemplaire.idExemplaire NOT IN
                                                          (
                                                            SELECT exemplaire.idExemplaire
                                                            FROM emprunt
                                                              JOIN exemplaire ON emprunt.idExemplaire = exemplaire.idExemplaire
                                                            WHERE dateRendu IS NULL
                                                          );";
                                $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
                                $donnees = $reponse->fetchAll();
                                foreach($donnees as $row):
                                    $titre = $row['idExemplaire'] . " - " . $row['titreOeuvre'] . " - " . $row['etatExemplaire'];
                                    ?>

                                    <option value="<?= $row['idExemplaire']?>" <?php if(isset($_POST['idExemplaire']) && !empty($_POST['idExemplaire']) && $row['idExemplaire']==$_POST['idExemplaire']) echo "selected"; ?>><?= $titre ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <button class="arrondi" type="submit">Ajouter</button>
                </form>
            </article>
        </div>
    </section>
<?php include "Footer.php";