    <article id="post-<?php the_ID() ?>" <?php post_class( 'article' ) ?>>
    <header class="article__header">
        <div class="article__meta">
        <?php if ( !is_page() ) : ?>
            <div class="post-info">
                <?php
                $taxonomy_links = array();
                $project_index_url = coenv_get_project_index_url(get_the_id());

                if (get_post_type() == 'post') {
                    $news_terms = get_the_terms(get_the_id(), 'topic');
                    if (!empty($news_terms) && !is_wp_error($news_terms)) {
                        foreach ($news_terms as $term) {
                            $taxonomy_links[] = '<a href="' . site_url() . '/about/news/topic/' . $term->slug . '">' . $term->name . '</a>';
                        }
                    }
                }

                if (get_post_type() == 'project') {
                    $project_topics = get_the_terms(get_the_id(), 'project_topic');
                    if (!empty($project_topics) && !is_wp_error($project_topics)) {
                        foreach ($project_topics as $project_topic) {
                            $taxonomy_links[] = '<a href="' . $project_index_url . '/project_topic/' . $project_topic->slug . '">' . $project_topic->name . '</a>';
                        }
                    }

                    $project_types = get_the_terms(get_the_id(), 'project_type');
                    if (!empty($project_types) && !is_wp_error($project_types)) {
                        foreach ($project_types as $project_type) {
                            $taxonomy_links[] = '<a href="' . $project_index_url . '/project_type/' . $project_type->slug . '">' . $project_type->name . '</a>';
                        }
                    }
                }
                ?>
                <div class="article__categories">
                     <?php if(!empty($taxonomy_links)){ echo implode(', ', $taxonomy_links); } ?>
                </div>
            </div>
        <?php endif ?>
        
        <?php if(has_post_thumbnail()) { ?>
            	<div class="coenv-thumb"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'excerpt' ) ?></a></div>
        <?php }; ?>
        <?php if(get_field('event_date')) {
            echo '<div class="post-info"><i class="fa fa-calendar"></i> ' . get_field('event_date') . '</div>';
        } else {
            $event_date = '';
        }; ?>
            </div>
        <h2 class="article__title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>

    </header>
    <section class="article__content">
        <?php the_excerpt(); ?>
        <a href="<?php echo the_permalink(); ?>" class="button" aria-label="Read more about <?php the_title(); ?>">Read more</a>

    </section>
    <?php remove_filter( 'the_title', 'wptexturize' );
    remove_filter( 'the_excerpt', 'wptexturize' ); ?>

</article><!-- .article -->
