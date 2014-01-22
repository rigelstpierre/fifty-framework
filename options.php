<?php
/**
 * File used to setup your theme options.
 * Theme options are located in your dashboard at Appreance->Theme Options
 *
 * @package WordPress
 * @subpackage Fifty Framework
 * @since 1.0
 */
 
function optionsframework_option_name()
{
    $optionsframework_settings = get_option( 'optionsframework' );
    $optionsframework_settings['id'] = 'options_'.$theme_prefix.'themes';
    update_option( 'optionsframework', $optionsframework_settings);
}


// Begin options
function optionsframework_options()
{

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

    // TOGGLE CORE APP.JS
    $options[] = array(
      'name' => __( 'Application Javascript', 'FFW' ),
      'desc' => __( 'Toggle on/off the parent theme (fifty-framework) application javascript (app.js)', 'FFW' ),
      'id'   => 'toggle_app_js',
      'std'  => '0',
      'type' => 'checkbox'
    );


    // TOGGLE SIDEBAR ON/OFF
    $options[] = array(
      'name' => __( 'Enable Sidebar', 'FFW' ),
      'desc' => __( 'Toggle on/off the sidebars globally.', 'FFW' ),
      'id'   => 'toggle_sidebar',
      'std'  => '0',
      'type' => 'checkbox'
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

    // GOOGLEPLUS
    $options[] = array(
      'name' => __( 'Google Plus URL', 'FFW' ),
      'std'  => '',
      'id'   => 'social_url_googleplus',
      'type' => 'text'
    );

    // TWITTER
    $options[] = array(
      'name' => __( 'Twitter URL', 'FFW' ),
      'std'  => '',
      'id'   => 'social_url_twitter',
      'type' => 'text'
    );
      // TWITTER CLIENT ID
      $options[] = array(
        'name'  => __( 'Twitter Client ID', 'FFW' ),
        'std'   => '',
        'id'    => 'social_url_twitter_client_id',
        'type'  => 'text',
        'class' => 'sub-section'
      );
      // TWITTER CLIENT SECRET
      $options[] = array(
        'name'  => __( 'Twitter Client Secret', 'FFW' ),
        'std'   => '',
        'id'    => 'social_url_twitter_client_secret',
        'type'  => 'text',
        'class' => 'sub-section'
      );

    // INSTAGRAM
    $options[] = array(
      'name' => __( 'Instagram URL', 'FFW' ),
      'std'  => '',
      'id'   => 'social_url_instagram',
      'type' => 'text'
    );
      // INSTAGRAM CLIENT ID
      $options[] = array(
        'name'  => __( 'Instagram Client ID', 'FFW' ),
        'std'   => '',
        'id'    => 'social_url_instagram_client_id',
        'type'  => 'text',
        'class' => 'sub-section'
      );
      // INSTAGRAM CLIENT SECRET
      $options[] = array(
        'name'  => __( 'Instagram Client Secret', 'FFW' ),
        'std'   => '',
        'id'    => 'social_url_instagram_client_secret',
        'type'  => 'text',
        'class' => 'sub-section'
      );

    // YOUTUBE
    $options[] = array(
      'name' => __( 'Youtube URL', 'FFW' ),
      'std'  => '',
      'id'   => 'social_url_youtube',
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
   * Colors
   * @since 1.0
   */
  $options[] = array(
    'name'  => __( 'Colors', 'FFW' ),
    'type'  => 'heading',
  );
    // COLORS ENABLE
    $options[] = array(
      'name' => __( 'Enable Custom Colors', 'FFW' ),
      'desc' => __( 'Check this box to enable the output of custom color styles/classes.', 'FFW' ),
      'id'   => 'enable_colors',
      'std'  => '1',
      'type' => 'checkbox'
    );
    
    // HEADER - BG
    $options[] = array(
      "name" => __( 'Header - Background Color', 'FFW' ),
      "desc" => __( 'The background color of the header area', 'FFW' ),
      "id"   => "header_color_bg",
      "std"  => "1",
      "type" => "color",
    );
    // HEADER - TEXT
    $options[] = array(
      "name" => __( 'Header - Text Color', 'FFW' ),
      "desc" => __( 'The color of the text in the header (nav) area. This includes links', 'FFW' ),
      "id"   => "header_color_text",
      "std"  => "1",
      "type" => "color",
    );
    // HEADER - TEXT HOVER
    $options[] = array(
      "name" => __( 'Header - Text Color Hover', 'FFW' ),
      "desc" => __( 'The hover color of the links in the header (nav) area.', 'FFW' ),
      "id"   => "header_color_text_hover",
      "std"  => "1",
      "type" => "color",
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





  /**
   * Analytics
   * @since 1.0
   */
  $options[] = array(
    'name'  => __( 'Analytics', 'FFW' ),
    'type'  => 'heading'
  );

    // CUSTOM LOGO
    $options[] = array(
      'name' => __( 'Analytics Javascript Code', 'FFW' ),
      'desc' => __( '<b>IMPORTANT</b> - DO NOT include the &lt;script&gt; opening and closing tags.', 'FFW' ),
      'std'  => '',
      'id'   => 'analytics_js_code',
      'type' => 'textarea'
    );






  /**
   * Debugging
   * @since 1.0
   */
  $options[] = array(
    'name'  => __( 'Debugging', 'FFW' ),
    'type'  => 'heading',
  );
    
    // TOGGLE ON/OF DEBUGGING BOX
    $options[] = array(
      'name' => __( 'Debug Box Enable', 'FFW' ),
      'desc' => __( 'Check this box to enable the debug box', 'FFW' ),
      'id'   => 'enable_debug',
      'std'  => '1',
      'type' => 'checkbox'
    );


    // SHOW TEMPLATE NAME IN JS CONSOLE
    $options[] = array(
      'name' => __( 'Template Debugging', 'FFW' ),
      'desc' => __( 'Check box to show page template name in JS console', 'FFW' ),
      'id'   => 'debug_template_name',
      'std'  => '0',
      'type' => 'checkbox'
    );

    

    // TOGGLE WPADMINBAR
    /* 
      Example WPADMINBAR <style> output:
      ----------------------------------
      <style type="text/css" media="screen">
        html, * html body { margin-top: 32px !important; }
        @media screen and ( max-width: 782px ) { html, * html body { margin-top: 46px !important; } }
      </style>
     */
    $options[] = array(
      'name'    => __( 'Toggle WPADMINBAR', 'FFW' ),
      'desc'    => __( 'Toggle on/off the top fixed bar when logged in', 'FFW' ),
      'id'      => 'toggle_wpadminbar',
      'std'     => '1',
      'type' => 'select',
      'options' => array(
        'wpadminbar_on'    => 'Leave admin bar as normal', 
        'wpadminbar_off'   => 'Turn OFF (hide) the admin bar', 
        'wpadminbar_fixed' => 'Turn ON fixed positioning for the admin bar'
      ),
    );


  /**
   * Scripts
   * @since 1.0
   */
  $options[] = array(
    'name'  => __( 'Scripts', 'FFW' ),
    'type'  => 'heading'
  );
    // SKROLLR
    $options[] = array(
      'name' => __( 'Toggle ON/OFF <b>skrollr.js</b>', 'FFW' ),
      'desc' => __( 'Check to ENABLE, uncheck to DISABLE', 'FFW' ),
      'id'   => 'toggle_js_skrollr',
      'std'  => '1',
      'type' => 'checkbox'
    );
    // ENQUIRE
    $options[] = array(
      'name' => __( 'Toggle ON/OFF <b>enquire.js</b>', 'FFW' ),
      'desc' => __( 'Check to ENABLE, uncheck to DISABLE', 'FFW' ),
      'id'   => 'toggle_js_enquire',
      'std'  => '1',
      'type' => 'checkbox'
    );
    // BACKSTRETCH
    $options[] = array(
      'name' => __( 'Toggle ON/OFF <b>backstretch.js</b>', 'FFW' ),
      'desc' => __( 'Check to ENABLE, uncheck to DISABLE', 'FFW' ),
      'id'   => 'toggle_js_backstretch',
      'std'  => '1',
      'type' => 'checkbox'
    );



  return $options;
}