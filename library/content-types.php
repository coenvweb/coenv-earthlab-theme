<?php

/*
 * Register custom content types
 */

function coenv_earthlab_post_types_init() {
  register_post_type( 'case_study',
    array(
      'labels' => array(
      'name' => __( 'Case Studies' ),
      'singular_name' => __( 'Case Study' ),
      'add_new_item' => __( 'Add Case Study'),
      'edit_item' => __( 'Edit Case Study'),
      'new_item' => __( 'New Case Study'),
      ),
    'hierarchical' => false,
    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
    'public' => true,
    'has_archive' => false,
    'show_ui' => true,
    'rewrite' => array('slug' => 'about/case-study'),
    'menu_icon' => 'dashicons-slides',
    )
  );
}

add_action( 'init', 'coenv_earthlab_post_types_init' );

function case_tax() {
    $case_labels = array(
        'name'                       => _x( 'Focus Areas', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Focus Area', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Focus Areas', 'text_domain' ),
        'all_items'                  => __( 'All Focus Areas', 'text_domain' ),
        'parent_item'                => __( 'Parent Focus Area', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Focus Area:', 'text_domain' ),
        'new_item_name'              => __( 'New Focus Area', 'text_domain' ),
        'add_new_item'               => __( 'Add Focus Area', 'text_domain' ),
        'edit_item'                  => __( 'Edit Focus Area', 'text_domain' ),
        'update_item'                => __( 'Update Focus Area', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'search_items'               => __( 'Search Focus Areas', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove focus areas', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most popular focus areas', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
    );
    $case_args = array(
        'labels'                     => $case_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        //args below prevent default wp permalinks from messing up our index pages
        'rewrite'                    => 'focus_area',
        'query_var'                  => false,
    );
    register_taxonomy( 'focus-area', array( 'case_study', 'post' ), $case_args );
}

add_action('init', 'case_tax');
