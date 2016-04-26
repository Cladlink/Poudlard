<?php
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
        <h1>Gestion des auteurs</h1>
        <div  class="large-centered medium-centered small-centered large-4 medium-6 small-10 columns">
            <img src="img/auteurs.jpg" alt="Gilderoy Lockhart"/>
        </div>
        <div class="row">
            <article class="panel large-12 medium-12 small-12 columns" >
                <h2>Rechercher un auteur</h2>
                <form action="auteurGestion.php" method="post">
                    <div class="row">
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="text" placeholder="Nom de l'auteur" id="nomAuteur" name="nomAuteur">
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="text" placeholder="Prénom de l'auteur" id="prenomAuteur" name="prenomAuteur">
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
                <h2 >Liste des auteurs</h2>
                <a href="auteurAdd.php"><img class="imagePlus" src="img/ajouter.png" alt="plus sur fond vert"/></a>
                <?php
                if(isset($_POST)
                    && isset($_POST['nomAuteur'])
                    && isset($_POST['prenomAuteur']))
                {

                    if(!empty($_POST['nomAuteur'])
                        || !empty($_POST['prenomAuteur']))
                    {
                        $where = "WHERE ";
                        if(!empty($_POST['nomAuteur']))
                            $where = $where . "AUTEUR.nomAuteur like \"" . htmlentities($_POST['nomAuteur']) . "%\" ";

                        if(!empty($_POST['prenomAuteur']))

                            if ($where == "WHERE ")
                                $where = $where . "AUTEUR.prenomAuteur like \"" . htmlentities($_POST['prenomAuteur']) . "%\" ";
                            else
                                $where = $where . "AND AUTEUR.prenomAuteur like \"" . htmlentities($_POST['prenomAuteur']) . "%\" ";

                    }
                    include "php/connexion.php";


                    $ma_commande_SQL = "SELECT  AUTEUR.idAuteur,
                                                AUTEUR.nomAuteur,
                                                AUTEUR.prenomAuteur
                                        FROM    AUTEUR "
                        . $where
                        . " ORDER BY AUTEUR.nomAuteur;";
                }
                else
                {
                    $ma_commande_SQL = "SELECT  AUTEUR.idAuteur,
                                                AUTEUR.nomAuteur,
                                                AUTEUR.prenomAuteur
                                          FROM    AUTEUR
                                        ORDER BY AUTEUR.nomAuteur;";
                }

                include "php/connexion.php";
                $reponse = $ma_connexion_mysql->query($ma_commande_SQL);
                $donnees = $reponse->fetchAll();?>
                <table>
                    <tr>
                        <th>Nom Auteur</th>
                        <th>Prénom Auteur</th>
                        <th>modifier</th>
                        <th>supprimer</th>
                    </tr>
                    <?php foreach ($donnees as $row) :
                        $addrUpdate = "auteurUpdate.php?auteur=" . $row['idAuteur'];
                        $addrDelete = "auteurSupprimer.php?auteur=" . $row['idAuteur'];
                        ?><tr>
                        <td><?= $row['nomAuteur']; ?></td>
                        <td><?= $row['prenomAuteur']?></td>
                        <td><a href="<?= $addrUpdate?>"><img class="icone" src="img/modifier.png" alt="icone modifier"></a></td>
                        <td><a href="<?= $addrDelete?>"><img class="icone" src="img/supprimer.png" alt="croix rouge"></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </article>
        </div>
    </section>
<?php include "Footer.php";