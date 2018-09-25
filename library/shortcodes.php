<?php
function focus_directors($args) {
    $atts = shortcode_atts(array(
        'header' => 'Directors',
        'directors' => 'Director 1, Director2',
        'links' => '',
    ), $args);
    $directors = explode(',', $atts['directors']);
    $links = explode(',', $atts['links']);
    $output = '<h2 class="focus_director">'.$atts["header"].'</h2>';
    $output .= '<ul class="directors_list">';
    foreach($directors as $i => $director) {
        $link = $links[$i];
        $output .= '<li class="director_item"><a href="'.trim($link).'" target="_blank">'.trim($director).'<hr></a></li>';
    }
    $output .= '</ul>';
    return $output;
}
add_shortcode('directors', 'focus_directors');

function staff_member($args) {
    $atts = shortcode_atts(array(
        'name' => '',
        'id' => 0
    ), $args);
    if($atts['id']) {
        $staff_args = array(
            'post_type' => 'staff',
            'p' => $atts['id']
        );
    } else if($atts['name']) {
        $staff_args = array(
            'post_type' => 'staff',
            'title' => $atts['name']
        );
    } else {
        return;
    }
    
    $staff = new WP_Query($staff_args);

    if($staff->have_posts()) {
        while($staff->have_posts()) {
            $staff->the_post();
            $member = $staff->post;
            $output = "<div id='bio-t-".$member->post_name."' class='contact'>";
                if(has_post_thumbnail()) {
                    $img = get_the_post_thumbnail($member->id, 'thumbnail', array('class' => 'alignleft profile-image'));
                    $output .= $img;
                } else {
                    $output .= "<img class='alignleft profile-image' alt='not pictured' src='".get_template_directory_uri()."/assets/images/person_placeholder.jpg' />";
                }
                $output .= '<div class="contact-info">';
                    $output .= '<div class="contact-title">';
                        $output .= '<h3>'.$member->post_title.'</h3>';
                        $output .= '<h4>'.get_field('title').'</h4>';
                    $output .= '</div>';
                    $output .= '<ul class="contact-list">';
                        $output .= '<li><i class="fa fa-envelope"></i><a href="mailto:'.get_field('email').'">'.get_field('email').'</a></li>';
                        foreach (get_field('phone_number') as $row) {
                            $output .= '<li><i>' . $row['label'] . ':</i><a href="tel:'.$row['number'].'">'.$row['number'].'</a> </li>';
                        }
                    $output .= '</ul>';
                $output .= '</div>';
            $output .= "</div>";
        }
    }
    wp_reset_query();
    return $output;
}
add_shortcode('staff', 'staff_member');

function gift_frame($args) {
    $atts = shortcode_atts(array(
        'fund_codes' => 'ENVINS',
    ), $args);
    $output = '<div class="make-a-gift"><iframe src="https://online.gifts.washington.edu/secure/makeagift/givingOpps.aspx?nobanner=true&amp;source_typ=3&amp;source='.$atts['fund_codes'].'" style="width: 100%; height: 700px;" frameborder="0"></iframe></div>';
    return $output;
}
add_shortcode('make_a_gift', 'gift_frame');

function news_section($args) {
    global $wp_query, $post;
    $atts = shortcode_atts(array(
        'topic' => '',
        'member' => '',
        'number' => '3',
    ), $args);
    if (!empty($atts['topic'])) {
        $taxonomy = 'topic';
        $term = $atts['topic'];
    } elseif (!empty($atts['member'])) {
        $taxonomy = 'member-affiliates';
        $term = $atts['member'];
    } elseif (get_term_by('slug', $post->post_name, 'member-affiliates')) {
        $taxonomy = 'member-affiliates';
        $term = $post->post_name;
    }
    $full_term = get_term_by('slug', $term, $taxonomy);
    
    /**
    * Blog loop
    */
    $query_args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 3,
        'ignore_sticky_posts' => 1,
        'tax_query' => array(
            array(
              'taxonomy' => $taxonomy,
              'field' => 'slug',
              'terms' => $term,
            )
          )
    );

    $wp_query = new WP_Query( $query_args );
    if ($wp_query->have_posts()) {
        ob_start();
        ?><div class="related-news clearfix"><h2>News</h2>
        <?php
        # The Loop
        while ( $wp_query->have_posts() ) {
            $wp_query->the_post();
                get_template_part( 'template-parts/mini-excerpt' );
        }; ?>
        <a class="button" href="<?php echo '/news-and-events/' . $taxonomy . '/' . $term . '/' ?>">More <?php echo $full_term->name; ?> news</a>
        </div>
        <?php wp_reset_query();
        return ob_get_clean();
    } else {
        return false;
    };
}
add_shortcode('news_section', 'news_section');
?>
