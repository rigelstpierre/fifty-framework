<?php
/**
 * Fifty Framework functions and definitions.
 *
 *
 * @package WordPress
 * @subpackage fiftyandfifty
 * @since Fifty and Fifty 1.0
 */


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


	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	* This theme supports Post Formats. If you want to remove them, comment this line.
	*
	*/
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	register_nav_menu('primary', __( 'Navigation Menu', 'fifty-framework' ) );

}
add_action( 'after_setup_theme', 'fiftyframework_setup' );


/**
 * Registers two widget areas.
 *
 * @since Fifty Framework 1.0
 *
 * @return void
 */
function fiftyframework_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'fifty-framework' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in pages and the blog.', 'fifty-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'fiftyframework_widgets_init' );