<?php
/**
 * todo
 *      permettre les emprunts (faire liste déroulante des adherents dans un select puis pareil pour livre
 *      gérer les rendus de livre
 *      faire un historique
 *      empécher les emprunts si un livre est emprunté depuis plus de 1mois
 *      limiter les emprunts à deux livres maxi
 *
 */
session_start(); ?>

<?php include "Header.php";?>

<?php if(isset( $_SESSION['message'])): ?>
    <div data-alert class="alert-box success radius">
        <?php echo $_SESSION['message']; ?>
        <a href="#" class="close">&times;</a>
    </div>
    <?php
    unset( $_SESSION['message']);
endif;
if(isset( $_SESSION['messageError'])): ?>
    <div data-alert class="alert-box alert success radius">
        <?php echo $_SESSION['messageError']; ?>
        <a href="#" class="close">&times;</a>
    </div>
    <?php
    unset( $_SESSION['messageError']);
endif; ?>
    <section>
        <h1>Gestion des Emprunts</h1>
        <div class="row">
            <article class="panel large-12 medium-12 small-12 columns" >
                <h2>Rechercher un livre emprunté</h2>
                <form action="empruntGestion.php" method="post">
                    <div class="row">
                        <div class="large-4 medium-4 small-4 columns">
                            <label for="nomAdherent">Nom de l'adherent</label>
                            <input type="text" id="nomAdherent" name="nomAdherent">
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <label for="dateEmpruntMini">date Emprunt mini</label>
                            <input type="date" placeholder="Date d'emprunt mini" id="dateEmpruntMini" name="dateEmpruntMini">

                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <label for="dateEmpruntMaxi">Date d'emprunt maxi</label>
                            <input type="date"  id="dateEmpruntMaxi" name="dateEmpruntMaxi">
                        </div>
                    </div>
                    <button class="arrondi" type="submit">Rechercher</button>
                </form>
            </article>
        </div>
    </section>

    <section>
        <div class="row">
            <article class=" panel large-12 medium-12 small-12 columns">
                <h2 >Liste des livres empruntés</h2>
                <a href="empruntAdd.php"><img class="imagePlus" src="img/ajouter.png" alt="plus sur fond vert"/></a>
                <?php
                if(isset($_POST)
                    && isset($_POST['nomAdherent'])
                    && isset($_POST['dateEmpruntMini'])
                    && isset($_POST['dateEmpruntMaxi']))
                {

                    if(!empty($_POST['nomAdherent'])
                        || !empty($_POST['dateEmpruntMini'])
                        || !empty($_POST['dateEmpruntMaxi']))
                    {
                        $where = " ";
                        if(!empty($_POST['nomAdherent']))
                            $where = $where . "AND ADHERENT.nomAdherent like \"%" . htmlentities($_POST['nomAdherent']) . "%\" ";

                        if(!empty($_POST['dateEmpruntMini']))
                        {
                            $where = $where . "AND EMPRUNT.dateEmprunt >= \"" . htmlentities($_POST['dateEmpruntMini']) . "\" ";
                        }
                        if(!empty($_POST['dateEmpruntMaxi']))
                        {
                            $where = $where . "AND EMPRUNT.dateEmprunt <= \"" . htmlentities($_POST['dateEmpruntMaxi']) . "\" ";
                        }
                    }
                    include "php/connexion.php";


                    $ma_commande_SQL = "SELECT EMPRUNT.idAdherent, EMPRUNT.idExemplaire, ADHERENT.nomAdherent, OEUVRE.titreOeuvre, EMPRUNT.dateEmprunt, ADDDATE(EMPRUNT.dateEmprunt, INTERVAL 45 DAY) as dateRenduMax
                                        FROM EMPRUNT
                                        JOIN ADHERENT
                                          ON EMPRUNT.idAdherent = ADHERENT.idAdherent
                                        JOIN EXEMPLAIRE
                                          ON EXEMPLAIRE.idExemplaire = emprunt.idExemplaire
                                        JOIN OEUVRE
                                          ON EXEMPLAIRE.idOeuvre = OEUVRE.idOeuvre
                                        WHERE EMPRUNT.dateRendu IS NULL"
                                        . $where . "
                                        ORDER BY EMPRUNT.dateEmprunt DESC;";
                }
                else
                {
                    $ma_commande_SQL = "SELECT EMPRUNT.idAdherent, EMPRUNT.idExemplaire, ADHERENT.nomAdherent, OEUVRE.titreOeuvre, EMPRUNT.dateEmprunt, ADDDATE(EMPRUNT.dateEmprunt, INTERVAL 45 DAY) as dateRenduMax
                                        FROM EMPRUNT
                                        JOIN ADHERENT
                                          ON EMPRUNT.idAdherent = ADHERENT.idAdherent
                                        JOIN EXEMPLAIRE
                                          ON EXEMPLAIRE.idExemplaire = emprunt.idExemplaire
                                        JOIN OEUVRE
                                          ON EXEMPLAIRE.idOeuvre = OEUVRE.idOeuvre
                                        WHERE EMPRUNT.dateRendu IS NULL
                                        ORDER BY EMPRUNT.dateEmprunt DESC;
                                        ";
                }

                include "php/connexion.php";
                $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
                $donnees = $reponse->fetchAll();
                ?>

                <table>
                    <tr>
                    <th>Nom Adherent</th>
                    <th>Livre emprunté</th>
                    <th>Date d'emprunt</th>
                    <th>Date de rendu maxi</th>
                    </tr>

                    <?php foreach ($donnees as $row) :
                        $addRendu = "empruntRendu.php?adherent="
                            . $row['idAdherent']
                            ."&exemplaire="
                            . $row['idExemplaire']
                            ."&dateEmprunt="
                            . $row['dateEmprunt'];
                        ?><tr>
                        <td><?= $row['nomAdherent']; ?></td>
                        <td><?= $row['titreOeuvre']; ?></td>
                        <td><?= $row['dateEmprunt']?></td>
                        <td><?= $row['dateRenduMax']?></td>
                        <td><a href="<?= $addRendu ?>"><img class="icone" src="img/livreRendu.png" alt="livre ouvert avec plume"></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </article>
        </div>
    </section>
<?php include "Footer.php";