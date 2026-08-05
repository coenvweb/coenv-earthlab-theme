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
                $taxonomy_links = array();
                $project_topic_links = array();
                $project_type_links = array();
                $project_index_url = coenv_get_project_index_url(get_the_id());
                $award_date_display = '';

                if (get_post_type() == 'post') {
                    $news_terms = get_the_terms(get_the_id(), 'topic');
                    if (!empty($news_terms) && !is_wp_error($news_terms)) {
                        foreach ($news_terms as $term) {
                            $taxonomy_links[] = '<a href="' . site_url() . '/about/news/topic/' . $term->slug . '">' . $term->name . '</a>';
                        }
                    }
                }

                if (get_post_type() == 'project') {
                    $award_date = get_field('award_date');
                    if (!empty($award_date)) {
                        try {
                            $award_date_display = (new DateTime($award_date))->format('F j, Y');
                        } catch (Exception $e) {
                            $award_date_display = $award_date;
                        }
                    }

                    $project_topics = get_the_terms(get_the_id(), 'project_topic');
                    if (!empty($project_topics) && !is_wp_error($project_topics)) {
                        foreach ($project_topics as $project_topic) {
                            $project_topic_links[] = '<a href="' . $project_index_url . '/project_topic/' . $project_topic->slug . '">' . $project_topic->name . '</a>';
                        }
                    }

                    $project_types = get_the_terms(get_the_id(), 'project_type');
                    if (!empty($project_types) && !is_wp_error($project_types)) {
                        foreach ($project_types as $project_type) {
                            $project_type_links[] = '<a href="' . $project_index_url . '/project_type/' . $project_type->slug . '">' . $project_type->name . '</a>';
                        }
                    }

                    $taxonomy_links = array_merge($project_topic_links, $project_type_links);
                }
                ?>
            <div class="article__categories">
                 <?php if (get_post_type() == 'project' && !empty($award_date_display)) { ?>
                    <div><strong>Award Date:</strong> <?php echo esc_html($award_date_display); ?></div>
                 <?php } ?>
                 <?php if (get_post_type() == 'project' && !empty($project_topic_links)) { ?>
                    <div><strong>Project Topics:</strong> <?php echo implode(', ', $project_topic_links); ?></div>
                 <?php } ?>
                 <?php if (get_post_type() == 'project' && !empty($project_type_links)) { ?>
                    <div><strong>Project Types:</strong> <?php echo implode(', ', $project_type_links); ?></div>
                 <?php } ?>
                 <?php if (get_post_type() != 'project' && !empty($taxonomy_links)) { echo implode(', ', $taxonomy_links); } ?>
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
    <?php if((get_post_type() == 'project') && isset($member_info)) {
        echo $member_info;
    } ?>
	</div>
	<?php do_action( 'foundationpress_post_after_entry_content' ); ?>
	<?php the_post_navigation(); ?>
</article>
