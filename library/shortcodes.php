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
                        $output .= '<li><i class="fa fa-phone"></i><a href="tel:'.get_field('phone_number').'">'.get_field('phone_number').'</a></li>';
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
?>
