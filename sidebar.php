<?php
/**
 * The sidebar containing the main widget area
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>
<aside class="sidebar">
	<?php
	do_action( 'foundationpress_before_sidebar' );
	$menu_id = $GLOBALS['post']->ID;
	if (is_singular('post')) {
		$menu_id = NEWS_PAGE_PARENT_ID;
	}
	if (is_singular('projects')) {
		$menu_id = PROJECT_PAGE_PARENT_ID;
	}
	if (!is_front_page() && !is_page_template('page-templates/focus-page.php')) {
		echo '<div class="coenv_base_subnav show-for-medium">';
		  echo coenv_base_section_title($GLOBALS['post']->ID);
			echo coenv_base_hierarchical_submenu($menu_id);
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
</aside>
