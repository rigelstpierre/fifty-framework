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

/**
 * Simple function to set up the theme. 
 */
function FFW_add_theme_features()
{
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
  $custom_header_args = array(
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
      'admin-preview-callback' => ''
  );
  add_theme_support( 'custom-header', $custom_header_args );

  // Post Thumbnails (Featured Image)
  add_theme_support( 'post-thumbnails' );

}
add_action( 'after_setup_theme', 'FFW_add_theme_features', 11 );


/**
 * Strict Standards Toggle
 * @since 1.2
 */
$strict_standards_toggle_off = true;
if ( $strict_standards_toggle_off ) {
  ini_set('display_errors', '0');     # don't show any errors...
  error_reporting(E_ALL | E_STRICT);  # ...but do log them
}



/**
 * Nav Menus
 * @since 1.0
 */
function FFW_add_theme_nav_menus()
{

  // Menus
  register_nav_menus ( array(
    'header_menu' => __( 'Header Menu', 'FFW' ),
    'footer_menu' => __( 'Footer Menu', 'FFW' )
  ) );

  /**
   * I believe this function is a fallback for the nav menu
   * @todo    Remove "standard" from the function here and wherever it's called
   * @return  void
   */
  function standard_fallback_nav_menu( )
  {
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
function FFW_add_theme_sidebars()
{

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

    // FOOTER DEFAULT
    register_sidebar( array(
      'name'          => __( 'Footer Sidebar Default', 'FFW' ),
      'id'            => 'sidebar_footer_default',
      'description'   => __( 'Appears in pages and the blog.', 'FFW' ),
      'before_widget' => '<aside id="%1$s" class="footer-widget widget %2$s">',
      'after_widget'  => '</aside>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ) );

    //Conditionals based around a plugin in being installed
    if( function_exists( 'ffw_port_get_label_singular' ) ) {

      //Get labels from the plugin
      $portfolio_label_cap  = ucwords( ffw_port_get_label_singular() );
      $portfolio_label    = strtolower(ffw_port_get_label_singular() );

      // PORTFOLIO
      register_sidebar( array(
        'name'          => __( $portfolio_label_cap . ' Sidebar', 'FFW' ),
        'id'            => 'portfolio_default',
        'description'   => __( 'Appears on '. $portfolio_label .' detail pages.', 'FFW' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '<div class="separator"></div></aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
      ) );

    } //ffw_port_get_label_singular
        
    //Conditionals based around a plugin in being installed
    if( function_exists( 'ffw_staff_get_label_singular' ) ) {

    $staff_label_cap  = ucwords( ffw_staff_get_label_singular() );
    $staff_label      = strtolower( ffw_staff_get_label_singular() );

    // STAFF
      register_sidebar( array(
        'name'          => __( $staff_label_cap . ' Sidebar', 'FFW' ),
        'id'            => 'staff_default',
        'description'   => __( 'Appears on '. $staff_label .' detail pages.', 'FFW' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '<div class="separator"></div></aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
      ) );
    } //ffw_staff_get_label_singular
  } //register_sidebar
} //FFW_add_theme_sidebars
add_action( 'widgets_init', 'FFW_add_theme_sidebars' );





/**
 * This function removes some items from wp_head and cleans up the dashboard.
 * @since 1.1
 */
function ffw_security_and_cleanup()
{
  //REMOVE WORDPRESS VERSION IN THE HEADER FROM <head>
  remove_action('wp_head', 'wp_generator');

  //REMOVE WINDOWS LIVE WRITER CRAP FROM <head>
  remove_action('wp_head', 'wlwmanifest_link');

  //REMOVE RSS FEED LINKS FROM <head>
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'start_post_rel_link');
  remove_action('wp_head', 'index_rel_link');
  remove_action('wp_head', 'adjacent_posts_rel_link');

  //CLEAN UP THE DASHBOARD AND REMOVES THE WORDPRESS STUFF.
  function remove_dashboard_widgets() 
  {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
  } 
  add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );


  //add_action('admin_bar_menu', 'ffw_add_tool_bar_items', 100);
  function ffw_add_tool_bar_items( $admin_bar )
  {
    $admin_bar->add_menu( array(
      'id'    => 'fifty-fifty-menu',
      'title' => 'Fifty & Fifty Support',
      'href'  => '#',
      'meta'  => array(
        'title' => __('Fifty & Fifty Support')
      ),
    ));

    $admin_bar->add_menu( array(
      'id'    => 'fifty-fifty-sub-menu-emaio',
      'parent' => 'fifty-fifty-menu',
      'title' => 'Email',
      'href'  => 'mailto:braden@fiftyandfifty.org',
      'meta'  => array(
        'title' => __('Email'),
        'target' => '_blank',
        'class' => 'email_menu_item_class'
      ),
    ));

    $admin_bar->add_menu( array(
      'id'    => 'fifty-fifty-sub-menu-basecamp',
      'parent' => 'fifty-fifty-menu',
      'title' => 'Basecamp',
      'href'  => 'https://basecamp.com/2029646/',
      'meta'  => array(
        'title' => __('Basecamp'),
        'target' => '_blank',
        'class' => 'basecamp_menu_item_class'
      ),
    ));
  }
}
add_action( 'init', 'ffw_security_and_cleanup' );



