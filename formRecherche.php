<?php include "Header.php"; ?>

<section>
    <h1>Liste des livres</h1>
    <div class="row">
        <article class="panel large-12 medium-12 small-12 columns">
        <?php
        if(isset($_POST) && isset($_POST['nomAuteur']) && isset($_POST['titreOeuvre']) && isset($_POST['dateParution'])):

            if(!empty($_POST['nomAuteur']) || !empty($_POST['titreOeuvre']) || !empty($_POST['dateParution']))
            {
                if(!empty($_POST['nomAuteur']))
                    $where = $where . "AND AUTEUR.nomAuteur like \"%" . $_POST['nomAuteur'] . "%\" ";
                if(!empty($_POST['titreOeuvre']))
                    $where = $where . "AND OEUVRE.titreOeuvre like \"%" . $_POST['titreOeuvre'] . "%\" ";
                if(!empty($_POST['dateParution']))
                    $where = $where . "AND YEAR(OEUVRE.dateParutionOeuvre) = YEAR(" . $_POST['dateParution'] . ")";
            }
            include "php/connexion.php";


            $ma_commande_SQL = "SELECT OEUVRE.titreOeuvre, AUTEUR.nomAuteur, AUTEUR.prenomAuteur, OEUVRE.dateParutionOeuvre, EXEMPLAIRE.idExemplaire,
                                   COUNT(exemplaire.idExemplaire) as exemplaire_Restant
                                FROM EXEMPLAIRE
                                JOIN OEUVRE ON exemplaire.idOeuvre = oeuvre.idOeuvre
                                JOIN AUTEUR ON oeuvre.idAuteur = auteur.idAuteur
                                WHERE exemplaire.idExemplaire NOT IN
                                      (
                                  SELECT exemplaire.idExemplaire
                                  FROM emprunt
                                  JOIN exemplaire ON emprunt.idExemplaire = exemplaire.idExemplaire
                                  WHERE dateRendu IS NULL
                                )
                                ". $where ."
                                GROUP BY Oeuvre.titreOeuvre;";
            $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
            $donnees = $reponse->fetchAll();?>
            <table>
                <thead>
                    <th>Titre livre</th>
                    <th>Nom auteur</th>
                    <th>Prenom auteur</th>
                    <th>Date de parution</th>
                    <th>Quantité disponible</th>
                </thead>
            <?php foreach ($donnees as $row) :

                ?><tr>
                    <td><?= $row['titreOeuvre'] ?></td>
                    <td><?= $row['nomAuteur']; ?></td>
                    <td><?= $row['prenomAuteur']?></td>
                    <td><?= $row['dateParutionOeuvre']?></td>
                    <td><?= $row['exemplaire_Restant']?></td>
                </tr>
            <?php endforeach; ?>
            </table>
        <?php endif; ?>
        </article>
    </div>
</section>
<?php include "Footer.php";?>