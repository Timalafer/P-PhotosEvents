<h1>Photographe event</h1>

<?php
// Arguments de la requête pour récupérer une photo aléatoire du type de publication 'photos'
$photo_args = array(
    'post_type' => 'photos',
    'posts_per_page' => 1,
    'orderby' => 'rand',
);

// Création d'une nouvelle instance de WP_Query avec les arguments définis
$photo_query = new WP_Query($photo_args);

// Vérification s'il y a des publications correspondant à la requête
if ($photo_query->have_posts()) {
    // Boucle while pour parcourir les résultats de la requête
    while ($photo_query->have_posts()) {
        $photo_query->the_post();
        echo get_the_post_thumbnail(get_the_ID(), 'full');
    }
    // Réinitialisation des données de la requête
    wp_reset_postdata();
}
?>