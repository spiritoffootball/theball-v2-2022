<?php
/**
 * Geo Mashup Class.
 *
 * Handles Geo Mashup compatibility.
 *
 * @package The_Ball_v2_2022
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Geo Mashup Class.
 *
 * A class that encapsulates Geo Mashup compatibility.
 *
 * @since 1.0.0
 */
class The_Ball_v2_2022_Geo_Mashup {

	/**
	 * Theme object.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var The_Ball_v2_2022_Theme
	 */
	public $theme;

	/**
	 * Geo Mashup template directory path.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $dir_path = '';

	/**
	 * Geo Mashup template directory URL.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $url_path = '';

	/**
	 * The Organisation Post Types.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var array
	 */
	public $organisation_post_types = [
		'organisation',
		'partner',
		'host',
	];

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
	 * Initialises this object.
	 *
	 * @since 1.0.0
	 */
	public function initialise() {

		// Bootstrap class.
		$this->register_hooks();

		// Path and URL to the directory holding the templates.
		$this->dir_path = get_stylesheet_directory() . '/assets/templates/geo-mashup/';
		$this->url_path = get_stylesheet_directory_uri() . '/assets/templates/geo-mashup/';

		/**
		 * Broadcast that this class is active.
		 *
		 * @since 1.0
		 */
		do_action( 'the_ball_v2_2022/theme/geo_mashup/loaded' );

	}

	/**
	 * Register WordPress hooks.
	 *
	 * @since 1.0.0
	 */
	public function register_hooks() {

		// Take control of Geo Mashup paths.
		add_filter( 'wpcv_eo_maps/geo_mashup_custom/dir_path', [ $this, 'filter_dir_path' ], 10 );
		add_filter( 'wpcv_eo_maps/geo_mashup_custom/url_path', [ $this, 'filter_url_path' ], 10 );

		// Filter requests for Geo Mashup files.
		add_filter( 'wpcv_eo_maps/geo_mashup_custom/file_url', [ $this, 'filter_file_url' ], 10, 3 );

		// Filter the Geo Mashup query.
		// phpcs:ignore Squiz.Commenting.InlineComment.InvalidEndChar
		// add_filter( 'geo_mashup_locations_where', [ $this, 'filter_locations_where' ], 10, 2 );
		add_filter( 'geo_mashup_locations_groupby', [ $this, 'filter_locations_groupby' ], 10, 2 );
		add_filter( 'geo_mashup_locations_orderby', [ $this, 'filter_locations_orderby' ], 10, 2 );

		// Filter the Geo Mashup JSON map objects.
		add_filter( 'geo_mashup_locations_json_object', [ $this, 'filter_locations_json' ], 10, 2 );

		// Filter Info Window elements.
		// TODO: override Info Windows completely.
		add_filter( 'the_ball_v2_2022/info_window/link', [ $this, 'filter_info_window_link' ], 10, 2 );
		add_filter( 'the_ball_v2_2022/info_window/thumbnail', [ $this, 'filter_info_window_thumbnail' ], 10, 2 );
		add_filter( 'the_ball_v2_2022/info_window/content', [ $this, 'filter_info_window_excerpt' ], 10, 2 );
		add_filter( 'the_ball_v2_2022/info_window/more_link', [ $this, 'filter_info_window_read_more' ], 10, 2 );

	}

	// -----------------------------------------------------------------------------------

	/**
	 * Filters the path to the directory holding the templates.
	 *
	 * @since 1.0.0
	 *
	 * @param string $dir_path The path to the directory holding the templates.
	 * @return string $dir_path The modified path to the directory holding the templates.
	 */
	public function filter_dir_path( $dir_path ) {

		// Return theme directory path.
		return $this->dir_path;

	}

	/**
	 * Filters the URL to the directory holding the templates.
	 *
	 * @since 1.0.0
	 *
	 * @param string $url_path The URL to the directory holding the templates.
	 * @return string $url_path The modified URL to the directory holding the templates.
	 */
	public function filter_url_path( $url_path ) {

		// Return theme directory URL.
		return $this->url_path;

	}

	/**
	 * Filters the URL of a custom file if it exists.
	 *
	 * @since 1.0.0
	 *
	 * @param string $url The URL of the custom file.
	 * @param string $file The custom file being checked.
	 * @param array  $files The full array of custom files.
	 * @return string $url The modified URL of the custom file.
	 */
	public function filter_file_url( $url, $file, $files ) {

		/*
		$e = new \Exception();
		$trace = $e->getTraceAsString();
		error_log( print_r( [
			'method' => __METHOD__,
			'url' => $url,
			'file' => $file,
			'files' => $files,
			//'backtrace' => $trace,
		], true ) );
		*/

		// Maybe use our Custom Javascript file.
		if ( 'custom.js' === $file ) {
			$url = $this->url_path . 'custom.js';
		}

		// Maybe use our Custom Info Window file.
		if ( 'info-window.php' === $file ) {
			$url = $this->url_path . 'info-window.php';
		}

		/*
		// Maybe use our Custom Info Window Max file.
		if ( 'info-window-max.php' === $file ) {
			$url = $this->url_path . 'info-window-max.php';
		}
		*/

		/*
		$e = new \Exception();
		$trace = $e->getTraceAsString();
		error_log( print_r( [
			'method' => __METHOD__,
			'url-AFTER' => $url,
			//'backtrace' => $trace,
		], true ) );
		*/

		// --<
		return $url;

	}

