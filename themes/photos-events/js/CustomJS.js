jQuery(document).ready(function ($) {
    // Initialisation de Select2 pour les éléments avec la classe .taxonomy-select
    $('.taxonomy-select').select2({
        dropdownPosition: 'below'
    });

    // Gestion du survol des éléments avec la classe .bouton
    $(".bouton").hover(
        function () {
            $(this).find("a").css("color", "#fff"); // Changer la couleur de texte en blanc (#fff) au survol
        },
        function () {
            $(this).find("a").css("color", "#000"); // Rétablir la couleur de texte par défaut (#000) après le survol
        }
    );
});
