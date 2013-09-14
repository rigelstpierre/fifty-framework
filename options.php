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
   * Social
   * @since 1.0
   */
  $options[] = array(
    'name'  => __( 'Social', 'FFW' ),
    'type'  => 'heading'
  );

    // FACEBOOK
    $options[] = array(
      'name' => __( 'Facebook URL', 'FFW' ),
      'std'  => '',
      'id'   => 'social_url_facebook',
      'type' => 'text'
    );
    // TWITTER
    $options[] = array(
      'name' => __( 'Google Plus URL', 'FFW' ),
      'std'  => '',
      'id'   => 'social_url_googleplus',
      'type' => 'text'
    );
    // GOOGLE PLUS
    $options[] = array(
      'name' => __( 'Twitter URL', 'FFW' ),
      'std'  => '',
      'id'   => 'social_url_twitter',
      'type' => 'text'
    );





  /**
   * Slides (uses flexslider)
   * @since 1.0
   */
  $options[] = array(
    'name'  => __( 'Slides', 'FFW' ),
    'type'  => 'heading'
  );
    
    // SLIDES ENABLE
    $options[] = array(
      'name' => __( 'Slides Enable', 'FFW' ),
      'desc' => __( 'Check this box to enable the slides post type.', 'FFW' ),
      'id'   => 'enable_slides',
      'std'  => '1',
      'type' => 'checkbox'
    );
          
    // SLIDE ANIMATION TYPE
    $options[] = array(
      "name" => __( 'Animation', 'FFW' ),
      "desc" => __( 'Select your animation of choice.', 'FFW' ),
      "id"   => "slider_animation",
      "std"  => "slide",
      "type" => "select",
      "options" => array(
        'fade'  => 'fade',
        'slide' => 'slide'
      ),
    );
      
    // SLIDE DIRECTION
    $options[] = array(
      "name" => __( 'Direction', 'FFW' ),
      "desc" => __( 'Select the direction for your slides. Slide animation only & if using the <strong>vertical direction</strong> all slides must have the same height.', 'FFW' ),
      "id"   => "slider_direction",
      "std"  => "horizontal",
      "type" => "select",
      "options" => array(
        'horizontal' => 'horizontal',
        'vertical'   => 'vertical'
      ),
    );

    // SLIDE DIRECTION NAV PREVIOUS TEXT
    $options[] = array(
      "name" => __( 'Slider Previous Text', 'FFW' ),
      "desc" => __( 'Enter the Arrrows font character to use for the PREVIOUS button.', 'FFW' ),
      "id"   => "slider_prev_text",
      "std"  => "N",
      "type" => "text" ,
    );

    // SLIDE DIRECTION NAV NEXT TEXT
    $options[] = array(
      "name" => __( 'Slider Next Text', 'FFW' ),
      "desc" => __( 'Enter the Arrrows font character to use for the NEXT button.', 'FFW' ),
      "id"   => "slider_next_text",
      "std"  => "n",
      "type" => "text" ,
    );
    
    // SLIDE SPEED
    $options[] = array(
      "name" => __( 'Slider Speed', 'FFW' ),
      "desc" => __( 'Enter your preferred slider speed in milliseconds.', 'FFW' ),
      "id"   => "slider_slide_speed",
      "std"  => "7000",
      "type" => "text" ,
    );
    // SLIDE ANIMATION SPEED
    $options[] = array(
      "name" => __( 'Animation Speed', 'FFW' ),
      "desc" => __( 'Enter your preferred animation speed in milliseconds.', 'FFW' ),
      "id"   => "slider_animation_speed",
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

    // SIDEBAR POSITION
    $options[] = array(
      'name' => __( 'Sidebar Position', 'FFW' ),
      'desc' => __( 'Select where you want your sidebar positioned.', 'FFW' ),
      'std'  => '1',
      'id'   => 'sidebar_position_blog',
      'type' => 'select',
      'options' => array(
        'left'  => 'left',
        'right' => 'right'
      ),
    );

  return $options;
}