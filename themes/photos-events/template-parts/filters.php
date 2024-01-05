<?php
// Définition des taxonomies et de leurs libellés
$taxonomy_labels = [
    'categorie' => 'CATÉGORIES',
    'format' => 'FORMATS',
    'date' => 'TRIER PAR',
];

// Boucle sur chaque taxonomie pour générer les sélecteurs
foreach ($taxonomy_labels as $taxonomy => $label) {
    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => true,
    ]);

    if ($terms && !is_wp_error($terms)) {
        echo "<select id='$taxonomy' class='custom-select taxonomy-select' title='$label'>";
        echo "<option value=''>$label</option>";

        foreach ($terms as $term) {
            // Mettre la première lettre de chaque terme en majuscule
            $option_name = ucfirst($term->name);
            echo "<option value='$term->slug'>$option_name</option>";
        }

        echo "</select>";
    }
}
