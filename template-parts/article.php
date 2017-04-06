<article <?php post_class('main-content article') ?> id="post-<?php the_ID(); ?>">
	<header class="article__header">
        <?php if(get_field('event_date')) {
            $event_date = new DateTime(get_field('event_date'));
        ?>
            <div class="event">
                <div class="event_container">
                    <span class="month"><?=$event_date->format('F');?></span>
                    <span class="day"><?=$event_date->format('d');?></span>
                </div>
            </div>
        <?php } ?>
		<div class="article__meta">
			<?php if ( !is_page() ) : ?>
				<div class="post-info">
                    <?php if(get_field('event')) { ?>
                        Event
                    <?php } else { ?>
					    <time class="article__time" datetime="<?php echo get_the_date('Y-m-d h:i:s') ?>"><?php echo get_the_date('M j, Y') ?></time>
                    <?php } ?>
					<?php
					$more_terms = get_the_terms(get_the_id(), 'focus-area');
					if (!empty($more_terms)) {
						$more_terms_arr = array();

						foreach ($more_terms as &$term) {
							if(get_post_type() == 'post') {
								$more_terms_arr[] = '<a href="/about/news-and-events/focus-area/' . $term->slug . '">' . $term->name . '</a>';
							}
							if(get_post_type() == 'case_study') {
								$more_terms_arr[] = '<a href="/about/case-studies/focus-area/' . $term->slug . '">' . $term->name . '</a>';
							}
						}
					}
					?>
					|
					<div class="article__categories">
						 <?php echo implode(', ', $more_terms_arr) ?>
					</div>
				</div>
			<?php endif ?>
        </div>
		<h2 class="entry-title"><?php the_title(); ?></h2>
	</header>
	<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
	<div class="entry-content article__content">
        
		<?php the_content(); ?>
		<?php if ( get_field('story_link_(url)') && get_field('story_source_name') ): ?>
            <a href="<?php the_field('story_link_(url)'); ?>" class="button" target="_blank"><?php the_field('story_source_name'); ?></a>
        <?php endif; ?>
	</div>
	<?php do_action( 'foundationpress_post_after_entry_content' ); ?>
	<?php the_post_navigation(); ?>
</article>
