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
 * Flexslider JS
 * @author Alexander Zizzo
 * @since 1.3
 * @param (string) $selector
 * @param (string) $animation
 * @param (string) $prev
 * @param (string) $next
 * @param (string) $direction
 * @param (string) $slide_speed
 * @param (string) $animation_speed
 * @param (string) $css
 */
function flexslider_js( $args = NULL )
{
  // args/params
  $selector         = isset($args['selector']) ? $args['selector'] : '.flexslider';
  $animation       = isset($args['animation']) ? $args['animation'] : 'slide';
  $prev            = isset($args['prev']) ? $args['prev'] : 'N';
  $next            = isset($args['next']) ? $args['next'] : 'n';
  $direction       = isset($args['direction']) ? $args['direction'] : 'horizontal';
  $slide_speed     = isset($args['slide_speed']) ? $args['slide_speed'] : '7000';
  $animation_speed = isset($args['slide_speed']) ? $args['slide_speed'] : '600';
  $css             = isset($args['css']) ? $args['css'] : false;

  // JS
  ?>
    <script>
    jQuery(window).load(function($){
      jQuery('<?php echo $selector; ?>').flexslider({
        animation       : "<?php echo $animation; ?>",
        prevText        : "<?php echo $prev; ?>",
        nextText        : "<?php echo $next; ?>",
        direction       : "<?php echo $direction; ?>",
        slideShowSpeed  : "<?php echo $slide_speed; ?>",
        animationSpeed  : "<?php echo $animation_speed; ?>",
        useCSS          : false,
        start: function(slider){
          slider.find('ul.slides').fadeIn(250);
        }
      });
    });
    </script>
  <?php
}
add_action( 'FFW_flexslider_js', 'flexslider_js' );



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
  global $post, $template;

  // args
  $class     = isset($args['class']) ? $args['class'] : null;
  $bg        = isset($args['bg']) ? $args['bg'] : true;
  $height    = isset($args['height']) ? $args['height'] : 'auto';
  $staff_bg  = isset($args['staff_bg']) ? $args['staff_bg'] : null;
  $events_bg = isset($args['events_bg']) ? $args['events_bg'] : null;
  $debug     = isset($args['debug']) ? $args['debug'] : false; 

  // template name get
  $template    = explode( '/', $template );
  $array_count = count( $template );
  $array_count = $array_count - 1;
  $template    = $template[$array_count];

  

  //////////////////////////////
  // HERO URL PAGE LOGIC
  //////////////////////////////

  /* bg override
  ========================================================================================== */
  if ( $bg == false ) {
    $hero_url = '';

    if ( $debug ) { ?> <script>console.log('HERO_BEFORE DEBUGGING -> BG OVERRIDE');</script><?php }
  }
  /* is index.php
  ========================================================================================== */
  elseif ( get_option('page_for_posts' ) == get_the_ID() || $template == 'index.php' || is_category() || is_archive() ) {
    $hero_url = wp_get_attachment_url( get_post_thumbnail_id( get_option('page_for_posts' ) ) );

    if ( $debug ) { ?> <script>console.log('HERO_BEFORE DEBUGGING -> IS INDEX.PHP');</script><?php }
  }
  /* is archive or category   v1.35 removed is_archive() from logic
  ========================================================================================== */
  elseif ( is_category() && $bg != false ) {
    $hero_url = get_header_image();

    if ( $debug ) { ?> <script>console.log('HERO_BEFORE DEBUGGING -> IS ARCHIVE OR CATEGORY');</script><?php }
  }
  /* dntly_campaigns
  ========================================================================================== */
  elseif ( 'dntly_campaigns' == get_post_type() && is_archive() ) {
    $hero_url = get_header_image();

    if ( $debug ) { ?> <script>console.log('HERO_BEFORE DEBUGGING -> DNTLY_CAMPAIGNS');</script><?php }
  }
  /* staff post type
  ========================================================================================== */
  elseif ( $staff_bg == false && 'ffw_staff' == get_post_type() ) {
   
      $hero_url = '';
  

    if ( $debug ) { ?> <script>console.log('HERO_BEFORE DEBUGGING -> FFW_STAFF');</script><?php }
  }
  /* use video thumbnail
  ========================================================================================== */
  elseif ( has_post_format( 'video' ) && !is_archive() && !is_front_page() && !is_home() ) {
    $vid_url     = get_post_meta($post->ID, 'vid_url');
    $vid_url     = $vid_url[0];
    $vid_service = get_video_service( $vid_url );
    $vid_thumb   = get_video_data( $vid_url, 'thumbnail_large' );

    $hero_url    = $vid_thumb;
    $hero_class  = $vid_service;

    if ( $debug ) { ?> <script>console.log('HERO_BEFORE DEBUGGING -> USE VIDEO THUMBNAIL');</script><?php }
  }
  /* has post thumbnail (featured image)
  ========================================================================================== */
  elseif ( has_post_thumbnail() ) {
    $hero_url = wp_get_attachment_url( get_post_thumbnail_id( $post->ID) );

    if ( $debug ) { ?> <script>console.log('HERO_BEFORE DEBUGGING -> HAS POST THUMBNAIL');</script><?php }
  }
  /* use header image from settings
  ========================================================================================== */
  elseif ( get_header_image() != '' ) {
    $hero_url = get_header_image();
    $hero_height = get_custom_header()->height; // unused as of 09/16/2013

    if ( $debug ) { ?> <script>console.log('HERO_BEFORE DEBUGGING -> USE HEADER IMAGE');</script><?php }
  }
  else {
    $hero_url = '';

    if ( $debug ) { ?> <script>console.log('HERO_BEFORE DEBUGGING -> ELSE');</script><?php }
  }


  //////////////////////////////
  // HERO HEIGHT OVERRIDE
  //////////////////////////////
  if ( $height ) {
    $hero_height = $height;
    
    if ( $hero_height !== 'auto' ) {
      $hero_height_inline = 'height:'.$hero_height.'px;';
    } else {
      $hero_height_inline = '';
    }
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
  global $post, $ffw_post_types;

  // args
  $class           = isset($args['class']) ? $args['class'] : null;
  $show_page_title = isset($args['show_page_title']) ? $args['show_page_title'] : true;
  $text_override   = isset($args['text_override']) ? $args['text_override'] : false;

  // begin HTML ?>


  <?php /* TEXT_OVERRIDE
  ========================================================================================== */
  if ( $text_override ) : ?>
  <h1 class="page-title"><?php echo $text_override; ?></h1>

  <?php /* IS_PAGE
  ========================================================================================== */
  elseif ( is_page() ) : ?>
    
    <?php if ( $show_page_title ): ?>
      <h1 class="page-title"><?php the_title(); ?></h1>
    <?php endif; ?>

  <?php /* CUSTOM POST TYLES
  /* is_post_type_archive( 'ffw_events' ) || is_post_type_archive( 'ffw_portfolio' )
  ========================================================================================== */
  elseif ( is_single() || is_single($ffw_post_types) && $show_page_title == false ) : ?>
   
    <h1 class="page-title"><?php the_title(); ?></h1>

  <?php /* IS_SEARCH
  ========================================================================================== */ 
  elseif( is_search() ) : ?>

    <h1 class="page-title">Search Results</h1>

  <?php  /* IS_CATEGORY
  ========================================================================================== */
  elseif ( is_category() || is_archive() || is_page() ) : ?>

    <h1 class="page-title"><?php single_cat_title(); ?></h1>

  <?php /* IS_ARCHIVE
  ========================================================================================== */
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

  <?php  /* IS_CATEGORY
  ========================================================================================== */
  elseif ( is_category() ) : ?>
    <h1 class="page-title"><?php single_cat_title(); ?></h1>


  <?php /* ELSE
  ========================================================================================== */ 
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
  $class    = isset($args['class']) ? $args['class'] : 'post-meta';
  $wrapper  = isset($args['wrapper']) ? $args['wrapper'] : 'ul';
  $category = isset($args['category']) ? $args['category'] : false;
  $type     = isset($args['type']) ? $args['type'] : false;
  $author   = isset($args['author']) ? $args['author'] : true;
  $date     = isset($args['date']) ? $args['date'] : true;
  $comments = isset($args['comments']) ? $args['comments'] : true;
  
  ?>
    
  <?php if ( $wrapper == 'ul') : ?>
    <ul class="<?php echo $class; ?>">
    <?php $child_tag = 'li'; ?>
  <?php elseif ($wrapper == 'div') : ?>
    <div class="<?php echo $class; ?>">
    <?php $child_tag = 'span'; ?>
  <?php endif; ?>
    
      <?php /* CATEGORY
      ================================================== */ if ( $category ) : ?>
        <<?php echo $child_tag; ?> class="post-category">
            <i class="icon icon-video"></i>
            <?php the_category(); ?>
        </<?php echo $child_tag; ?>>
      <?php endif; ?>

      <?php /* AUTHOR
      ================================================== */ if ( $author ) : ?>
        <<?php echo $child_tag; ?> class="post-author">
            <span class="author-pre-text">By </span>
            <i class="icon icon-person"></i>
            <?php the_author(); ?>
        </<?php echo $child_tag; ?>>
      <?php endif; ?>

      <?php /* DATE/TIME
      ================================================== */ if ( $date ) : ?>
        <<?php echo $child_tag; ?> class="post-time">
            <i class="icon icon-calendar"></i>
            <time class="entry-date" datetime="<?php the_time(); ?>"><?php the_time('F j, Y'); ?></time>
        </<?php echo $child_tag; ?>>
      <?php endif; ?>

      <?php /* COMMENTS
      ================================================== */ if ( $comments ) : ?>
        <<?php echo $child_tag; ?> class="post-comments">
          <a href="<?php the_permalink(); ?>/#comments">
            <i class="icon icon-chat"></i>
            <?php echo get_comments_number(); ?> Comments
          </a>
        </<?php echo $child_tag; ?>>
      <?php endif; ?>

    <?php if ( $wrapper == 'ul') : ?>
      </ul>
    <?php elseif ($wrapper == 'div') : ?>
      </div>
    <?php endif; ?>

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
  <div class="mobile-menu-toggle-wrap mobile-only <?php echo $class; ?>">
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
 * Social Sharing Javascript
 * Add AddThis JS and SharePop JS inline as needed (required when using an email sharing action)
 * @author Alexander Zizzo
 * @since 1.3
 */
function social_share_js( $args = NULL )
{
  // args
  $addthis  = isset($args['addthis']) ? $args['addthis'] : false;
  $sharepop = isset($args['sharepop']) ? $args['sharepop'] : true;

  ?>
  <?php if ( $addthis ) : ?>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-527a9fd51bbed3ea"></script>
  <?php endif; ?>
  
  <?php if ( $sharepop ) : ?>
    <script type="text/javascript">function sharePop(url) { window.open( url, "myWindow", "status = 1, height = 500, width = 500, resizable = 0"); }</script>
  <?php endif; ?>

  <?php
} 
add_action('FFW_social_share_js', 'social_share_js');




/**
 * Add This JS
 * @author Alexander Zizzo
 * @since 1.3
 */
function addthis_js( $args = NULL )
{
  // args
  $label        = isset($args['label']) ? $args['label'] : true;
  $default_size = isset($args['default_size']) ? $args['default_size'] : true;
  $class        = isset($args['class']) ? $args['class'] : 'ffw_addthis_custom_styles';
  $facebook     = isset($args['facebook']) ? $args['facebook'] : true;
  $twitter      = isset($args['twitter']) ? $args['twitter'] : true;
  $email        = isset($args['email']) ? $args['email'] : true;
  $print        = isset($args['print']) ? $args['print'] : false;
  $more         = isset($args['more']) ? $args['more'] : false;

  // conditional class settings
  if ( $default_size ) {
    $addthis_default_style_classes = 'addthis_default_style addthis_32x32_style';
  } else {
    $addthis_default_style_classes = null;
  }
  ?>
      
    <div class="<?php echo $class; ?> addthis_toolbox <?php echo $addthis_default_style_classes; ?>">
      
      <?php if ( $label ) : ?>
        <span class="addthis_label">SHARE</span>
      <?php endif; ?>

      <?php if ( $facebook ) : ?>
        <a class="addthis_button_preferred_1"></a>
      <?php endif; ?>
      
      <?php if ( $twitter ) : ?>
        <a class="addthis_button_preferred_2"></a>
      <?php endif; ?>
      
      <?php if ( $email ) : ?>
        <a class="addthis_button_preferred_3"></a>
      <?php endif; ?>
      
      <?php if ( $print ) : ?>
        <a class="addthis_button_preferred_4"></a>
      <?php endif; ?>
      
      <?php if ( $more ) : ?>
        <a class="addthis_button_compact"></a>
        <a class="addthis_counter addthis_bubble_style"></a>
      <?php endif; ?>
    </div>

  <?php
} 
add_action('FFW_addthis_js', 'addthis_js');


    /**
     * Add This JS BEFORE
     * @since 1.3
     */
    function addthis_js_before( $args = NULL )
    {
      // args
      $pubid  = isset($args['pubid']) ? $args['pubid'] : 'xa-52b0d9094246c363';

      ?>
        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=<?php echo $pubid; ?>"></script>
      <?php
    }
    add_action('FFW_addthis_js_before', 'addthis_js_before');





/**
 * Social Share Menu
 * Display a social sharing menu
 * @author Alexander Zizzo
 * @since 1.3
 * @param $class (optional)
 */
function social_share_menu( $args = NULL )
{
  // args/params
  $class       = isset($args['class']) ? $args['class'] : null;
  $facebook    = isset($args['facebook']) ? $args['facebook'] : true;
  $google_plus = isset($args['google_plus']) ? $args['google_plus'] : false;
  $twitter     = isset($args['twitter']) ? $args['twitter'] : true;
  $email       = isset($args['email']) ? $args['email'] : false;

?>
  
  <ul class="menu-social <?php echo $class; ?>">

      <?php if ( $facebook ) : ?>
      <li class="social-link">
        <a class="socialico socialico-facebook circle" href="javascript:sharePop('https://www.facebook.com/sharer/sharer.php?u=<?php get_permalink(); ?>');"></a>
      </li>
      <?php endif; ?>

      <?php if ( $google_plus ) : ?>
      <li class="social-link">
        <a class="socialico socialico-googleplus circle" href="http://plus.google.com/fiftyandfifty"></a>
      </li>
      <?php endif; ?>

      <?php if ( $twitter ) : ?>
      <li class="social-link">
        <a class="socialico socialico-twitter circle" href="javascript:sharePop('http://twitter.com/intent/tweet?text='<?php get_the_title(); ?>'+'<?php get_permalink(); ?>')"></a>
      </li>
      <?php endif; ?>
      
      <?php if ( $email_alt ) : ?>
        <li class="social-link social-link-email">
          <a class="icon icon-email circle" href="mailto:" target="_blank"></a>
        </li>
      <?php endif; ?>
    </ul>
  <?php

}
add_action('FFW_social_share_menu', 'social_share_menu');



/**
 * Check Gmail Cookie Status
 */
function check_gmail_cookie( $args = NULL ) {
  ?>

    <script>
      function logged_in_to_gmail() { 
        console.log('Logged in to Gmail');
      }
      function not_logged_in_to_gmail() { 
        console.log('Not logged in to Gmail');
      }
    </script>
    <img style="display:none;"
         class="gmail_check" 
         onload="logged_in_to_gmail()"
         onerror="not_logged_in_to_gmail()"
         src="https://mail.google.com/mail/photos/img/photos/public/AIbEiAIAAABDCKa_hYq24u2WUyILdmNhcmRfcGhvdG8qKDI1ODFkOGViM2I5ZjUwZmZlYjE3MzQ2YmQyMjAzMjFlZTU3NjEzOTYwAZwSCm_MMUDjh599IgoA2muEmEZD"
    />

  <?php
}
add_action('FFW_check_gmail_cookie', 'check_gmail_cookie');



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
 * WPADMINBAR_ADJUST
 * Adjust the position of the #wpadminbar, or rather, the element following it,
 * to fix display when logged in
 * @since 1.35
 * @author Alexander Zizzo
 */
function style_override( $style_args = NULL )
{
  // If user is logged in
  if ( is_user_logged_in() ) : ?>

    <style>
      <?php 
      // Foreach style argument passed, used the key as the selector, and the value as the style properties
      foreach( $style_args as $key => $sa ) : ?>
        <?php echo $key; ?> { <?php echo $sa; ?> }
      <?php endforeach; ?>
    </style>

  <?php endif; 
}
add_action( 'FFW_style_override', 'style_override' );





/**
 * WP ADMIN BAR
 * Adjust the styling of the #wpadminbar 
 * @since 1.36
 * @author Alexander Zizzo
 * @see fifty-framework/functions/options.php -> 'toggle_wpadminbar' ID
 */
function wpadminbar( $args = NULL )
{
  // If user is logged in and the option is set
  if ( is_user_logged_in() && of_get_option( 'toggle_wpadminbar', '1' ) && of_get_option( 'toggle_wpadminbar' ) !== 'wpadminbar_on' ) :

    // If the option is set to hide the admin bar
    if ( of_get_option( 'toggle_wpadminbar' ) == 'wpadminbar_off' ) : ?>
        
      <?php do_action( 'FFW_style_override', array(
        '#wpadminbar'       => 'display:none !important;',
        'html, * html body' => 'margin-top: 0px !important;'
      )); ?>

    <?php endif; 

    // If the option is set the admin bar to fixed positioning
    if ( of_get_option( 'toggle_wpadminbar' ) == 'wpadminbar_fixed' ) : ?>

      <?php do_action( 'FFW_style_override', array(
        '#wpadminbar'       => 'position:fixed !important;',
        'html, * html body' => 'margin-top: 32px !important;'
      )); ?>

    <?php endif; ?>

  <?php endif;
}
add_action( 'FFW_wpadminbar', 'wpadminbar' );






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
    $analytics_str  = '<!-- ==================== -->';
    $analytics_str .= '<!--       ANALYTICS      -->';
    $analytics_str .= '<!-- ==================== -->';
    $analytics_str .= '<script type="text/javascript">';
    $analytics_str .= of_get_option( 'analytics_js_code' );
    $analytics_str .= '</script>';

    echo $analytics_str;

  } else {
    return null;
  }
}
add_action( 'FFW_analytics_code', 'analytics_js' );




