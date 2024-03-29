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
$partners_args = [
	'post_type' => 'partner',
	'post_status' => 'publish',
	'order' => 'ASC',
	'orderby' => 'title',
	'tax_query' => [
		[
			'taxonomy' => 'partner-type',
			'field' => 'slug',
			'terms' => 'powered-by',
		],
	],
];

// Do the query.
$partners = new WP_Query( $partners_args );

if ( $partners->have_posts() ) :
	?>

	<section class="organisation-list partner-list powered-by clear">
		<div class="organisation-list-inner partner-list-inner">

			<p><?php esc_html_e( 'The Ball 2022 to 2023 is powered by', 'the-ball-v2' ); ?></p>

			<?php

			// Start the loop.
			while ( $partners->have_posts() ) :

				$partners->the_post();

				// Get mini template.
				get_template_part( 'template-parts/content-organisation-logo' );

			endwhile;

			?>

		</div>
	</section><!-- .partner-list -->

	<?php

else :

	get_template_part( 'template-parts/content', 'coming-soon' );

endif;
