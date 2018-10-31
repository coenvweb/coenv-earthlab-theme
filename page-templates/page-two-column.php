<?php
/*
Template Name: Two Column
*/
get_header(); ?>

<?php 
get_template_part( 'template-parts/featured-image' ); 
$images = get_field('images_column');

$size = 'large';

?>

<div id="page-sidebar-left" role="main" class="page-content-two-column">

 <?php do_action( 'foundationpress_before_content' ); ?>
 <?php while ( have_posts() ) : the_post(); ?>
   <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
       <?php do_action( 'foundationpress_page_before_entry_content' ); ?>
       
       <div class="row">
       <h2 class="page-title"><?php the_title(); ?></h2>
       <div class="entry-content columns left small-12 medium-12 large-7">
              <?php the_content(); ?>
          </div>
          <div class="two-col-images-column columns right small-12 medium-12 large-5">
                  <?php
                    if( $images ): ?>
                    <div class="image-column-gallery">
                        <?php foreach( $images as $image ): ?>
                           <?php 
                           // image deets
                           $image_id = $image['ID'];
                           $image_url = $image['url'];
                           $caption = $image['caption'];
                           $alt = $image['alt'];
                           ?>

                           <?php if ($caption) { ?>
                            <figure id="<?php echo $image_id; ?>" class="wp-caption" itemscope>

                                <a href="<?php echo $image_url; ?>" title="<?php echo $alt; ?>"><?php echo wp_get_attachment_image( $image['ID'], $size ); ?></a>

                                <figcaption itemprop="description" class="wp-caption-text">
                                   <?php echo $caption; ?>
                                </figcaption>
                            </figure>
                           <?php }                  

                            else { ?>
                            <figure id="<?php echo $image_id; ?>">
                                <a href="<?php echo $image_url; ?>" title="<?php echo $alt; ?>"><?php echo wp_get_attachment_image( $image['ID'], $size ); ?></a>
                            </figure>
                           <?php } ?>

                        <?php endforeach; ?>

                    </div>
                <?php endif; ?>

          </div>
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
