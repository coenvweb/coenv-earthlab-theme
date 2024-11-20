<?php
/**
 * 
 * @link https://codex.wordpress.org/Theme_Development
 * @package EarthLab
 */

 //fix for wp 6.7 auto image size
 add_filter(
	'wp_content_img_tag',
	static function ( $image ) {
			return str_replace( 'sizes="auto, ', ' sizes="', $image );
	}
);
add_filter(
	'wp_get_attachment_image_attributes',
	static function ( $attr ) {
			if ( isset( $attr['sizes'] ) ) {
					$attr['sizes'] = preg_replace( '/^auto, /', '', $attr['sizes'] );
			}
			return $attr;
	}
);

/** Various clean up functions */
// require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/menu-walkers.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Add Nav Options to Customer */
require_once( 'library/navigation-lvl2.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

require_once( 'library/photos.php' );


/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/protocol-relative-theme-assets.php' );

// College customizations

/** Utility Functions */
require_once( 'library/coenv-helper.php' );

/** Define custom post types */
require_once( 'library/content-types.php' );

/** Custom Widgets */
require_once( 'library/widgets.php' );

/** Configure url rewrites for cpts */
require_once( 'library/rewrites.php' );

/** Shortcodes */
require_once( 'library/shortcodes.php' );

// GDPR Compliance
require_once('library/gdpr.php');

if( function_exists('acf_add_options_page')) {
    acf_add_options_page();
}

// Remove meta title from wp_head, we will add it manually
if (has_action('wp_head','_wp_render_title_tag') == 1) {
    remove_action('wp_head','_wp_render_title_tag', 1);
}
