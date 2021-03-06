<?php
/**
 * Equity Framework
 *
 * WARNING: This file is part of the core Equity Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Equity\Sidebars
 * @author  IDX, LLC
 * @license GPL-2.0+
 * @link    
 */

add_action( 'equity_sidebar', 'equity_do_sidebar' );
/**
 * Echo default sidebar default content.
 *
 * Only shows if sidebar is empty, and current user has the ability to edit theme options (manage widgets).
 *
 * @since 1.0
 *
 * @uses equity_default_widget_area_content() Template for default widget area content.
 */
function equity_do_sidebar() {

	if ( ! dynamic_sidebar( 'sidebar' ) && current_user_can( 'edit_theme_options' )  ) {
		equity_default_widget_area_content( __( 'Default Sidebar Widget Area', 'equity' ) );
	}

}

/**
 * Template for default widget area content.
 *
 * @since 1.0
 *
 * @param string $name Name of the widget area e.g. `__( 'Default Sidebar Widget Area', 'yourtextdomain' )`.
 */
function equity_default_widget_area_content( $name ) {

	echo '<section class="widget widget_text"><div class="widget-wrap">';
	
		printf( '<h4 class="widgettitle">%s</h4>', esc_html( $name ) );
		echo '<div class="textwidget"><p>';
		
			printf( __( 'This is the %s. Drag and drop any available widgets into place by visiting the <a href="%s">Widgets Page</a>.', 'equity' ), $name, admin_url( 'widgets.php' ) );
		
		echo '</p></div>';
	
	echo '</div></section>';

}
