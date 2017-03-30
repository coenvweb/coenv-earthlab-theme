<?php
/**
 * The template for displaying search results pages.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

	<div id="search" class="row" role="main">
        <?php do_action('foundationPress_before_content'); ?>


        <div class="main-content">
            <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
				<div class="field-wrap">
					<label for="s">Search Field</label>
					<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search this site">
					<button type="submit"><i class="fa fa-search"></i><span>Search</span></button>
				</div>
			</form>
			<?php if ($wp_query->found_posts): ?>
				<div class="panel">
					<div class="left"><?php echo $wp_query->found_posts; ?> results for <strong>"<?php echo get_search_query(); ?>"</strong></div>
				</div>
			<?php endif; ?>
            <?php if ( have_posts() ) : ?>

                <?php while ( have_posts() ) : the_post(); ?>
                   <h2><a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a></h2>
                    <div class="search-excerpt">
					<?php
						$teaser_limited = get_the_excerpt();
						$teaser_limited = strip_tags($teaser_limited);
						$teaser_limited = trim($teaser_limited, '!,?.&nbsp;');
						echo $teaser_limited . '...';
					?>
                    </div>
                <?php endwhile; ?>

            <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>

            <?php endif;?>

            <?php do_action('foundationPress_before_pagination'); ?>

            <?php if ( function_exists('FoundationPress_pagination') ) { FoundationPress_pagination(); } else if ( is_paged() ) { ?>

                <nav id="post-nav">
                    <div class="post-previous"><?php next_posts_link( __( '&larr; Older posts', 'FoundationPress' ) ); ?></div>
                    <div class="post-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'FoundationPress' ) ); ?></div>
                </nav>
            <?php } ?>
        </div>

        <?php do_action('foundationPress_after_content'); ?>

	</div>
<?php get_footer();
