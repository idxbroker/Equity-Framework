<?php
/**
 * Equity Framework
 *
 * WARNING: This file is part of the core Equity Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Equity\Archives
 * @author  IDX, LLC
 * @license GPL-2.0+
 * @link    
 */

add_filter( 'equity_term_intro_text_output', 'wpautop' );
add_action( 'equity_before_loop', 'equity_do_taxonomy_title_description', 15 );
/**
 * Add custom headline and / or description to category / tag / taxonomy archive pages.
 *
 * If the page is not a category, tag or taxonomy term archive, or we're not on the first page, or there's no term, or
 * no term meta set, then nothing extra is displayed.
 *
 * If there's a title to display, it is marked up as a level 1 heading.
 *
 * If there's a description to display, it runs through `wpautop()` before being added to a div.
 *
 * @since 1.0
 *
 * @global WP_Query $wp_query Query object.
 *
 * @return null Return early if not the correct archive page, not page one, or no term meta is set.
 */
function equity_do_taxonomy_title_description() {

	global $wp_query;

	if ( ! is_category() && ! is_tag() && ! is_tax() )
		return;

	if ( get_query_var( 'paged' ) >= 2 )
		return;

	$term = is_tax() ? get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ) : $wp_query->get_queried_object();

	if ( ! $term || ! isset( $term->meta ) )
		return;

	$headline = $intro_text = '';

	if ( $term->meta['headline'] )
		$headline = sprintf( '<h1 class="archive-title">%s</h1>', strip_tags( $term->meta['headline'] ) );
	if ( $term->meta['intro_text'] )
		$intro_text = apply_filters( 'equity_term_intro_text_output', $term->meta['intro_text'] );

	if ( $headline || $intro_text )
		printf( '<div class="archive-description taxonomy-description">%s</div>', $headline . $intro_text );

}

add_filter( 'equity_author_intro_text_output', 'wpautop' );
add_action( 'equity_before_loop', 'equity_do_author_title_description', 15 );
/**
 * Add custom headline and description to author archive pages.
 *
 * If we're not on an author archive page, or not on page 1, then nothing extra is displayed.
 *
 * If there's a custom headline to display, it is marked up as a level 1 heading.
 *
 * If there's a description (intro text) to display, it is run through `wpautop()` before being added to a div.
 *
 * @since 1.0
 *
 * @return null Return early if not author archive or not page one.
 */
function equity_do_author_title_description() {

	if ( ! is_author() )
		return;

	if ( get_query_var( 'paged' ) >= 2 )
		return;

	$headline   = get_the_author_meta( 'headline', (int) get_query_var( 'author' ) );
	$intro_text = get_the_author_meta( 'intro_text', (int) get_query_var( 'author' ) );

	$headline   = $headline ? sprintf( '<h1 class="archive-title">%s</h1>', strip_tags( $headline ) ) : '';
	$intro_text = $intro_text ? apply_filters( 'equity_author_intro_text_output', $intro_text ) : '';

	if ( $headline || $intro_text )
		printf( '<div class="archive-description author-description">%s</div>', $headline . $intro_text );

}

add_action( 'equity_before_loop', 'equity_do_author_box_archive', 15 );
/**
 * Add author box to the top of author archive.
 *
 * If the headline and description are set to display the author box appears underneath them.
 *
 * @since 1.3.2
 *
 * @uses equity_author_box() Echo the author box and its contents.
 *
 * @see equity_do_author_title_and_description Author title and description.
 *
 * @return Return early if not author archive or not page one.
 */
function equity_do_author_box_archive() {

	if ( ! is_author() || get_query_var( 'paged' ) >= 2 )
		return;

	if ( get_the_author_meta( 'equity_author_box_archive', get_query_var( 'author' ) ) )
		equity_author_box( 'archive' );

}

add_filter( 'equity_cpt_archive_intro_text_output', 'wpautop' );
add_action( 'equity_before_loop', 'equity_do_cpt_archive_title_description' );
/**
 * Add custom headline and description to relevant custom post type archive pages.
 *
 * If we're not on a post type archive page, or not on page 1, then nothing extra is displayed.
 *
 * If there's a custom headline to display, it is marked up as a level 1 heading.
 *
 * If there's a description (intro text) to display, it is run through wpautop() before being added to a div.
 *
 * @since 1.0
 *
 * @uses equity_has_post_type_archive_support() Check if a post type should potentially support an archive setting page.
 * @uses equity_get_cpt_option()                Get list of custom post types which need an archive settings page.
 *
 * @return null Return early if not on relevant post type archive.
 */
function equity_do_cpt_archive_title_description() {

	if ( ! is_post_type_archive() || ! equity_has_post_type_archive_support() )
		return;

	if ( get_query_var( 'paged' ) >= 2 )
		return;

	$headline   = equity_get_cpt_option( 'headline' );
	$intro_text = equity_get_cpt_option( 'intro_text' );

	$headline   = $headline ? sprintf( '<h1 class="archive-title">%s</h1>', $headline ) : '';
	$intro_text = $intro_text ? apply_filters( 'equity_cpt_archive_intro_text_output', $intro_text ) : '';

	if ( $headline || $intro_text )
		printf( '<div class="archive-description cpt-archive-description">%s</div>', $headline . $intro_text );

}
