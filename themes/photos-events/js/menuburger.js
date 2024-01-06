jQuery(document).ready(function ($) {
    // Sélection des éléments du DOM
    const header = $('header');
    const menuBurger = $('.burgerMenu');
    const nav = $('.navigation');

    // Gestion de l'événement 'click' sur le menu burger
    menuBurger.on('click', function () {
        // Vérifie si la classe 'open' est présente sur l'élément <header>
        const isOpen = header.hasClass('open');

        // Toggle des classes 'open' pour afficher ou masquer le menu burger et la navigation
        header.toggleClass('open', !isOpen);
        menuBurger.toggleClass('open', !isOpen);
        nav.toggleClass('open', !isOpen);
    });
});
