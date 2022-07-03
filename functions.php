<?php
/**
 * The Ball v2 2022 Child Theme Functions
 *
 * Theme amendments and overrides.
 *
 * @package The_Ball_v2_2022
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Set our version here.
define( 'THE_BALL_V2_2022_VERSION', '1.0.0' );

/**
 * Bootstraps theme object and returns instance.
 *
 * @since 1.0.0
 *
 * @return The_Ball_v2_2022_Theme $theme The theme instance.
 */
function the_ball_v2_2022_theme() {

	// Declare as static.
	static $theme;

	// Instantiate theme class if not yet instantiated.
	if ( ! isset( $theme ) ) {
		require get_stylesheet_directory() . '/includes/classes/class-theme.php';
		$theme = new The_Ball_v2_2022_Theme();
	}

	// --<
	return $theme;

}

// Bootstrap immediately.
the_ball_v2_2022_theme();
