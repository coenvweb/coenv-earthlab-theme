<?php
/**
 * The sidebar containing the main widget area
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<div class="sidebar">
	<?php
	do_action( 'foundationpress_before_sidebar' );
	$menu_id = $GLOBALS['post']->ID;
	if (is_singular('post')) {
		$menu_id = NEWS_PAGE_PARENT_ID;
	}
	if (is_singular('project')) {
		$menu_id = PROJECT_PAGE_PARENT_ID;
	}
	if (!is_front_page() && !is_page_template('page-templates/focus-page.php')) {
		echo '<div class="coenv_base_subnav" id="sidenav">';
		  if (is_singular('project')) {
			  $projects_page_id = (int) PROJECT_PAGE_PARENT_ID;
			  $grants_root_id = (int) wp_get_post_parent_id($projects_page_id);
			  if (empty($grants_root_id)) {
				  $grants_root_id = $projects_page_id;
			  }
			  echo '<h2 class="section-title"><a href="' . esc_url(get_permalink($grants_root_id)) . '">' . esc_html(get_the_title($grants_root_id)) . '</a></h2>';
			  echo coenv_base_hierarchical_submenu_get_children(get_post($grants_root_id), get_post($projects_page_id));
		  } else {
			  echo coenv_base_section_title($GLOBALS['post']->ID);
			  echo coenv_base_hierarchical_submenu($menu_id);
		  }
		echo '</div>';
	}
	?>
	<?php dynamic_sidebar('sidebar-widgets'); ?>
	<?php
	$ancestor_id = coenv_base_get_ancestor('ID');

	if (!function_exists('dynamic_sidebar') || !dynamic_sidebar( $ancestor_id )):

		dynamic_sidebar( $ancestor_id );
	endif;

	do_action( 'foundationpress_after_sidebar' ); ?>
</div>
