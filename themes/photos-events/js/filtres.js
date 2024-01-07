/* les Filtres */
console.log("les Filtres : son js est chargé");

// Fonction pour récupérer les photos filtrées
(function ($) {
    function fetchFilteredPhotos() {
        // Construction d'un objet de filtre avec les valeurs sélectionnées dans les champs de filtre
        var filter = {
            'categorie': $('#categorie').val(),
            'format': $('#format').val(),
            'date': $('#date').val(),
        };

        // Requête AJAX pour récupérer les données filtrées
        $.ajax({
            url: ajaxurl,
            data: {
                'action': 'filter_photos',
                'filter': filter
            },
            type: 'POST',
            beforeSend: function () {
                $('#gallery').html('<div class="loading">Chargement...</div>');
            },
            success: function (data) {
                $('#gallery').html(data);
                attachEventsToImages();
                setTimeout(function () {
                    document.getElementById('gallery').scrollIntoView();
                }, 0);
            }
        });
    }

    // Gestionnaire d'événement pour les changements sur les sélecteurs de filtre
    $('#gallery-filters select').on('change', function (event) {
        event.preventDefault();
        // À chaque changement dans les filtres, déclenche la récupération des photos filtrées
        fetchFilteredPhotos();
    });
})(jQuery);
