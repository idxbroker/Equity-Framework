<?php
/**
 * Equity Framework
 *
 * WARNING: This file is part of the core Equity Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package Equity\Shortcodes
 * @author  IDX, LLC
 * @license GPL-2.0+
 * @link    
 */

add_shortcode('listing_meta', 'listing_meta_shortcode');
/**
 * Returns meta data for listings
 * @param  array $atts meta key
 * @return string meta value wrapped in span
 * @since  1.5
 */
function listing_meta_shortcode($atts) {
	extract(shortcode_atts(array(
		'key' => ''
	), $atts ) );
	$postid = get_the_id();

	return '<span class=' . $key . '>' . get_post_meta($postid, '_listing_' . $key, true) . '</span>';
}

add_shortcode('social_icons','equity_agent_social_icons');
/**
 * Returns links with the icon class of their type wrapped in a div
 * 
 * @since 1.0
 * 
 * @uses  equity_get_social_links
 */
function equity_agent_social_icons($atts) {

	extract(shortcode_atts(array(
		'newtab' => 0
	), $atts ) );

	$links = equity_get_social_links();
	$icons = '';

	if ($newtab) {
		$target = '_blank';
	} else {
		$target = '_self';
	}

	foreach($links as $type => $url) {
		if ( 'email' == $type ) {
			$url = 'mailto:' . $url;
		}
		// Brand icons in Font Awesome 5 use the 'fab' class, non-brand icons like rss need to use 'fas'.
		if ( 'rss' === $type ) {
			$icons .= '<a class="fas fa-' . $type . '" href="' . $url . '" target="' . $target . '"></a>';
		} else if ( '' != $url ) {
			$icons .= '<a class="fab fa-' . $type . '" href="' . $url . '" target="' . $target . '"></a>';
		}
	}

	return '<div class="agent-social-icons clearfix">' . $icons . '</div>';
}

add_shortcode( 'agent_phone', 'agent_phone_shortcode' );
/**
 * Adds agent phone shortcode
 */
function agent_phone_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'icon' => 'fa-phone'
	), $atts ) );

	$countrycode = equity_get_option('agent_phone_country_code');
	$phone = equity_get_option('agent_phone');
	$cleanphone = preg_replace('/\D+/', '', $phone);

	return sprintf('<div class="agent-phone-wrap"><i class="fas %s"></i><a class="agent-phone" href="tel:+%s%s">%s</a></div>', $icon, $countrycode, $cleanphone, $phone);
}

add_shortcode( 'agent_email', 'agent_email_shortcode' );
/**
 * Adds agent email shortcode
 */
function agent_email_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'icon' => 'fa-envelope'
	), $atts ) );

	$email = equity_get_option('agent_email');
	if ( ! is_email ($email) )
		return;

	return '<div class="agent-email-wrap"><i class="fas ' . $icon . '"></i><a href="mailto:' . antispambot($email) . '">' . antispambot($email) . '</a></div>';
}

add_shortcode( 'agent_address', 'agent_address_shortcode' );
/**
 * Adds agent address shortcode
 */
function agent_address_shortcode() {
	$address = equity_get_option('agent_address');
	return sprintf('<p class="agent-address"><i class="fas fa-map-marker"></i>%s</p>', $address);
}

add_shortcode( 'button', 'equity_button_shortcode' );
/**
 * Adds the button shortcode
 */
function equity_button_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'size'      => 'small',
		'color'     => '',
		'secondary' => false,
		'expand'    => false,
		'newtab'    => 0,
		'url'       => ''
	), $atts ) );

	$classes = 'button ' . $size;

	if ($expand) {
		$classes .= ' expand';
	}

	if ($secondary) {
		$classes .= ' secondary';
	} 

	if ($newtab) {
		$target = '_blank';
	} else {
		$target = '_self';
	}

	if ($color) {
		$classes .= ' custom-hex';
		return '<a class="' . $classes . '" href="' . $url . '" target="' . $target . '" style="background-color:' . $color . ' !important;">' . $content . '</a>';
	}

	return '<a class="' . $classes . '" href="' . $url . '" target="' . $target . '">' . do_shortcode($content) . '</a>';
}

