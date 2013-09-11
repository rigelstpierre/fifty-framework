<?php
add_action('init', 'FFW_scripts_styles');

/**
 * FFW_scripts_styles
 * Add the scripts & styles. Some examples may be left commented out. 
 * @since 1.0
 * @author Alexander Zizzo
 */
function FFW_scripts_styles(){

  /**
   * Styles
   */
  wp_register_style( 'style',  get_stylesheet_directory_uri().'/style.css' );
  

  /**
   * Javascripts
   */

  // vendor
  wp_register_script('flexslider', get_template_directory_uri() . '/assets/js/vendor/jquery.flexslider.js', array('jquery'),'',true );
  wp_register_script('scrollTo', get_template_directory_uri() . '/assets/js/vendor/jquery.scrollTo.js', array('jquery'),'',true );
  wp_register_script('easing', get_template_directory_uri() . '/assets/js/vendor/jquery.easing.min.js', array('jquery'),'',true );
  wp_register_script('skrollr', get_template_directory_uri() . '/assets/js/vendor/skrollr.js', array('jquery'),'',true );
  
  // page specific
  // wp_register_script('example', get_template_directory_uri() . '/assets/js/vendor/example.js', array('jquery'),'',true );
  
  // application
  wp_register_script('app', get_template_directory_uri() . '/assets/js/app.js', array('jquery'),'',true );


  /**
   * Ajax Localize
   */
  wp_localize_script( 'app', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );



  /**
   * Enqueue Scripts & Styles
   */
  add_action('wp_enqueue_scripts', function(){
    wp_enqueue_style('style');
    
    wp_enqueue_script('jquery');
    wp_enqueue_script('easing');
    wp_enqueue_script('scrollTo');
    // wp_enqueue_script('skrollr');
    wp_enqueue_script('flexslider');
    wp_enqueue_script('app');

    // if ( is_page('example') ) { wp_enqueue_script('example'); }

  });
  

  /**
   * Admin Styles & Scripts
   */
  // wp_register_style( 'admin',  get_stylesheet_directory_uri().'/admin/admin.css' );
  // wp_register_script('admin', get_template_directory_uri().'/admin/admin.js', array('jquery'));
  
  add_action('admin_enqueue_scripts', function(){
    // wp_enqueue_style('admin');
    // wp_enqueue_script('admin');
  });
}



