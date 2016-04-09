<?php include "Header.php";

// requete ajouter adherent
if (isset($_POST['nomAdherent'])
    && isset($_POST['adresseAdherent'])
    && isset($_POST['dateAdhesion']))
{
    if (!empty($_POST['nomAdherent'])
        && !empty($_POST['adresseAdherent'])
        && !empty($_POST['dateAdhesion']))
    {

        include "php/connexion.php";

        $ma_commande_SQL = "INSERT INTO ADHERENT VALUES (null, \""
            . $_POST['nomAdherent']
            . "\", \""
            . $_POST['adresseAdherent']
            . "\", \""
            . $_POST['dateAdhesion']
            . "\");";
        if($ma_connexion_mysql!= NULL)
        {
            $nbr_lignes_affectees=$ma_connexion_mysql->exec($ma_commande_SQL);
        }

        $message = 	"l'adherent " . $_POST['nomAdherent'] . " a bien été créé !";
        header('location: adherentGestion.php');
    }
}
?>
    <h1>Adherent</h1>
    <section>
        <div class="row">
            <article class="panel large-12 medium-12 small-12 columns" >
                <h2>modifier un adhérent</h2>
                <form action="adherentAdd.php" method="post">
                    <div class="row">
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="text" placeholder="Nom de l'adherent" id="nomAdherent" name="nomAdherent">
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="text" placeholder="Adresse de l'adhérent" id="adresseAdherent" name="adresseAdherent">
                        </div>
                        <div class="large-4 medium-4 small-4 columns">
                            <input type="date" placeholder="Date Adhésion" id="dateAdhesion" name="dateAdhesion">
                        </div>
                    </div>
                    <button class="arrondi" type="submit">Ajouter</button>
                </form>
            </article>
        </div>
    </section>
<?php include "Footer.php";