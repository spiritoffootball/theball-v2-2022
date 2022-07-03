<?php
/**
 * The Ball v2 2022 Theme Class.
 *
 * @package The_Ball_v2_2022
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * The Ball v2 2022 Theme Class.
 *
 * A class that encapsulates this theme's functionality.
 *
 * @since 1.0.0
 */
class The_Ball_v2_2022_Theme {

	/**
	 * Geo Mashup compatibility object.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var object $geo_mashup The Geo Mashup compatibility object.
	 */
	public $geo_mashup;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Listen for parent theme class to be loaded.
		add_action( 'the_ball_v2/theme/loaded', [ $this, 'initialise' ] );

	}

	/**
	 * Initialises this object.
	 *
	 * @since 1.0.0
	 */
	public function initialise() {

		// Include files.
		$this->include_files();

		// Set up objects and references.
		$this->setup_objects();

		// Register hooks.
		$this->register_hooks();

		/**
		 * Broadcast that this instance is loaded.
		 *
		 * @since 1.0.0
		 */
		do_action( 'the_ball_v2_2022/theme/loaded' );

	}

	/**
	 * Include files.
	 *
	 * @since 1.0.0
	 */
	public function include_files() {

		// Only do this once.
		static $done;
		if ( isset( $done ) && $done === true ) {
			return;
		}

		// Include class files.
		include get_stylesheet_directory() . '/includes/classes/class-geo-mashup.php';

		/*
		// Include functions files.
		include get_stylesheet_directory() . '/includes/functions-theme.php';
		*/

		// We're done.
		$done = true;

	}

	/**
	 * Set up this plugin's objects.
	 *
	 * @since 1.0.0
	 */
	public function setup_objects() {

		// Only do this once.
		static $done;
		if ( isset( $done ) && $done === true ) {
			return;
		}

		// Instantiate classes.
		$this->geo_mashup = new The_Ball_v2_2022_Geo_Mashup( $this );

		// We're done.
		$done = true;

	}

	/**
	 * Register WordPress hooks.
	 *
	 * @since 1.0.0
	 */
	public function register_hooks() {

	}

}
