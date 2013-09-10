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
 * Theme Setup
 * @since 1.0
 */
require_once( get_template_directory() .'/functions/setup.php' );
require_once( get_template_directory() .'/functions/scripts.php' );


/**
 * Functions
 * @since 1.0
 */

// Actions & Hooks
require_once( get_template_directory() .'/functions/actions.php' );

// Components
require_once( get_template_directory() .'/functions/widgets.php' );
