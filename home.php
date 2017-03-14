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
		<?php
		# The Loop
		while ( $feature_query->have_posts() ) : 
			$feature_query->the_post();
			if (get_field('feature_excerpt')) {
				$feature_excerpt = get_field('feature_excerpt');
			}
			if (get_the_post_thumbnail()) {
				$feature_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail-size', true);
				$feature_caption = get_post(get_post_thumbnail_id());
				$feature_caption = $feature_caption->post_excerpt;
			}

			echo '<div class="feature-image" style="background-image:url(' . $feature_image[0] . ')">';
			    echo '<div class="feature row">';
					echo '<div class="feature-info-container small-offset-1 small-10 columns">';
						echo '<div class="feature-info">';
							echo '<div class="feature-content">';
                                echo '<div class="feature-title">';
								    echo '<h2>' . get_the_title() . '</h2>';
                                echo '</div>';
                                echo '<div class="medium-offset-4 medium-8 large-offset-6 large-6 columns feature-excerpt">';
								    echo '<p>' . $feature_excerpt . '</p>';
                                echo '</div>';
							echo '</div><!-- .feature-content -->';

						echo '</div><!-- .feature-info -->';
					echo '</div><!-- .feature-info-container -->';
			    echo '</div><!-- .feature -->';
			echo '</div>';
		endwhile;
		wp_reset_postdata();
		?>
	</div>

	<div class="focus-areas">
        <div class="focus-texture">
            <div class="row">
                <div class="large-offset-1 large-2 medium-offset-2 medium-4 small-offset-3 small-6 columns block-title focus-title">
                    <h3>
                        We<br>
                        Focus<br>
                        On
                    </h3>
                </div>
            </div>
        </div>
        <div class="row widgets-area">
            <?php dynamic_sidebar('homepage-focus'); ?>
        </div>
        <div class="focus-texture">
        </div>
	</div>

	<div class="divider">
	</div>

	<div class="do-this">
        <div class="do-this-texture">
            <div class="row ">
                <div class="large-offset-9 large-2 columns medium-offset-6 medium-4 small-offset-3 small-6 block-title do-title">
                    <h3>
                        How<br>
                        Do We<br>
                        Do This
                    </h3>
                </div>
            </div>
        </div>
        <div class="row widgets-area">
            <?php dynamic_sidebar('homepage-do'); ?>
        </div>
        <div class="do-this-texture">
        </div>
	</div>

	<div class="divider">
	</div>

    <!-- Homepage News and Events -->
	
</div>

<?php get_footer();
