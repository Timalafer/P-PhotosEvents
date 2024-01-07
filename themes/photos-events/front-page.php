<?php get_header(); ?>

<main>
    <!-- Bannière et titre de la page -->
    <section class="banner">
        <?php get_template_part('template-parts/banner'); ?>
    </section>

    <!-- Galerie de photos triable -->

    <section id="gallery-filters" class="gallery-filters">
        <?php get_template_part('template-parts/filters'); ?>
    </section>


    <section id="gallery" class="gallery">
        <?php get_template_part('template-parts/gallery'); ?>
    </section>


    <!--charger plus -->

    <button id="load-more" data-page="1" data-url="<?php echo admin_url('admin-ajax.php'); ?>">Charger plus</button>


    <!-- Permet les appels AJAX côté client vers les fonctionnalités back-end spécifiques de WordPress -->


    <script>
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
    </script>

</main>




<?php get_footer(); ?>