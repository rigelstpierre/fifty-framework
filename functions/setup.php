<?php 

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Fifty Framework supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @package Fifty and Fifty
 * @author Bryan Monzon & Alexander Zizzo
 * @since 1.0
 * @return void
 */


function FFW_add_theme_features() {
  // Text Domain
  load_theme_textdomain('fifty-framework', get_template_directory() . 'languages' );

  // Automatic Feed Links
  add_theme_support( 'automatic-feed-links' );
  
  // HTML5
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

  // Post Formats
  add_theme_support( 'post-formats', array(
    'audio', 'video', 'gallery', 'image', 'link', 'quote'
  ) );

  // Custom Header
  add_theme_support( 'custom-header', array(
      'default-image'          => '',
      'random-default'         => false,
      'width'                  => 0,
      'height'                 => 0,
      'flex-height'            => false,
      'flex-width'             => false,
      'default-text-color'     => '',
      'header-text'            => false,
      'uploads'                => true,
      'wp-head-callback'       => '',
      'admin-head-callback'    => '',
      'admin-preview-callback' => '',
  ) );

  // Post Thumbnails (Featured Image)
  add_theme_support( 'post-thumbnails' );

}
add_action( 'after_setup_theme', 'FFW_add_theme_features', 11 );





/**
 * Nav Menus
 * @since 1.0
 */
function FFW_add_theme_nav_menus() {

  // Menus
  register_nav_menus ( array(
    'header_menu' => __( 'Header Menu', 'FFW' ),
    'footer_menu' => __( 'Footer Menu', 'FFW' )
  ) );


  function standard_fallback_nav_menu( ) {
    wp_page_menu( 'show_home=1&include=-1' );
  }
}
add_action( 'init', 'FFW_add_theme_nav_menus' );





/**
 * Register Sidebars
 * @package Fifty Framework
 * @since 1.0
 * @return void
 */
function FFW_add_theme_sidebars() {

  if( function_exists( 'register_sidebar' ) ){

     // DEFAULT
    register_sidebar( array(
      'name'          => __( 'Sidebar Default', 'FFW' ),
      'id'            => 'sidebar_default',
      'description'   => __( 'Appears in pages and the blog.', 'FFW' ),
      'before_widget' => '<aside id="%1$s" class="widget %2$s">',
      'after_widget'  => '<div class="separator"></div></aside>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ) );

    if( function_exists( 'ffw_port_get_label_singular' ) && 
        function_exists( 'ffw_staff_get_label_singular' ) ){

        //Get labels from the plugin
        $portfolio_label_cap  = ucwords( ffw_port_get_label_singular() );
        $portfolio_label    = strtolower(ffw_port_get_label_singular() );

        $staff_label_cap  = ucwords( ffw_staff_get_label_singular() );
        $staff_label    = strtolower( ffw_staff_get_label_singular() );


    // PORTFOLIO
      register_sidebar( array(
        'name'          => __( $portfolio_label_cap . ' Sidebar', 'FFW' ),
        'id'            => $portfolio_label . '_default',
        'description'   => __( 'Appears on '. $portfolio_label .' detail pages.', 'FFW' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '<div class="separator"></div></aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
      ) );

    // STAFF
      register_sidebar( array(
        'name'          => __( $staff_label_cap . ' Sidebar', 'FFW' ),
        'id'            => $staff_label . '_default',
        'description'   => __( 'Appears on '. $staff_label .' detail pages.', 'FFW' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '<div class="separator"></div></aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
      ) );
    }
  }


}
add_action( 'widgets_init', 'FFW_add_theme_sidebars' );