	// -----------------------------------------------------------------------------------

	/**
	 * Filters the selection of map objects.
	 *
	 * @since 1.0.0
	 *
	 * @param str   $where The where clause.
	 * @param array $query_args The WordPress query arguments.
	 * @return str $where The modified where clause.
	 */
	public function filter_locations_where( $where, $query_args ) {

		// Only filter main map.
		if ( empty( $query_args['map_post_type'] ) || ! is_array( $query_args['map_post_type'] ) ) {
			return $where;
		}
		if ( count( $query_args['map_post_type'] ) !== 4 ) {
			return $where;
		}

		/*
		// We can conveniently sort by Post Type name.
		$where .= 'AND o.pos';
		*/

		/*
		$e = new \Exception();
		$trace = $e->getTraceAsString();
		error_log( print_r( [
			'method' => __METHOD__,
			'where' => $where,
			'query_args' => $query_args,
			//'backtrace' => $trace,
		], true ) );
		*/

		// --<
		return $where;

	}

	/**
	 * Filters the grouping of map objects.
	 *
	 * @since 1.0.0
	 *
	 * @param str   $groupby The grouping.
	 * @param array $query_args The WordPress query arguments.
	 * @return str $groupby The modified grouping.
	 */
	public function filter_locations_groupby( $groupby, $query_args ) {

		// Only filter main map.
		if ( empty( $query_args['map_post_type'] ) || ! is_array( $query_args['map_post_type'] ) ) {
			return $groupby;
		}
		if ( count( $query_args['map_post_type'] ) !== 4 ) {
			return $groupby;
		}

		// We can conveniently group by Post title.
		$groupby = 'GROUP BY o.post_title';

		/*
		$e = new \Exception();
		$trace = $e->getTraceAsString();
		error_log( print_r( [
			'method' => __METHOD__,
			'groupby' => $groupby,
			'query_args' => $query_args,
			//'backtrace' => $trace,
		], true ) );
		*/

		// --<
		return $groupby;

	}

	/**
	 * Filters the order of map objects.
	 *
	 * @since 1.0.0
	 *
	 * @param str   $sort The sort order.
	 * @param array $query_args The WordPress query arguments.
	 * @return str $sort The modified sort order.
	 */
	public function filter_locations_orderby( $sort, $query_args ) {

		// Only filter main map.
		if ( empty( $query_args['map_post_type'] ) || ! is_array( $query_args['map_post_type'] ) ) {
			return $sort;
		}
		if ( count( $query_args['map_post_type'] ) !== 4 ) {
			return $sort;
		}

		// We can conveniently sort by Post Type name.
		$sort = 'ORDER BY post_type ASC, post_status ASC, ID ASC, geo_date DESC';

		/*
		$e = new \Exception();
		$trace = $e->getTraceAsString();
		error_log( print_r( [
			'method' => __METHOD__,
			'sort' => $sort,
			'query_args' => $query_args,
			//'backtrace' => $trace,
		], true ) );
		*/

		// --<
		return $sort;

	}

	// -----------------------------------------------------------------------------------

	/**
	 * Filters the JSON properties of the map object.
	 *
	 * @since 1.0.0
	 *
	 * @param array   $json_properties The JSON properties of the map object.
	 * @param WP_Post $queried_object The WordPress Post object.
	 * @return array $json_properties The modified JSON properties of the map object.
	 */
	public function filter_locations_json( $json_properties, $queried_object ) {

		// Bail if not a Post.
		if ( empty( $queried_object->object_id ) ) {
			return $json_properties;
		}

		// Get the Post ID.
		$post_id = $queried_object->object_id;

		// Bail if empty.
		if ( empty( $post_id ) ) {
			return $json_properties;
		}

		// Modify our "Ball" Post Type.
		if ( 'ball' === get_post_type( $post_id ) ) {

			// Set common propeties.
			$json_properties['is_ball']   = 1;
			$json_properties['ball_icon'] = get_stylesheet_directory_uri() . '/assets/images/geo-mashup/ball_72_arrow.png';

			// Set properties unique to The Ball.
			$ball = get_post( $post_id );
			if ( 'the-ball-2022-2023' === $ball->post_name ) {
				$json_properties['is_the_ball'] = 1;
			}

		}

		// Modify our "Partner" Post Type.
		if ( 'partner' === get_post_type( $post_id ) ) {
			$json_properties['is_partner'] = 1;
		}

		// Modify our "Ball Host" Post Type.
		if ( 'host' === get_post_type( $post_id ) ) {
			$json_properties['is_host']   = 1;
			$json_properties['host_icon'] = get_stylesheet_directory_uri() . '/assets/images/geo-mashup/host_36_white.png';
		}

		// Modify our "Event" Post Type.
		if ( 'event' === get_post_type( $post_id ) ) {
			$json_properties['is_event'] = 1;
		}

		/*
		$e = new \Exception();
		$trace = $e->getTraceAsString();
		error_log( print_r( [
			'method' => __METHOD__,
			'post_id' => $post_id,
			'json_properties' => $json_properties,
			//'backtrace' => $trace,
		], true ) );
		*/

		/*
		$meta_field = get_post_meta( $post_id, 'selector', true );
		$complete_date = strtotime( $meta_field );
		$todays_date = time();

		if ( $todays_date > $complete_date ) {
			$json_properties['my_complete'] = 1;
		} else {
			$json_properties['my_complete'] = 0;
		}
		*/

		// --<
		return $json_properties;

	}

