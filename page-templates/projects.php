<?php
/*
Template Name: Projects Index
*/

// keep track of whether or not this is the index page
$filtered = false;

//Focus Areas
if(isset($wp_query->query_vars['focus-area'])){
    $coenv_cat_term_2 = urlencode(htmlentities($wp_query->query_vars['focus-area']));
    $coenv_cat_term_2_arr = get_term_by('slug',$coenv_cat_term_2,'focus-area');
    $coenv_cat_term_2_val = $coenv_cat_term_2_arr->name;
    $filtered = true;
} else {
    $coenv_cat_2 = $coenv_cat_term_2 = null;
}

if(isset($wp_query->query_vars['case-search'])) {
    $search = urldecode($wp_query->query_vars['case-search']);
}

?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div id="page-sidebar-left" class="page-template-index page-template-projects" role="main">
    <div <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
        <div class="entry-content">
            <h2 class="page-title"><?php the_title(); ?></h2>
            <?php the_content(); ?>
            <div class="row filters">
                <div class=" large-6 columns" data-url="<?php the_permalink() ?>" data-cat="focus-area">
                    <?php coenv_base_cat_filter('focus-area', $coenv_cat_term_2); // Category filter ?>
                </div>
                <div class="case-search large-6 columns" data-url="<?php the_permalink() ?>" data-cat="case-search">
                    <form role="search" method="get" class="search-form" action="<?php the_permalink() ?>">
                        <div class="field-wrap">
                            <label for="case-search">Search projects</label>
                            <input value="<?= $search ?>" name="case-search" id="s" placeholder="Search case studies" aria-label="Search" title="Search" type="text">
                            <button type="submit"><i class="fa fa-search"></i><span>Search</span></button>
                        </div>
                    </form>
                </div>
                <div class="small-12 columns">
                    <hr>
                </div>
            </div>
            <?php
                /**
                * Blog loop
                */
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $query_args = array(
                    'post_type'	=> 'project',
                    'post_status' => 'publish',
                    'posts_per_page' => 10,
                    'ignore_sticky_posts' => 1,
                    'paged' => $paged
                );

                if($coenv_cat_term_2) {
                    $query_args['taxonomy'] = 'focus-area';
                    $query_args['term'] = $coenv_cat_term_2;
                }

                if($search) {
                    $query_args['s'] = $search;
                }

                $wp_query = new WP_Query( $query_args );
                if ($wp_query->have_posts()) {
                    if ($coenv_cat_term_2) { // Category filter ?>
                        <div class="panel">
                            <div class="left"><?php echo $wp_query->found_posts; ?> project<?=($wp_query->found_posts > 1 ? 's' : '')?> focusing on <span class="term"><?php echo $coenv_cat_term_2_val; ?></span></div> <div class="right"><a class="button" href="<?php the_permalink() ?>">All Projects</a></div>
                        </div>
                    <?php }
                    if ($search) { // Category filter ?>
                        <div class="panel">
                            <div class="left"><?php echo $wp_query->found_posts; ?> project<?=($wp_query->found_posts > 1 ? 's' : '')?> matching <span class="term"><?php echo $search; ?></span></div> <div class="right"><a class="button" href="<?php the_permalink() ?>">All Projects</a></div>
                        </div>
                    <?php } ?>
                    <?php
                    # The Loop
                    while ( $wp_query->have_posts() ) {
                        $wp_query->the_post(); ?>
                        <div class="blog clearfix">
                            <?php get_template_part( 'template-parts/excerpt' ); ?>
                        </div>
                    <?php } ?>
                    <div class="pager">
                    <?php if ( function_exists('FoundationPress_pagination') ) { 
                        FoundationPress_pagination(); 
                    } else if ( is_paged() ) { ?>
                        <nav id="post-nav">
                            <div class="post-previous"><?php //next_posts_link( __( '&larr; Older posts', 'FoundationPress' ) ); ?></div>
                            <div class="post-next"><?php //previous_posts_link( __( 'Newer posts &rarr;', 'FoundationPress' ) ); ?></div>
                        </nav>
                    <?php } ?>
                    </div>
                <?php } else { ?>
                    <p>We're sorry. Your crtieria did not match any projects. <a href="/projects">Return to all projects &raquo;</a></p>
                <?php } ?>
            </div>		
            <?php if ( is_active_sidebar( 'after-content' ) ) { ?>
                <?php do_action('foundationPress_after_content'); ?>
                <ul class="widget-area after-content">
                    <?php dynamic_sidebar("after-content"); ?>
                </ul>
            <?php } ?>
            <?php do_action('foundationPress_after_content'); ?>
        </div>
        <?php wp_reset_postdata();
        wp_reset_query(); ?>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
