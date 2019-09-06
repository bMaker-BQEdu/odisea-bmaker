<?php get_header(); ?>
<main>
        <!-- section -->
        <section>
            <header class="content-header">
                <h1 class="page-header container"><?php single_cat_title(); ?></h1>
            </header>
            <div class="container">
                <?php get_template_part('loop'); ?>

                <?php get_template_part('pagination'); ?>
            </div>
        </section>
        <!-- /section -->
    <?php get_sidebar(); ?>
</main>
<?php get_footer(); ?>
