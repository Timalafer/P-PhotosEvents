/* les Filtres */
console.log("les Filtres : son js est chargé");

(function ($) {

    function fetchFilteredPhotos() {
        var filter = {
            'categorie': $('#categorie').val(),
            'format': $('#format').val(),
            'date': $('#date').val(),
        };

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
        })
    }

    $('#gallery-filters select').on('change', function (event) {
        event.preventDefault();
        fetchFilteredPhotos();
    });
})(jQuery);