/**
 * Page Stats Debugging
 * Display some stats in the console
 * @author Alexander Zizzo
 * @since 1.4
 * @todo Migrate to option toggleable
 */
function site_stats_log( $args = NULL )
{

  // globals
  global $post, $wp_query, $template;

  // vars
  $page_name     = get_the_title();
  $query_count   = get_num_queries();
  $time_til      = timer_stop( 0, 3 );
  $mem_usage     = (memory_get_peak_usage() / 1024 / 1024 );
  
  // Template 
  $template    = explode( '/', $template );
  $array_count = count( $template );
  $array_count = $array_count - 1;
  $template    = $template[$array_count];


  if ( of_get_option('debug_template_name') ) { ?>
  
    <script>console.log('Page Name:  %c <?php echo $page_name; ?>', 'font-weight:bold; text-transform:uppercase; color: #bada55');</script>
    <script>console.log('Template:   %c <?php echo $template; ?>', 'font-weight:bold; text-transform:uppercase; color: #7db8db');</script>
    <script>console.log('Queries:    %c <?php echo $query_count; ?>', 'font-weight:bold; text-transform:uppercase; color: #b89555');</script>
    <script>console.log('Rendered:   %c <?php echo $time_til; ?>', 'font-weight:bold; text-transform:uppercase; color: #db7bbe');</script>
    <script>console.log('Mem Usage:  %c <?php echo $mem_usage; ?>', 'font-weight:bold; text-transform:uppercase; color: #f4005f');</script>
  
  <?php }
}
add_action( 'FFW_site_stats_log', 'site_stats_log' );
