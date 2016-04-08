<?php include "Header.php";
if (isset($_POST['nomAdherent'])
    && isset($_POST['adresseAdherent']))
{
    include "php/connexion.php";

    $ma_commande_SQL = "INSERT INTO ADHERENT VALUES (null, \""
        . $_POST['nomAdherent']
        . "\", \""
        . $_POST['adresseAdherent']
        . "\", NOW())";
    echo "coucou";echo "coucou";echo "coucou";echo "coucou";
    if($ma_connexion_mysql!= NULL)
    {
        $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
        echo "\n<br> nbre de lignes affectees : ".$nbr_lignes_affectees;
    }

    $message = 	"l'adherent " . $_POST['nomAdherent'] . " a bien été créé !";
}


?>

<?php if(isset($message)): ?>
    <div data-alert class="alert-box success radius">
        <?php echo $message; ?>
        <a href="#" class="close">&times;</a>
    </div>
<?php endif ?>
    <section>
        <h1>Ajouter un adhérent</h1>
        <div class="row">
            <article class="panel large-12 medium-12 small-12 columns" >
                <form action="gestionAdherent.php" method="post">
                    <div class="row">
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="text" placeholder="Nom de l'adherent" id="nomAdherent" name="nomAdherent">
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="text" placeholder="Adresse de l'adhérent" id="adresseAdherent" name="adresseAdherent">
                        </div>
                    </div>
                    <button class="arrondi" type="submit">Ajouter</button>
                </form>
            </article>
        </div>
    </section>

<?php include "Footer.php";