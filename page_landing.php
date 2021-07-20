<?php
/**
 * Template Name: Landing
 * 
 * This template adds a landing page template in the Equity Theme Framework by removing all framework elements except the content.
 *
 * @package Equity\Templates
 * @author  IDX, LLC
 * @license GPL-2.0+
 */

//* Add custom body class to the head
add_filter( 'body_class', 'equity_add_body_class' );
function equity_add_body_class( $classes ) {

   $classes[] = 'equity-landing';
   return $classes; 

}

//* Force full width content layout
add_filter( 'equity_site_layout', '__equity_return_full_width_content' );

//* Remove site header elements
remove_action( 'equity_before_header', 'equity_do_top_header' );
remove_action( 'equity_header', 'equity_header_markup_open', 5 );
remove_action( 'equity_header', 'equity_do_header' );
remove_action( 'equity_header', 'equity_header_markup_close', 15 );

//* Remove navigation
remove_action( 'equity_after_header', 'equity_do_main_nav' );

//* Remove breadcrumbs
remove_action( 'equity_before_loop', 'equity_do_breadcrumbs' );

//* Remove site footer widgets
remove_action( 'equity_before_footer', 'equity_footer_widget_areas' );

//* Remove site footer elements
remove_action( 'equity_footer', 'equity_footer_markup_open', 5 );
remove_action( 'equity_footer', 'equity_do_footer' );
remove_action( 'equity_footer', 'equity_footer_markup_close', 15 );

//* Run the Equity loop
equity();