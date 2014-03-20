<?php
/**
 * FFW_scripts_styles
 * Add the scripts & styles. Some examples may be left commented out. 
 * @since 1.0
 * @author Alexander Zizzo
 */
add_action('init', 'FFW_scripts_styles');
function FFW_scripts_styles()
{

  /**
   * Styles
   * @TEMP Select 1000px Grid, or 960px Grid without Media Queries in Theme Options
   */
  // 1000px
  if ( of_get_option( 'toggle_1000px_grid' ) && of_get_option( 'toggle_1000px_grid', '1' ) ) {
    wp_register_style( 'style',  get_template_directory_uri().'/assets/css/style-1000px.css' );
  }
  // no media queries
  if ( of_get_option( 'toggle_no_media_query_grid' ) && of_get_option( 'toggle_no_media_query_grid', '1' ) ) {
    wp_register_style( 'style',  get_template_directory_uri().'/assets/css/style-no-media-queries.css' );
  }
  // default 960px with media queries
  if ( !of_get_option( 'toggle_1000px_grid' ) && !of_get_option( 'toggle_no_media_query_grid' ) ) {
    wp_register_style( 'style',  get_template_directory_uri().'/assets/css/style.min.css' );
  }

  /**
   * Javascripts
   */

  // vendor
  wp_register_script('flexslider', get_template_directory_uri() . '/assets/js/vendor/jquery.flexslider.js', array('jquery'),'',false );
  // wp_register_script('jqmobile', get_template_directory_uri() . '/assets/js/vendor/jquery.mobile.min.js', array('jquery'),'',true );
  wp_register_script('scrollTo', get_template_directory_uri() . '/assets/js/vendor/jquery.scrollTo.js', array('jquery'),'',true );
  wp_register_script('easing', get_template_directory_uri() . '/assets/js/vendor/jquery.easing.1.3.js', array('jquery'),'',true );
  wp_register_script('fitvid', get_template_directory_uri() . '/assets/js/vendor/jquery.fitvid.min.js', array('jquery'),'',true );
  wp_register_script('animo', get_template_directory_uri() . '/assets/js/vendor/animo.js', array('jquery'),'',true );
  
  wp_register_script('skrollr', get_template_directory_uri() . '/assets/js/vendor/skrollr.js', array('jquery'),'',true );
  wp_register_script('enquire', get_template_directory_uri() . '/assets/js/vendor/enquire.min.js', array('jquery'),'',true );
  wp_register_script('backstretch', get_template_directory_uri() . '/assets/js/vendor/jquery.backstretch.min.js', array('jquery'),'',true );
  wp_register_script('magnific-popup', get_template_directory_uri() . '/assets/js/vendor/jquery.magnific-popup.min.js', array('jquery'),'',true );
  wp_register_script('sticky', get_template_directory_uri() . '/assets/js/vendor/jquery.sticky.js', array('jquery'),'',true );

  // page specific
  // wp_register_script('example', get_template_directory_uri() . '/assets/js/vendor/example.js', array('jquery'),'',true );
  
  // toggle app.js in options
  if ( of_get_option( 'toggle_app_js', '1' ) ) {
    // wp_register_script('app', get_template_directory_uri() . '/assets/js/app.js', array('jquery'),'',true );
    wp_register_script('app_min', get_template_directory_uri() . '/assets/js/app.min.js', array('jquery'),'',true );
  }
  

  /**
   * Ajax Localize
   */
  wp_localize_script( 'app', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );



  /**
   * Enqueue Scripts & Styles
   */
  add_action('wp_enqueue_scripts', 'FFW_enqueue_scripts' );
  function FFW_enqueue_scripts()
  {
    wp_enqueue_style('style');
    
    wp_enqueue_script('jquery');
    
    wp_enqueue_script('easing');
    wp_enqueue_script('scrollTo');
    wp_enqueue_script('flexslider');
    wp_enqueue_script('fitvid');
    wp_enqueue_script('sticky');
    wp_enqueue_script('animo');

    // toggle-able scripts in options
    // if ( of_get_option( 'toggle_js_jqmobile', '1' ) ) wp_enqueue_script('jqmobile');        // JQUERY MOBILE (js media queries)
    if ( of_get_option( 'toggle_js_skrollr', '1' ) ) wp_enqueue_script('skrollr');          // SKROLLR (parallax in markup)
    if ( of_get_option( 'toggle_js_enquire', '1' ) ) wp_enqueue_script('enquire');          // ENQUIRE (js media queries)
    if ( of_get_option( 'toggle_js_backstretch', '1' ) ) wp_enqueue_script('backstretch');  // BACKSTRETCH (dynamic image resizing assistance)

    
    /**
     * Disabled Scripts - WIP
     * @author Alexander Zizzo
     * @since 1.36
     */
    // wp_enqueue_script('magnific-popup');

    // toggle app.js in options
    if ( of_get_option( 'toggle_app_js', '1' ) ) {
      wp_enqueue_script('app_min');
    }

    

    // if ( is_page('example') ) { wp_enqueue_script('example'); }

  }
  

  /**
   * Admin Styles & Scripts
   */
  // wp_register_style( 'admin',  get_stylesheet_directory_uri().'/admin/admin.css' );
  // wp_register_script('admin', get_template_directory_uri().'/admin/admin.js', array('jquery'));
  
  add_action('admin_enqueue_scripts', 'FFW_admin_scripts' );
  function FFW_admin_scripts()
  {
    // wp_enqueue_style('admin');
    // wp_enqueue_script('admin');
  }
  

  //add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
  function mw_enqueue_color_picker( $hook_suffix ) {
      // first check that $hook_suffix is appropriate for your admin page
      wp_enqueue_style( 'wp-color-picker' );
      wp_enqueue_script( 'ffw-color-picker', get_template_directory_uri('assets/js/colorpicker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
  }

}



