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

					wp_nav_menu( [
						'theme_location' => 'footer',
						'menu_class'     => 'the-ball-v2-footer',
						'link_before'    => '<span>',
						'link_after'     => '</span>',
						'fallback_cb'    => '',
						'depth'          => 1,
					] );

					?>
				</div><!-- .footer-menu -->
			<?php endif; ?>

			<?php if ( is_active_sidebar( 'footer' ) ) : ?>
				<div class="footer-widgets">
					<?php dynamic_sidebar( 'footer' ); ?>
				</div>
			<?php endif; ?>

			<div class="sof_network network_white clearfix">

				<div class="network_inner clearfix">

					<h3><?php esc_html_e( 'The SOF Network', 'the-ball-v2' ); ?></h3>

					<ul>
						<li class="brazil_icon"><a href="https://br.spiritoffootball.com/" title="<?php esc_attr_e( 'Spirit of Football Brazil', 'the-ball-v2' ); ?>"><?php esc_html_e( 'Spirit of Football Brazil', 'the-ball-v2' ); ?></a></li>
						<li class="cic_icon"><a href="https://spiritoffootball.com/" title="<?php esc_attr_e( 'Spirit of Football CIC', 'the-ball-v2' ); ?>"><?php esc_html_e( 'Spirit of Football CIC', 'the-ball-v2' ); ?></a></li>
						<li class="sof_network_last germany_icon"><a href="https://spirit-of-football.de/" title="<?php esc_attr_e( 'Spirit of Football Germany', 'the-ball-v2' ); ?>"><?php esc_html_e( 'Spirit of Football Germany', 'the-ball-v2' ); ?></a></li>
					</ul>

				</div><!-- /network_inner -->

			</div><!-- /sof_network_white -->

			<?php if ( $powered_by_loop = locate_template( 'template-parts/powered-by.php' ) ) : ?>
				<?php load_template( $powered_by_loop ); ?>
			<?php endif; ?>

			<div class="site-info">
				<p><?php printf( __( 'Website content &copy; %1$s %2$s. All rights reserved.', 'the-ball-v2' ), '<a href="https://spiritoffootball.com">Spirit of Football</a>', gmdate( 'Y' ) ); ?></p>
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
