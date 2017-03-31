<?php

/*
 * Case Study Focus Areas
 */

class coenv_base_case_cats extends WP_Widget {

    /**
    * Register widget with WordPress.
    */
    function __construct() {
      parent::__construct(
           'coenv_base_case_cats', // Base ID
           __('Case Studies by Focus Area', 'text_domain'), // Name
           array( 'description' => __( 'Display short previews of case studies based on focus area', 'text_domain' ), ) // Args
      );
    }


    /**
    * Front-end display of widget.
    *
    * @see WP_Widget::widget()
    *
    * @param array $args     Widget arguments.
    * @param array $instance Saved values from database.
    */
    public function widget( $args, $instance ) {
        $focus_area = $instance['focus_area'];

        $query_args = array(
            'post_type' => 'case_study',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'ignore_sticky_posts' => 1,
            'taxonomy' => 'focus-area',
            'term' => $focus_area,
        );

        $wp_query = new WP_Query( $query_args );

        if ($wp_query->have_posts()) {

            echo $args['before_widget'];
            echo '<div class="row">';
                echo '<div class="small-12 columns">';
                    if ( ! empty( $instance['title'] ) ) {
                        echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
                    }

                    echo "<ul class='widget-case-list'>";
                        while ( $wp_query->have_posts() ) :
                            $wp_query->the_post();
                        ?>
                            <li class="case-preview">
                                <h4><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <p class="case-excerpt">
                                    <?php the_excerpt(); ?>
                                </p>
                            </li>

                        <?php
                        endwhile;
                    echo "</ul>";

                    if($instance['more_link']) {
                        echo "<a class='button' href='/about/case-studies/focus-area/".$focus_area."'>See more ".$focus_area." case studies</a>";
                    }

                echo '</div>';
            echo '</div>';
            echo $args['after_widget'];
        }
    }

    /**
    * Back-end widget form.
    *
    * @see WP_Widget::form()
    *
    * @param array $instance Previously saved values from database.
    */
    public function form( $instance ) {

        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        if ( isset( $instance[ 'focus_area' ] ) ) {
            $focus_area = $instance[ 'focus_area' ];
        }
        if ( isset( $instance[ 'more_link' ] ) ) {
            $more_link = $instance[ 'more_link' ];
        }

        $focus_areas = get_terms('focus-area');
        ?>
        
       <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p> 
        <p>
            <label for="<?php echo $this->get_field_id( 'focus_area' ); ?>"><?php _e( 'Focus Area:' ); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id( 'focus_area' ); ?>" name="<?php echo $this->get_field_name( 'focus_area' ); ?>">
                <option value="0">Select one...</option>
                <?php foreach($focus_areas as $area) { ?>
                    <option <?=($area->slug == $focus_area ? 'selected' : '')?> value="<?php echo $area->slug; ?>"><?php echo $area->name; ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'more_link' ); ?>"><?php _e( 'Display a link to more related case studies?' ); ?></label> 
            <input <?=($instance['more_link'] ? 'checked' : '')?> class="widefat" id="<?php echo $this->get_field_id( 'more_link' ); ?>" name="<?php echo $this->get_field_name( 'more_link' ); ?>" type="checkbox" >
        </p> 
        <?php
    }

    /**
    * Sanitize widget form values as they are saved.
    *
    * @see WP_Widget::update()
    *
    * @param array $new_instance Values just sent to be saved.
    * @param array $old_instance Previously saved values from database.
    *
    * @return array Updated safe values to be saved.
    */
    public function update( $new_instance, $old_instance ) {
       $instance = $old_instance;

        $instance['title'] = ( ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '');
        $instance['focus_area'] = ( ! empty( $new_instance['focus_area'] ) ? strip_tags( $new_instance['focus_area'] ) : '' );
        $instance['more_link'] = ( ! empty( $new_instance['more_link'] ) ? strip_tags( $new_instance['more_link'] ) : '' );

        return $instance;
    }

} // class coenv_base_case_cats

// register coenv_base_case_cats widget
function register_coenv_base_case_cats() {
    register_widget( 'coenv_base_case_cats' );
}
add_action( 'widgets_init', 'register_coenv_base_case_cats' );

/*
 * Sub-navigation
 */

class coenv_base_subnav extends WP_Widget {

     /**
      * Register widget with WordPress.
      */
     function __construct() {
          parent::__construct(
               'coenv_base_subnav', // Base ID
               __('Sub-navigation (COENV)', 'text_domain'), // Name
               array( 'description' => __( 'Sub-navigation for each section, usually placed in the sidebar.', 'text_domain' ), ) // Args
          );
     }
     

