<?php

/*
 * Register custom content types
 */

 

function coenv_earthlab_post_types_init() {
  register_post_type( 'project',
    array(
      'labels' => array(
      'name' => __( 'Projects' ),
      'singular_name' => __( 'Project' ),
      'add_new_item' => __( 'Add Project'),
      'edit_item' => __( 'Edit Project'),
      'new_item' => __( 'New Project'),
      ),
    'hierarchical' => false,
    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
    'public' => true,
    'has_archive' => false,
    'show_ui' => true,
    'rewrite' => array('slug' => 'project'),
    'menu_icon' => 'dashicons-format-image',
	'parent_page' => 'projects',
    )
  );
  register_post_type( 'staff',
    array(
      'labels' => array(
      'name' => __( 'Staff' ),
      'singular_name' => __( 'Staff Member' ),
      'add_new_item' => __( 'Add Staff Member'),
      'edit_item' => __( 'Edit Staff Member'),
      'new_item' => __( 'New Staff Member'),
      ),
    'hierarchical' => false,
    'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
    'public' => false,
    'has_archive' => false,
    //'show_ui' => true,
    'rewrite' => false,
    'menu_icon' => 'dashicons-admin-users',
	//'parent_page' => 'about/staff',
    )
  ); 
}

add_action( 'init', 'coenv_earthlab_post_types_init' );

function project_tax() {
    
    $topic_labels = array(
        'name'                       => _x( 'Topics', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Topic', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Topics', 'text_domain' ),
        'all_items'                  => __( 'All Topics', 'text_domain' ),
        'parent_item'                => __( 'Parent Topic', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Topic:', 'text_domain' ),
        'new_item_name'              => __( 'New Topic', 'text_domain' ),
        'add_new_item'               => __( 'Add Topic', 'text_domain' ),
        'edit_item'                  => __( 'Edit Topic', 'text_domain' ),
        'update_item'                => __( 'Update Topic', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate topics with commas', 'text_domain' ),
        'search_items'               => __( 'Search Topics', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove topics', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most popular topics', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
    );
    $topic_args = array(
        'labels'                     => $topic_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        //args below prevent default wp permalinks from messing up our index pages
        'rewrite'                    => false,
    );
    register_taxonomy( 'topic', array( 'project', 'post' ), $topic_args );
    
    $affiliated_members_labels = array(
        'name'                       => _x( 'Member/Affiliates', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Member/Affiliates', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Member/Affiliates', 'text_domain' ),
        'all_items'                  => __( 'All Member/Affiliates', 'text_domain' ),
        'parent_item'                => __( 'Parent Member', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Member:', 'text_domain' ),
        'new_item_name'              => __( 'New Member', 'text_domain' ),
        'add_new_item'               => __( 'Add Member', 'text_domain' ),
        'edit_item'                  => __( 'Edit Member', 'text_domain' ),
        'update_item'                => __( 'Update Member', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'search_items'               => __( 'Search Member/Affiliates', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove affiliated members', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most popular affiliated members', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
    );
    $affiliated_members_args = array(
        'labels'                     => $affiliated_members_labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        //args below prevent default wp permalinks from messing up our index pages
        'rewrite'                    => false,
    );
    register_taxonomy( 'member-affiliates', array( 'project', 'post' ), $affiliated_members_args );
}

add_action('init', 'project_tax');


define( 'PROJECT_PAGE_PARENT_ID', '598' );
define( 'NEWS_PAGE_PARENT_ID', '606' );

/**
 * save project parent
 */
function coenv_base_project_parent( $data, $postarr ) {
    global $post;

    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $data;

    if ( $post->post_type == "project" ){
        $data['post_parent'] = PROJECT_PAGE_PARENT_ID;
    }

    return $data;
}
add_action( 'wp_insert_post_data', 'coenv_base_project_parent', '104', 2  );

/**
 * save news parent
 */
function coenv_base_news_parent( $data, $postarr ) {
    global $post;

    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $data;

    if ( $post->post_type == "post" ){
        $data['post_parent'] = NEWS_PAGE_PARENT_ID;
    }

    return $data;
}
add_action( 'wp_insert_post_data', 'coenv_base_news_parent', '104', 2  );
