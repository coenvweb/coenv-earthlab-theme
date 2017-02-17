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
   // 'rewrite' => array('slug' => 'case-study'),
    'menu_icon' => 'dashicons-slides',
    )
  );
}

add_action( 'init', 'coenv_earthlab_post_types_init' );