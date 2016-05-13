<?php
session_start();
include "Header.php";
include "php/connexion.php";

if(isset( $_SESSION['message'])): ?>
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
    <h1>Exemplaires</h1>
    <div class="row">
        <article class="panel large-12 medium-12 small-12 columns" >
            <h2>Rechercher dans les exemplaires</h2>
            <form action="exemplaireEtat.php" method="post">
                <div class="row">
                    <div class="large-4 medium-4 small-4 columns">
                        Afficher les exemplaires dont l'état est :
                        <select name="etatEx" id="etatEx">
                            <option value="">Choisir un état</option>
                            <option value="EXCELLENT">EXCELLENT</option>
                            <option value="BON">BON</option>
                            <option value="MOYEN">MOYEN</option>
                            <option value="MAUVAIS">MAUVAIS</option>
                        </select>
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
            <h2 >Liste des exemplaires</h2>
            <?php
            if(isset($_POST)
                && isset($_POST['etatEx']))
            {
                if(!empty($_POST['etatEx'])) {
                    $where = "WHERE EXEMPLAIRE.etatExemplaire LIKE \"" . htmlentities($_POST['etatEx']) . "%\"";
                }

                $ma_commande_SQL = "SELECT EXEMPLAIRE.idExemplaire,
                                          EXEMPLAIRE.etatExemplaire,
                                          OEUVRE.titreOeuvre
                                FROM OEUVRE
                                JOIN EXEMPLAIRE ON OEUVRE.idOeuvre = EXEMPLAIRE.idOeuvre
                                " . $where . "
                                ORDER BY EXEMPLAIRE.idExemplaire;";
            }
            else
            {
                $ma_commande_SQL = "SELECT EXEMPLAIRE.idExemplaire,
                                          EXEMPLAIRE.etatExemplaire,
                                          OEUVRE.titreOeuvre
                                FROM OEUVRE
                                JOIN EXEMPLAIRE ON OEUVRE.idOeuvre = EXEMPLAIRE.idOeuvre
                                ORDER BY EXEMPLAIRE.idExemplaire;";
            }

            $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
            $donnees = $reponse->fetchAll();?>
            <table>
                <thead>
                <tr>
                    <th>ID Exemplaire</th>
                    <th>Titre du livre</th>
                    <th>Etat</th>
                </tr>
                </thead>
                <?php foreach ($donnees as $row) :
                    ?><tr>
                        <td><?= $row['idExemplaire'] ?></td>
                        <td><?= $row['titreOeuvre']; ?></td>
                        <td><?= $row['etatExemplaire']?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </article>
    </div>
</section>

<?php include "Footer.php";