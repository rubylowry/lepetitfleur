<?php /*

@package lepetitfleur
*/

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="container">

				<?php

					if( have_posts() ):

						while( have_posts() ): the_post();

							get_template_part( 'template-parts/content', get_post_format() );

						endwhile;

					endif;

				?>

			</div><!-- .container -->

			<div class="container text-center">
          <a class="btn btn-lg btn-default lepetitfleur-load-more" data-page="1"><span class="le-petit-fleur fleur-loading"></span> Load More</a>
			</div><!-- .container -->

		</main>
	</div><!-- #primary -->

<?php get_footer(); ?>