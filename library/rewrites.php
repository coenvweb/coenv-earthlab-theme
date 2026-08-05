<?php
/**
 * Generates all the rewrite rules for a given post type and it's taxonomies.
 *
 * @param string|object $post_type The post type for which you wish to create the rewrite rules
 * @param string $index_path relative path from site root to the index page for your cpt
 * @param 2D array $extra_rules optional Non-taxonomy query vars you wish to create rewrite rules for. Rules will be added in the form '/query_var/(.+)/'. 
 * Each nested array represents rules to be treated together as one rewrite
 *
 */
function generate_cpt_rewrite_rules( $post_type, $index_path, $query_vars = array() ) {
    global $wp_rewrite;

    if( ! is_object( $post_type ) )
        $post_type = get_post_type_object( $post_type );

    $new_rewrite_rules = array();

    $taxonomies = get_object_taxonomies( $post_type->name, 'objects' );

    $index_page = get_page_by_path($index_path);
    if (empty($index_page) || empty($index_page->ID)) {
        return array();
    }

    // all possible taxonomies for each cpt to queryvars
    foreach( $taxonomies as $taxonomy )
        $query_vars[] = $taxonomy->name;

    // All possible permutations of queryvars
    for( $i = 1; $i <= count( $query_vars );  $i++ ) {

        $new_rewrite_rule =  $index_path . '/';
        $new_query_string = 'index.php?page_id=' . $index_page->ID;

        // Prepend the rewrites & queries
        for( $k = 1; $k <= $i; $k++ ) {
            $new_rewrite_rule .= '(' . implode( '|', $query_vars ) . ')/(.+?)/';
            $new_query_string .= '&' . $wp_rewrite->preg_index( $k * 2 - 1 ) . '=' . $wp_rewrite->preg_index( $k * 2 );
        }

        // Add the ability to page all rewrites
        $new_paged_rewrite_rule = $new_rewrite_rule . 'page/([0-9]{1,})/';
        $new_paged_query_string = $new_query_string . '&paged=' . $wp_rewrite->preg_index( $i * 2 + 1 );

        // Trailing slash is optional
        $new_paged_rewrite_rule = $new_paged_rewrite_rule . '?$';
        $new_rewrite_rule = $new_rewrite_rule . '?$';

        $new_rewrite_rules = array( $new_paged_rewrite_rule => $new_paged_query_string,
                                    $new_rewrite_rule       => $new_query_string )
                             + $new_rewrite_rules;
    }

    return $new_rewrite_rules;
}

function coenv_get_projects_index_path() {
    if (defined('PROJECT_PAGE_PARENT_ID')) {
        $project_page = get_post((int) PROJECT_PAGE_PARENT_ID);
        if (!empty($project_page)) {
            $project_uri = get_page_uri($project_page->ID);
            if (!empty($project_uri)) {
                return $project_uri;
            }
        }
    }

    $projects_index_pages = get_posts(array(
        'post_type' => 'page',
        'posts_per_page' => 1,
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-templates/projects.php',
        'post_status' => 'publish'
    ));
    if (!empty($projects_index_pages)) {
        $project_uri = get_page_uri($projects_index_pages[0]->ID);
        if (!empty($project_uri)) {
            return $project_uri;
        }
    }

    return 'grants/projects';
}

function add_cpt_rewrites($wp_rewrite) {
    $projects_index_path = coenv_get_projects_index_path();
    $a_rules = generate_cpt_rewrite_rules('post', 'about/news', array('news-search', 'topic'));
    $b_rules = generate_cpt_rewrite_rules('project', $projects_index_path, array('project-search', 'project_topic', 'project_type'));
    if (empty($b_rules)) {
        $fallback_paths = array('grants/projects', 'about/projects', 'projects');
        foreach ($fallback_paths as $fallback_path) {
            $b_rules = generate_cpt_rewrite_rules('project', $fallback_path, array('project-search', 'project_topic', 'project_type'));
            if (!empty($b_rules)) {
                break;
            }
        }
    }
    $wp_rewrite->rules = $a_rules + $b_rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'add_cpt_rewrites');

function coenv_add_explicit_project_filter_rewrites() {
    $projects_index_path = coenv_get_projects_index_path();
    $index_page = get_page_by_path($projects_index_path);

    if (empty($index_page) || empty($index_page->ID)) {
        return;
    }

    $page_id = (int) $index_page->ID;
    $path_regex = preg_quote(trim($projects_index_path, '/'), '/');

    add_rewrite_rule(
        '^' . $path_regex . '/project_topic/([^/]+)/?$',
        'index.php?page_id=' . $page_id . '&project_topic=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^' . $path_regex . '/project_type/([^/]+)/?$',
        'index.php?page_id=' . $page_id . '&project_type=$matches[1]',
        'top'
    );
    add_rewrite_rule(
        '^' . $path_regex . '/project_topic/([^/]+)/page/([0-9]{1,})/?$',
        'index.php?page_id=' . $page_id . '&project_topic=$matches[1]&paged=$matches[2]',
        'top'
    );
    add_rewrite_rule(
        '^' . $path_regex . '/project_type/([^/]+)/page/([0-9]{1,})/?$',
        'index.php?page_id=' . $page_id . '&project_type=$matches[1]&paged=$matches[2]',
        'top'
    );
}
add_action('init', 'coenv_add_explicit_project_filter_rewrites', 20);

function add_query_vars() {
    add_rewrite_tag('%topic%', '(.+?)/');
    add_rewrite_tag('%news-search%', '(.+?)/');
    add_rewrite_tag('%project-search%', '(.+?)/');
    add_rewrite_tag('%project_topic%', '(.+?)/');
    add_rewrite_tag('%project_type%', '(.+?)/');
}
add_action('init', 'add_query_vars');

function coenv_maybe_flush_project_rewrites() {
    $rewrite_version = 'coenv_project_rewrites_v3';
    $stored_version = get_option('coenv_project_rewrites_version');

    if ($stored_version !== $rewrite_version) {
        flush_rewrite_rules(false);
        update_option('coenv_project_rewrites_version', $rewrite_version);
    }
}
add_action('init', 'coenv_maybe_flush_project_rewrites', 30);

?>
