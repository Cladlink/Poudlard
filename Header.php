<!DOCTYPE html>
<html class="no-js" lang="fr">

	<head>
		<title>Bibliothèque de Poudlard</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/foundation.css" />
		<link rel="stylesheet" href="css/foundation.min.css" />
		<link rel="stylesheet" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="styles.css" />
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
						<?php if (isset($_SESSION['droit']) && $_SESSION['droit'] == 'admin') : ?>
						<li class="has-dropdown active"><a href="#">Emprunt</a>
						<ul class="dropdown">
							<li class="active"><a  href="empruntGestion.php">Emprunts / rendus</a></li>
							<li class="active"><a href="empruntHistorique.php">Historique</a></li>
						</ul>
						</li>
						<li class="active"><a href="livreGestion.php">Livres</a></li>
						<li class="active"><a href="adherentGestion.php">Adhérents</a></li>
						<li class="active"><a href="auteurGestion.php">Auteurs</a></li>
						<li class="active"><a href="statsGestion.php">Statistiques</a></li>
					<?php endif; ?>
					</ul>

					<ul class="right">
						<?php if(isset($_SESSION['droit'])) : ?>
                            <li class="active"><a href="User_disconnect.php?deconnexion=deconnexion">se deconnecter</a></li>
						<?php else: ?>
							<li class="active"><a href="User_connect.php">se connecter </a></li>
						<?php endif; ?>
					</ul>
				</section>
			</nav>
		</div>