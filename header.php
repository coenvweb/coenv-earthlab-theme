<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php if ( is_category() ) { 
		  echo 'Category Archive for &quot;'; single_cat_title(); echo '&quot; | '; bloginfo( 'name' );
		} elseif ( is_tag() ) { 
		  echo 'Tag Archive for &quot;'; single_tag_title(); echo '&quot; | '; bloginfo( 'name' );
		} elseif ( is_archive() ) { 
		  wp_title(''); echo ' Archive | '; bloginfo( 'name' );
		} elseif ( is_search() ) { 
		  echo 'Search for &quot;'.esc_html($s).'&quot; | '; bloginfo( 'name' );
		} elseif ( is_home() || is_front_page() ) { 
		  bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
		}  elseif ( is_404() ) { 
		  echo 'Error 404 Not Found | '; bloginfo( 'name' );
		} elseif ( is_single() ) { 
		  wp_title('');
		} else {
		  echo wp_title( ' | ', 'false', 'right' ); bloginfo( 'name' );
		} ?></title>

        <?php
			$banner = coenv_banner();
			$banner_class = $banner ? 'has-banner' : '';
			$banner_class .= ' template-print';
            $post = get_queried_object();
			$post_title = get_the_title().' | ' . get_bloginfo( 'name' );
			if (!is_front_page() ) {
				$advancedExcerpt = strip_tags(get_the_excerpt());
			} else {
				$advancedExcerpt = 'EarthLab reimagines the world as it should be, while impacting the world as it is. Equal parts research engine and community catalyst, EarthLab harnesses the power of co-created solutions to our most imminent environmental challenges.';
			}
			$post_description = $advancedExcerpt;
			$post_link = get_permalink();
			if ( has_post_thumbnail( $post->ID ) ) { 
				$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				$post_image = $thumb_src[0];
			} elseif ( $banner ) {
				$post_image = $banner['url'];
			} else {
				$post_image = get_template_directory_uri().'/assets/images/logo-1200x1200.png';
			}
        ?>

		<meta property="og:title" content="<?php echo $post_title ?>" />
		<meta property="og:description" content="<?php echo $coenv_excerpt; ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:url" content="<?php echo $post_link ?>" />
		<meta property="og:image" content="<?php echo $post_image ?>" />
		<meta property="og:site_name" content="<?php bloginfo('name') ?>" /

		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri() ?>/assets/images/icons/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri() ?>/assets/images/icons/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/assets/images/icons/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri() ?>/assets/images/icons/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/assets/images/icons/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri() ?>/assets/images/icons/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/assets/images/icons/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri() ?>/assets/images/icons/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri() ?>/assets/images/icons/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri() ?>/assets/images/icons/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri() ?>/assets/images/icons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri() ?>/assets/images/icons/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri() ?>/assets/images/icons/favicon-16x16.png">
		<link rel="manifest" href="<?php echo get_template_directory_uri() ?>/assets/images/manifest.json">
		<meta name="msapplication-TileColor" content="#4b2e84">
		<meta name="theme-color" content="#4b2e84">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<?php do_action( 'foundationpress_after_body' ); ?>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
	<div class="off-canvas-wrapper">
		<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
	<?php endif; ?>

	<?php do_action( 'foundationpress_layout_start' ); ?>

	<header id="masthead" class="site-header" role="banner">
        <div class="coenv-top-bar-wrapper show-for-medium">
			<div class="coenv-top-bar">
				<div class="coenv-top-bar-left">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <svg id="desktop-logo" width="108" height="73" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 108 73" enable-background="new 0 0 108 73" xml:space="preserve" role="img" aria-label="Wlogo">
                          <title>UW W Logo</title>
                          <path d="M79.343,0.112c0,0.858,0,12.238,0,13.098c0.856,0,9.206,0,9.206,0L78.271,51.461
                            c0,0-12.577-50.636-12.756-51.349c-0.687,0-12.626,0-13.303,0c-0.188,0.696-13.796,51.352-13.796,51.352L28.95,13.21
                            c0,0,8.726,0,9.585,0c0-0.859,0-12.239,0-13.098c-0.919,0-37.532,0-38.451,0c0,0.858,0,12.238,0,13.098c0.851,0,8.52,0,8.52,0
                            s14.703,58.809,14.88,59.522c0.708,0,19.942,0,20.639,0c0.183-0.697,9.852-37.454,9.852-37.454s9.188,36.747,9.364,37.454
                            c0.707,0,19.941,0,20.639,0C84.164,72.03,99.635,13.21,99.635,13.21s7.6,0,8.449,0c0-0.859,0-12.239,0-13.098
                            C107.176,0.112,80.251,0.112,79.343,0.112z"/>
                        </svg>
                    </a>
				</div>
				<div class="coenv-top-bar-right">
					
				</div>
			</div>
		</div>

		<div class="title-bar" data-responsive-toggle="site-navigation">
			<button class="menu-icon" type="button" data-toggle="mobile-menu"></button>
			<div class="title-bar-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			</div>
		</div>
        
        <div id="sticky-container" data-sticky-container>
            <div class="top-bar-wrapper sticky" data-sticky data-margin-top="0" data-options="marign-top:0;" style="width:100%" data-top-anchor="sticky-container:top" data-btm-anchor="footer:top">
                <div class="top-bar row">
                    <div class="top-bar-left">
                        <nav id="site-navigation" class="main-navigation" role="navigation">
                            <div class="nav-bar">
                                <ul class="menu">
                                    <li class="home"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="top-bar-right">
                        <?php foundationpress_top_bar_r() ?>
                        <?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
                            <?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
		</div>


	</header>

	<section class="container">
		<?php do_action( 'foundationpress_after_header' );
