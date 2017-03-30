<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

    <?php get_template_part( 'template-parts/featured-image' ); ?>

    <div id="not-found" class="row" role="main">

        <article class="main-content" id="post-<?php the_ID(); ?>">
            <div class="entry-content">
                <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
                    <div class="field-wrap">
                        <label for="s">Search Field</label>
                        <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search this site">
                        <button type="submit"><i class="fa fa-search"></i><span>Search</span></button>
                    </div>
                </form>
                <div class="error">
                    <p class="bottom"><?php _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'foundationpress' ); ?></p>
                </div>
                <p><?php _e( 'Please try the following:', 'foundationpress' ); ?></p>
                <ul>
                    <li><?php _e( 'Check your spelling', 'foundationpress' ); ?></li>
                    <li><?php printf( __( 'Return to the <a href="%s">home page</a>', 'foundationpress' ), home_url() ); ?></li>
                    <li><?php _e( 'Click the <a href="javascript:history.back()">Back</a> button', 'foundationpress' ); ?></li>
                </ul>
            </div>
        </article>

    </div>
<?php get_footer();
