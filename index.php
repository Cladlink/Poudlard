<?php
session_start();
include('Header.php');
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
endif;
?>

<section>
    <h1>Bibliothèque de Poudlard</h1>
    <div class = "row">
        <div  class="large-centered medium-centered large-8 medium-10 small-12 columns">
            <img src="img/bibli.jpg" alt="image de bibliothèque" />
        </div>
    </div>

    <article class="panel large-8 large-centered medium-8 medium-centered small-12 columns">
        <h2>Avant-propos</h2>
        <p>
            Depuis cet interface vous pourrez :
              Lorem ipsum dolor sit amet, consectetur adipisicing elit. A accusantium, blanditiis cupiditate dolorem eligendi fuga illum itaque modi molestiae natus necessitatibus nemo neque numquam, placeat quibusdam reprehenderit suscipit vitae voluptates!
        </p>
    </article>
</section>
<?php include('Footer.php'); ?>
