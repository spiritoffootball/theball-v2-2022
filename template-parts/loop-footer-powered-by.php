<?php
/**
 * Template part for embedding Partner logos in the footer.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_Ball_v2
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Define query args.
$loop_include_args = [
	'post_type'   => 'partner',
	'post_status' => 'publish',
	'order'       => 'ASC',
	'orderby'     => 'title',
	// phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	'tax_query'   => [
		[
			'taxonomy' => 'partner-type',
			'field'    => 'slug',
			'terms'    => 'powered-by',
		],
	],
];

// Do the query.
$loop_include = new WP_Query( $loop_include_args );

if ( $loop_include->have_posts() ) : ?>

	<!-- loop-footer-powered-by.php -->
	<section id="footer-powered-by" class="loop-include loop-include-three content-area powered-by clear">
		<div class="loop-include-inner">

			<header class="loop-include-header">
				<h2 class="loop-include-title screen-reader-text"><?php esc_html_e( 'The Ball 2022 to 2023 is powered by', 'the-ball-v2-2022' ); ?></h2>
			</header><!-- .loop-include-header -->

			<div class="loop-include-posts">
				<?php

				// Start the loop.
				while ( $loop_include->have_posts() ) :

					$loop_include->the_post();

					// Get mini template.
					get_template_part( 'template-parts/content-organisation-logo' );

				endwhile;

				?>
			</div><!-- .loop-include-posts -->

			<footer class="loop-include-footer">
				<?php /* the_posts_navigation(); */ ?>
			</footer><!-- .loop-include-footer -->

		</div><!-- .loop-include-inner -->
	</section><!-- .loop-include -->

	<?php

endif;

// Prevent weirdness.
wp_reset_postdata();
unset( $loop_include_args, $loop_include );
