<article <?php post_class('main-content article') ?> id="post-<?php the_ID(); ?>">
	<header class="article__header">
        <?php if(get_field('event_date')) {
            try {
                $event_date = new DateTime(get_field('event_date'));
                ?> <div class="event">
                    <div class="event_container">
                        <span class="month"><?=$event_date->format('F');?></span>
                        <span class="day"><?=$event_date->format('d');?></span>
                    </div>
                </div> <?php
            } catch (Exception $e) {
                $event_date = get_field('event_date');
                ?> <div class="event">
                    <div class="event_container">
                        <span class="month"><?=$event_date;?></span>
                    </div>
                </div> <?php
            }
        ?>
        <?php } ?>
		<div class="article__meta">
			<?php if ( !is_page() ) : ?>
				<div class="post-info">
                    <?php if(get_field('event_date')) { ?>
                        Event |
                    <?php } elseif(get_post_type() == 'post') { ?>
					    <time class="article__time" datetime="<?php echo get_the_date('Y-m-d h:i:s') ?>"><?php echo get_the_date('M j, Y') ?></time> |
                    <?php } ?>
					<?php
                $more_terms = get_the_terms(get_the_id(), 'topic');
                if (!empty($more_terms)) {
                    $more_terms_arr = array();

                    foreach ($more_terms as &$term) {
                        if(get_post_type() == 'post') {
                            $more_terms_arr[] = '<a href="' . site_url() . '/news-and-events/topic/' . $term->slug . '">' . $term->name . '</a>';
                        }
                        if(get_post_type() == 'project') {
                            $more_terms_arr[] = '<a href="' . site_url() . '/projects/topic/' . $term->slug . '">' . $term->name . '</a>';
                        }
                    }
                }
                //if(get_post_type() == 'project') {
                //    $member_terms = get_the_terms(get_the_id(), 'member-affiliates');
                //    foreach ($member_terms as &$member_term) {
                //        $member_terms_arr[] = '<a href="' . site_url() . '/projects/member-affiliates/' . $member_term->slug . '">' . $member_term->name . '</a>';
                //        $member_info[] = '<div class="more-about-member"><a href="' . site_url() . '/projects/member-affiliates/' . $member_term->slug . '"><h3>More about the ' . $member_term->name . '</h3></a> <div class="text-box"> <div class="text-box-inner"><p>' . $member_term->description . '</p><a class="button" href="' . site_url() . '/members-and-affiliates/' . $member_term->slug . '">Learn more</a></div></div></div>';
                //    }
                //}
                ?>
            <div class="article__categories">
                 <?php echo implode(', ', $more_terms_arr) ?>
                 <?php if(isset($member_terms)){ echo '| ' . implode(', ', $member_terms_arr); }; ?>
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
        <a href="<?php echo wp_kses_post( get_field('story_link_(url)')); ?>" class="button" target="_blank"><?php echo wp_kses_post( get_field('story_source_name')); ?></a>
    <?php endif; ?>  
    <?php if(get_post_type() == 'project') {
        echo implode( '', $member_info);
    } ?>
	</div>
	<?php do_action( 'foundationpress_post_after_entry_content' ); ?>
	<?php the_post_navigation(); ?>
</article>
