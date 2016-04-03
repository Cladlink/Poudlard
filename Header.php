<!DOCTYPE html>
<html class="no-js" lang="fr">
	<head>
		<title>Bibliothèque de Poudlard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/foundation.css" />
		<link rel="stylesheet" href="css/foundation.min.css" />
		<link rel="stylesheet" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="Styles.css" />
		<link rel="icon" href="img/favicon.png" />

		<script src="js/vendor/modernizr.js"></script>
	</head>
	<body>
		<div class="fixed" >
			<nav class="top-bar" data-topbar role="navigation">
				<ul class="title-area">
					<li class="name">
						<h1><a href="index.php">Bibliothèque</a></h1>
					</li>
					<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
				</ul>	

				<section class="top-bar-section">
					<!-- Right Nav Section -->
					<ul class="left">
						<li class="active"><a href="recherche.php">Recherche</a></li>
						<li class="has-dropdown active">
							<a href="#">Gestion des livres</a>
							<ul class="dropdown">
								<li><a href="ajouterLivre.php">Ajouter un livre</a></li>
								<li><a href="supprimerLivre.php">Supprimer un livre</a></li>
								<li><a href="#">Rechercher un livre</a></li>
							</ul>
						</li>
						<li class="has-dropdown active">
							<a href="#">Gestion des emprunts</a>
							<ul class="dropdown">
								<li><a href="ajouterEmprunt.php">Ajouter un emprunt</a></li>
								<li><a href="rendreLivre.php">Rendre un livre</a></li>
								<li><a href="empruntsEnCours.php">Emprunts en cours</a></li>
							</ul>
						</li>
						<li class="has-dropdown active">
							<a href="#">Gestion des adhérents</a>
							<ul class="dropdown">
								<li><a href="ajouterAdherent.php">Ajouter un adhérent</a></li>
								<li><a href="supprimerAdherent.php">Supprimer un adhérent</a></li>
								<li><a href="rechercherAdherent.php">Rechercher un adhérent</a></li>
							</ul>
						</li>
					</ul>
				</section>
			</nav>
		</div>
