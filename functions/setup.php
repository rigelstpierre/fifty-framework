<?php 

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Fifty and Fifty 1.0
 *
 * @return void
 */

function fiftyframework_setup(){

  load_theme_textdomain('fifty-framework', get_template_directory() . 'languages' );

  // Automatic Feed Links
  add_theme_support( 'automatic-feed-links' );
  
  // HTML5
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

  /**
   * Post Formats
   * @since 1.0
   */
  add_theme_support( 'post-formats', array(
    'audio', 'video', 'gallery', 'image', 'link', 'quote'
  ) );

  /**
   * Nav Menus
   * @since 1.0
   */
  register_nav_menu('primary', __( 'Navigation Menu', 'fifty-framework' ) );

}
add_action( 'after_setup_theme', 'fiftyframework_setup' );