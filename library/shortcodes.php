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
        $output .= '<li class="director_item"><a href="'.trim($link).'" target="_blank">'.trim($director).'</a></li>';
    }
    $output .= '</ul>';
    return $output;
}
add_shortcode('directors', 'focus_directors');

?>
