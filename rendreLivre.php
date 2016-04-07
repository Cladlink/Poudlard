<?php include "Header.php"; ?>

<section>
    <h1>Emprunts</h1>
    <div class="row">
        <article class="panel large-12 medium-12 small-12 columns" >
            <form action="#" method="post">
                <div class="row">
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="text" placeholder="Numero d'adherent" id="idAdherent" name="idAdherent">
                    </div>
                    <div class="large-4 medium-4 small-4 columns">
                        <input type="text" placeholder="Code Livre" id="idExemplaire" name="idExemplaire">
                    </div>
                </div>
                <button class="arrondi" type="submit">Ajouter</button>
            </form>
        </article>
    </div>
</section>

<?php include "Footer.php"; ?>
