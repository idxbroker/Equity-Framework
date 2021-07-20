<?php
/**
 * Equity Framework
 *
 * WARNING: This file is part of the core Equity Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Equity\IDX
 * @author  IDX, LLC
 * @license GPL-2.0+
 * @link    http://equityframework.com
 *
 * Redirects to the appropriate search page after quicksearch form submit
 * 
 * This file is responsible for building the query string out of the form field values
 * submitted via the Equity IDX Quick Search Widget or the Search Scrollspy
 *
 * After building the query string, the user is redirected to the IDX results page.
 *
 * The URI of the IDX results page relies on the value of Equity_Idx_Api::system_results_url()
 */


// do nothing if the form was not submitted
if ( ! isset($_POST['submit']) ) {
	exit;
}

$data = $_POST;
$location = $data['results_url'];
$query_string = '';

// dont want these to end up in the query string
unset($data['submit']);
unset($data['results_url']);

// unset any empty data so it doesn't end up in the query string
foreach( $data as $key => $value ) {

	if ( empty($data[$key]) ) {
		unset($data[$key]);
	}
}

// build the query string if there is any remaining $data
if ( !empty($data) ) {
	$query_string = http_build_query($data);
}

header('Location: ' . $location . '?' . $query_string);
exit;