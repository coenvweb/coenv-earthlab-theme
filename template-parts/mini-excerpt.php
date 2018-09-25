    <article id="post-<?php the_ID() ?>" <?php post_class( 'article' ) ?>>

    <header class="article__header">
        <div class="article__meta">
        <?php if ( !is_page() ) : ?>
            <div class="post-info">
                <?php if(get_field('event_date')) {
                    echo '<i class="fa fa-calendar"></i> ' . get_field('event_date') . ' | ';
                } else {
                    $event_date = '';
                }; ?>
                <?php
                $more_terms = get_the_terms(get_the_id(), 'topic');
                if (!empty($more_terms)) {
                    $more_terms_arr = array();

                    foreach ($more_terms as &$term) {
                        if(get_post_type() == 'post') {
                            $more_terms_arr[] = '<a href="' . site_url() . '/news-and-events/topic/' . $term->slug . '">' . $term->name . '</a>';
                        }
                        if(get_post_type() == 'project') {
                            $more_terms_arr[] = '<a href="' . site_url() . '/about/case-studies/topic/' . $term->slug . '">' . $term->name . '</a>';
                        }
                    }
                    ?> <div class="article__categories">
                        <?php echo implode(', ', $more_terms_arr) ?>
                    </div> <?php
                }
                ?>
            </div>
        <?php endif ?>
        </div>
        
        <p class="article__title"><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title() ?></a></p>

    </header>
    <?php remove_filter( 'the_title', 'wptexturize' );
    remove_filter( 'the_excerpt', 'wptexturize' ); ?>

</article><!-- .article -->
