<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>
<div class="homepage">
	<?php
	/**
	 * Loop for homepage features.
	 */
	$feature_args = array(
		'post_type' => 'features',
		'post_status' => 'publish',
		'posts_per_page' => 1,
		'orderby' => 'menu_order',
		);
	$feature_query = new WP_Query( $feature_args ); ?>
	<div class="homepage-features">
        <div class="playpause">
            <i class="fa fa-pause running"></i>
            <div class="progress" role="progressbar" tabindex="0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-meter" style="width: 0%;"></div>
            </div>
        </div>
		<?php
		# The Loop
		while ( $feature_query->have_posts() ) : 
			$feature_query->the_post();
			if (get_field('feature_excerpt')) {
				$feature_excerpt = get_field('feature_excerpt');
			}
            $feature_images = get_field('hero_images');
			$images = array();
			$count = 0;
			while(have_rows('hero_images')) : the_row();
				$image = get_sub_field('image');
				if($count == 0) {
					echo '<div class="feature-image active" id="'.$image['id'].'" style="background-image:url('.$image['url'].');" >';
				} else {
					echo '<div class="feature-image inactive" id="'.$image['id'].'" style="background-image:url('.$image['url'].');" >';
				}
				echo '</div>';
				$count++;
			endwhile;
			echo '<div class="feature row">';
				echo '<div class="feature-info-container small-offset-1 small-10 columns">';
					echo '<div class="feature-info">';
						echo '<div class="feature-content">';
							echo '<div class="feature-title">';
								echo '<h2>' . get_the_title() . '</h2>';
							echo '</div>';
							echo '<div class="medium-offset-4 medium-8 large-offset-6 large-6 columns feature-excerpt">';
								echo '<p>' . $feature_excerpt . '</p>';
                echo '<a class="button" href="/about">Learn more</i></a>';
							echo '</div>';
						echo '</div><!-- .feature-content -->';

					echo '</div><!-- .feature-info -->';
					echo '<div class="hero-texture">';
					echo '</div>';
				echo '</div><!-- .feature-info-container -->';
			echo '</div><!-- .feature -->';	
		endwhile;
		wp_reset_postdata();
		?>
	</div>
    

	<div class="news-events">
        <div class="news-texture">
           <div class="row">
                <div class="large-offset-1 large-2 medium-offset-2 medium-4 small-offset-3 small-6 columns block-title news-title">
                    <h3>
                       News &<br>
                       Events
                    </h3>
                    <a class="button" href="/news-and-events">More News</a>
                </div>
            </div> 
        </div>
        <div class="news">
            <div class="row">
                <div class="columns large-8 news-main">
                    <?php
                        /**
                        * Blog loop
                        */
                        $query_args = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => 2,
                            'post__in'  => get_option( 'sticky_posts' ),
                            'ignore_sticky_posts' => 1,
                        );

                        $wp_query = new WP_Query( $query_args );
                        if ($wp_query->have_posts()) {
                            # The Loop
                            while ( $wp_query->have_posts() ) {
                                $wp_query->the_post(); ?>
                                <div class="blog clearfix">
                                    <?php get_template_part( 'template-parts/excerpt' ); ?>
                                </div>
                            <?php } ?>
                        <?php }; ?>
                </div>
                <div class="columns large-4 news-sidebar">
                    <?php
                        /**
                        * Blog loop
                        */
                        $query_args = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => 3,
                            'ignore_sticky_posts' => 1,
                            'post__not_in'  => get_option( 'sticky_posts' ),
                        );

                        $wp_query = new WP_Query( $query_args );
                        if ($wp_query->have_posts()) {
                            # The Loop
                            while ( $wp_query->have_posts() ) {
                                $wp_query->the_post(); ?>
                                <div class="blog clearfix">
                                    <?php get_template_part( 'template-parts/mini-excerpt' ); ?>
                                </div>
                            <?php } ?>
                        <?php }; ?>
                    <div class="widgets-area">
                        <?php dynamic_sidebar('homepage-news-sidebar'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="news-texture">
        </div>
	</div>

	<div id="do-this" class="divider do-this-divider">
	</div>

	<div class="do-this">
        <div class="do-this-texture">
            <div class="row ">
                <div class="large-offset-1 large-2 medium-offset-2 medium-4 small-offset-3 small-6 columns block-title do-title">
                    <h3>
                        Our<br> 
                        Approach
                    </h3>
                    <a class="button" href="/about/">Learn More</a>
                </div>
            </div>
        </div>
        <div class="widgets-area">
            <div class="row">
                <?php dynamic_sidebar('homepage-do'); ?>
            </div>
        </div>
        <div class="do-this-texture">
        </div>
    </div>

</div>

<?php get_footer();
