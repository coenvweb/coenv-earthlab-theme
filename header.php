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
        <meta name="twitter:dnt" content="on">
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
            $ancestor = coenv_get_ancestor();
            $post = get_queried_object();
			$post_title = get_the_title().' | ' . get_bloginfo( 'name' );
			if (!is_front_page() ) {
				$advancedExcerpt = strip_tags(get_the_excerpt());
			} else {
				$advancedExcerpt = 'EarthLab reimagines the world as it should be, while impacting the world as it is. Equal parts research engine and community catalyst, EarthLab harnesses the power of co-created solutions to our most imminent environmental challenges.';
			}
			$post_description = $advancedExcerpt;
			$post_link = get_permalink();
			if ( has_post_thumbnail( get_the_id() )) { 
				$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				$post_image = $thumb_src[0];
            } elseif($ancestor) {
                $post_image = get_the_post_thumbnail_url($ancestor, 'full');
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
        <meta name="keywords" content="EarthLab, Earth Lab, UW, Environment, Climate, Ocean, Ecosystems, Hazards" />

		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-97311419-1', 'auto');
		  ga('send', 'pageview');
          ga('set', 'anonymizeIp', true);

		</script>

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
	<?php do_action( 'foundationpress_after_body' ); ?>

	<div class="off-canvas-wrapper">
		<div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
		<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>

	<?php do_action( 'foundationpress_layout_start' ); ?>

	<header id="masthead" class="site-header" role="banner">
        <div class="coenv-top-bar-wrapper">
			<div class="coenv-top-bar">
				<div class="coenv-top-bar-left">
                   <a class="desktop_logo" href="https://uw.edu">
                        <svg id="desktop-logo" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 108 73" role="img" aria-label="Wlogo">
                          <title>UW Logo</title>
                          <path d="M79.343,0.112c0,0.858,0,12.238,0,13.098c0.856,0,9.206,0,9.206,0L78.271,51.461
                            c0,0-12.577-50.636-12.756-51.349c-0.687,0-12.626,0-13.303,0c-0.188,0.696-13.796,51.352-13.796,51.352L28.95,13.21
                            c0,0,8.726,0,9.585,0c0-0.859,0-12.239,0-13.098c-0.919,0-37.532,0-38.451,0c0,0.858,0,12.238,0,13.098c0.851,0,8.52,0,8.52,0
                            s14.703,58.809,14.88,59.522c0.708,0,19.942,0,20.639,0c0.183-0.697,9.852-37.454,9.852-37.454s9.188,36.747,9.364,37.454
                            c0.707,0,19.941,0,20.639,0C84.164,72.03,99.635,13.21,99.635,13.21s7.6,0,8.449,0c0-0.859,0-12.239,0-13.098
                            C107.176,0.112,80.251,0.112,79.343,0.112z"/>
                        </svg>
                    </a>
                    <a class="university_logo" href="https://uw.edu">
						 <svg version="1.1" id="university_logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 class="uw-name" viewBox="-70 381.4 469.1 31.6" xml:space="preserve" alt="University of Washington">
                         <title>University of Washington</title>
					<g>
						<path d="M384.6,404.3v-17.4l12.1,19.4h1.2v-21.3l2-2h-6.1l2,2v14.8l-10.5-16.8h-4.8l2,2v19.2l-2,2h6.1L384.6,404.3z M366.6,405.1
							c-4.7,0-6.3-5.6-6.3-10.4c0-4.8,1.6-10.4,6.3-10.4c4.7,0,6.3,5.6,6.3,10.4C372.9,399.5,371.3,405.1,366.6,405.1 M357.3,394.7
							c0,5.9,3.3,12.1,9.3,12.1c6,0,9.3-6.2,9.3-12.1c0-5.9-3.3-12.1-9.3-12.1C360.7,382.5,357.3,388.8,357.3,394.7 M346.8,404.5v-19.7
							h4.4l2.5,2.5v-4.2h-16.4v4.2l2.5-2.5h4.4v19.7l-1.8,1.9h6.2L346.8,404.5z M329.6,395.7v7.5c-0.6,0.5-1.7,1.7-3.8,1.7
							c-5.2,0-7.8-5.2-7.8-10.2c0-5,3.3-10.2,7.8-10.2c1.2,0,2.1,0.3,2.8,1.1l2.6,2.5v-4c-1.4-0.7-2.8-1.3-5.4-1.3
							c-6.3,0-10.8,5.7-10.8,11.9c0,6.2,4.5,11.9,10.8,11.9c3.6,0,5.1-0.9,6.4-1.7v-9.2l1.8-1.9h-6.2L329.6,395.7z M295.1,404.3v-17.4
							l12.2,19.4l1,0v-21.3l2-2h-6.1l2,2v14.8l-10.5-16.8H291l2,2v19.2l-2,2h6.1L295.1,404.3z M278.4,383.1l1.9,1.9v19.6l-1.9,1.9h6.3
							l-1.9-1.9v-19.6l1.9-1.9H278.4z M257.7,394.6h9.8v9.8l-1.9,1.9h6.3l-1.9-1.9v-19.6l1.9-1.9h-6.3l1.9,1.9v8h-9.8v-8l1.9-1.9h-6.2
							l1.8,1.9v19.6l-1.8,1.9h6.2l-1.9-1.9V394.6z M247.2,399.8c0-2.3-1.1-3.7-2.2-4.5l-4.7-3.4c-1.7-1.2-2.6-2.8-2.6-4
							c0-2.4,2.1-3.3,3.4-3.3c0.7,0,1.1,0.3,1.5,0.3l2,2.2l2.2-3.2l-4.6-0.9c-0.3-0.1-0.5-0.1-1.1-0.1c-4.1,0-5.9,3.5-5.9,5.7
							c0,1.8,0.9,3.8,3,5.3l4.8,3.4c1.3,0.9,1.7,2.2,1.7,3.4c0,2-1.2,4.1-3.9,4.1c-0.6,0-1.2-0.1-1.6-0.3l-2.2-2.6l-2,3.6l4.5,0.9
							c0,0,0.8,0.2,1.4,0.2C243.6,406.6,247.2,404.3,247.2,399.8 M221.2,388.2l3.2,9.6h-6.5L221.2,388.2z M215.6,404.5l1.7-4.9h7.7
							l1.6,4.9l-1.8,1.8h6.6l-1.9-1.9l-7.3-21.4h-1.2l-7.4,21.4l-1.9,1.9h5.6L215.6,404.5z M190.9,406.3l5.3-16.8l5.2,16.8h1.2l6.7-21.4
							l1.9-1.9h-5.6l1.8,1.8l-4.9,16.1l-4.8-16.1l1.8-1.8h-6.6l1.9,1.9l0.5,1.5l-4.5,14.5l-4.8-16.1l1.8-1.8h-6.6l1.9,1.9l6.5,21.4H190.9
							z M156.4,392.4l-0.9,0.9l0.1,0.3h2.7c-0.4,3-0.8,5.5-1.4,9.6c-0.9,6.1-1.6,8.3-2.3,8.8c-0.2,0.2-0.5,0.3-0.8,0.3
							c-0.4,0-1-0.3-1.4-0.5c-0.4-0.2-0.7,0-0.9,0.2c-0.3,0.3-0.6,0.7-0.6,1.1c0,0.7,0.9,1,1.4,1c0.6,0,2.2-0.5,3.6-2.3
							c1.1-1.4,2.6-4.6,3.9-12c0.2-1.4,0.5-2.8,1.1-6.4l3.3-0.3l0.7-0.9H161c1-6.1,1.8-7.9,3.2-7.9c1,0,1.8,0.4,2.5,1.1
							c0.2,0.2,0.6,0.2,0.9,0c0.3-0.2,0.7-0.8,0.7-1.2c0-0.7-0.9-1.4-2-1.4c-1.9,0-3.9,1.1-5.3,2.7c-1.3,1.5-2.1,4-2.6,6.7H156.4z
							 M141.7,401c0-4.9,2.5-7.5,3.5-7.9c0.3-0.1,0.8-0.3,1.1-0.3c1.6,0,2.6,1.2,2.6,3.8c0.1,4.3-2.2,8.1-3.5,8.6c-0.3,0.1-0.7,0.2-1,0.2
							C142.4,405.4,141.7,403.4,141.7,401 M147.3,391.6c-0.9,0-2.2,0.4-3.5,1.2c-2.3,1.3-4.7,4.4-4.7,9c0,2.3,1.1,4.9,4.1,4.9
							c1.4,0,3.5-1,4.9-2.2c2.2-2,3.4-5.3,3.4-8.3C151.4,393.4,150,391.6,147.3,391.6 M109.3,384.9l5.9,10.6v9l-1.9,1.9h6.3l-1.9-1.9v-9
							l6-10.6l1.9-1.9h-5.8l1.8,1.8l-4.9,8.7l-4.7-8.7l1.8-1.8h-6.6L109.3,384.9z M97,404.5v-19.7h4.4l2.5,2.5v-4.2H87.6v4.2l2.5-2.5h4.4
							v19.7l-1.8,1.9h6.2L97,404.5z M75.9,383.1l1.9,1.9v19.6l-1.9,1.9h6.3l-1.9-1.9v-19.6l1.9-1.9H75.9z M69.2,399.8
							c0-2.3-1.1-3.7-2.2-4.5l-4.7-3.4c-1.7-1.2-2.6-2.8-2.6-4c0-2.4,2.1-3.3,3.3-3.3c0.7,0,1.1,0.3,1.5,0.3l2.1,2.2l2.2-3.2l-4.6-0.9
							c-0.3-0.1-0.5-0.1-1.1-0.1c-4.1,0-5.9,3.5-5.9,5.7c0,1.8,0.9,3.8,3,5.3l4.8,3.4c1.3,0.9,1.7,2.2,1.7,3.4c0,2-1.2,4.1-3.9,4.1
							c-0.6,0-1.2-0.1-1.6-0.3l-2.2-2.6l-2,3.6l4.5,0.9c0,0,0.7,0.2,1.4,0.2C65.5,406.6,69.2,404.3,69.2,399.8 M39.3,384.8h2.8
							c2.5,0,4.5,2.1,4.5,4.6c0,2.4-2,4.3-4.5,4.3h-2.8V384.8z M39.3,404.5v-9h3.5l5.6,10.8h3.9l-1.8-1.9l-5.2-9.5
							c2.6-0.8,4.4-3.2,4.4-5.4c0-3.9-3.7-6.4-7.5-6.4h-7.2l1.8,1.9v19.6l-1.8,1.9h6.2L39.3,404.5z M28.9,406.3v-4.3l-2.5,2.5h-7.1v-9.8
							h5.2l1.9,1.9v-5.4l-1.9,1.9h-5.2v-8.3h7.1l2.5,2.5v-4.2H14.9l1.8,1.9v19.6l-1.8,1.9H28.9z M-1.3,383.1h-6.6l1.9,1.9l6.5,21.4h1.2
							l6.7-21.4l1.9-1.9H4.8l1.8,1.8L1.6,401l-4.8-16.1L-1.3,383.1z M-19.4,383.1l1.9,1.9v19.6l-1.9,1.9h6.3l-1.9-1.9v-19.6l1.9-1.9
							H-19.4z M-41,404.3v-17.4l12.5,19.4h0.8v-21.3l2-2h-6.1l2,2v14.8l-10.5-16.8h-4.8l2,2v19.2l-2,2h6.1L-41,404.3z M-67.2,400.1
							c0,3.8,3.2,6.7,7.2,6.7c3.8,0,7.5-2.8,7.5-6.7v-15l2-2h-6.1l2,2v15c0,2.7-2.1,4.8-4.8,4.8c-2.7,0-5.1-2.1-5.1-4.8v-15l2-2h-6.7l2,2
							V400.1z"/>
					</g>
					</svg>
                    </a> 
				</div>
				<div class="coenv-top-bar-right">
                    <?php EL_universal_top_bar(); ?>
				</div>
			</div>
		</div>

		<div class="title-bar" data-responsive-toggle="site-navigation">
			<button class="menu-icon" type="button" data-toggle="mobile-menu"><span class="hide">Mobile Menu</span></button>
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
                    <div class="menu-item menu-item-search-button top-bar-right"><i class="fa-search fa"></i><i class="fa-times fa hide"></i></div>
                    <div class="top-bar-right desktop-main-menu">
                        <?php foundationpress_top_bar_r() ?>
                            <?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
                    </div>
                    <div class="top-bar-right search-bar show-for-sr">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            </div>
		</div>


	</header>

	<section class="container">
		<?php do_action( 'foundationpress_after_header' );
