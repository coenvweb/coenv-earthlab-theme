    <article id="post-<?php the_ID() ?>" <?php post_class( 'article' ) ?>>
    <header class="article__header">
        <div class="article__meta">
        <?php if ( !is_page() ) : ?>
            <div class="post-info">
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
                //    }
                //}
                ?>
                <div class="article__categories">
                     <?php echo implode(', ', $more_terms_arr) ?>
                     <?php if(isset($member_terms)){ echo '| ' . implode(', ', $member_terms_arr); }; ?>
                </div>
            </div>
        <?php endif ?>
        
        <?php if(has_post_thumbnail()) { ?>
            	<div class="coenv-thumb"><a style="float: right;" href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'excerpt' ) ?></a></div>
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
        <a href="<?php echo the_permalink(); ?>" class="button">Read more</a>

    </section>
    <?php remove_filter( 'the_title', 'wptexturize' );
    remove_filter( 'the_excerpt', 'wptexturize' ); ?>

</article><!-- .article -->
