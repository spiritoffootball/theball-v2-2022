<?php
/**
 * Geo Mashup Info Window Template.
 *
 * This is a copy of the default template for the info window in Geo Mashup maps.
 *
 * See "info-window.php" the Geo Mashup "default-templates" directory.
 *
 * For styling of the info window, see "map-style.css".
 *
 * @package The_Ball_v2_2022
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Modify the Post Thumbnail size.
add_filter( 'post_thumbnail_size', [ 'GeoMashupQuery', 'post_thumbnail_size' ] );

// A potentially heavy-handed way to remove shortcode-like content.
add_filter( 'the_excerpt', [ 'GeoMashupQuery', 'strip_brackets' ] );

?>
<!-- assets/templates/geo-mashup/info-window.php -->

<div class="locationinfo post-location-info">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php

			// Get Post Type.
			$post_type_class = ' post_type_' . get_post_type( get_the_ID() );

			// Init multiple items class.
			$multiple_items_class = '';
			if ( $wp_query->post_count > 1 ) {
				$multiple_items_class = ' multiple_items';
			}

			// Init feature image array.
			$feature_image = [
				'exists' => false,
				'class' => '',
				'thumbnail' => '',
			];

			// Maybe fill out array with values.
			if ( has_post_thumbnail() ) {
				$feature_image['exists'] = true;
				$feature_image['class'] = ' has_feature_image';
				$feature_image['thumbnail'] = get_the_post_thumbnail( get_the_ID(), 'medium' );
			}

			/**
			 * Filter the feature image array.
			 *
			 * @since 1.0
			 *
			 * @param array $feature_image The array of feature image data.
			 * @param int $post_id The numeric ID of the WordPress Post.
			 */
			$feature_image = apply_filters( 'the_ball_v2_2022/info_window/thumbnail', $feature_image, get_the_ID() );

			/**
			 * Filters the links to the Post.
			 *
			 * @since 1.0
			 *
			 * @param bool $show True if showing links to the Post.
			 * @param int $post_id The numeric ID of the WordPress Post.
			 */
			$show_link = apply_filters( 'the_ball_v2_2022/info_window/link', true, get_the_ID() );

			/**
			 * Filters the "Read More" link.
			 *
			 * @since 1.0
			 *
			 * @param bool $show True if showing the "Read More" link.
			 * @param int $post_id The numeric ID of the WordPress Post.
			 */
			$more_link = apply_filters( 'the_ball_v2_2022/info_window/more_link', true, get_the_ID() );

			/*
			$e = new \Exception();
			$trace = $e->getTraceAsString();
			error_log( print_r( [
				//'method' => __METHOD__,
				'file' => __FILE__,
				'wp_query->post_count' => $wp_query->post_count,
				'post_type_class' => $post_type_class,
				'has_feature_image' => $feature_image['exists'],
				'feature_image' => $feature_image,
				//'backtrace' => $trace,
			], true ) );
			*/

			?>

			<div class="location-post<?php echo $multiple_items_class . $feature_image['class'] . $post_type_class; ?>">

				<div class="post_header">

					<?php if ( true === $feature_image['exists'] ) : ?>
						<?php if ( true === $show_link ) : ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="feature-link">
						<?php endif; ?>
						<?php echo $feature_image['thumbnail']; ?>
						<?php if ( true === $show_link ) : ?>
							</a>
						<?php endif; ?>
					<?php endif; ?>

					<div class="post_header_text">
						<h2>
						<?php if ( true === $show_link ) : ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php endif; ?>
						<?php the_title(); ?>
						<?php if ( true === $show_link ) : ?>
							</a>
						<?php endif; ?>
						</h2>
					</div><!-- /.post_header_text -->

				</div><!-- /.post_header -->

				<?php if ( apply_filters( 'the_ball_v2_2022/info_window/content', true, get_the_ID() ) ) : ?>
						<div class="storycontent">
							<p>
							<?php

							echo apply_filters(
								'the_ball_v2_2022/info_window/content',
								wp_strip_all_tags( get_the_excerpt() ),
								get_the_ID()
							);

							?>
							</p>
							<?php if ( true === $more_link ) : ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more-link"><?php esc_html_e( 'Read more', 'the-ball-v2-2022' ); ?></a>
							<?php endif; ?>
						</div>
				<?php endif; ?>

			</div><!-- /.location-post -->

		<?php endwhile; ?>

	<?php else : ?>

		<h2 class="center"><?php esc_html_e( 'Not Found', 'the-ball-v2-2022' ); ?></h2>
		<p class="center"><?php esc_html_e( 'Sorry, but we can’t find what you are looking for.', 'the-ball-v2-2022' ); ?></p>

	<?php endif; ?>

</div>
