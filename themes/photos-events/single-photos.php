<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package photos-events
 */

get_header();
?>

<?php

//ACF
$photo_url = get_field('photo');
$reference = get_field('reference');
$REFERENCE = strtoupper(get_field('reference'));
$type = get_field('type');

$annees = get_the_terms(get_the_ID(), 'date');
if ($annees && !is_wp_error($annees)) {
	$annee_names = array();
	foreach ($annees as $annee) {
		$annee_names[] = $annee->name;
	}
	$year = implode(', ', $annee_names);
} else {
	$year = 'Aucune date définie';
}

$categories = get_the_terms(get_the_ID(), 'categorie');
$formats = get_the_terms(get_the_ID(), 'format');
$categorie_name = $categories[0]->name;

// Définissez les URLs des vignettes pour le post précédent et suivant
$nextPost = get_next_post();
$previousPost = get_previous_post();
$previousThumbnailURL = $previousPost ? get_the_post_thumbnail_url($previousPost->ID, 'thumbnail') : '';
$nextThumbnailURL = $nextPost ? get_the_post_thumbnail_url($nextPost->ID, 'thumbnail') : '';

?>

<section class="cataloguePhotos">
	<div class="galleryPhotos">
		<div class="detailPhoto">

			<div class="containerPhoto">
				<?php
				$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
				$photo_url = $image ? $image[0] : ''; // Récupération de l'URL de l'image

				if ($photo_url) {
					echo '<img src="' . esc_url($photo_url) . '" alt="' . esc_attr(get_the_title()) . '">';
				} else {
					echo 'Image non disponible';
				}
				?>
				<div class="singlePhotoOverlay">
					<div class="fullscreen-icon" data-reference="<?php echo esc_attr($reference); ?>" data-full="<?php echo esc_url($photo_url); ?>" data-category="<?php echo esc_attr($categorie_name); ?>">
						<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/fullscreen.svg" alt="Icone fullscreen">
					</div>
				</div>
			</div>

			<div class="selecteurK">
				<h2><?php echo get_the_title(); ?></h2>

				<div class="taxonomies">

					<p>RÉFÉRENCE : <span id="single-reference"><?php echo strtoupper($reference) ?></span></p>
					<p>CATÉGORIE : <?php foreach ($categories as $key => $cat) {
										$categoryNameSingle = $cat->name;
										echo strtoupper($categoryNameSingle);
									}  ?></p>
					<p>FORMAT : <?php foreach ($formats as $key => $format) {
									$formatName = $format->name;
									echo strtoupper($formatName);
								} ?></p>
					<p>TYPE : <?php echo strtoupper($type) ?> </p>
					<p>ANNÉE : <?php echo $year ?> </p>
				</div>
			</div>
		</div>
	</div>

	<div class="contenairContact">
		<div class="contact">
			<p class="interesser"> Cette photo vous intéresse ? </p>
			<button id="boutonContact" data-reference="<?php echo $REFERENCE; ?>">Contact</button>
		</div>

		<div class="naviguationPhotos">

			<!-- Conteneur pour la miniature -->
			<div class="miniPicture" id="miniPicture">
				<!-- La miniature sera chargée ici par JavaScript -->
			</div>

			<div class="naviguationArrow">
				<?php if (!empty($previousPost)) : ?>
					<img class="arrow arrow-left" src="<?php echo get_theme_file_uri() . '/assets/images/left.png'; ?>" alt="Photo précédente" data-thumbnail-url="<?php echo $previousThumbnailURL; ?>" data-target-url="<?php echo esc_url(get_permalink($previousPost->ID)); ?>">
				<?php endif; ?>

				<?php if (!empty($nextPost)) : ?>
					<img class="arrow arrow-right" src="<?php echo get_theme_file_uri() . '/assets/images/right.png'; ?>" alt="Photo suivante" data-thumbnail-url="<?php echo $nextThumbnailURL; ?>" data-target-url="<?php echo esc_url(get_permalink($nextPost->ID)); ?>">
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
<section>
	<div class="titreVousAimerezAussi">
		<h3>VOUS AIMEREZ AUSSI</h3>
	</div>

	<div class="PhotoSimilaire">

		<?php
		// Récupération des catégories de la photo actuelle
		$categories = get_the_terms(get_the_ID(), 'categorie');
		if ($categories && !is_wp_error($categories)) {
			// Récupération des ID des catégories
			$category_ids = wp_list_pluck($categories, 'term_id');

			// Construction de la requête pour récupérer 2 photos similaires aléatoires
			$args = array(
				'post_type' => 'photos',
				'posts_per_page' => 2,
				'orderby' => 'rand',
				'post__not_in' => array(get_the_ID()),
				'tax_query' => array(
					array(
						'taxonomy' => 'categorie',
						'field' => 'term_id',
						'terms' => $category_ids,
					),
				),
			);

			$related_block = new WP_Query($args);
			while ($related_block->have_posts()) {
				$related_block->the_post();
				if (has_post_thumbnail()) {
					$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
					$photo_url = $image ? $image[0] : ''; // Vérification de l'existence de l'image
					$reference = get_field('reference');
					$categorie_name = isset($categories[0]) ? $categories[0]->name : '';
		?>
					<div class="blockPhotoRelative">
						<img src="<?php echo esc_url($photo_url); ?>" alt="<?php the_title(); ?>">
						<div class="overlay">
							<h2><?php echo esc_html(get_the_title()); ?></h2>
							<h3><?php echo esc_html($categorie_name); ?></h3>
							<div class="eye-icon">
								<a href="<?php echo esc_url(get_permalink()); ?>">
									<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/icon_eye.svg" alt="voir la photo">
								</a>
							</div>
							<div class="fullscreen-icon" data-full="<?php echo esc_url($photo_url); ?>" data-category="<?php echo esc_attr($categorie_name); ?>" data-reference="<?php echo esc_attr($reference); ?>">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/fullscreen.svg" alt="Icone fullscreen">
							</div>
						</div>
					</div>
		<?php
				}
			}
			wp_reset_postdata();

			// Si aucune photo similaire n'est trouvée
			if ($related_block->post_count === 0) {
				echo "<p class='photoNotFound'> Pas de photo similaire trouvée pour la catégorie ''" . $categorie_name . "'' </p>";
			}
		}
		?>

	</div>
	<button id="toutesLesPhotos" class="bouton">
		<a href="<?php echo home_url(); ?>#containerPhoto">Toutes les photos</a>
	</button>
</section>



<?php
get_footer();
