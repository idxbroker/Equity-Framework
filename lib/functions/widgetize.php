<?php
/**
 * Equity Framework
 *
 * WARNING: This file is part of the core Equity Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Equity\WidgetAreas
 * @author  IDX, LLC
 * @license GPL-2.0+
 * @link    
 */

/**
 * Expedites the widget area registration process by taking common things, before / after_widget, before / after_title,
 * and doing them automatically.
 *
 * See the WP function `register_sidebar()` for the list of supports $args keys.
 *
 * A typical usage is:
 *
 * ~~~
 * equity_register_widget_area(
 *     array(
 *         'id'          => 'my-sidebar',
 *         'name'        => __( 'My Sidebar', 'my-theme-text-domain' ),
 *         'description' => __( 'A description of the intended purpose or location', 'my-theme-text-domain' ),
 *     )
 * );
 * ~~~
 *
 * @since 1.0
 *
 * @uses equity_markup() Contextual markup.
 *
 * @param string|array $args Name, ID, description and other widget area arguments.
 *
 * @return string The sidebar ID that was added.
 */
function equity_register_widget_area( $args ) {

	$defaults = array(
		'before_widget' => equity_markup( array(
			'html5' => '<section id="%1$s" class="widget %2$s">',
			'echo'  => false,
		) ),
		'after_widget'  => equity_markup( array(
			'html5' => '</section>' . "\n",
			'echo'  => false
		) ),
		'before_title'  => '<h4 class="widget-title widgettitle">',
		'after_title'   => '</h4>' . "\n",
	);

	/**
	 * A filter on the default parameters used by `equity_register_widget_area()`.
	 *
	 * @since 1.0
	 */
	$defaults = apply_filters( 'equity_register_widget_area_defaults', $defaults, $args );

	$args = wp_parse_args( $args, $defaults );

	return register_sidebar( $args );

}

add_action( 'equity_setup', 'equity_register_default_widget_areas' );
/**
 * Register the default Equity widget areas.
 *
 * @since 1.0
 *
 * @uses equity_register_widget_area() Register widget areas.
 */
function equity_register_default_widget_areas() {

	equity_register_widget_area(
		array(
			'id'               => 'sidebar',
			'name'             => __( 'Default Sidebar', 'equity' ),
			'description'      => __( 'This is the default sidebar.', 'equity' ),
		)
	);

}

add_action( 'after_setup_theme', 'equity_register_footer_widget_areas' );
/**
 * Register footer widget areas based on the number of widget areas selected in the customizer.
 * Set to 3 by default. Setting default in customizer add_setting is too late.
 *
 * @since 1.0
 *
 * @uses equity_register_widget_area() Register footer widget areas.
 *
 * @return null Return early if option is set to zero.
 */
function equity_register_footer_widget_areas() {

	if ( get_theme_mod( 'footer_widgets' ) == '' ) {
		set_theme_mod( 'footer_widgets', 3 );
	}

	$footer_widgets = get_theme_mod( 'footer_widgets' );

	if ( $footer_widgets == 0 )
		return;

	$counter = 1;

	while ( $counter <= $footer_widgets ) {
		equity_register_widget_area(
			array(
				'id'               => sprintf( 'footer-%d', $counter ),
				'name'             => sprintf( __( 'Footer %d', 'equity' ), $counter ),
				'description'      => sprintf( __( 'Footer %d widget area.', 'equity' ), $counter ),
			)
		);

		$counter++;
	}

}

add_action( 'after_setup_theme', 'equity_register_top_header_widget_area' );
/**
 * Register top header widget areas if user specifies in the child theme.
 *
 * @since 1.0
 *
 * @uses equity_register_widget_area() Register widget area.
 *
 * @return null Return early if there's no theme support.
 */
function equity_register_top_header_widget_area() {

	if ( ! current_theme_supports( 'equity-top-header-bar' ) )
		return;

	if ( ! equity_nav_menu_supported( 'top-header-left' ) )
		equity_register_widget_area(
			array(
				'id'               => 'top-header-left',
				'name'             => __( 'Top Header Left', 'equity' ),
				'description'      => __( 'This is the top left widget area above the main header.', 'equity' ),
				'before_widget'    => '',
				'after_widget'     => '',
			)
		);

	if ( ! equity_nav_menu_supported( 'top-header-right' ) )
		equity_register_widget_area(
			array(
				'id'               => 'top-header-right',
				'name'             => __( 'Top Header Right', 'equity' ),
				'description'      => __( 'This is the top right widget area above the main header.', 'equity' ),
				'before_widget'    => '',
				'after_widget'     => '',
			)
		);

}

add_action( 'after_setup_theme', 'equity_register_header_right_widget_area' );
/**
 * Register header right widget area. 
 *
 * @since 1.0
 *
 * @uses equity_nav_menu_supported() Check if header right menu is supported in theme
 * @uses equity_register_widget_area() Register widget area.
 */
