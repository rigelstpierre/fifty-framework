<?php
/**
 * File used to setup your theme options.
 * Theme options are located in your dashboard at Appreance->Theme Options
 *
 * @package WordPress
 * @subpackage Fifty Framework
 * @since 1.0
 */
 
function optionsframework_option_name() {
    $optionsframework_settings = get_option( 'optionsframework' );
    $optionsframework_settings['id'] = 'options_'.$theme_prefix.'themes';
    update_option( 'optionsframework', $optionsframework_settings);
}


// Begin options
function optionsframework_options() {

  $options = array();
  

  /**
   * General
   * @since 1.0
   */
  $options[] = array(
    'name'  => __( 'General', 'FFW' ),
    'type'  => 'heading'
  );

    // CUSTOM LOGO
    $options[] = array(
      'name' => __( 'Custom Logo', 'FFW' ),
      'desc' => __( 'Upload your custom logo.', 'FFW' ),
      'std'  => '',
      'id'   => 'custom_logo',
      'type' => 'upload'
    );


  /**
   * Slides (uses flexslider)
   * @since 1.0
   */
  $options[] = array(
    'name'  => __( 'Slides', 'FFW' ),
    'type'  => 'heading'
  );
        
  $options[] = array(
    'name' => __( 'Slides Enable', 'FFW' ),
    'desc' => __( 'Check this box to enable the slides post type.', 'FFW' ),
    'id'   => 'enable_slides',
    'std'  => '1',
    'type' => 'checkbox'
  );
        
  $options[] = array(
    "name" => __( 'Toggle: Slideshow', 'FFW' ),
    "desc" => __( 'Check this box to enable automatic slideshow for your slides.', 'FFW' ),
    "id"   => "slides_slideshow",
    "std"  => "true",
    "type" => "select",
    "options" => array(
      'true'  => 'true',
      'false' => 'false'
    ),
  );
    
  $options[] = array(
    "name" => __( 'Toggle: Randomize', 'FFW' ),
    "desc" => __( 'Check this box to enable the randomize feature for your slides.', 'FFW' ),
    "id"   => "slides_randomize",
    "std"  => "false",
    "type" => "select",
    "options" => array(
      'true'  => 'true',
      'false' => 'false'
    ),
  );
    
  $options[] = array(
    "name" => __( 'Animation', 'FFW' ),
    "desc" => __( 'Select your animation of choice.', 'FFW' ),
    "id"   => "slides_animation",
    "std"  => "slide",
    "type" => "select",
    "options" => array(
      'fade'  => 'fade',
      'slide' => 'slide'
    ),
  );
    
  $options[] = array(
    "name" => __( 'Direction', 'FFW' ),
    "desc" => __( 'Select the direction for your slides. Slide animation only & if using the <strong>vertical direction</strong> all slides must have the same height.', 'FFW' ),
    "id"   => "slides_direction",
    "std"  => "horizontal",
    "type" => "select",
    "options" => array(
      'horizontal' => 'horizontal',
      'vertical'   => 'vertical'
    ),
  );
    
  $options[] = array(
    "name" => __( 'SlideShow Speed', 'FFW' ),
    "desc" => __( 'Enter your preferred slideshow speed in milliseconds.', 'FFW' ),
    "id"   => "slideshow_speed",
    "std"  => "7000",
    "type" => "text" ,
  );
    
  $options[] = array(
    "name" => __( 'Animation Speed', 'FFW' ),
    "desc" => __( 'Enter your preferred animation speed in milliseconds.', 'FFW' ),
    "id"   => "animation_speed",
    "std"  => "600",
    "type" => "text"
  );


  
  /**
   * Blog
   * @since 1.0
   */
  $options[] = array(
    'name'  => __( 'Blog', 'FFW' ),
    'type'  => 'heading',
  );
    
    // FEATURED POST ON SINGLE
    $options[] = array(
      "name" => __( 'Toggle: Featured Images On Single Blog Posts', 'FFW' ),
      "desc" => __( 'Check this box to enable featured images on single blog posts.', 'FFW' ),
      "id"   => "blog_single_thumbnail",
      "std"  => "1",
      "type" => "checkbox",
    );

  return $options;
}