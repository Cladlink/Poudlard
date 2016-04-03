<?php include "Header.php"; ?>

<section>
    <h1>Recherche</h1>
    <div class="row">
        <article class="panel large-12 medium-12 small-12 columns" >
            <form action="formRecherche.php" method="post">
                <div class="row">
                    <div class="large-4 medium-4 small-4 columns"><input type="text" placeholder="Nom auteur" id="nomAuteur" name="nomAuteur"></div>
                    <div class="large-4 medium-4 small-4 columns"><input type="text" placeholder="Titre du livre" id="titreOeuvre" name="titreOeuvre"></div>
                    <div class="large-4 medium-4 small-4 columns"><input type="date" placeholder="Date de parution" id="dateParution" name="dateParution"></div>
                </div>
                <button class="arrondi" type="submit">Envoyer</button>
            </form>
        </article>
    </div>
</section>

<?php include "Footer.php"; ?>
