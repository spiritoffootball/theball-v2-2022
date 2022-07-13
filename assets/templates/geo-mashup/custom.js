/**
 * Geo Mashup Custom Javascript.
 *
 * Handles modifications to default Geo Mashup behaviours.
 *
 * @package The_Ball_v2_2022
 */

/**
 * Actions to take when an Object Icon is loaded.
 *
 * @since 1.0.0
 *
 * @param {Object} properties The JSON properties object.
 * @param {Object} object The Object Icon object.
 */
GeoMashup.addAction( 'objectIcon', function( properties, object ) {

	/*
	console.log( 'OBJECT ICON: ' + object.title );
	console.log( 'properties', properties );
	console.log( 'object', object );
	*/

	// Use a custom icon for "Ball" Post Type.
	if ( object.is_ball == 1 ) {

		/*
		console.log( 'CUSTOM BALL ICON' );
		*/

		object.icon.image = object.ball_icon;

		// Use a custom icon size for "The Ball" itself.
		if ( object.is_the_ball == 1 ) {
			object.icon.iconSize = [ 60, 72 ];
			object.icon.iconAnchor = [ 30, 72 ];
		} else {
			object.icon.iconSize = [ 50, 60 ];
			object.icon.iconAnchor = [ 30, 60 ];
		}

		// Save Icon for later.
		properties.ball_icon = object.ball_icon;

		/*
		console.log( 'properties-AFTER', properties );
		console.log( 'object-AFTER', object );
		*/

	}

	// Use a custom icon for "Partner" Post Type.
	if ( object.is_partner == 1 ) {

		///*
		console.log( 'CUSTOM PARTNER ICON' );
		//*/

		object.icon.image = properties.url_path + '/images/mm_36_navy.png';

		/*
		console.log( 'object-AFTER', object );
		*/

	}

	// Use a custom icon for "Host" Post Type.
	if ( object.is_host == 1 ) {

		/*
		console.log( 'CUSTOM BALL HOST ICON' );
		*/

		//object.icon.image = properties.url_path + '/images/mm_36_orange.png';
		object.icon.image = object.host_icon;

		/*
		console.log( 'object-AFTER', object );
		*/

	}

	// Use a custom icon for "Event" Post Type.
	if ( object.is_event == 1 ) {

		/*
		console.log( 'CUSTOM EVENT ICON' );
		*/

		//object.icon.image = properties.url_path + '/images/mm_36_orange.png';
		//object.icon.image = object.host_icon;

		/*
		console.log( 'object-AFTER', object );
		*/

	}

} );

/**
 * Actions to take when a Marker is loaded.
 *
 * @since 1.0.0
 *
 * @param {Object} options The JSON properties object.
 * @param {Object} marker The Marker object.
 */
GeoMashup.addAction( 'marker', function( options, marker ) {

	/*
	console.log( 'MARKER CREATE: ' + marker.labelText );
	console.log( 'options', options );
	console.log( 'marker', marker );
	*/

	// Only Ball icons are 72px tall.
	if ( marker.iconSize.length && marker.iconSize[1] === 72 ) {
		//marker.click.removeAllHandlers();
	}

} );

/**
 * Filters a Marker representing multiple objects.
 *
 * @since 1.0.0
 *
 * @param {Object} options The JSON properties object.
 * @param {Object} marker The Marker object.
 */
GeoMashup.addAction( 'multiObjectMarker', function( options, marker ) {

	/*
	console.log( 'MULTI OBJECT MARKER CREATE' );
	console.log( 'options', options );
	console.log( 'marker', marker );
	*/

	// Only Ball icons are 72px tall.
	if ( marker.iconSize.length && marker.iconSize[1] === 72 ) {

		//marker.click.removeAllHandlers();
		marker.iconUrl = options.ball_icon;

	}

	// Only "Other" Ball icons are 60px tall.
	if ( marker.iconSize.length && marker.iconSize[1] === 60 ) {

		//marker.click.removeAllHandlers();
		marker.iconUrl = options.ball_icon;

		/*
		marker.click.addHandler( function() {
			// Toggle marker selection
			if ( marker === GeoMashup.selected_marker ) {
				GeoMashup.deselectMarker();
			} else {
				GeoMashup.selectMarker( marker );
			}
		} );
		*/

	}

} );

/**
 * Filters the Object Marker options.
 *
 * @since 1.0.0
 *
 * @param {Object} options The JSON properties object.
 * @param {Object} marker_options The Marker options.
 * @param {Object} marker The Marker object.
 */
GeoMashup.addAction( 'objectMarkerOptions', function( options, marker_options, marker ) {

	/*
	console.log( 'OBJECT MARKER OPTIONS' );
	console.log( 'options', options );
	console.log( 'marker_options', marker_options );
	console.log( 'marker', marker );
	*/

} );

/**
 * Actions to take when the Map is loaded.
 *
 * @since 1.0.0
 *
 * @param {Object} options The JSON properties object.
 * @param {Object} glow_options The Map Item object.
 */
GeoMashup.addAction( 'glowMarkerIcon', function( options, glow_options, marker ) {

	/*
	console.log( 'GLOW MARKER ICON' );
	console.log( 'options', options );
	console.log( 'glow_options', glow_options );
	console.log( 'marker', marker );
	*/

} );

/**
 * Actions to take when the Map is loaded.
 *
 * @since 1.0.0
 *
 * @param {Object} properties The JSON properties.
 * @param {Object} map The Mapstraction Map object.
 */
GeoMashup.addAction( 'loadedMap', function ( properties, map ) {

	/*
	console.log( 'MAP LOADED' );
	console.log( 'properties', properties );
	console.log( 'map', map );
	console.log( 'gmap', map.maps.googlev3 );
	console.log( 'gmap markers', map.maps.googlev3.markers );
	*/

} );