function equity_register_header_right_widget_area() {

	if ( ! equity_nav_menu_supported( 'header-right' ) )
		equity_register_widget_area(
			array(
				'id'               => 'header-right',
				'name'             => is_rtl() ? __( 'Header Left', 'equity' ) : __( 'Header Right', 'equity' ),
				'description'      => __( 'This is the widget area in the header.', 'equity' ),
			)
		);

}

add_action( 'after_setup_theme', 'equity_register_after_entry_widget_area' );
/**
 * Register after-entry widget area if user specifies in the child theme.
 *
 * @since 1.0
 *
 * @uses equity_register_widget_area() Register widget area.
 *
 * @return null Return early if there's no theme support.
 */
function equity_register_after_entry_widget_area() {

	if ( ! current_theme_supports( 'equity-after-entry-widget-area' ) )
		return;

	equity_register_widget_area(
		array(
			'id'              => 'after-entry',
			'name'            => __( 'After Entry', 'equity' ),
			'description'     => __( 'This is the widget area after single posts.', 'equity' ),
		)
	);

}

/**
 * Conditionally display a sidebar, wrapped in an aside element by default.
 *
 * The $args array accepts the following keys:
 *
 *  - `before` (markup to be displayed before the widget area output),
 *  - `after` (markup to be displayed after the widget area output),
 *  - `default` (fallback text if the sidebar is not found, or has no widgets, default is an empty string),
 *  - `show_inactive` (flag to show inactive sidebars, default is false),
 *  - `before_sidebar_hook` (hook that fires before the widget area output),
 *  - `after_sidebar_hook` (hook that fires after the widget area output).
 *
 * Return false early if the sidebar is not active and the `show_inactive` argument is false.
 *
 * @since 1.0
 *
 * @param string $id   Sidebar ID, as per when it was registered
 * @param array  $args Arguments.
 *
 * @return boolean False if $args['show_inactive'] set to false and sidebar is not currently being used. True otherwise.
 */
function equity_widget_area( $id, $args = array() ) {

	if ( ! $id )
		return false;

	$args = wp_parse_args(
		$args,
		array(
			'before'              => '<aside class="widget-area">',
			'after'               => '</aside>',
			'default'             => '',
			'show_inactive'       => 0,
			'before_sidebar_hook' => 'equity_before_' . $id . '_widget_area',
			'after_sidebar_hook'  => 'equity_after_' . $id . '_widget_area',
		)
	);

	if ( ! is_active_sidebar( $id ) && ! $args['show_inactive'] )
		return false;

	//* Opening markup
	echo $args['before'];

	//* Before hook
	if ( $args['before_sidebar_hook'] )
			do_action( $args['before_sidebar_hook'] );

	if ( ! dynamic_sidebar( $id ) )
		echo $args['default'];

	//* After hook
	if( $args['after_sidebar_hook'] )
			do_action( $args['after_sidebar_hook'] );

	//* Closing markup
	echo $args['after'];

	return true;

}

add_action( 'after_setup_theme', 'equity_text_widget_filters' );
/**
 * Add filters to text widgets that enable shortcodes and oembed.
 *
 * @since 1.0
 *
 * @link http://www.wpbeginner.com/wp-tutorials/how-to-enable-oembed-in-wordpress-text-widgets/
 */
function equity_text_widget_filters() {
	global $wp_embed;
	add_filter( 'widget_text', array( $wp_embed, 'run_shortcode' ), 8 );
	add_filter( 'widget_text', array( $wp_embed, 'autoembed'), 8 );
	add_filter( 'widget_text', 'do_shortcode' );
}

/**
 * Returns true if any of the Equity sidebars are active
 *
 * @since  1.0
 * 
 * @param  array $sidebar_widget_areas
 *
 * @uses  is_active_sidebar()
 * 
 * @return bool
 */
function equity_any_sidebar_is_active($sidebar_widget_areas) {
	foreach($sidebar_widget_areas as $sidebar) {
		if ( is_active_sidebar($sidebar) ) {
			return true;
		}
	}

	return false;
}

/**
 * Get widget counts.
 *
 * @param string $id The widget area ID.
 * @return int Number of widgets in the widget area.
 */
function equity_count_widgets( $id ) {
	global $sidebars_widgets;

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}
}

/**
 * Set the widget class for flexible widgets.
 *
 * @param string $id The widget area ID.
 * @return Name of column class.
 */
function equity_widget_area_class( $id ) {
	$count = equity_count_widgets( $id );

	$class = 'columns';

	if ( 1 === $count ) {
		$class .= ' widget-full';
	} elseif ( 0 === $count % 3 ) {
		$class .= ' widget-thirds';
	} elseif ( 0 === $count % 4 ) {
		$class .= ' widget-fourths';
	} elseif ( 1 === $count % 2 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;
}
