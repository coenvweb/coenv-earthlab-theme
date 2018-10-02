<?php

/**
 * Image sizes
 */

add_image_size( 'med_sq', '240', '240', true );
add_image_size( 'sm_sq', '120', '120', true );


/**
 * Gets the top-level ancestor for pages, posts and custom post types
 * Credit: https://github.com/elcontraption/wp-tools 
 * @param
 * - string
 * @return 
 * - array
 */
function coenv_base_get_ancestor($attr = 'ID') {

    $post = get_queried_object();

    // test for search
    if ( is_search() ) {
        return false;
    }

    if ( (is_archive() || is_search())) {

        $page_for_posts = get_option( 'page_for_posts' );

        if ( $page_for_posts == 0 ) {
            return false;
        }

        $ancestor = get_post( 42 );
        return $ancestor->$attr;
    }

    if($post->post_type == 'post') {
        $post_page = get_page_by_path( 'about/news-and-events' );
        $parent = get_post($post_page->post_parent);
        return $parent->$attr;
    }

    // test for pages
    if ( $post->post_type == 'page' ) {

        // test for top-level pages
        if ( $post->post_parent == 0 ) {
            return $post->$attr;
        }

        // must be a child page
        $ancestors = get_post_ancestors( $post->ID );
        $ancestor = get_post( array_pop( $ancestors ) );
        return $ancestor->$attr;
    }

    // test for custom post types
    $custom_post_types = get_post_types( array( '_builtin' => false ), 'object' );
    if ( !empty( $custom_post_types ) && array_key_exists( $post->post_type, $custom_post_types ) ) {

        // is parent_page slug defined?
        if ( isset( $custom_post_types[ $post->post_type ]->parent_page ) ) {

            // parent_page slug is defined.
            $parent = get_page_by_path( $custom_post_types[ $post->post_type ]->parent_page );

        } else {

            // parent_page slug is not defined
            // find custom slug
            $slug = $custom_post_types[ $post->post_type ]->rewrite[ 'slug' ];

            // if a page exists with the same slug, assume that's the parent page
            $parent = get_page_by_path( $slug );
        }

        // get ancestors of $parent
        if (isset($parent)) {
            $ancestors = get_post_ancestors( $parent->ID );

            // if ancestors is empty, just return $parent;
            if ( empty( $ancestors ) ) {
                return $parent->$attr;
            }

            $ancestor = get_post( array_pop( $ancestors ) );
            return $ancestor->$attr;
        }
    }
}

/* 
 * Remove underline from both Full and Basic TinyMCE toolbars in ACF
 */
add_filter( 'acf/fields/wysiwyg/toolbars' , 'coenv_base_acf_toolbar'  );
function coenv_base_acf_toolbar( $toolbars ) {

    if( ($key = array_search('underline' , $toolbars['Basic' ][1])) !== false ) {
        unset( $toolbars['Basic' ][1][$key] );
    }
    if( ($key = array_search('underline' , $toolbars['Full' ][2])) !== false ) {
        unset( $toolbars['Full' ][2][$key] );
    }

    // return $toolbars - IMPORTANT!
    return $toolbars;
}

/* 
 * Category filters for WPQuery templates (blog, publications, faculty, etc.)
 */
function coenv_base_cat_filter($tax,$tax_value) {

$tax_obj = get_taxonomy($tax);
$tax_str = $tax_obj->labels->name;

$cats_args  = array(
    'orderby' => 'name',
    'order' => 'ASC',
    'taxonomy' => $tax
);
$cats = wp_list_categories_for_post_type($tax);
    if ($cats) {
        if ($tax == 'topic') {
            echo '<label class="hide" for="select-category">Select a Focus Area:</label>';
            echo '<div class="" data-url="'.get_the_permalink().'">';
        } else {
            echo '<label class="hide" for="select-category">Select a category:</label>';
        }
        echo '<select name="select-category" class="select-category" id="select-category">';
        echo '<option class="level-0" value="' . get_the_permalink() . '">All ' . $tax_str . '</option>';
        foreach($cats as $cat) {
            $selected = $cat->slug == $tax_value ? ' selected="selected"' : '';
            echo $cat->slug;
            echo "</br>";
            echo $tax_value;
            echo '<option value="' . $tax . '/' . $cat->slug . '/#page-sidebar-left"' . $selected . '>' . $cat->name . '</option>';
        }
        echo '</select>';
        if ($tax == 'topic') {
            echo '</div>';
        }
    }
}


