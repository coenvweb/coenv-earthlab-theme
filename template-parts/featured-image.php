<?php
// If a featured image is set, insert into layout and use Interchange
// to select the optimal image size per named media query.
if(get_post_type() == 'post' || is_search() || is_404() || get_post_type() == 'case_study') {
    $ancestor = 22;
} else {
    $ancestor = coenv_get_ancestor();
} ?>
    <header id="featured-hero" role="banner" data-interchange="[<?php echo get_the_post_thumbnail_url($ancestor, 'featured-small'); ?>, small], [<?php echo get_the_post_thumbnail_url($ancestor, 'featured-medium'); ?>, medium], [<?php echo get_the_post_thumbnail_url($ancestor, 'featured-large'); ?>, large], [<?php echo get_the_post_thumbnail_url($ancestor, 'featured-xlarge'); ?>, xlarge]">
        <div class="row feature_row">
<?php if(is_search()) { ?>;
            <h1 class="small-offset-1 small-10 columns page-title">Search Results</h1>
<?php } elseif (is_404()) { ?>
            <h1 class="small-offset-1 small-10 columns page-title"><?php _e( 'File Not Found', 'foundationpress' ); ?></h1>
<?php } elseif (get_post_type() == 'case_study') { ?>
            <h1 class="small-offset-1 small-10 columns page-title">Case studies</h1>
<?php } elseif (get_post_type() == 'post') { ?>
            <h1 class="small-offset-1 small-10 columns page-title">News and events</h1>
<?php } else {?>
            <h1 class="small-offset-1 small-10 columns page-title"><?php echo get_the_title($ancestor); ?></h1>
<?php } ?>
    </div>
</header>

