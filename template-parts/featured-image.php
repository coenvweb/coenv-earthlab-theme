<?php
// If a featured image is set, insert into layout and use Interchange
// to select the optimal image size per named media query.
$ancestor = coenv_get_ancestor();
if ( has_post_thumbnail( $ancestor ) ) : ?>
	<header id="featured-hero" role="banner" data-interchange="[<?php echo get_the_post_thumbnail_url($ancestor, 'featured-small'); ?>, small], [<?php echo get_the_post_thumbnail_url($ancestor, 'featured-medium'); ?>, medium], [<?php echo get_the_post_thumbnail_url($ancestor, 'featured-large'); ?>, large], [<?php echo get_the_post_thumbnail_url($ancestor, 'featured-xlarge'); ?>, xlarge]">
        <div class="row feature_row">
            <h1 class="small-offset-1 small-10 columns page-title"><?php the_title(); ?></h1>
        </div>
	</header>
<?php endif;
