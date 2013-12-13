<?php

/**
  * FFW Actions
  * List of contents
  * -----------------------
  * pagination();
  * slider_full();
  * hero (before/after)();
  * post_details();
  * mobile_nav_toggle();
  * svg_control();
 */


/**
 * FFW_actions
 * Theme actions - used in some cases in place of template parts for more
 * dynamic control. Ex: social links, hero units, etc. 
 * @since 1.0
 * @author Alexander Zizzo
 */
function FFW_actions()
{
  /**
   * Pagination
   * @author Alexander Zizzo
   * @package Fifty Framework
   * @since 1.0
   */
  function pagination( $args = NULL ) 
  {

    // ex: text align class (.left, .center, .right)
    $class     = isset($args['class']) ? $args['class'] : null;
    // optional ID
    $id        = isset($args['id']) ? $args['id'] : null;
    // prev & next text
    $prev_text = isset($args['prev_text']) ? $args['prev_text'] : 'W';
    $next_text = isset($args['next_text']) ? $args['next_text'] : 'w';

    ?>
    
    <nav id="<?php echo $id; ?>" class="pagination <?php echo $class; ?>">
    <?php 
      loop_pagination( array( 
        'prev_text' => __( '<span class="pagination-nav prev meta-nav">'.$prev_text.'</span>'),
        'next_text' => __( '<span class="pagination-nav next meta-nav">'.$next_text.'</span>')
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
  function slider_full( $args = NULL ) 
  {

    global $post;

    $class    = isset($args['class']) ? $args['class'] : null;
    $id       = isset($args['id']) ? $args['id'] : null;
    $category = isset($args['category']) ? $args['category'] : null;
    $options  = isset($args['options']) ? $args['options'] : false;

    if ( of_get_option ( 'enable_slides', '1' ) ) :

    ?>
      
      <?php /* GET SLIDER OPTIONS  | DEFAULT FALLBACKS
      ================================================== */
        if ( $options ) {
          $slider_animation       = $options['slider_animation'];
          $slider_direction       = $options['slider_direction'];
          $slider_prev_text       = $options['slider_prev_text'];
          $slider_next_text       = $options['slider_next_text'];
          $slider_speed           = $options['slider_slide_speed'];
          $slider_animation_speed = $options['slider_animation_speed'];
        } else {
          $slider_animation       = of_get_option('slider_animation');
          $slider_direction       = of_get_option('slider_direction');
          $slider_prev_text       = of_get_option('slider_prev_text');
          $slider_next_text       = of_get_option('slider_next_text');
          $slider_speed           = of_get_option('slider_slide_speed');
          $slider_animation_speed = of_get_option('slider_animation_speed');
        }
      ?>
      
      <?php /* FLEXSLIDER JAVASCRIPT
      ================================================== */ ?>
      <script>
        jQuery(window).load(function($){
          jQuery('#<?php echo $id; ?>.flexslider').flexslider({
            animation       : "<?php echo $slider_animation; ?>",
            prevText        : "<?php echo $slider_prev_text; ?>",
            nextText        : "<?php echo $slider_next_text; ?>",
            direction       : "<?php echo $slider_direction; ?>",
            slideShowSpeed  : "<?php echo $slider_speed; ?>",
            animationSpeed  : "<?php echo $slider_animation_speed; ?>",
            useCSS          : false,
            start: function(slider){
              slider.find('ul.slides').fadeIn(250);
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
      if( have_posts() ) : ?>
        <div id="<?php echo $id; ?>" class="flexslider <?php echo $class; ?>">
          <ul class="slides">

            <?php $i = 1; while (have_posts()) : the_post(); ?>
            <?php
            //Get slide options
            $slide_class          = get_post_meta( $post->ID, "_FFW_slide_class", true );
            $hide_slide_text      = get_post_meta( $post->ID, "_FFW_slide_remove_text", true );
            $slide_text_alignment = get_post_meta( $post->ID, "_FFW_slide_text_alignment", true );
            $slide_thumbnail_img  = wp_get_attachment_image_src( get_post_meta( $post->ID, "_FFW_slide_thumbnail", true ), 'full' );
            $slide_background_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
            // reset vars to first array items
            $slide_background_img = $slide_background_img[0];
            // $slide_class          = $slide_class[0];
            
            $s_styles = "";
            $s_class  = "";
            if( $slide_background_img ){
              $s_styles .= "background-image: url( ".$slide_background_img." );"; 
              $s_styles .= "background-repeat: no-repeat;";
              $s_styles .= "background-position: center center;";
              $s_styles .= "background-size: cover;"; 
            }   
            ?>          
          
            <li id="slide<?php echo $i; ?>" data-thumb="" class="<?php echo $s_class; ?>" style="<?php echo $s_styles;?>"> 
              <div class="flex-overlay"></div>
              <div class="container">
                <div class="slide-content <?php echo $slide_text_alignment; ?>">

                  <?php if( !$hide_slide_text ) : ?>       
                      <h1 class="slide-title"><?php the_title(); ?></h1>
                      <div class="seperator"></div>
                      <?php the_content(); ?>
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
  add_action( 'FFW_slider_full', 'slider_full' );



  /**
   * Hero
   * @author Alexander Zizzo
   * @package Fifty Framework
   * @since 1.0
   */

  // HERO_BEFORE
  ///////////////////////////////////////
  function hero_before( $args = NULL ) 
  {

    global $post;

    // args
    $class     = isset($args['class']) ? $args['class'] : null;
    $bg        = isset($args['bg']) ? $args['bg'] : true;
    $height    = isset($args['height']) ? $args['height'] : 'auto';
    $staff_bg  = isset($args['staff_bg']) ? $args['staff_bg'] : null;
    $events_bg = isset($args['events_bg']) ? $args['events_bg'] : null;

 
    //////////////////////////////
    // HERO URL PAGE LOGIC
    //////////////////////////////


    // bg override
    if ( $bg == false ) {
      $hero_url = '';
    }
    // is archive or category
    elseif ( is_archive() || is_category() && $bg != false ) {
      $hero_url = get_header_image();
    }
    // dntly_campaigns
    elseif ( 'dntly_campaigns' == get_post_type() && is_archive() ) {
      $hero_url = get_header_image();
    }
    // staff post type
    elseif ( $staff_bg == false && 'ffw_staff' == get_post_type() ) {
      $hero_url = '';
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


    //////////////////////////////
    // HERO HEIGHT OVERRIDE
    //////////////////////////////
    if ( $height ) {
      $hero_height = $height;
      $hero_height_inline = 'height:'.$hero_height.'px;';
    }

    // begin HTML ?>

      <div id="hero" class="hero-<?php echo $class; ?>" style="background-image:url('<?php echo $hero_url; ?>');<?php echo $hero_height_inline; ?>">
        <div class="container" style="<?php echo $hero_height_inline; ?>">
          <div class="hero-inner">

    <?php // end HTML
  } 
  add_action('FFW_hero_before', 'hero_before');


  // HERO
  ///////////////////////////////////////
  function hero( $args = NULL ) 
  {
    global $post;

    // args
    $class           = isset($args['class']) ? $args['class'] : null;
    $show_page_title = isset($args['show_page_title']) ? $args['show_page_title'] : false;
    $text_override   = isset($args['text_override']) ? $args['text_override'] : false;

    
    // begin HTML ?>

    <?php // TEXT_OVERRIDE
      if ( $text_override ) : ?>
      
      <h1 class="page-title"><?php echo $text_override; ?></h1>

    <?php // PAGE
      elseif ( is_page() ) : ?>
      
      <?php if ( $show_page_title ): ?>
        <h1 class="page-title"><?php the_title(); ?></h1>
      <?php endif; ?>

    <?php // CUSTOM POST TYPES
     elseif ( is_single() || is_singular() || is_post_type_archive( 'ffw_events' ) || is_post_type_archive( 'ffw_portfolio' ) && $show_page_title == false ) : ?>

     <!-- No Hero Title -->

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

      <h1 class="page-title"><?php single_cat_title(); ?></h1>
    <?php 
    elseif( is_search() ) : ?>
    <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'ffw' ), get_search_query() ); ?></h1>
    <?php // ELSE
      else: ?>

      <h1 class="page-title"><?php the_title(); ?></h1>

    <?php endif; ?>

    <?php // end HTML
  }
  add_action('FFW_hero', 'hero');


  // HERO_AFTER
  ///////////////////////////////////////
  function hero_after( $args = NULL ) 
  {

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
   * Mobile Nav Toggle
   * Display the hamburger nav icon and html markup
   * @author Alexander Zizzo
   * @since 1.2
   * @param $class (optional)
   */
  function mobile_nav_toggle( $args = NULL )
  {
    // args
    $class    = isset($args['class']) ? $args['class'] : null;

    ?>
    <div class="mobile-menu-toggle-wrap" class="mobile-only <?php echo $class; ?>">
      <button id="mobile-menu-toggle" class="no-appearance">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <?php

  }
  add_action('FFW_mobile_nav_toggle', 'mobile_nav_toggle');







  /**
   * SVG Control
   * @author Alexander Zizzo
   * @package Fifty Framework
   * @since 1.2
   */
  function svg_control( $args = NULL ) 
  {
    // parameters
    $debug       = isset($args['debug']) ? $args['debug'] : null;
    $file        = isset($args['file']) ? $args['file'] : null;
    $path        = isset($args['path']) ? $args['path'] : null;
    $class       = isset($args['class']) ? $args['class'] : null;
    $width       = isset($args['width']) ? $args['width'] : null;
    $height      = isset($args['height']) ? $args['height'] : null;
    $id          = isset($args['id']) ? $args['id'] : null;
    $fills       = isset($args['fills']) ? $args['fills'] : null;
    $hover_fills = isset($args['hover_fills']) ? $args['hover_fills'] : null;

    // svg path
    if ( $path ) {
      // if path is given, use it
      $svg_file         = get_stylesheet_directory() . $path . $file . '.svg';
      $svg_file_string  = file_get_contents($svg_file);
    } else {
      // otherwise use the default path (assets/images/svgs/...)
      $svg_file         = get_stylesheet_directory() . '/assets/images/svgs/' . $file . '.svg';
      $svg_file_string  = file_get_contents($svg_file);
    }

    // load SVG as XML (SimpleXMLElement Object)
    $xml = simplexml_load_string($svg_file_string);

    // make sure amount of fills passed in params match the count of paths in SVG
    if ( count($fills) == count($xml->path) ) {
      // loop through SVG attributes and assign fills to paths
      for ($i = 0; $i < count($xml->path); $i++) {
        $xml->path[$i]->attributes()->fill = $fills[$i];
      }
      // DEBUG - check new written path fills
      if ( $debug ) foreach( $xml->path as $s ) { pp($s); }
    } else {
      print 'Fill count mismatch';
    }
    // DEBUG - pretty print modified xml object
    if ( $debug ) pp($xml);

    // inline styles for hover via CSS [INCOMPLETE]
    $svg_style_str  = '<style>';
    $svg_style_str .= '</style>';


    // svg string with wrapper div for sizing
    $svg_str .= '<div class="svg_wrap" id="'.$id.'" style="width:'.$width.';height:'.$height.';">';
    $svg_str .= $xml->asXML(); //modified XML/SVG
    $svg_str .= '</div>';

    echo $svg_str;


  }
  add_action('FFW_svg_control', 'svg_control');




  /**
   * Comment Form
   * Abstraction to keep markup clean since arguments are numberous
   * @author Alexander Zizzo
   * @since 1.0
   */
  function display_comment_form() 
  {
    global $user_login, $user_identity;

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
          __( '<small>Commenting as <span class="user_identity">%2$s</span>. <a href="%3$s" title="Log out of this account">Log out</a> or <a href="%1$s" title="Edit profile">Edit Profile</a>.</small>' ),
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
    comment_form( $args );
  }
  add_action( 'FFW_comment_form', 'display_comment_form' );





  /**
   * Analytics
   * Include analytics code from theme options for use in header/footer. Abitrary name convention for any support
   * @author Alexander Zizzo
   * @since 1.3
   * @return (string) $analytics_str OR null
   * @todo Make 'smarter', detect if <script> tags accidentally in string, sanitize, etc.
   */
  function analytics_js( $args = NULL )
  {
    // params/args
    $in_footer = isset($args['in_footer']) ? $args['in_footer'] : false;

    // if we have the option set, create the analytics script string, otherwise return NULL.
    if ( of_get_option ( 'analytics_js_code') ) {
      $analytics_str  = '<script type="text/javascript">';
      $analytics_str .= of_get_option( 'analytics_js_code' );
      $analytics_str .= '</script>';

      echo $analytics_str;

    } else {
      return null;
    }
  }
  add_action( 'FFW_analytics_code', 'analytics_js' );

}
add_action('init', 'FFW_actions');