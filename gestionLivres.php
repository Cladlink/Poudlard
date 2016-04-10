<?php
session_start();
include "Header.php"; ?>

<section>
    <h1>Ajouter un adhérent</h1>
    <div class="row">
        <article class="panel large-12 medium-12 small-12 columns" >
            <form action="formRechercheAdherent.php" method="post">
                <div class="row">
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="text" placeholder="" id="nomAdherent" name="nomAdherent">
                    </div>
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

<?php include "Footer.php"; ?>