function wp_list_categories_for_post_type($post_type, $args = '') {
    $exclude = array();

    // Check ALL categories for posts of given post type
    foreach (get_categories() as $category) {
        $posts = get_posts(array('post_type' => $post_type, 'category' => $category->cat_ID));

        // If no posts found, ...
        if (empty($posts))
            // ...add category to exclude list
            $exclude[] = $category->cat_ID;
    }

    // Set up args
    if (! empty($exclude)) {
        $args .= ('' === $args) ? '' : '&';
        $args .= 'exclude='.implode(',', $exclude);
    }

    // List categories
    get_categories($args);
}

/* 
 * Date filters for WPQuery templates (blog, publications, faculty, etc.)
 */
function coenv_base_date_filter($post_type,$coenv_month,$coenv_year) {
    $counter = 0;
    $ref_month = '';
    $monthly = new WP_Query(array('posts_per_page' => -1, 'post_type'   => $post_type));
    echo '<label class="visuallyhidden" for="select-month">Choose a month</label>';
    echo '<select name="select-month" class="select-category" id="select-month">';
    echo '<option value="">All Dates</option>';
    if( $monthly->have_posts() ) :
        while( $monthly->have_posts() ) : $monthly->the_post();
            if( get_the_date('mY') != $ref_month ) {
                $month_num = get_the_date('m');
                $month_str = get_the_date('F');
                $year_num = get_the_date('Y');
                if ($year_num == $coenv_year && $month_num == $coenv_month) {
                 $selected = ' selected="selected"';
                } else {
                    $selected = '';
                }
                echo '<option value="coenv-year/' . $year_num . '/coenv-month/' . $month_num  . '/#page-sidebar-left"' . $selected . '>' . $month_str . ' ' . $year_num . '</option>';
               // echo "\n".get_the_date('F Y');
                $ref_month = get_the_date('mY');
                $counter = 0;
            }
        endwhile; 
    endif;
    echo '</select>';
    wp_reset_postdata();
    wp_reset_query();
}

/**
 * Remove default taxonomies
 */

add_action( 'init', 'coenv_unregister_taxonomies');
function coenv_unregister_taxonomies(){
	global $wp_taxonomies;
	$taxonomies = array( 'category', 'post_tag', 'news_tag' );
	foreach( $taxonomies as $taxonomy ) {
		if ( taxonomy_exists( $taxonomy) ) {
			unset( $wp_taxonomies[$taxonomy]);
		}
	}
}

// Callback function to filter the MCE settings
function add_two_column_list_format( $init_array ) {
	// Define the style_formats array
	$style_formats = array(
        array(
            'title' => 'Paragraph',
            'block' => 'p',
        ),  
        array(
            'title' => 'Introduction',
            'block' => 'span',
            'classes' => 'intro'
        ),  
       array(
            'title' => 'Button',
            'block' => 'span',
            'classes' => 'button'
        ),
        array(
            'title' => 'Heading 2',
            'block' => 'h2',
        ),  
        array(
            'title' => 'Heading 3',
            'block' => 'h3'
        ),  
        array(
            'title' => 'Heading 4',
            'block' => 'h4'
        ),  
        array(
            'title' => 'Small',
            'block' => 'span',
            'classes' => 'small'
        ),  
		array(
			'title' => 'Two Column Ul',
			'selector' => 'ul',
			'classes' => 'two-col',
		),
    );
	// Insert the array, JSON ENCODED, into 'style_formats'
	$init_array['style_formats'] = json_encode( $style_formats );  
	
	return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'add_two_column_list_format' );
?>
