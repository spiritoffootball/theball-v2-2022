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
$the_ball_event_args = [
	'post_type' => 'event',
	'post_status' => 'publish',
	'no_found_rows' => true,
	'post__in' => [ 1014 ],
];

// The query.
$the_ball_event = new WP_Query( $the_ball_event_args );

if ( $the_ball_event->have_posts() ) :

	$sof_the_ball_event = true;

	?>

	<!-- loop-events-the-ball.php -->
	<section id="event-the-ball" class="content-area insert-area event-the-ball clear">

		<header class="events-header">
			<!--<h2 class="events-title"><?php esc_html_e( 'Make your pledge with The Ball', 'the-ball-v2-2022' ); ?></h2>-->
		</header><!-- .events-header -->

		<?php

		// Init counter for giving items classes.
		$post_loop_counter = new The_Ball_v2_Counter();

		// Start the loop.
		while ( $the_ball_event->have_posts() ) :

			$the_ball_event->the_post();

			// Get mini template.
			get_template_part( 'template-parts/content-event-the-ball' );

		endwhile;

		// Ditch counter.
		$post_loop_counter->remove_filter();
		unset( $post_loop_counter );

		?>

		<footer class="loop-insert-footer events-footer">
		</footer><!-- .events-footer -->

	</section><!-- #events -->

	<?php

endif;

// Prevent weirdness.
wp_reset_postdata();
