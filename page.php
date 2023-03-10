<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

 get_header(); ?>

 <?php get_template_part( 'template-parts/featured-image' ); ?>

 <div id="page-sidebar-left" role="main">

 <?php do_action( 'foundationpress_before_content' ); ?>
 <?php while ( have_posts() ) : the_post(); ?>
   <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
       <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
       <div class="entry-content">
           <?php if(get_the_ID() != 22) { ?>
            <h2 class="page-title"><?php the_title(); ?></h2>
           <?php } ?>
           <?php the_content(); ?>
           <?php 
            $posts = get_field('page_contacts', get_the_ID());
                if( $posts ): ?>
                    <div class="page-contacts">
                    <h2 class="small-contact-title">
                    <?php
                    $page_contact_title = get_field('contact_title');
                    if ($page_contact_title) {
                        echo $page_contact_title;
                    } elseif (count($posts) > 1) {
                        echo 'EarthLab Contacts:';
                    } else {
                        echo 'EarthLab Contact:';
                    };
                    ?>
                    </h2>
                    <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
                        <?php setup_postdata($post);
                            $member = $post;
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
                            wp_reset_query();
                            echo $output;
                        ?>
                    <?php endforeach; ?>
                    <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
                    </div>
                <?php endif; ?>
       </div>
       <footer>
           <?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
           <p><?php the_tags(); ?></p>
       </footer>
   </article>
 <?php endwhile;?>

 <?php do_action( 'foundationpress_after_content' ); ?>
 <?php get_sidebar(); ?>

 </div>

 <?php get_footer();
