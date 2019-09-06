<?php /* Template Name: Full Page Template */ get_header('fullpage');  ?>
<!-- Full Page Template for no sidebar  -->
<?php get_header('fullpage'); ?>
<main>
	<div class="container bg-white rounded">
		<div class="row">
			<div class="col-12">
				<!-- section -->
				<section>

					<h1 class="page-header"><?php the_title(); ?></h1>

				<?php if (have_posts()): while (have_posts()) : the_post(); ?>

					<!-- article -->
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php the_content(); ?>

						<?php comments_template( '', true ); // Remove if you don't want comments ?>

						<br class="clear">

						<?php edit_post_link(); ?>

					</article>
					<!-- /article -->

				<?php endwhile; ?>

				<?php else: ?>

					<!-- article -->
					<article>

						<h2><?php _e( 'Sorry, nothing to display.', 'wpbmaker' ); ?></h2>

					</article>
					<!-- /article -->

				<?php endif; ?>

				</section>
				<!-- /section -->
			</div><!-- /.col-xs-12 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</main>
<?php get_footer('fullpage'); ?>

