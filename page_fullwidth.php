<?php
/**
 * Template Name: Full width
 * 
 * This template forces a full width layout in the Equity Theme Framework.
 * Useful for situations where a full width page is needed but cannot be selected normally through admin layout settings.
 *
 * @package Equity\Templates
 * @author  IDX, LLC
 * @license GPL-2.0+
 */

add_filter('equity_pre_get_option_site_layout', 'equity_full_width_template');
function equity_full_width_template($opt) {
    $opt = 'full-width-content';
	return $opt;
}

equity();