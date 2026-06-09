<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The_Ball_v2_2022
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

	</div><!-- #content -->

	<?php

	/**
	 * Allow others to insert content after the default content.
	 *
	 * @since 1.0.0
	 */
	do_action( 'the_ball_v2_after_content' );

	?>

	<?php

	/**
	 * Allow others to insert content before the footer.
	 *
	 * @since 1.0.0
	 */
	do_action( 'the_ball_v2_before_footer' );

	?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-inner">

			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<div class="footer-menu">
					<?php

					$args = [
						'theme_location' => 'footer',
						'menu_class'     => 'the-ball-v2-2022-footer',
						'link_before'    => '<span>',
						'link_after'     => '</span>',
						'fallback_cb'    => '',
						'depth'          => 1,
					];

					wp_nav_menu( $args );

					?>
				</div><!-- .footer-menu -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer' ) ) : ?>
				<div class="footer-widgets">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $sof_network = locate_template( 'template-parts/footer-sof-network.php' ) ) : ?>
				<?php load_template( $sof_network ); ?>
			<?php endif; ?>

			<?php $powered_by_loop = locate_template( 'template-parts/loop-footer-powered-by.php' ); ?>
			<?php if ( $powered_by_loop ) : ?>
				<?php load_template( $powered_by_loop ); ?>
			<?php endif; ?>

			<div class="site-info">
				<?php /* translators: 1: The opening anchor tag, 2: The closing anchor tag, 3: The current year. */ ?>
				<p><?php printf( esc_html__( 'Website content &copy; %1$sSpirit of Football%2$s %3$s. All rights reserved.', 'theball-v2-2022' ), '<a href="https://spiritoffootball.com">', '</a>', esc_html( gmdate( 'Y' ) ) ); ?></p>
			</div><!-- .site-info -->

		</div><!-- .footer-inner -->
	</footer><!-- #colophon -->

	<?php

	/**
	 * Allow others to insert content after the footer.
	 *
	 * @since 1.0.0
	 */
	do_action( 'the_ball_v2_after_footer' );

	?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
