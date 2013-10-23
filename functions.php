<?php
/**
 * Fifty Framework functions and definitions.
 * USAGE: comment out undesired function files. 
 *
 * @package WordPress
 * @subpackage fiftyandfifty
 * @since Fifty and Fifty 1.0
 */


/**
 * Debugging
 */
$debug = false;

if ( $debug ) {
	ini_set('display_errors','On');
	error_reporting(E_ALL);
	define('WP_USE_THEMES', false);
}

/**
 * Global Variables
 */
$theme_prefix = 'FFW_';


/**
* Define Constants
*/
define( $theme_prefix . 'JS_DIR', get_template_directory_uri().'/assets/js' );
define( $theme_prefix . 'CSS_DIR', get_template_directory_uri().'/assets/css' );



/**
 * Set Up ACF Fields
 * @since  1.1
 */
global $acf;
 
if( !$acf ){
    define( 'ACF_LITE' , false );
    include_once('advanced-custom-fields/acf.php' );
    require_once( get_template_directory() . '/functions/acf_register_fields.php' );
}

/**
 * Theme Setup
 * @since 1.0
 */
require_once( get_template_directory() .'/functions/setup.php' );
require_once( get_template_directory() .'/functions/scripts.php' );
require_once( get_template_directory() .'/functions/load-admin.php' );
require_once( get_template_directory() .'/functions/helpers.php' );
require_once( get_template_directory() .'/functions/shortcodes.php' );

/**
 * Load Hybrid Core Framework
 * @since  1.1
 */
/* Load the core theme framework. */

/*
require_once( trailingslashit( get_template_directory() ) . 'hybrid-core/hybrid.php' );
new Hybrid();

add_action( 'after_setup_theme', 'ffw_hybrid_core_setup', 10 );
function ffw_hybrid_core_setup() {


}
*/




/**
 * Widgets
 * @since 1.0
 */

// Mr MetaBox
if(!class_exists('mrMetaBox')) {
  define('MRMETABOX_URL', TEMPLATEPATH . '/admin/mr-meta-box/');
  require_once(MRMETABOX_URL . 'mr-meta-box.php');
}
// Widgets (FFW Custom)
require_once( get_template_directory() .'/lib/widget-author_info/plugin.php');
require_once( get_template_directory() .'/lib/widget-social_links/plugin.php');


/**
 * Functions
 * @since 1.0
 */

// Actions & Hooks
require_once( get_template_directory() .'/functions/actions.php' );

// Components
require_once( get_template_directory() .'/functions/comments.php' );
require_once( get_template_directory() .'/functions/pagination.php' );

// Post Types
if ( of_get_option ( 'enable_slides', '1' ) ) {
  require_once( get_template_directory() .'/functions/post-types/slides.php' );
  require_once( get_template_directory() .'/functions/meta/slides.php' );
}



// Metaboxes
require_once( get_template_directory() .'/functions/meta/post-formats.php' );

// Debugging Helper
if ( of_get_option ( 'enable_debug', '1' ) ) {
  require_once( get_template_directory() .'/functions/debug.php' );
}




/**
 * Admin Styles
 * @since 1.0
 */
function FFW_add_admin_styles_scripts() {

  wp_register_script( 'widget-admin-style', get_template_directory_uri() . '/lib/js/admin.widgets.js' );
  wp_enqueue_script( 'widget-admin-style' );

  wp_register_style( 'ffw-admin-scripts', get_template_directory_uri() . '/lib/css/admin.css' );
  wp_enqueue_style( 'ffw-admin-scripts' );
}
add_action( 'admin_print_styles', 'FFW_add_admin_styles_scripts' );

