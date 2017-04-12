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

function gift_frame($args) {
    $atts = shortcode_atts(array(
        'fund_codes' => 'ENVINS',
    ), $args);
    $output = '<div class="make-a-gift"><iframe src="https://online.gifts.washington.edu/secure/makeagift/givingOpps.aspx?nobanner=true&amp;source_typ=3&amp;source='.$atts['fund_codes'].'" style="width: 100%; height: 700px;" frameborder="0"></iframe></div>';
    return $output;
}
add_shortcode('make_a_gift', 'gift_frame');
?>
