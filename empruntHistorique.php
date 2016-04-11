<?php
session_start();

include "Header.php" ?>
    <section>
        <h1>Historique des Emprunts</h1>
        <div class="row">
            <article class="panel large-12 medium-12 small-12 columns" >
                <h2>Recherche</h2>
                <form action="empruntHistorique.php" method="post">
                    <div class="row">
                        <div class="large-4 medium-4 small-4 columns">
                            <div>
                                <label for="nomAdherent">Nom de l'adherent</label>
                                <input type="text" id="nomAdherent" name="nomAdherent">
                            </div>
                            <div>
                                <label for="titreOeuvre">Titre du livre</label>
                                <input type="text" id="titreOeuvre" name="titreOeuvre">
                            </div>
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <div>
                                <label for="dateEmpruntMini">date Emprunt mini</label>
                                <input type="date" placeholder="Date d'emprunt mini" id="dateEmpruntMini" name="dateEmpruntMini">

                            </div>
                            <div>
                                <label for="dateEmpruntMaxi">Date d'emprunt maxi</label>
                                <input type="date"  id="dateEmpruntMaxi" name="dateEmpruntMaxi">
                            </div>
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <div>
                                <label for="dateRenduMini">date Rendu mini</label>
                                <input type="date" placeholder="Date d'Rendu mini" id="dateRenduMini" name="dateRenduMini">

                            </div>
                            <div>
                                <label for="dateRenduMaxi">Date d'Rendu maxi</label>
                                <input type="date"  id="dateRenduMaxi" name="dateRenduMaxi">
                            </div>
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
                <h2 >Historique des livres empruntés</h2><?php
                if(isset($_POST)
                    && isset($_POST['nomAdherent'])
                    && isset($_POST['dateEmpruntMini'])
                    && isset($_POST['dateEmpruntMaxi'])
                    && isset($_POST['dateRenduMini'])
                    && isset($_POST['dateRenduMaxi'])
                    && isset($_POST['titreOeuvre']))
                {

                    if(!empty($_POST['nomAdherent'])
                        || !empty($_POST['dateEmpruntMini'])
                        || !empty($_POST['dateEmpruntMaxi'])
                        || !empty($_POST['dateRenduMini'])
                        || !empty($_POST['dateRenduMaxi'])
                        || !empty($_POST['titreOeuvre']))
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
                        if(!empty($_POST['dateEmpruntMini']))
                        {
                            $where = $where . "AND EMPRUNT.dateRendu >= \"" . htmlentities($_POST['dateRenduMini']) . "\" ";
                        }
                        if(!empty($_POST['dateEmpruntMaxi']))
                        {
                            $where = $where . "AND EMPRUNT.dateRendu <= \"" . htmlentities($_POST['dateRenduMaxi']) . "\" ";
                        }
                        if(!empty($_POST['titreOeuvre']))
                        {
                            $where = $where . "AND OEUVRE.titreOeuvre like \"%" . htmlentities($_POST['titreOeuvre']) . "%\" ";
                        }
                    }
                    include "php/connexion.php";


                    $ma_commande_SQL = "SELECT ADHERENT.nomAdherent, OEUVRE.titreOeuvre, EMPRUNT.dateEmprunt, EMPRUNT.dateRendu
                                        FROM EMPRUNT
                                        JOIN ADHERENT
                                          ON EMPRUNT.idAdherent = ADHERENT.idAdherent
                                        JOIN EXEMPLAIRE
                                          ON EXEMPLAIRE.idExemplaire = emprunt.idExemplaire
                                        JOIN OEUVRE
                                          ON EXEMPLAIRE.idOeuvre = OEUVRE.idOeuvre
                                        WHERE EMPRUNT.dateRendu IS NOT NULL"
                        . $where . "
                                        ORDER BY EMPRUNT.dateRendu DESC;";
                }
                else
                {
                    $ma_commande_SQL = "SELECT ADHERENT.nomAdherent, OEUVRE.titreOeuvre, EMPRUNT.dateEmprunt, EMPRUNT.dateRendu
                                        FROM EMPRUNT
                                        JOIN ADHERENT
                                          ON EMPRUNT.idAdherent = ADHERENT.idAdherent
                                        JOIN EXEMPLAIRE
                                          ON EXEMPLAIRE.idExemplaire = emprunt.idExemplaire
                                        JOIN OEUVRE
                                          ON EXEMPLAIRE.idOeuvre = OEUVRE.idOeuvre
                                        WHERE EMPRUNT.dateRendu IS NOT NULL
                                        ORDER BY EMPRUNT.dateRendu DESC;
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
                        <th>Date de rendu</th>
                    </tr>

                    <?php foreach ($donnees as $row) :
                        ?><tr>
                        <td><?= $row['nomAdherent']; ?></td>
                        <td><?= $row['titreOeuvre']; ?></td>
                        <td><?= $row['dateEmprunt']?></td>
                        <td><?= $row['dateRendu']?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </article>
        </div>
    </section>
<?php include "Footer.php";