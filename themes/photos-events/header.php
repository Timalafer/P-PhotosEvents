<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package photos-events
 */

?>

<!doctype html>
<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">

		<header class="site-header">
			<nav id="site-navigation" class="siteNavigation" role="navigation">
				<div class="logo">
					<a href="<?php echo home_url('/'); ?>"> <!-- Lien vers la page d'accueil -->
						<img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/Logo.png'; ?>" alt="Logo"> <!-- Affichage du logo -->
					</a>
				</div>

				<div class="burgerMenu">
					<span class="bar"></span>
					<span class="bar"></span>
					<span class="bar"></span> <!-- Éléments pour le menu burger (mobile) -->
				</div>

				<div class="navigation">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1', // Emplacement du menu déclaré dans functions.php
							'container'      => 'false', // Pas de conteneur HTML pour le menu
							'menu_class'     => 'menuNavigation', // Classe pour le style du menu
						)
					);
					?>
				</div>
			</nav>

		</header>