<?php
session_start();

include "php/connexion.php";
include "Header.php";?>

<section>
    <div class="row">
        <article class=" panel large-12 medium-12 small-12 columns">
            <h2 >Liste des livres empruntés</h2>
            <?php
                $ma_commande_SQL = "SELECT EMPRUNT.idAdherent, EMPRUNT.idExemplaire, ADHERENT.nomAdherent, OEUVRE.titreOeuvre, EMPRUNT.dateEmprunt, ADDDATE(EMPRUNT.dateEmprunt, INTERVAL 45 DAY) as dateRenduMax
                                    FROM EMPRUNT
                                    JOIN ADHERENT
                                      ON EMPRUNT.idAdherent = ADHERENT.idAdherent
                                    JOIN EXEMPLAIRE
                                      ON EXEMPLAIRE.idExemplaire = emprunt.idExemplaire
                                    JOIN OEUVRE
                                      ON EXEMPLAIRE.idOeuvre = OEUVRE.idOeuvre
                                    ORDER BY EMPRUNT.dateEmprunt DESC;
                                    ";
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
                    </tr>
                <?php endforeach; ?>
            </table>
        </article>
    </div>
</section>
<?php include "Footer.php";