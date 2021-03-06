<?php
/**
 * Equity Framework
 *
 * WARNING: This file is part of the core Equity Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Equity\Framework
 * @author  IDX, LLC
 * @license GPL-2.0+
 * @link    
 */

/**
 * Used to initialize the framework in the various template files.
 *
 * It pulls in all the necessary components like header and footer, the basic
 * markup structure, and hooks.
 *
 * @since 1.0
 */

function equity() {

	get_header();

	do_action( 'equity_before_content_sidebar_wrap' );
	equity_markup( array(
		'html5'   => '<div %s>',
		'context' => 'content-sidebar-wrap',
	) );

		do_action( 'equity_before_content' );
		equity_markup( array(
			'html5'   => '<main %s>',
			'context' => 'content',
		) );

			do_action( 'equity_before_loop' );
			do_action( 'equity_loop' );
			do_action( 'equity_after_loop' );
			
		equity_markup( array(
			'html5' => '</main>', //* end .content
		) );
		do_action( 'equity_after_content' );

	echo '</div>'; //* end .content-sidebar-wrap
	do_action( 'equity_after_content_sidebar_wrap' );

	get_footer();

}