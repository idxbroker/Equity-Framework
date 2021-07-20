<?php
/**
 * Template Name: Communities
 * 
 * This template adds a Communities page that will display all child pages of the current page in a dynamic block grid
 * using jQuery Masonry
 *
 * @package Equity\Templates
 * @author  IDX, LLC
 * @license GPL-2.0+
 */

add_filter( 'equity_pre_get_option_site_layout', '__equity_return_full_width_content' );
remove_action( 'equity_entry_content', 'equity_do_post_content' );
add_action( 'equity_entry_content', 'community_template_content' );
remove_action( 'equity_after_entry', 'equity_get_comments_template' );

/**
 * Outputs markup for the communities template
 */
function community_template_content() {

	the_content();

	echo '<div class="masonry-content">';

	global $post;
	$args = array(
		'post_parent' => $post->ID,
		'post_type' => 'page',
		'order'    => 'ASC',
		'posts_per_page'=>-1
	);

	$cq = new WP_Query($args);

	while ($cq->have_posts()) : $cq->the_post();
?>
	<div class="masonry-item">
		<h2>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>
		</h2>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( apply_filters( 'community_thumbnail_size', $community_thumbnail_size = 'medium' ) ); ?>
		</a>
		<?php printf('<div class="neighborhood-excerpt">%s</div>', get_the_content_limit( 200, 'Read More...') ); ?>
	</div><!-- .masonry-item -->
	<?php
	endwhile;

	echo '</div>';

	wp_reset_postdata();
}

add_action('wp_enqueue_scripts', 'community_template_scripts');
function community_template_scripts() {
	wp_enqueue_script('masonry');
}

add_action('wp_footer', 'community_template_masonry_js', 999);
/**
 * Initializes masonry
 */
function community_template_masonry_js() {
	?>
	<script>
	jQuery(document).ready(function($) {
		var $container = $('.masonry-content');
		$container.imagesLoaded(function(){
			$container.masonry({
				itemSelector : '.masonry-item',
				columnWidth : ".wp-post-image",
				gutter : 40,
				isAnimated : true,
				isFitWidth : true
			});
		});
	});
	</script>
	<?php
}

equity();