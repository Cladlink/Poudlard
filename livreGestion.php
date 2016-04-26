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
    <h1>Gestion des livres</h1>
    <div class="row">
        <article class="panel large-12 medium-12 small-12 columns" >
            <h2>Rechercher un livre</h2>
            <form action="livreGestion.php" method="post">
                <div class="row">
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="text" placeholder="Titre de livre" id="titreLivre" name="titreLivre">
                    </div>
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="text" placeholder="Nom de l'auteur" id="nomAuteur" name="nomAuteur">
                    </div>
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="date" placeholder="Date de parution" id="dateParution" name="dateParution">
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
            <a href="livreAdd.php"><img class="imagePlus" src="img/ajouter.png" alt="plus sur fond vert"/></a>
            <h2 >Liste des livres</h2>
            <?php
            if(isset($_POST)
                && isset($_POST['titreLivre'])
                && isset($_POST['nomAuteur'])
                && isset($_POST['dateParution']))
            {
                if(!empty($_POST['titreLivre'])
                    || !empty($_POST['nomAuteur'])
                    || !empty($_POST['dateParution'])) {
                    $where = "WHERE";
                    if (!empty($_POST['titreLivre']))
                        $where = $where . " OEUVRE.titreOeuvre LIKE \"%" . htmlentities($_POST['titreLivre']) . "%\"";
                    if (!empty($_POST['nomAuteur']))
                        if ($where == "WHERE")
                            $where = $where . " AUTEUR.nomAuteur LIKE \"%" . htmlentities($_POST['nomAuteur']) . "%\"";
                        else
                            $where = $where . " AND AUTEUR.nomAuteur LIKE \"%" . htmlentities($_POST['nomAuteur']) . "%\"";
                    if (!empty($_POST['dateParution']))
                        if ($where == "WHERE")
                            $where = $where . " OEUVRE.dateParutionOeuvre LIKE \"%" . htmlentities($_POST['dateParution']) . "%\"";
                        else
                            $where = $where . " AND OEUVRE.dateParutionOeuvre LIKE \"%" . htmlentities($_POST['dateParution']) . "%\"";
                }

                $ma_commande_SQL = "SELECT OEUVRE.idOeuvre,
                                            OEUVRE.titreOeuvre,
                                            AUTEUR.nomAuteur,
                                            OEUVRE.dateParutionOeuvre
                                    FROM OEUVRE
                                    JOIN AUTEUR ON OEUVRE.idAuteur = AUTEUR.idAuteur
                                    " . $where . "
                                    ORDER BY AUTEUR.nomAuteur, OEUVRE.titreOeuvre;";
            }
            else
            {
                $ma_commande_SQL = "SELECT OEUVRE.idOeuvre,
                                            OEUVRE.titreOeuvre,
                                           AUTEUR.nomAuteur,
                                            OEUVRE.dateParutionOeuvre
                                        FROM OEUVRE
                                        JOIN AUTEUR ON OEUVRE.idAuteur = AUTEUR.idAuteur
                                        ORDER BY AUTEUR.nomAuteur, OEUVRE.titreOeuvre;";
            }

            $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
            $donnees = $reponse->fetchAll();?>
            <table>
                <thead>
                <th>ID Oeuvre</th>
                <th>Titre</th>
                <th>Nom Auteur</th>
                <th>Date de parution</th>
                <th>Accéder aux exemplaires</th>
                <th>Modifier</th>
                <th>Supprimer</th>
                </thead>
            <?php foreach ($donnees as $row) :
                $addrUpdate = "livreUpdate.php?oeuvre=" . $row['idOeuvre'];
                $addrDelete = "livreSupprimer.php?oeuvre=" . $row['idOeuvre'];
                $addrExemplaire = "exemplaireGestion.php?oeuvre=" . $row["idOeuvre"];
                ?><tr>
                <td><?= $row['idOeuvre'] ?></td>
                <td><?= $row['titreOeuvre']; ?></td>
                <td><?= $row['nomAuteur']?></td>
                <td><?= $row['dateParutionOeuvre']?></td>
                <td><a href="<?= $addrExemplaire?>"><img class="icone" src="img/exemplaire.png" alt="icone exemplaire"></a></td>
                <td><a href="<?= $addrUpdate?>"><img class="icone" src="img/modifier.png" alt="icone modifier"></a></td>
                <td><a href="<?= $addrDelete?>"><img class="icone" src="img/supprimer.png" alt="croix rouge"></a></td>
                </tr>
            <?php endforeach; ?>
            </table>
        </article>
    </div>
</section>

<?php include "Footer.php"; ?>
