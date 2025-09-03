<?php
/**
 * Template part for embedding a display of the Event for "The Ball".
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package The_Ball_v2
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

global $sof_the_ball_event;
$sof_the_ball_event = false;

// Define query args.
$loop_include_args = [
	'post_type'          => 'event',
	'post_status'        => 'publish',
	'no_found_rows'      => true,
	'suppress_filters'   => false,
	'showpastevents'     => true,
	'event_start_before' => 'today',
	'event_end_before'   => 'now',
	'post__in'           => [ 1014 ], // This will be overridden in child themes.
];

// The query.
$loop_include = new WP_Query( $loop_include_args );

if ( $loop_include->have_posts() ) :

	$sof_the_ball_event = true;

	?>

	<!-- loop-events-the-ball.php -->
	<section id="event-the-ball" class="loop-include loop-include-one content-area clear">
		<div class="loop-include-inner">

			<header class="loop-include-header">
				<h2 class="loop-include-title"><?php esc_html_e( 'Make your pledge with The Ball', 'the-ball-v2' ); ?></h2>
			</header><!-- .loop-include-header -->

			<div class="loop-include-posts">
				<?php

				// Start the loop.
				while ( $loop_include->have_posts() ) :

					$loop_include->the_post();

					// Get mini template.
					get_template_part( 'template-parts/content-event-the-ball' );

				endwhile;

				?>
			</div><!-- .loop-include-posts -->

		</div><!-- .loop-include-inner -->
	</section><!-- .loop-include -->

	<?php

endif;

// Prevent weirdness.
wp_reset_postdata();
unset( $loop_include_args, $loop_include );
