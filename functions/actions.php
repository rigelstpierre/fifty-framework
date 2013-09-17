<?php
add_action('init', 'FFW_actions');

/**
 * FFW_actions
 * Theme actions - used in some cases in place of template parts for more
 * dynamic control. Ex: social links, hero units, etc. 
 * @since 1.0
 * @author Alexander Zizzo
 */
function FFW_actions(){




  /**
   * Pagination
   * @since 1.0
   */
  function pagination( $args = NULL ) {

    $class = isset($args['class']) ? $args['class'] : null;
    $id = isset($args['id']) ? $args['id'] : null;

    ?>
    
    <nav id="<?php echo $id; ?>" class="pagination <?php echo $class; ?>">
    <?php 
      loop_pagination( array( 
        'prev_text' => __( '<span class="pagination-nav prev meta-nav">W</span>'),
        'next_text' => __( '<span class="pagination-nav next meta-nav">w</span>')
      ) ); 
    ?>
    </nav>

    <?php 
  }
  add_action('FFW_pagination', 'pagination');











  /**
   * Slider
   * @author Alexander Zizzo
   * @since 1.0
   */
  function slider_full( $args = NULL ) {

    global $post;

    $class    = isset($args['class']) ? $args['class'] : null;
    $id       = isset($args['id']) ? $args['id'] : null;
    $category = isset($args['category']) ? $args['category'] : null;

    if ( of_get_option ( 'enable_slides', '1' ) ) :

    ?>
      
      <?php /* GET SLIDER SETTINGS FROM OPTIONS
      ================================================== */
        $slider_animation       = of_get_option('slider_animation');
        $slider_direction       = of_get_option('slider_direction');
        $slider_prev_text       = of_get_option('slider_prev_text');
        $slider_next_text       = of_get_option('slider_next_text');
        $slider_speed           = of_get_option('slider_slide_speed');
        $slider_animation_speed = of_get_option('slider_animation_speed');
      ?>
      
      <?php /* FLEXSLIDER JAVASCRIPT
      ================================================== */ ?>
      <script>
        jQuery(window).load(function($){
          jQuery('.flexslider').flexslider({
            animation       : "<?php echo $slider_animation; ?>",
            prevText        : "<?php echo $slider_prev_text; ?>",
            nextText        : "<?php echo $slider_next_text; ?>",
            direction       : "<?php echo $slider_direction; ?>",
            slideShowSpeed  : "<?php echo $slider_speed; ?>",
            animationSpeed  : "<?php echo $slider_animation_speed; ?>",
            start: function(slider){
              slider.find('ul.slides').addClass('show-lis');
            }
          });
        });
      </script>

      <?php /* QUERY THE SLIDER POST TYPE
      ================================================== */
      query_posts( array(
        'ignore_sticky_posts' => 1,
        'posts_per_page'      => 20,
        'post_type'           => 'slides',
        'tax_query' => array(
          array(
            'taxonomy' => 'slides_category',
            'field' => 'slug',
            'terms' => $category
          )
        )
      )); ?>


      <?php /* START THE LOOP IF WE HAVE SLIDES
      ================================================== */
      if(have_posts()) :?>
        <div id="<?php echo $id; ?>" class="flexslider <?php echo $class; ?>">
          <ul class="slides">

            <?php $i = 1; while (have_posts()) : the_post(); ?>
            <?php
            //Get slide options
            $slide_class          = get_post_meta($post->ID, "_FFW_slide_class", true);         
            $show_slide_text      = get_post_meta($post->ID, "_FFW_slide_show_text", true);
            $slide_text_alignment = get_post_meta($post->ID, "_FFW_slide_text_alignment", true);
            $slide_thumbnail_img  = wp_get_attachment_image_src(get_post_meta($post->ID, "_FFW_slide_thumbnail", true), 'full');
            $slide_background_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
            // reset vars to first array items
            $slide_background_img = $slide_background_img[0];
            // $slide_class          = $slide_class[0];
            
            $s_styles = "";
            $s_class  = "";
            if($slide_background_img){
              $s_styles .= "background-image: url(".$slide_background_img.");";           
              $s_styles .= "background-repeat: no-repeat;";
              $s_styles .= "background-position: center center;";
              $s_styles .= "background-size: cover;"; 
            }   
            ?>          
          
            <li id="slide<?php echo $i; ?>" data-thumb="" class="<?php echo $s_class; ?>" style="<?php echo $s_styles;?>"> 
              <div class="flex-overlay"></div>
              <div class="container">
                <div class="slide-content">

                  <?php if($show_slide_text) : ?>       
                    <div class="details <?php echo $slide_text_alignment; ?>">
                      <h1><?php the_title(); ?></h1>
                      <div class="seperator"></div>
                      <?php the_content(); ?>
                      <?php//echo wpautop(do_shortcode($slide_class)); ?>
                    </div>
                  <?php endif; ?>

                </div><!-- .slide-content -->
              </div><!-- .container -->
            </li>
            
            <?php $i++; ?>      
          
            <?php endwhile; ?>
          </ul>
        </div>  

      <?php endif; ?>
      <?php wp_reset_query(); wp_reset_postdata(); ?>

    <?php else : ?>
      <h1> Slider Not Enabled </h1>
    <?php endif;

  }
  add_action('FFW_slider_full', 'slider_full');











  /**
   * Hero
   * @author Alexander Zizzo
   * @package Fifty Framework
   * @since 1.0
   */

  // HERO_BEFORE
  ///////////////////////////////////////
  function hero_before( $args = NULL ) {

    global $post;

    // args
    $class    = isset($args['class']) ? $args['class'] : null;

    // vars
    $hero_class = '';

    // is archive or category
    
    if ( is_archive() || is_category() ) {
      $hero_url = get_header_image();
    }
    // use video thumbnail
    elseif ( has_post_format( 'video' ) ) {
      $vid_url     = get_post_meta($post->ID, 'vid_url');
      $vid_url     = $vid_url[0];
      $vid_service = get_video_service( $vid_url );
      $vid_thumb   = get_video_data( $vid_url, 'thumbnail_large' );

      $hero_url    = $vid_thumb;
      $hero_class  = $vid_service;
    }
    // has post thumbnail (featured image)
    elseif ( has_post_thumbnail() ) {
      $hero_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    }
    // use header image from settings
    elseif ( get_header_image() != '' ) {
      $hero_url = get_header_image();
      $hero_height = get_custom_header()->height; // unused as of 09/16/2013
    }
    else {
      $hero_url = '';
    }

    // begin HTML ?>

      <div id="hero" class="hero-<?php echo $hero_class; ?>" style="background-image:url('<?php echo $hero_url; ?>');">
        <div class="container">
          <div class="hero-inner">

    <?php // end HTML
  } 
  add_action('FFW_hero_before', 'hero_before');


  // HERO
  ///////////////////////////////////////
  function hero( $args = NULL ) {
    
    global $post;

    // args
    $class    = isset($args['class']) ? $args['class'] : null;
    
    // begin HTML ?>
    
    <?php // SINGLE OR PAGE
      if ( is_single() || is_page() ) : ?>

      <h1 class="page-title"><?php the_title(); ?></h1>

    <?php // ARCHIVE
      elseif ( is_archive() && !is_category() ): ?>

      <h1 class="page-title">
        <?php
          if ( is_day() )       : printf( __( 'Archives: %s', 'FFW' ), get_the_date() );
          elseif ( is_month() ) : printf( __( 'Archives: %s', 'FFW' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'FFW' ) ) );
          elseif ( is_year() )  : printf( __( 'Archives: %s', 'FFW' ), get_the_date( _x( 'Y', 'yearly archives date format', 'FFW' ) ) );
          else                  : _e( 'Archives', 'FFW' );
          endif;
        ?>
      </h1>

    <?php // CATEGORY
      elseif ( is_category() ) : ?>

      <h1 class="page-title"><?php the_category(); ?></h1>

    <?php // ELSE
      else: ?>

      <h1 class="page-title"><?php the_title(); ?></h1>

    <?php endif; ?>

    <?php // end HTML
  }
  add_action('FFW_hero', 'hero');


  // HERO_AFTER
  ///////////////////////////////////////
  function hero_after( $args = NULL ) {

    // begin HTML ?>
    
          </div>
        </div>
      </div>

    <?php // end HTML
  }
  add_action('FFW_hero_after', 'hero_after');












  /**
   * Post Details
   * @author Alexander Zizzo
   * @package Fifty Framework
   * @since 1.0
   */
  function post_details( $args = NULL ) {

    global $post;
    $class    = isset($args['class']) ? $args['class'] : null;
    $author   = isset($args['author']) ? $args['author'] : true;
    $date     = isset($args['date']) ? $args['date'] : true;
    $comments = isset($args['comments']) ? $args['comments'] : true;
    
    ?>
      
      <ul class="post-meta <?php echo $class; ?>">
        <?php if ( $author ) : ?>
          <li class="post-author">
              <span>By </span>
              <i class="icon icon-person"></i>
              <?php the_author(); ?>
          </li>
        <?php endif; ?>
        <?php if ( $date ) : ?>
          <li class="post-time">
              <i class="icon icon-calendar"></i>
              <time class="entry-date" datetime="<?php the_time(); ?>"><?php the_time('F j, Y'); ?></time>
          </li>
        <?php endif; ?>
        <?php if ( $comments ) : ?>
          <li class="post-comments">
            <a href="<?php the_permalink(); ?>/#comments">
              <i class="icon icon-chat"></i>
              <?php echo get_comments_number(); ?> Comments
            </a>
          </li>
        <?php endif; ?>
      </ul>

    <?php 
  }
  add_action('FFW_post_details', 'post_details');












  /**
   * Comment Form
   * Abstraction to keep markup clean since arguments are numberous
   * @author Alexander Zizzo
   * @since 1.0
   */
  function display_comment_form() {
    $args = array(
      'id_form'           => 'commentform',
      'id_submit'         => 'submit',
      'title_reply'       => __( 'Leave a Reply' ),
      'title_reply_to'    => __( 'Leave a Reply to %s' ),
      'cancel_reply_link' => __( 'Cancel Reply' ),
      'label_submit'      => __( 'Post Comment' ),

      'must_log_in'           => 
        '<p class="must-log-in">' .
          sprintf(
            __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
            wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . 
        '</p>',

      'logged_in_as'          => 
        '<p class="logged-in-as">' .
          sprintf(
          __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
            admin_url( 'profile.php' ),
            $user_identity,
            wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
          ) . 
        '</p>',

      'comment_notes_before'  => '',

      'comment_notes_after'   => '',

      'fields'                => apply_filters( 'comment_form_default_fields', array(

        'author'  =>
          '<div class="fields-halves"><p class="comment-form-author field-half">' .
          '<label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' .
          ( $req ? '<span class="required">*</span>' : '' ) .
          '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
          '" size="30"' . $aria_req . ' /></p>',

        'email'   =>
          '<p class="comment-form-email field-half"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' .
          ( $req ? '<span class="required">*</span>' : '' ) .
          '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
          '" size="30"' . $aria_req . ' /></p></div>',

        )
      ),
    );
    comment_form($args);
  }
  add_action('FFW_comment_form', 'display_comment_form');

}