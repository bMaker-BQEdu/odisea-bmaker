<?php get_header();
$postType = array ('etapa01' => 'Primer hito',
    'etapa02' => 'Segundo hito',
    'etapa03' => 'Tercer hito',
    'etapa04' => 'Cuarto hito',
    'etapa05' => 'Quinto hito');
?>
<main>
	<div class="container">
            <?php if (have_posts()): while (have_posts()) : the_post(); ?>

                <!-- article -->
                <article class="post-content" id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>

                    <a class="d-block font-weight-bold text-dark text-size-1" href="<?php echo esc_url( get_category_link( 4 ) ); ?>">
                        <img class="mr-2" width="22" height="22" srcset="<?php bloginfo('template_url'); ?>/img/icon-angle@3x.png" alt="<" /> Volver a los hitos de los profesores
                    </a>

                    <span class="rounded-pill bg-tertiary text-white text-size-0 px-2 py-1 d-inline-block my-3"><?php echo $postType [get_post_type()]; ?></span>
                    <!-- post title -->
                    <h1 class="text-size-7 font-weight-bold mb-3"><?php the_title(); ?></h1>
                    <!-- /post title -->
                    <?php
                    $thisauthorID = get_the_author_meta('ID');
                    $centerName = get_the_author_meta('centro_educativo_al_que_pertenece_ellos_equipos', $thisauthorID);
                    ?>

                    <!-- post details -->
                    <span class="bg-primary textarea-wrap text-white text-size-0 px-2 py-1"><?php echo($centerName); ?></span>

                    <div class="d-md-flex justify-content-between align-items-center">
                        <p class="mt-3 text-size-3"><?php echo get_the_author_meta('first_name') .' '.get_the_author_meta('last_name'); ?></p>
                        <span class="date"><?php the_time('d/m/y'); ?></span>
                    </div>
                    <!-- /post details -->

                    <!-- post thumbnail -->
                    <?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <?php the_post_thumbnail('large', ['class' => 'img-fluid']); // Fullsize image for the single post ?>
                        </a>
                        <hr>
                    <?php endif; ?>
                    <!-- /post thumbnail -->
                    <div class="mt-4">
                    <?php the_content(); // Dynamic Content ?>
                    </div>

                    <?php //the_tags( __( 'Tags: ', 'wpbmaker' ), ', ', '<br>'); // Separated by commas with a line break at the end ?>



                    <?php edit_post_link(); // Always handy to have Edit Post Links available ?>

                    <?php //comments_template(); ?>

                </article>
                <!-- /article -->

            <?php endwhile; ?>

            <?php else: ?>

                <!-- article -->
                <article>

                    <h1><?php _e( 'Sorry, nothing to display.', 'wpbmaker' ); ?></h1>

                </article>
                <!-- /article -->

            <?php endif; ?>
        <?php get_sidebar(); ?>
	</div><!-- /.container -->
</main>
<?php get_footer(); ?>
