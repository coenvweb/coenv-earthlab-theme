    <article id="post-<?php the_ID() ?>" <?php post_class( 'article' ) ?>>

    <header class="article__header">
        <div class="article__meta">
        <?php if ( !is_page() ) : ?>
            <div class="post-info">
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
                <div class="article__categories">
                     <?php echo implode(', ', $more_terms_arr) ?>
                </div>
            </div>
        <?php endif ?>
        </div>

        <p class="article__title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a></p>

    </header>
    <section class="article__content">
		<?php if(get_field('event_date')) {
            $event_date = new DateTime(get_field('event_date'));
        ?>
            <div class="event">
                <?php if ( get_field('story_link_(url)') && get_field('story_source_name') ) { ?>
                    <a href="<?php the_field('story_link_(url)') ?>">
                <?php } else { ?>
                    <a href="<?php the_permalink() ?>">
                <?php } ?>
                    <div class="event_container">
                        <span class="month"><?=$event_date->format('F');?></span>
                        <span class="day"><?=$event_date->format('d');?></span>
                    </div>
                </a>
            </div>
        <?php }; ?>

    </section>
    <?php remove_filter( 'the_title', 'wptexturize' );
    remove_filter( 'the_excerpt', 'wptexturize' ); ?>

</article><!-- .article -->
