<?php
/*
Template Name: News
*/

// keep track of whether or not this is the index page
$filtered = false;

//Categories
if(isset($wp_query->query_vars['category'])){
    $coenv_cat_term_1 = urlencode(htmlentities($wp_query->query_vars['category']));
    $coenv_cat_term_1_arr = get_term_by('slug',$coenv_cat_term_1,'category');
    $coenv_cat_term_1_val = $coenv_cat_term_1_arr->name;
    $filtered = true;
} else {
    $coenv_cat_1 = $coenv_cat_term_1 = null;
}

//Focus Areas
if(isset($wp_query->query_vars['focus_area'])){
    $coenv_cat_term_2 = urlencode(htmlentities($wp_query->query_vars['focus_area']));
    $coenv_cat_term_2_arr = get_term_by('slug',$coenv_cat_term_2,'focus_area');
    $coenv_cat_term_2_val = $coenv_cat_term_2_arr->name;
    $filtered = true;
} else {
    $coenv_cat_2 = $coenv_cat_term_2 = null;
}

?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div id="page" class="page-template-news" role="main">
    <div class="row">
        <div <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
            <div class="entry-content">
                <h1 class="article__title"><?php the_title(); ?></h1>
                <?php the_content(); ?>
                <div class="row filters">
                    <div class=" large-6 columns" data-url="<?php the_permalink() ?>" data-cat="category">
                        <?php coenv_base_cat_filter('category', $coenv_cat_term_1); // Category filter ?>
                    </div>
                    <div class=" large-6 columns" data-url="<?php the_permalink() ?>" data-cat="focus_area">
                        <?php coenv_base_cat_filter('focus_area', $coenv_cat_term_2); // Category filter ?>
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
                        'post_type'	=> 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => 10,
                        'ignore_sticky_posts' => 1,
                        'paged' => $paged
                    );
                    // Category filter
                    if($coenv_cat_term_1) {
                        $query_args['taxonomy'] = 'category';
                        $query_args['term'] = $coenv_cat_term_1;
                    }

                    if($coenv_cat_term_2) {
                        $query_args['taxonomy'] = 'focus_area';
                        $query_args['term'] = $coenv_cat_term_2;
                    }

                    $wp_query = new WP_Query( $query_args );
                    if ($wp_query->have_posts()) {
                        if ($coenv_cat_term_1) { // Category filter ?>
                            <div class="panel">
                                <div class="left"><?php echo $wp_query->found_posts; ?> posts in <?php echo $coenv_cat_term_1_val; ?></div>
                            </div>
                        <?php } ?>
                        <?php if ($coenv_cat_term_2) { // Category filter ?>
                            <div class="panel">
                                <div class="left"><?php echo $wp_query->found_posts; ?> posts focusing on <?php echo $coenv_cat_term_2_val; ?></div>
                            </div>
                        <?php } ?>
                        <?php
                        # The Loop
                        while ( $wp_query->have_posts() ) {
                            $wp_query->the_post(); ?>
                            <div class="blog clearfix">
                                <?php get_template_part( 'template-parts/story' ); ?>
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
                        <p>We're sorry. Your crtieria did not match any posts. <a href="/research/publications">Return to all posts &raquo;</a></p>
                    <?php } ?>
                </div>		
                <?php if ( is_active_sidebar( 'after-content' ) ) { ?>
                    <?php do_action('foundationPress_after_content'); ?>
                    <ul class="widget-area after-content">
                        <?php dynamic_sidebar("after-content"); ?>
                    </ul>
                <?php } ?>
                <a href="#" class="back-to-top">Back to Top</a>
                <?php do_action('foundationPress_after_content'); ?>
            </div>
            <?php wp_reset_postdata();
            wp_reset_query(); ?>
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
