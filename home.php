<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>
<div class="homepage">
	<div class="homepage-features">
        <div class="playpause">
            <i class="fa fa-pause running"></i>
            <div class="progress" role="progressbar" tabindex="0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-meter" style="width: 0%;"></div>
            </div>
        </div>
		<?php
        $hero = get_field('hero');
        if ($hero['feature_excerpt']) {
            $feature_excerpt = $hero['feature_excerpt'];
        }
        $feature_images = $hero['hero_images'];
        $images = array();
        $count = 0;
        while(have_rows('hero')) : the_row();
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
        endwhile;
        echo '<div class="feature row">';
            echo '<div class="feature-info-container small-offset-1 small-10 columns">';
                echo '<div class="feature-info">';
                    echo '<div class="feature-content">';
                        echo '<div class="feature-title">';
                            echo '<h2>' . get_field('hero_headline') . '</h2>';
                        echo '</div>';
                        echo '<div class="medium-offset-4 medium-8 large-offset-6 large-6 columns feature-excerpt">';
                            echo '<p>' . $feature_excerpt . '</p>';
            echo '<a class="button" href="'.get_field('hero_link').'">Learn more</i></a>';
                        echo '</div>';
                    echo '</div><!-- .feature-content -->';

                echo '</div><!-- .feature-info -->';
                echo '<div class="hero-texture">';
                echo '</div>';
            echo '</div><!-- .feature-info-container -->';
        echo '</div><!-- .feature -->';	
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

    <?php 
    wp_reset_query();
    $featured_work = get_field('featured_work');
    while(have_rows('featured_work')) : the_row();
    $featured_work_items = get_sub_field('featured_work_items');
    $random_row = array_rand($featured_work_items, 1);
    $image = $featured_work_items[$random_row]['featured_work_item_image']; ?>
    <div class="featured-work" style="background-image:url('<?php echo $image['url'] ?>');">
        <div class="featured-work-texture">
            <div class="row ">
                <div class="large-3 medium-4 small-6 columns tab-title">
                    <h2>
                        <?php echo $featured_work['featured_work_section_title'] ?>
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="inner-black-box large-7 medium-9 small-12">
            <?php 
                        echo '<h3>' . $featured_work_items[$random_row]['featured_work_item_title'] . '</h3>';
                        echo '<p>' . $featured_work_items[$random_row]['featured_work_item_description'] . '</p>';
                        $link = $featured_work_items[$random_row]['featured_work_item_link'];
                        if( $link ) {
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            echo '<a class="button" href="' . esc_url( $link_url ) . '" target="' . esc_attr( $link_target ) . '">' . esc_html( $link_title ) . '</a>';
                        };
            ?>
            </div>
        </div>
    </div>
    <?php 
      endwhile;
    ?>

    <?php $black_boxes = get_field('black_boxes_statement'); 
    while(have_rows('black_boxes_statement')) : the_row();
    $background_image = get_sub_field('image_background');?>
	<div class="approach">
        <div class="approach-texture">
            <div class="row ">
                <div class="large-offset-1 large-2 medium-offset-2 medium-4 small-offset-3 small-6 columns block-title approach-title">
                    <h3>
                        Our<br> 
                        Approach
                    </h3>
                    <a class="button" href="/about/">Learn More</a>
                </div>
            </div>
        </div>
        <div class="widgets-area" style="background-image:url('<?php echo $background_image['url'] ?>');">
            <div class="row small-up-1 medium-up-2 large-up-4">
                <?php 
                    while(have_rows('black_boxes')) : the_row();
                        echo '<div class="column column-block align-self-middle"><div class="inner-box"><span>';
                        echo '<h3>' . get_sub_field('black_box_title') . '</h3>';
                        echo '<p>' . get_sub_field('black_box_description') . '</p>';
                        echo '</span></div></div>';
                    endwhile;
                ?>
            </div>
        </div>
    </div>
    <?php endwhile; ?>

</div>

<?php get_footer();
