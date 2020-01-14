<?php get_header();
$postType = array ('etapa01' => 'Primer hito',
    'etapa02' => 'Segundo hito',
    'etapa03' => 'Tercer hito',
    'etapa04' => 'Cuarto hito',
    'etapa05' => 'Quinto hito');
?>
<main>
    <!-- section -->
    <section>
        <header class="content-header">
            <h1 class="page-header container"><?php single_cat_title(); ?></h1>
        </header>

        <?php $catID = get_cat_ID(single_cat_title('', false));
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $postTypeQuery = ['etapa01','etapa02','etapa03','etapa04','etapa05'];
        $currentPostTypeName = "Todos los hitos";

        if ( isset($_GET["post_type"]) && trim($_GET["post_type"]))  {
            $postTypeQuery = $_GET['post_type'];
            switch ($postTypeQuery) {
                case 'etapa01':
                    $currentPostTypeName = "Primer hito";
                    break;
                case 'etapa02':
                    $currentPostTypeName = "Segundo hito";
                    break;
                case 'etapa03':
                    $currentPostTypeName = "Tercero hito";
                    break;
                case 'etapa04':
                    $currentPostTypeName = "Cuarto hito";
                    break;
                case 'etapa05':
                    $currentPostTypeName = "Quinto hito";
                    break;
            }
        }

        $args = array( 'post_type' => $postTypeQuery,
            //'cat' => $catID,
            'posts_per_page' => 9999999,
            'paged' => $paged,
            'post_status' => 'publish',
            'orderby'=> 'date');
        //'orderby'=> 'modified');
        $loop = new WP_Query( $args );
        ?>
        <div class="container">
            <div class="d-md-flex justify-content-md-end">
                <div class="dropdown my-4" data-js="stage-selector">
                    <button class="btn btn-gray-400 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ver: <span class="current"><?php echo $currentPostTypeName; ?></span>
                        <svg width="22" height="22" class="icon icon-icon-angle rotate-90 ml-2"><use xlink:href="<?php bloginfo('template_url'); ?>/img/bmaker-icons/symbol-defs.svg#icon-icon-angle"></use></svg>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="<?php echo esc_url( get_category_link( 2 ) ); ?>" data-target="">Todos los hitos</a>
                        <a class="dropdown-item" href="<?php echo esc_url( get_category_link( 2 ) ); ?>?post_type=etapa01" data-target="etapa01">Primer hito</a>
                        <a class="dropdown-item" href="<?php echo esc_url( get_category_link( 2 ) ); ?>?post_type=etapa02" data-target="etapa02">Segundo hito</a>
                        <a class="dropdown-item" href="<?php echo esc_url( get_category_link( 2 ) ); ?>?post_type=etapa03" data-target="etapa03">Tercero hito</a>
                        <a class="dropdown-item" href="<?php echo esc_url( get_category_link( 2 ) ); ?>?post_type=etapa04" data-target="etapa04">Cuarto hito</a>
                        <a class="dropdown-item" href="<?php echo esc_url( get_category_link( 2 ) ); ?>?post_type=etapa05" data-target="etapa05">Quinto hito</a>
                    </div>
                </div>
            </div>
            <?php if ( $loop->have_posts() ) : ?>
                <div class="site-content clearfix" role="main">
                    <div class="container">
                        <ul class="row list-unstyled align-items-lg-stretch">
                            <?php /* The loop */ ?>
                            <?php while ( $loop->have_posts() ) : $loop->the_post();
                                $postTypePost = get_post_type(); ?>
                                <li id="post-<?php the_ID(); ?>" <?php post_class('col-12 col-md-6 col-lg-4 mb-4 '); ?>>
                                    <a class="category-card d-block" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <?php
                                        $thisauthorID = get_the_author_meta('ID');
                                        $centerName = get_the_author_meta('centro_educativo_al_que_pertenece_ellos_equipos', $thisauthorID);
                                        ?>
                                        <p class="text-truncate text-white mb-2"><span class="bg-primary textarea-wrap text-size-0 px-2 py-1"><?php echo($centerName); ?></span></p>

                                        <p class="mt-2 text-size-1 text-truncate "><?php echo get_the_author_meta('first_name') .' '.get_the_author_meta('last_name'); ?></p>
                                        <!-- post title -->
                                        <h2 class="text-size-1 font-weight-bold"> <?php the_title(); ?> </h2>
                                        <!-- /post title -->

                                        <!-- post details -->
                                        <p class="d-flex justify-content-between align-items-center mt-3 mb-2">
                                            <span class="rounded-pill bg-tertiary text-white text-size-0 px-2 py-1"><?php echo $postType [$postTypePost]; ?></span>
                                            <span class="date"><?php the_time('d/m/y'); ?></span>
                                        </p>
                                        <!-- /post details -->
                                        <div class="text-size-1">
                                            <?php wpbmaker_excerpt('wpbmaker_index'); // Build your custom callback length in functions.php ?>
                                        </div>

                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div><!-- #content -->
            <?php else : ?>
                <div class="no-results d-flex align-items-center justify-content-center">
                    <p><?php _e( 'Todavía no hay contenido que mostrar.', 'wpbmaker' ); ?> <a class="font-weight-bold" href="<?php echo esc_url( get_category_link( 2 ) ); ?>"><?php _e( 'Ver todos los hitos >', 'wpbmaker' ); ?></a> </p>
                    <img class="my-5" width="300px" src="<?php bloginfo('template_url'); ?>/img/home/home-section-3-2.svg" />
                </div>
            <?php endif; ?>

            <!-- Add the pagination functions here. -->
            <?php get_template_part('pagination'); ?>
        </div><!-- /.container -->
    </section>
    <!-- /section -->
    <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
