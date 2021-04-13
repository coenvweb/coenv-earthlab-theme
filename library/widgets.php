<?php

/*
 * Project Focus Areas
 */

class coenv_base_project_cats extends WP_Widget {

    /**
    * Register widget with WordPress.
    */
    function __construct() {
      parent::__construct(
           'coenv_base_project_cats', // Base ID
           __('Projects by Focus Area', 'text_domain'), // Name
           array( 'description' => __( 'Display short previews of projects based on focus area', 'text_domain' ), ) // Args
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
            'post_type' => 'project',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'ignore_sticky_posts' => 1,
            'taxonomy' => 'topic',
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

                    echo "<ul class='widget-project-list'>";
                        while ( $wp_query->have_posts() ) :
                            $wp_query->the_post();
                        ?>
                            <li class="project-preview">
                                <h4><a href="<?php echo get_the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <p class="project-excerpt">
                                    <?php the_excerpt(); ?>
                                </p>
                            </li>

                        <?php
                        endwhile;
                    echo "</ul>";

                    if($instance['more_link']) {
                        echo "<a class='button' href='/projects/topic/".$focus_area."'>More ".$focus_area." projects</a>";
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

        $focus_areas = get_terms('topic');
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
            <label for="<?php echo $this->get_field_id( 'more_link' ); ?>"><?php _e( 'Display a link to more related projects?' ); ?></label> 
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

} // class coenv_base_project_cats

// register coenv_base_project_cats widget
function register_coenv_base_project_cats() {
    register_widget( 'coenv_base_project_cats' );
}
add_action( 'widgets_init', 'register_coenv_base_project_cats' );

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
            'taxonomy' => 'topic',
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
                            <a href="/about/news-and-events/topic/<?php echo $focus_area; ?>"> <?php echo $focus_area; ?> News</a>
                        </div>
                    </div>
                <?php

                    ?>
                    <div class="news-preview">
						<?php if(get_field('event_date')) {
							$event_date = new DateTime(get_field('event_date'));
						?>  
							<div class="row collapse event">
								<div class="event_container news_thumb small-12 columns">
									<span class="month"><?=$event_date->format('F');?></span>
									<span class="day"><?=$event_date->format('d');?></span>
								</div>
							</div>
						<?php } ?>
                        <?php if(has_post_thumbnail()) { ?>
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
                                    echo "<a class='button' href='/project/topic/".$focus_area."'>More ".$focus_area." news items</a>";
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

        $focus_areas = get_terms('topic');
      
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

function register_coenv_newsletter_widget() {
    register_widget( 'newsletter_widget' );
}
add_action( 'widgets_init', 'register_coenv_newsletter_widget' );

class newsletter_widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'newsletter-tile',
            'description' => 'A signup form for the EarthLab Newsletter',
        );
        parent::__construct( 'newsletter_widget', 'Newsletter Widget', $widget_ops );
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
            <div class="newsletter-signup widget widget-newsletter-signup">
                <?php echo $args['before_title']; ?>
                    <?=$instance['title']?>
                <?php echo $args['after_title']; ?>
                <div class="text-box">
                    <img class="widget-image" src="<?=$instance['image_uri']?>" alt="<?=$instance['image_alt']?>" />
                    <div class="text-box-inner">
                        <p>Sign up for our newsletter</p>
                        <script type="text/javascript" src="https://subscribe.gifts.washington.edu/Scripts/SubManBuilder/submanbuilder.js" id="uwSubscriptionManager"></script>
                        <script type="text/javascript">
                            SUBMANBUILDER.makeIframe({
                                subscriptionID: [1234],           //REQUIRED: Subscription ID(s) for sign up e.g. [25, 27] for sign up to multiple sub prefs
                                fromName: "UW Earthlab Email Sign Up",   //RECOMMENDED: From name of the confirmation email
                                fromEmail: "earthlab@uw.edu",   //RECOMMENDED: From email of the confirmation email
                                showPlaceHolders: false,        //OPTIONAL: Show placeholder text inside the text boxes
                                hideLabels: false,              //OPTIONAL: Hide form labels
                                returnURL: "",                  //OPTIONAL: Set if confirmation page is different than sign up page
                            });
                        </script>
                        <div class="social-area">
                        <p>Follow EarthLab <span class="social-icon-box right"><a class="social-icon" href="https://www.facebook.com/UWEarthLab/"><i class="fa fa-facebook"></i></a> <a class="social-icon" href="https://twitter.com/uwearthlab"><i class="fa fa-twitter"></i></a>
                        <a class="social-icon" href="https://www.instagram.com/uwearthlab"><i class="fa fa-instagram"></i></a><a class="social-icon" href="https://www.linkedin.com/company/uwearthlab"><i class="fa fa-linkedin"></i></a></span></p>
                        
                        </div>
                        
                    </div>
                </div>
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
        
        if ( isset( $instance[ 'image_alt' ] ) ) {
            $image_alt = $instance[ 'image_alt' ];
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"> 
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
        $instance['image_uri'] = ( ! empty( $new_instance['image_uri'] ) ? strip_tags( $new_instance['image_uri'] ) : '' );
        $instance['image_alt'] = ( ! empty( $new_instance['image_alt'] ) ? strip_tags( $new_instance['image_alt'] ) : '' );

        return $instance;
    }
}

function register_earthlab_text_widget() {
    register_widget( 'earthlab_text_widget' );
}
add_action( 'widgets_init', 'register_earthlab_text_widget' );

class earthlab_text_widget extends WP_Widget {

    /**
     * Sets up the widgets name etc
     */
    public function __construct() {
        $widget_ops = array( 
            'classname' => 'text-tile',
            'description' => 'A panel of information',
        );
        parent::__construct( 'text_widget', 'Earthlab Text Widget', $widget_ops );
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
            <div class="earthlab-text widget widget-earthlab-text">
                <?php echo $args['before_title']; ?>
                    <?=$instance['title']?>
                <?php echo $args['after_title']; ?>
                <div class="text-box">
                    <?php if ( !empty( $instance[ 'image_alt' ] ) ) { ?>
                        <img class="widget-image" src="<?=$instance['image_uri']?>" alt="<?=$instance['image_alt']?>" />
                    <?php }; ?>
                    <div class="text-box-inner">
                        <p><?=$instance['description']?></p>
                        <p><a class="button" href="<?=$instance['more_link']?>">Learn more</a></p>
                    </div>
                </div>
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
        
        if ( isset( $instance[ 'image_alt' ] ) ) {
            $image_alt = $instance[ 'image_alt' ];
        }
        
        if ( isset( $instance[ 'description' ] ) ) {
            $description = $instance[ 'description' ];
        }
        
        if ( isset( $instance[ 'more_link' ] ) ) {
            $more_link = $instance[ 'more_link' ];
        }
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"> 
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
        <p>
            <label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description' ); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>"><?php echo esc_attr( $description ); ?></textarea> 
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'more_link' ); ?>"><?php _e( 'Link to learn more:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'more_link' ); ?>" name="<?php echo $this->get_field_name( 'more_link' ); ?>" type="text" value="<?php echo esc_attr( $more_link ); ?>"> 
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
        $instance['image_uri'] = ( ! empty( $new_instance['image_uri'] ) ? strip_tags( $new_instance['image_uri'] ) : '' );
        $instance['image_alt'] = ( ! empty( $new_instance['image_alt'] ) ? strip_tags( $new_instance['image_alt'] ) : '' );
        $instance['description'] = ( ! empty( $new_instance['description'] ) ? strip_tags( $new_instance['description'] ) : '' );
        $instance['more_link'] = ( ! empty( $new_instance['more_link'] ) ? strip_tags( $new_instance['more_link'] ) : '' );

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

/**
 * Events Widget
 */
register_widget( 'CoEnv_Widget_Events' );
class CoEnv_Widget_Events extends WP_Widget {

  public function __construct() {
    $args = array(
      'classname' => 'widget widget-events',
      'description' => __( 'Display a short list of Trumba calendar events.', 'coenv' )
    );
 
    parent::__construct(
      'trumba_events', // base ID
      'Trumba Events', // name
      $args
    );
  }

  public function widget( $args, $instance ) {
    extract( $args );

   if (isset($instance['title'])) {
        $title = apply_filters( 'widget_title', $instance['title'] );
    } else {
        $title = null;
    }
    if (isset($instance['feed_url'])) {
        $feed_url = apply_filters( 'feed_url', $instance['feed_url'] );
        $feed_url = str_replace('http://', 'https://', $feed_url ); 
    }
    if (isset($instance['events_url'])) {
        $events_url = apply_filters( 'events_url', $instance['events_url'] );
    } else {
        $events_url = null;
    }
    if (isset($instance['posts_per_page'])) {
        $posts_per_page = (int) $instance['posts_per_page'];
    } else {
        $posts_per_page = 3;
    }

    if ( !isset( $feed_url ) || empty( $feed_url ) ) {
      return;
    }

    // get cached XML from WP transient API
    $events_xml = get_transient( 'trumba_events_xml' );
    if ( $events_xml === false || $events_xml === '' ) {
        $ctx = stream_context_create(array('http'=>
            array(
                'timeout' => 3,  //1200 Seconds is 20 Minutes
            )
        ));

        if ($events_xml = file_get_contents( $feed_url, false, $ctx )) {

        } else {
            return;
        };
      set_transient( 'trumba_events_xml', $events_xml, 1 * MINUTE_IN_SECONDS );
    }
    
    $xml = new SimpleXmlElement($events_xml);
    
    $events = array();

    foreach ($xml->channel->item as $item) {     
      $events[] = array(
        'title' => $item->title,
        'date'  => $item->category,
        'url' => $item->link
      );
    }

    $events = array_slice( $events, 0, $posts_per_page );

    ?>
      <?php echo $before_widget; ?>
      <div class="events widget widget-events">
      <?php echo $args['before_title']; ?>
            <?=$title?>
        <?php echo $args['after_title']; ?>
        <div class="text-box">

      <ul class="event-list">

      <?php if ( count( $events ) ) : ?>

        <?php foreach ( $events as $key => $event ) : ?>


            <li>
            <?php
            $date = substr($event['date'], 0, -6);
            $date = strtotime($date);
            $date = date('F j', $date);
            ?>
              <a href="<?php echo $event['url'] ?>">
              <p class="date"><i class="fa fa-calendar"></i> <?php echo $date ?></p>
              <p class="title"><?php echo $event['title'] ?></p>
              </a>
            </li>

      

        <?php endforeach ?>

      <?php else : ?>

        <li><p class="title">No upcoming events.</p>
            <p class="small">Additional events can be found on the <a href="http://environment.washington.edu/alumni-and-community/calendar-events/" title="College of the Environment Calendar">College of the Environment Events Calendar</a>.</p></li>

      <?php endif ?>
        
      </ul>

      <?php if ( $events_url != '' ) : ?>        
            <a href="<?php echo $events_url; ?>" class="button right" title="View All Events">Full events calendar</a>
      <?php endif ?>

      </div>
        </div>
      <?php echo $after_widget ?>
    
    <?php
  }

  public function form( $instance ) {

    $title = isset( $instance['title'] ) ? $instance['title'] : __( 'Events', 'coenv' );
    $feed_url = $instance['feed_url'];
    $events_url = $instance['events_url'];
    $posts_per_page = isset( $instance['posts_per_page'] ) ? (int) $instance['posts_per_page'] : 5;
 
    ?>
      <p>
        <label for="<?php echo $this->get_field_name( 'title' ) ?>"><?php _e( 'Title:' ) ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ) ?>" name="<?php echo $this->get_field_name( 'title' ) ?>" value="<?php echo esc_attr( $title ) ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_name( 'feed_url' ) ?>"><?php _e( 'Feed URL:' ) ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'feed_url' ) ?>" name="<?php echo $this->get_field_name( 'feed_url' ) ?>" value="<?php echo esc_attr( $feed_url ) ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_name( 'events_url' ) ?>"><?php _e( 'More link (URL):' ) ?></label>
        <input type="text" class="widefat" id="<?php echo $this->get_field_id( 'events_url' ) ?>" name="<?php echo $this->get_field_name( 'events_url' ) ?>" value="<?php echo esc_attr( $events_url ) ?>" />
      </p>
      <p>
        <label for="<?php echo $this->get_field_name( 'posts_per_page' ) ?>">Number of events to show: </label>
        <input name="<?php echo $this->get_field_name( 'posts_per_page' ) ?>" type="text" size="3" value="<?php echo $posts_per_page ?>" />
      </p>
    <?php
  }

  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['feed_url'] = strip_tags( $new_instance['feed_url'] );
    $instance['posts_per_page'] = strip_tags( $new_instance['posts_per_page'] );
    $instance['events_url'] = strip_tags( $new_instance['events_url'] );
     
    return $instance;
  }

}
