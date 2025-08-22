<?php
/**
 * The Ball 2022-2023 Shortcode Class.
 *
 * Provides a Shortcode for rendering a teaser for The Ball 2022-2023 Event.
 *
 * @package The_Ball_v2_2022
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * The Ball 2022-2023 Shortcode Class.
 *
 * A class that encapsulates a Shortcode for rendering a teaser for The Ball 2022-2023 Event.
 *
 * @since 1.0.0
 */
class The_Ball_v2_2022_Theme_Shortcode_The_Ball {

	/**
	 * Theme object.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var The_Ball_v2_2022_Theme
	 */
	public $theme;

	/**
	 * Shortcode name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $tag = 'sof_the_ball_event_teaser';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 *
	 * @param object $theme The theme object.
	 */
	public function __construct( $theme ) {

		// Store reference to theme.
		$this->theme = $theme;

		// Init when this theme is loaded.
		add_action( 'the_ball_v2_2022/theme/loaded', [ $this, 'initialise' ] );

	}

	/**
	 * Initialise this object.
	 *
	 * @since 1.0.0
	 */
	public function initialise() {

		// Register hooks.
		$this->register_hooks();

	}

	/**
	 * Register hooks.
	 *
	 * @since 1.0.0
	 */
	public function register_hooks() {

		// Register Shortcode.
		add_action( 'init', [ $this, 'shortcode_register' ] );

	}

	// -----------------------------------------------------------------------------------

	/**
	 * Register our Shortcode.
	 *
	 * @since 1.0.0
	 */
	public function shortcode_register() {

		// Register our Shortcode and its callback.
		add_shortcode( $this->tag, [ $this, 'shortcode_render' ] );

	}

	/**
	 * Render the Shortcode.
	 *
	 * @since 1.0.0
	 *
	 * @param array  $attr The saved Shortcode attributes.
	 * @param string $content The enclosed content of the Shortcode.
	 * @param string $tag The Shortcode which invoked the callback.
	 * @return string $content The HTML-formatted Shortcode content.
	 */
	public function shortcode_render( $attr, $content = '', $tag = '' ) {

		// Return something else for feeds.
		if ( is_feed() ) {
			return '<p>' . __( 'Visit the website to see the Event.', 'the-ball-v2-2022' ) . '</p>';
		}

		// Find the template.
		$the_ball_loop = locate_template( 'template-parts/loop-events-the-ball.php' );
		if ( empty( $the_ball_loop ) ) {
			return '';
		}

		// Use the theme template.
		ob_start();
		load_template( $the_ball_loop );
		$content = ob_get_contents();
		ob_end_clean();

		// --<
		return $content;

	}

}
