<?php
/**
 * Register widget areas
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */


if ( ! function_exists( 'foundationpress_sidebar_widgets' ) ) :
    function foundationpress_sidebar_widgets() {
        $before_widget = '<article id="%1$s" class="widget %2$s">';
        $after_widget = '</article>';
        $before_title = '<h3>';
        $after_title = '</h3>';
        register_sidebar(array(
                    'id' => 'sidebar-widgets',
                    'name' => __( 'Sidebar widgets', 'foundationpress' ),
                    'description' => __( 'Drag widgets to this sidebar container.', 'foundationpress' ),
                    'before_widget' => $before_widget,
                    'after_widget'  => $after_widget,
                    'before_title'  => $before_title,
                    'after_title' => $after_title
                    ));

        register_sidebar(array(
                    'id' => 'footer-widgets',
                    'name' => __( 'Footer widgets', 'foundationpress' ),
                    'description' => __( 'Drag widgets to this footer container', 'foundationpress' ),
                    'before_widget' => $before_widget,
                    'after_widget'  => $after_widget,
                    'before_title'  => $before_title,
                    'after_title' => $after_title
                    ));

        /** 
         * Adds a widget area for each section.
         */

        // this will return only top-level pages
        $pages = get_pages('parent=0&sort_column=menu_order&sort_order=ASC');
        $pages_to_remove = coenv_base_menu_exclude();

        if ( empty( $pages ) ) { 
            return false;
        }

        foreach( $pages as $page ) { 
            // remove specific pages
            if( !in_array( $page->ID, $pages_to_remove ) ) { 
                register_sidebar( array(
                            'id' => 'sidebar-' . $page->ID,
                            'name' => 'Sidebar / ' . $page->post_title,
                            'description' => __('Drag widgets to this container.', 'foundationpress'),
                            'before_widget' => $before_widget,
                            'after_widget'  => $after_widget,
                            'before_title'  => $before_title,
                            'after_title' => $after_title
                            ) );
            }
        }
    }

add_action( 'widgets_init', 'foundationpress_sidebar_widgets' );
endif;

if ( ! function_exists( 'homepage_widgets' ) ) :
    function homepage_widgets() {
        register_sidebar(array(
            'id' => 'homepage-focus',
            'name' => __( 'Homepage Focus Areas', 'foundationpress' ),
            'description' => __( 'Drag widgets to this homepage container.', 'foundationpress' ),
            'before_widget' => '<div class="columns focus-tile small-12 medium-6 large-3">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="focus_area_title">',
            'after_title' => '</h4>',
            ));
        register_sidebar(array(
            'id' => 'homepage-do',
            'name' => __( 'Homepage How We Do This', 'foundationpress' ),
            'description' => __( 'Drag widgets to this homepage container.', 'foundationpress' ),
            'before_widget' => '<div class="columns do-this-tile small-12 medium-36 large-3">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="do_area_title">',
            'after_title' => '</h4>',
            ));
    }

add_action( 'widgets_init', 'homepage_widgets' );
endif;
