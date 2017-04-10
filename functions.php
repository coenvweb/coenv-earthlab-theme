<?php
/**
 * 
 * @link https://codex.wordpress.org/Theme_Development
 * @package EarthLab
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

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

if( function_exists('acf_add_options_page')) {
    acf_add_options_page();
}
