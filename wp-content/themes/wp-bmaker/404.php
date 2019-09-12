<?php get_header(); ?>
<main>
	<div class="container">
        <!-- section -->
        <section>
            <!-- article -->
            <article id="post-404" class="p-5">
                <div class="error-title d-flex flex-column flex-md-row align-items-center justify-content-center p-md-5 ">
                    <img class="img-fluid" src="<?php bloginfo('template_url'); ?>/img/404.svg">
                    <div class="error-cont pl-5">
                        <h1><?php _e( '404', 'wpbmaker' ); ?></h1>
                        <p><?php _e( '¡Vaya! La página a la que intentas acceder no existe.', 'wpbmaker' ); ?></p>
                        <a class="font-weight-bold" href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'wpbmaker' ); ?></a>
                    </div>
                </div>
            </article>
            <!-- /article -->
        </section>
        <!-- /section -->
    </div><!-- /.container -->
    <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