	// -----------------------------------------------------------------------------------

	/**
	 * Filters the link to the Post in the Map Info Window.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $show True if linking to the Post.
	 * @param int  $post_id The numeric ID of the WordPress Post.
	 * @return bool $showTrue if linking to the Post, false to hide.
	 */
	public function filter_info_window_link( $show, $post_id ) {

		// Show if one of our Organisation Post Types.
		if ( in_array( get_post_type( $post_id ), $this->organisation_post_types, true ) ) {
			$show = true;
		}

		// Never show for Balls.
		if ( 'ball' === get_post_type( $post_id ) ) {
			$show = false;
		}

		// --<
		return $show;

	}

	/**
	 * Filters the feature image data for the Map Info Window.
	 *
	 * @since 1.0.0
	 *
	 * @param array $feature_image The existing array of feature image data.
	 * @param int   $post_id The numeric ID of the WordPress Post.
	 * @return array $feature_image The modified array of feature image data.
	 */
	public function filter_info_window_thumbnail( $feature_image, $post_id ) {

		/*
		$e = new \Exception();
		$trace = $e->getTraceAsString();
		error_log( print_r( [
			'method' => __METHOD__,
			//'feature_image' => $feature_image,
			'post_id' => $post_id,
			'post_type' => get_post_type( $post_id ),
			//'backtrace' => $trace,
		], true ) );
		*/

		// If one of our Organisation Post Types.
		if ( in_array( get_post_type( $post_id ), $this->organisation_post_types, true ) ) {

			// Get the logo for Organisations.
			$logo = get_field( 'logo', $post_id );

			/*
			$e = new \Exception();
			$trace = $e->getTraceAsString();
			error_log( print_r( [
				'method' => __METHOD__,
				'logo' => $logo,
				//'backtrace' => $trace,
			], true ) );
			*/

			if ( ! empty( $logo ) ) {
				$feature_image['exists']    = true;
				$feature_image['class']     = ' has_feature_image';
				$feature_image['thumbnail'] = sprintf(
					'<img src="%1$s" width="%2$s" height="%3$s">',
					$logo['sizes']['medium'],
					( $logo['sizes']['medium-width'] / 2 ),
					( $logo['sizes']['medium-height'] / 2 )
				);
			}

		}

		/*
		$e = new \Exception();
		$trace = $e->getTraceAsString();
		error_log( print_r( [
			'method' => __METHOD__,
			'feature_image' => $feature_image,
			//'backtrace' => $trace,
		], true ) );
		*/

		// --<
		return $feature_image;

	}

	/**
	 * Filters the excerpt of the Map Info Window.
	 *
	 * @since 1.0.0
	 *
	 * @param string $excerpt The existing Post excerpt for the Info Window.
	 * @param int    $post_id The numeric ID of the WordPress Post.
	 * @return string $excerpt The modified Post excerpt for the Info Window.
	 */
	public function filter_info_window_excerpt( $excerpt, $post_id ) {

		// Use a stripped out version of the ACF Field for Organisations.
		if ( in_array( get_post_type( $post_id ), $this->organisation_post_types, true ) ) {
			$excerpt = wp_strip_all_tags( get_field( 'about', $post_id ) );
		}

		// Show stripped out version of the content for The Ball.
		if ( 'ball' === get_post_type( $post_id ) ) {
			$excerpt = wp_strip_all_tags( get_the_content( $post_id ) );
		}

		// --<
		return $excerpt;

	}

	/**
	 * Filters the read more link in the Map Info Window.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $show True if showing the "Read More" link.
	 * @param int  $post_id The numeric ID of the WordPress Post.
	 * @return bool $show True if showing the "Read More" link, false to hide.
	 */
	public function filter_info_window_read_more( $show, $post_id ) {

		// Never show for Organisations.
		if ( in_array( get_post_type( $post_id ), $this->organisation_post_types, true ) ) {
			$show = false;
		}

		// Never show for The Ball.
		if ( 'ball' === get_post_type( $post_id ) ) {
			$show = false;
		}

		return $show;

	}

}