add_shortcode( 'column', 'equity_column_shortcode' );
add_shortcode( 'row', 'equity_row_shortcode' );
/**
 * Adds the column and row shortcode
 *
 * @see http://foundation.zurb.com/docs/components/grid.html for classes
 */
function equity_column_shortcode($atts, $content = null) {
extract(shortcode_atts(array(
		'small'  => '',
		'medium' => '',
		'large'  => ''
	), $atts ) );
	
	$classes = '';

	if ($small) {
		$classes .= " small-" . $small;
	}

	if ($medium) {
		$classes .= " medium-" . $medium;
	}

	return '<div class="' . $classes . ' large-' . $large . ' columns">' . do_shortcode($content) . '</div>';

}
function equity_row_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(), $atts ) );
	return '<div class="row">' . do_shortcode($content) . '</div><!-- .row -->';
}

add_shortcode( 'alert_box', 'equity_alert_box_shortcode' );
/**
 * Adds the alert box shortcode
 *
 * @see http://foundation.zurb.com/docs/components/alert_boxes.html
 */
function equity_alert_box_shortcode($atts, $content = null) {
extract(shortcode_atts(array(
		'type'       => '',
		'allowclose' => '',
		'border'     => ''
	), $atts ) );
	
	$classes = '';
	$close = '';

	if ($type) {
		$classes .= " ' . $type . '";
	}

	if ($border) {
		$classes .= " ' . $border . '";
	}

	if ($allowclose) {
		$close = '<a href="#" class="close">&times;</a>';
	}

	return '<div data-alert class="alert-box' . $classes . '">' . $content . ' ' . $close . '</div>';

}

add_shortcode( 'icon', 'equity_icon_shortcode' );
/**
 * Adds the icon shortcode
 */
function equity_icon_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'icon'   => 'fa-circle',
		'size'    => '20',
		'color'  => ''
	), $atts ) );

	$classes = 'fas ' . $icon;
	$icon_size = $size;

	return '<i class="' . $classes . '" style="font-size:' . $icon_size . 'px; color:' . $color . ';"></i>';
}

add_shortcode( 'properticon', 'equity_properticon_shortcode' );
/**
 * Adds the properticon shortcode
 * http://agentevolution.github.io/properticons/
 */
function equity_properticon_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'icon'   => 'properticons-logo-realtor',
		'size'    => '40',
		'color'  => ''
	), $atts ) );

	$classes = 'properticons ' . $icon;
	$icon_size = $size;

	return '<i class="' . $classes . '" style="font-size:' . $icon_size . 'px; color:' . $color . ';"></i>';
}

add_shortcode( 'iconbox', 'equity_iconbox_shortcode' );
/**
 * Adds the iconbox shortcode
 */
function equity_iconbox_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
		'type'    => 1,
		'newtab'  => 0,
		'icon'    => 'fa-truck',
		'url'     => '',
		'heading' => 'Icon Box Heading'
	), $atts ) );

	$classes = 'ae-iconbox type-' . $type;

	if ($newtab) {
		$target = '_blank';
	} else {
		$target = "_self";
	}

	if ($url) {

	return '
		<div class="' . $classes . '">
			<div class="icon"><a href="' . $url . '" target="' . $target . '"><i class="fas ' . $icon . '"></i></a></div>
			<h4><a href="' . $url . '" target="' . $target . '">' . $heading . '</a></h4>
			<p>' . $content . '</p>
		</div><!-- ae-iconbox type-' . $type . ' -->
		';
	}

	return '
		<div class="' . $classes . '">
			<div class="icon"><i class="fas ' . $icon . '"></i></div>
			<h4>' . $heading . '</h4>
			<p>' . $content . '</p>
		</div><!-- ae-iconbox type-' . $type . ' -->
		';
}

