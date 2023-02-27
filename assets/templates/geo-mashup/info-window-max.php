<?php
/**
 * Geo Mashup Info Window Max Template.
 *
 * This is a copy of the default template for the maximized info window display
 * of a clicked marker in a Geo Mashup map.
 *
 * See "info-window-max.php" in the Geo Mashup "default-templates" directory.
 *
 * @package The_Ball_v2_2022
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Avoid nested maps.
add_filter( 'the_content', [ 'GeoMashupQuery', 'strip_map_shortcodes' ], 1, 9 );

?>
<!-- assets/templates/geo-mashup/info-window-max.php -->

<div class="info-window-max">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'medium' ); ?>
			<?php endif; ?>

			<div class="storycontent">
				<?php the_content(); ?>
			</div>

		<?php endwhile; ?>

	<?php else : ?>

		<h2 class="center"><?php esc_html_e( 'Not Found', 'the-ball-v2-2022' ); ?></h2>
		<p class="center"><?php esc_html_e( 'Sorry, but you are looking for something that isn’t here.', 'the-ball-v2-2022' ); ?></p>

	<?php endif; ?>

</div>
