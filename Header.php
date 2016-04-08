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
		<link rel="icon" href="img/favicon.ico" />
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
					<ul class="left">
						<li class="active"><a href="recherche.php">Recherche</a></li>

						<li class="has-dropdown active">
							<a href="#">Gestion des emprunts</a>
							<ul class="dropdown">
								<li><a href="empruntLivre.php">Emprunter un livre</a></li>
								<li><a href="rendreLivre.php">Rendre un livre</a></li>
								<li><a href="listeEmprunts.php">Liste des emprunts</a></li>
							</ul>
						</li>

						<li class="active">
							<a href="rechercheAdherents.php">Gestion des livres</a>
						</li>

						<li class="has-dropdown active">
							<a href="#">Gestion des adhérents</a>
							<ul class="dropdown">
								<li><a href="gestionAdherent.php">ajouter un adhérent</a></li>
								<li><a href="rechercheAdherents.php">rechercher un adhérent</a></li>
							</ul>
						</li>

						<li class="has-dropdown active">
							<a href="#">Gestion des auteurs</a>
							<ul class="dropdown">
								<li><a href="gestionAdherent.php">ajouter un auteur</a></li>
								<li><a href="rechercheAdherents.php">rechercher un aauteur</a></li>
							</ul>
						</li>

						<li class="has-dropdown active">
							<a href="#">Gestion des exemplaires</a>
							<ul class="dropdown">
								<li><a href="gestionAdherent.php">ajouter un exemplaire</a></li>
								<li><a href="rechercheAdherents.php">rechercher un exemplaire</a></li>
							</ul>
						</li>

					</ul>
				</section>
			</nav>
		</div>