add_shortcode( 'flex_video', 'equity_flex_video_shortcode' );
/**
 * Adds the flex video shortcode for responsive videos
 * 
 * @see http://foundation.zurb.com/docs/components/flex_video.html
 */
function equity_flex_video_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(), $atts ) );

	return '<div class="flex-video">' . equity_clean_shortcode($content) . '</div>';
}

add_shortcode('testimonial','equity_testimonial_shortcode');
/**
 * Adds the testimonial shortcode
 */
function equity_testimonial_shortcode($atts = array(), $content = null) {
	extract(shortcode_atts(array(
		'image' => '',
		'name'  => '',
	), $atts));
	$content = preg_replace('#<br\s*/?>#', "", $content);

	if ( $image == null ) {
		$testimonial = '
		<div class="testimonial">
			<div class="testimonial-inner">
				<blockquote class="testimonial-text">
					<p class="testimonial-content">' . $content . '</p>
					<cite class="testimonial-name">' . $name . '</cite>
				</blockquote>
			</div><!-- .testimonial-inner -->
		</div><!-- testimonial -->
		';
	} else {
		$testimonial = '
		<div class="testimonial">
			<div class="testimonial-inner">
				<div class="testimonial-image">
					<img src="' . $image . '" alt="' . $name . '" class="circle" />
				</div><!-- .testimonial-image -->
				<blockquote class="testimonial-text">
					<p class="testimonial-content">' . $content . '</p>
					<cite class="testimonial-name">' . $name . '</cite>
				</blockquote>
			</div><!-- .testimonial-inner -->
		</div><!-- testimonial -->
		';
	}

	return $testimonial;
}

/**
 * Add support for Shortcake (Shortcode UI)
 * 
 * @see  https://github.com/fusioneng/Shortcake
 * @since 1.3
 * 
 */