     /**
      * Front-end display of widget.
      *
      * @see WP_Widget::widget()
      *
      * @param array $args     Widget arguments.
      * @param array $instance Saved values from database.
      */
     public function widget( $args, $instance ) {
          if ($GLOBALS['post']->post_parent) {
            echo coenv_base_section_title($GLOBALS['post']->ID);
          }
          echo $args['before_widget'];

          echo coenv_base_hierarchical_submenu($GLOBALS['post']->ID);
          echo $args['after_widget'];
     } 
     /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
     public function form( $instance ) {
      //var_dump($instance);

      if ( isset( $instance[ 'title' ] ) ) {
           $title = $instance[ 'title' ];
      }
      ?>
      <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
      </p>
     
      <?php 
     } 

} 

function register_coenv_base_subnav() {
    register_widget( 'coenv_base_subnav' );
}
add_action( 'widgets_init', 'register_coenv_base_subnav' );

/*
 * Blog or news categories
 */

class coenv_base_news_cats extends WP_Widget {

     /**
      * Register widget with WordPress.
      */
     function __construct() {
          parent::__construct(
               'coenv_base_news_cats', // Base ID
               __('News by Focus Area', 'text_domain'), // Name
               array( 'description' => __( 'Show news item previews from one focus area', 'text_domain' ), ) // Args
          );
     }

     /**
      * Front-end display of widget.
      *
      * @see WP_Widget::widget()
      *
      * @param array $args     Widget arguments.
      * @param array $instance Saved values from database.
      */
     public function widget( $args, $instance ) {
        $focus_area = $instance['focus_area'];
        $query_args = array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'ignore_sticky_posts' => 1,
            'taxonomy' => 'focus-area',
            'term' => $focus_area,
        );

        $wp_query = new WP_Query( $query_args );

        if ($wp_query->have_posts()) {
            echo $args['before_widget'];
                while ( $wp_query->have_posts() ) :
                    $wp_query->the_post();
                    ?>
                    <div class="row">
                        <div class="post-meta small-8 columns">
                            <?php echo $focus_area; ?> News | <?php echo get_the_date('M d, Y'); ?>
                        </div>
                    </div>
                <?php

                    ?>
                    <div class="news-preview">
                        <?php
                        if(has_post_thumbnail()) {
                            ?>
                            <div class="row collapse">
                                <div class="news_thumb small-12 columns">
                                    <?php the_post_thumbnail('fp-medium'); ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="row">
                            <div class="small-12 columns">
                                <h4><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                        <div class="row">
                            <?php
                            echo '<div class="small-12 columns">';
                                if($instance['more_link']) {
                                    echo "<a class='button' href='/about/case-studies/focus-area/".$focus_area."'>See more ".$focus_area." news items</a>";
                                }
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                <?php
                endwhile;
                
            echo $args['after_widget'];
        }
     }

     /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
     public function form( $instance ) {
       if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        if ( isset( $instance[ 'focus_area' ] ) ) {
            $focus_area = $instance[ 'focus_area' ];
        } 

        $focus_areas = get_terms('focus-area');
      
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'focus_area' ); ?>"><?php _e( 'Focus Area:' ); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id( 'focus_area' ); ?>" name="<?php echo $this->get_field_name( 'focus_area' ); ?>">
                <option value="0">Select one...</option>
                <?php foreach($focus_areas as $area) { ?>
                    <option <?=($area->slug == $focus_area ? 'selected' : '')?> value="<?php echo $area->slug; ?>"><?php echo $area->name; ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'more_link' ); ?>"><?php _e( 'Display a link to more related news items?' ); ?></label> 
            <input <?=($instance['more_link'] ? 'checked' : '')?> class="widefat" id="<?php echo $this->get_field_id( 'more_link' ); ?>" name="<?php echo $this->get_field_name( 'more_link' ); ?>" type="checkbox" >
        </p> 
         <?php
     }

     /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
     public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = ( ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '');
        $instance['focus_area'] = ( ! empty( $new_instance['focus_area'] ) ? strip_tags( $new_instance['focus_area'] ) : '' );
        $instance['more_link'] = ( ! empty( $new_instance['more_link'] ) ? strip_tags( $new_instance['more_link'] ) : '' );

        return $instance;
     }

} 

function register_coenv_base_news_cats() {
    register_widget( 'coenv_base_news_cats' );
}
add_action( 'widgets_init', 'register_coenv_base_news_cats' );


function register_coenv_focus_area_widget() {
    register_widget( 'focus_area_widget' );
}
add_action( 'widgets_init', 'register_coenv_focus_area_widget' );

