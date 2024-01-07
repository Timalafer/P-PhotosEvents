/*Miniatures*/
console.log("Affichage Miniature : son js est chargé");

jQuery(document).ready(function ($) {
    const miniPicture = $('#miniPicture');

    // Gestion des événements de survol des flèches (gauche et droite)
    $('.arrow-left, .arrow-right').hover(
        function () {
            // Au survol, affiche la miniature correspondante avec une opacité de 1
            miniPicture.css({
                visibility: 'visible',
                opacity: 1
            }).html(`<a href="${$(this).data('target-url')}">
                        <img src="${$(this).data('thumbnail-url')}" alt="${$(this).hasClass('arrow-left') ? 'Photo précédente' : 'Photo suivante'}">
                    </a>`);
        },
        function () {
            // À la fin du survol, masque la miniature en la rendant invisible (opacité 0)
            miniPicture.css({
                visibility: 'hidden',
                opacity: 0
            });
        }
    );

    // Gestion des événements de clic sur les flèches (gauche et droite)
    $('.arrow-left, .arrow-right').click(function () {
        window.location.href = $(this).data('target-url');
    });
});