if ( function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
	//* Alert box
	shortcode_ui_register_for_shortcode(
		'alert_box',
		array(
			'label'         => 'Alert box',
			'listItemImage' => 'dashicons-yes',
			'inner_content' => array(
				'label'        => esc_html__( 'Text', 'equity' ),
				'description'  => esc_html__( 'Content for the alert box', 'equity' ),
			),
			'attrs' => array(
                array(
                    'label' => 'Type',
                    'attr'  => 'type',
                    'type'  => 'select',
                    'value' => '',
                    'options' => array(
                    		''          => 'Default',
                    		'info'      => 'Info',
                    		'success'   => 'Success',
                    		'warning'   => 'Warning',
                    		'alert'     => 'Alert',
                    		'secondary' => 'Secondary',
                    ),
                ),
				array(
                    'label' => 'Border',
                    'attr'  => 'border',
                    'type'  => 'select',
                    'value' => '',
                    'options' => array(
                    		''       => 'Default',
                    		'round'  => 'Rounded',
                    		'radius' => 'Radius',
                    ),
                ),
                array(
                    'label' => 'Allow closing?',
                    'attr'  => 'allowclose',
                    'type'  => 'checkbox',
                    'value' => '',
                ),
            ),
		)
	);

	//* Buttons
	shortcode_ui_register_for_shortcode(
		'button',
		array(
			'label'         => 'Button',
			'listItemImage' => 'dashicons-admin-comments',
			'inner_content' => array(
				'label'        => esc_html__( 'Button Text', 'equity' ),
				'description'  => esc_html__( 'Content for button', 'equity' ),
			),
			'attrs' => array(
                array(
                    'label' => 'Size',
                    'attr'  => 'size',
                    'type'  => 'select',
                    'value' => 'large',
                    'options' => array(
                    		'tiny'  => 'Tiny',
                    		'small' => 'Small',
                    		'large' => 'Large',
                    ),
                ),
                array(
                    'label'       => 'URL',
                    'attr'        => 'url',
                    'type'        => 'url',
                    'placeholder' => 'Link URL',
                ),
                array(
                    'label' => 'Open in new tab?',
                    'attr'  => 'newtab',
                    'type'  => 'checkbox',
                    'value' => 0,
                ),
                array(
                    'label' => 'Expand to container width?',
                    'attr'  => 'expand',
                    'type'  => 'checkbox',
                    'value' => false,
                ),
                array(
                    'label' => 'Primary or secondary color?',
                    'attr'  => 'secondary',
                    'type'  => 'radio',
                    'value' => false,
                    'options' => array(
                    		true => 'Secondary',
                    		'' => 'Primary',
                    ),
                ),
                array(
                    'label' => 'Or custom color:',
                    'attr'  => 'color',
                    'type'  => 'color',
                    'value' => '',
                ),
            ),
		)
	);

	//* Icons
	shortcode_ui_register_for_shortcode(
		'icon',
		array(
			'label'         => 'Font Awesome Icon',
			'listItemImage' => 'dashicons-heart',
			'attrs' => array(
                array(
                    'label' => 'Icon class',
                    'attr'  => 'icon',
                    'type'  => 'text',
                    'value' => 'fa-circle',
                ),
                array(
                    'label' => 'Size',
                    'attr'  => 'size',
                    'type'  => 'text',
                    'value' => '30',
                ),
                array(
                    'label' => 'Hex Color',
                    'attr'  => 'color',
                    'type'  => 'color',
                    'value' => '#c2252c',
                ),
            ),
		)
	);

	//* Icon box
	shortcode_ui_register_for_shortcode(
		'iconbox',
		array(
			'label'         => 'Icon box',
			'listItemImage' => 'dashicons-visibility',
			'inner_content' => array(
				'label'        => esc_html__( 'Content', 'equity' ),
				'description'  => esc_html__( 'Content for the icon box', 'equity' ),
			),
			'attrs' => array(
				array(
                    'label' => 'Type',
                    'attr'  => 'type',
                    'type'  => 'select',
                    'value' => '1',
                    'options' => array(
                    		1  => '1',
                    		2  => '2',
                    		3  => '3',
                    		4  => '4',
                    		5  => '5',
                    ),
                ),
				array(
                    'label'       => 'Heading',
                    'attr'        => 'heading',
                    'type'        => 'text',
                    'placeholder' => 'Enter heading here',
                ),
                array(
                    'label'       => 'Icon class',
                    'attr'        => 'icon',
                    'type'        => 'text',
                    'placeholder' => '',
                ),
                array(
                    'label'       => 'URL (optional)',
                    'attr'        => 'url',
                    'type'        => 'url',
                    'placeholder' => 'Link URL',
                ),
                array(
                    'label' => 'Open in new tab?',
                    'attr'  => 'newtab',
                    'type'  => 'checkbox',
                    'value' => 0,
                ),
            ),
		)
	);

	//* Flex video
	shortcode_ui_register_for_shortcode(
		'flex_video',
		array(
			'label'         => 'Responsive video',
			'listItemImage' => 'dashicons-video-alt3',
			'attrs' => array(
                array(
                    'label' => 'Enter video embed code',
                    'attr'  => 'content',
                    'type'  => 'textarea',
                ),
            ),
		)
	);

	//* Testimonial
	shortcode_ui_register_for_shortcode(
		'testimonial',
		array(
			'label'         => 'Testimonial',
			'listItemImage' => 'dashicons-format-quote',
			'inner_content' => array(
				'label'        => esc_html__( 'Quote', 'equity' ),
				'description'  => esc_html__( 'Content for the block quote', 'equity' ),
			),
			'attrs' => array(
                array(
                    'label'       => 'Name',
                    'attr'        => 'name',
                    'type'        => 'text',
                    'placeholder' => 'Firstname Lastname',
                ),
                array(
                    'label'       => 'Photo (optional)',
                    'attr'        => 'image',
                    'type'        => 'attachment',
                    'libraryType' => array( 'image' ),
					'addButton'   => esc_html__( 'Select Image', 'equity' ),
					'frameTitle'  => esc_html__( 'Select Image', 'equity' ),
                ),
            ),
		)
	);
}