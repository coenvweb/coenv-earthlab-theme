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
                echo '<a class="button" href="#do-this">▼ Learn more</i></a>';
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
                            'offset' => 3,
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

	<!--<div class="divider news-divider">
	</div>

    <?php
        $news_args = array(
			'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'meta_key' => 'event',
            'meta_value' => '0',
            'post__in'  => get_option( 'sticky_posts' ),
            'ignore_sticky_posts' => 1,
        );
        $news_query = new WP_Query($news_args);

        $event_args = array(
			     'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'meta_key' => 'event',
            'meta_value' => '1',
            'ignore_sticky_posts' => 1,
        );
        $event_query = new WP_Query($event_args);
    ?>
    <div class="news-events">
        <div class="news-texture">
            <div class="row">
                <div class="large-offset-1 large-2 medium-offset-2 medium-4 small-offset-3 small-6 columns block-title news-title">
                    <h3>
                        News<br>
                        And<br>
                        Events
                    </h3>
                    <a class="button" href="/about/news-and-events/">More News</a>
                </div>
            </div>
        </div>
        <div class="news">
		<?php if($news_query->have_posts()) { 
				while($news_query->have_posts()): 
					$news_query->the_post();
                    $post_link_url = get_the_permalink();
                    $post_link = '<a class="button full_button" href="' . $post_link_url . '">Read More</a>';
			?>
				<article class="home_article row">
                    <?php if(has_post_thumbnail()) { ?>
                        <section class="article__image small-10 small-offset-1 medium-offset-0 medium-4 medium-push-8 columns">
                            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail('fp-medium') ?></a>
                        </section>
                        <section class="article__content medium-pull-4 medium-offset-1 medium-7 small-12 columns">
                    <?php } else { ?>
					    <section class="article__content medium-offset-1 medium-11 small-12 columns">
                    <?php } ?>
                            <div class="article__meta">
                                NEWS |
                                <time class="article__time" datetime="<?php echo get_the_date('Y-m-d h:i:s') ?>"><?php echo get_the_date('M j, Y') ?></time>
                                <?php
                                $more_terms = wp_get_post_terms(get_the_id(), 'focus-area');
                                if (!empty($more_terms)) {
                                    $more_terms_arr = array();

                                    foreach ($more_terms as &$term) {
                                        $more_terms_arr[] = '<a href="/about/news-and-events/focus-area/' . $term->slug . '">' . $term->name . '</a>';
                                    }   
                                }   
                                ?>  
                                |
                                <span class="article__categories">
                                     <?php echo implode(', ', $more_terms_arr) ?>
                                </span>
                            </div>
                            <h4 class="article__title">
                                <a href="<?php the_permalink() ?>"><?php the_title() ?></a>
                            </h4>
                            <div class="article__teaser">
                                <?php the_excerpt() ?>
                                <?php echo $post_link; ?>
                            </div>	
                        </section>
				</article>
			<?php
				endwhile;
                wp_reset_query();
			} ?>	
        </div>
        <div class="events">
			<?php if($event_query->have_posts()) { 
				while($event_query->have_posts()): 
					$event_query->the_post();
					$post_link_url = get_the_permalink();
					$post_link = '<a class="button full_button" href="' . $post_link_url . '">Learn More</a>';
                    $event_date = new DateTime(get_field('event_date'));
			?>
				<article class="home_article row">
					<section class="article__image small-offset-1 small-10 medium-4 medium-offset-1 columns">
                        <a href="<?php the_permalink(); ?>">
                            <div class="event_container">
                                <span class="month"><?=$event_date->format('F');?></span>
                                <span class="day"><?=$event_date->format('d');?></span>
                            </div>
                        </a>
					</section>
					<section class="article__content small-12 medium-7 columns">
                        <div class="article__meta">
                            EVENT |
							<?php
							$more_terms = wp_get_post_terms(get_the_id(), 'focus-area');
							if (!empty($more_terms)) {
								$more_terms_arr = array();

								foreach ($more_terms as &$term) {
									$more_terms_arr[] = '<a href="/about/news-and-events/focus-area/' . $term->slug . '">' . $term->name . '</a>';
								}
							}
							?>
							<span class="article__categories">
								 <?php echo implode(', ', $more_terms_arr) ?>
							</span>
						</div>
						<h4 class="article__title">
							<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
						</h4>
						<div class="article__teaser">
							<?php the_excerpt() ?>
							<?php echo $post_link; ?>
						</div> 
					</section>
				</article>
			<?php
				endwhile;
			} ?>
        </div>
        <div class="news-texture">

        </div>
    </div>
    <!-- Homepage News and Events -->

</div>

<?php get_footer();