class focus_area_widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'focus-area-tile',
            'description' => 'Display a single focus area tile for the homepage',
        );
        parent::__construct( 'focus_area_widget', 'Focus Area Widget', $widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
    ?>
        <a href="<?=$instance['more_link']?>">
            <div class="focus_container">
                <img class="focus-icon" src="<?=$instance['image_uri']?>" alt="<?=$instance['image_alt']?>" />
                <hr>
                <?php echo $args['before_title']; ?>
                    <?=$instance['title']?>
                <?php echo $args['after_title']; ?>
                <img class="focus-plus" src="<?php echo get_template_directory_uri() ?>/assets/images/focus-plus.png" alt="more" />
            </div>
        </a>
    <?php   
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        if ( isset( $instance[ 'more_link' ] ) ) {
            $more_link = $instance[ 'more_link' ];
        }
        if ( isset( $instance[ 'image_alt' ] ) ) {
            $image_alt = $instance[ 'image_alt' ];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"> 
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'more_link' ); ?>"><?php _e( 'Link to more (focus area page):' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'more_link' ); ?>" name="<?php echo $this->get_field_name( 'more_link' ); ?>" type="text" value="<?php echo esc_attr( $more_link ); ?>"> 
        </p>

		<p>
		    <label for="<?php echo $this->get_field_id('image_uri'); ?>">Icon</label><br />
			<img class="custom_media_image" src="<?php if(!empty($instance['image_uri'])){echo $instance['image_uri'];} ?>" style="margin:0;padding:0;max-width:100px;float:left;display:inline-block" />
			<input type="text" class="widefat custom_media_url" name="<?php echo $this->get_field_name('image_uri'); ?>" id="<?php echo $this->get_field_id('image_uri'); ?>" value="<?php echo $instance['image_uri']; ?>">
            <input type="button" value="<?php _e( 'Upload Image' ); ?>" class="button custom_media_upload" id="custom_image_uploader<?php echo $this->id; ?>"/>
    	</p>
        <p>
            <label for="<?php echo $this->get_field_id( 'image_alt' ); ?>"><?php _e( 'Image Alt Text:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'image_alt' ); ?>" name="<?php echo $this->get_field_name( 'image_alt' ); ?>" type="text" value="<?php echo esc_attr( $image_alt ); ?>"> 
        </p>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance = $old_instance;

        $instance['title'] = ( ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '');
        $instance['more_link'] = ( ! empty( $new_instance['more_link'] ) ? strip_tags( $new_instance['more_link'] ) : '' );
        $instance['image_uri'] = ( ! empty( $new_instance['image_uri'] ) ? strip_tags( $new_instance['image_uri'] ) : '' );
        $instance['image_alt'] = ( ! empty( $new_instance['image_alt'] ) ? strip_tags( $new_instance['image_alt'] ) : '' );

        return $instance;
    }
}

function register_coenv_do_this_widget() {
    register_widget( 'do_this_widget' );
}
add_action( 'widgets_init', 'register_coenv_do_this_widget' );

class do_this_widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'do-this-tile',
            'description' => 'Display a single "How We Do This" tile for the homepage',
        );
        parent::__construct( 'do_this_widget', 'How We Do This Widget', $widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
    ?>
        <div class="do_container">
            <?php echo $args['before_title']; ?>
                <?=$instance['title']?>
            <?php echo $args['after_title']; ?>
            <hr>
            <p class="do-description"><?=$instance['description']?></p>
        </div>
    <?php   
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        if ( isset( $instance[ 'description' ] ) ) {
            $description = $instance[ 'description' ];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"> 
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $description ); ?></textarea> 
        </p>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance = $old_instance;

        $instance['title'] = ( ! empty( $new_instance['title'] ) ? strip_tags( $new_instance['title'] ) : '');
        $instance['description'] = ( ! empty( $new_instance['description'] ) ? strip_tags( $new_instance['description'] ) : '' );

        return $instance;
    }
}
function register_coenv_quote_widget() {
    register_widget( 'quote_widget' );
}
add_action( 'widgets_init', 'register_coenv_quote_widget' );

class quote_widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'quote-widget',
            'description' => 'Display a single box in the sidebar',
        );
        parent::__construct( 'quote_widget', 'Sidebar Quote Widget', $widget_ops );
    }

    /**
     * Outputs the content of the widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
    ?>
        <div class="quote-box">
            <i class="fa fa-quote-left"></i>
            <p class="quote"><?=$instance['quote']?></p>
            <p class="quote-author"><?=$instance['author']?></p>
        </div>
    <?php   
        echo $args['after_widget'];
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
        // outputs the options form on admin
        if ( isset( $instance[ 'author' ] ) ) {
            $author = $instance[ 'author' ];
        }
        if ( isset( $instance[ 'quote' ] ) ) {
            $quote = $instance[ 'quote' ];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'quote' ); ?>"><?php _e( 'Quote:' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'quote' ); ?>" name="<?php echo $this->get_field_name( 'quote' ); ?>"><?php echo esc_attr( $quote ); ?></textarea> 
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'author' ); ?>"><?php _e( 'Author:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'author' ); ?>" name="<?php echo $this->get_field_name( 'author' ); ?>" type="text" value="<?php echo esc_attr( $author ); ?>"> 
        </p>
        <?php
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
        $instance = $old_instance;

        $instance['author'] = ( ! empty( $new_instance['author'] ) ? strip_tags( $new_instance['author'] ) : '');
        $instance['quote'] = ( ! empty( $new_instance['quote'] ) ? strip_tags( $new_instance['quote'] ) : '' );

        return $instance;
    }
}


// unregister all default WP Widgets
function unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);
