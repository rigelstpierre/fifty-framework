<?php
/**
 * A widget to display social links when provided URLs
 * @package Fifty Framework
 * @author Alexander Zizzo
 * @version 1.0
 * @since 1.0
 */
class FFW_Social_Links extends WP_Widget {

	/*--------------------------------------------------------*
	 * Constructor
	 *--------------------------------------------------------*/
	 
	public function __construct() {

		$widget_opts = array(
			'social_link_title' 		 => __( 'Title', 'FFW' ),
			'social_link_facebook'   => __( 'Facebook URL', 'FFW' ),
			'social_link_googleplus' => __( 'Google Plus URL', 'FFW' ),
			'social_link_twitter'    => __( 'Twitter URL', 'FFW' ),
		);	
		$this->WP_Widget( 'ffw-social-links', __( 'Social Links', 'FFW' ), $widget_opts );
		
		// We don't want to load these on the Appearance Options because we're overiding window.send_to_editor there, too.
		global $pagenow;
		if( 'themes.php' != $pagenow ) {
			
			add_action( 'admin_print_styles', array( &$this, 'register_admin_styles' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'register_admin_scripts' ) );
			
		} // end if
		
		add_action( 'wp_enqueue_scripts', array( &$this, 'register_widget_styles' ) );
		
	} // end constructor

	/*--------------------------------------------------------*
	 * API Functions
	 *--------------------------------------------------------*/
	 
	/**
	 * Outputs the content of the widget.
	 * @since 1.0
	 * @param The array of form elements
	 */
	public function widget( $args, $instance ) {
	
		extract( $args, EXTR_SKIP );
	
		$social_link_title      = empty( $instance['social_link_title']) ? '' : apply_filters( 'social_link_title', $instance['social_link_title'] );
		$social_link_facebook   = empty( $instance['social_link_facebook']) ? '' : apply_filters( 'social_link_facebook', $instance['social_link_facebook'] );
		$social_link_googleplus = empty( $instance['social_link_googleplus']) ? '' : apply_filters( 'social_link_googleplus', $instance['social_link_googleplus'] );
		$social_link_twitter    = empty( $instance['social_link_twitter']) ? '' : apply_filters( 'social_link_twitter', $instance['social_link_twitter'] );
		
		// Display the widget
		include( plugin_dir_path( __FILE__ ) .  'views/widget.php' );
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @new_instance	The previous instance of values before the update.
	 * @old_instance	The new instance of values to be generated via the update.
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		// we'll allow css and html, but no javascript
		$instance['social_link_title']      = preg_replace( '/<script\b[^>]*>(.*?)<\/script>/is', '', $new_instance['social_link_title'] );
		$instance['social_link_facebook']   = preg_replace( '/<script\b[^>]*>(.*?)<\/script>/is', '', $new_instance['social_link_facebook'] );
		$instance['social_link_googleplus'] = preg_replace( '/<script\b[^>]*>(.*?)<\/script>/is', '', $new_instance['social_link_googleplus'] );
		$instance['social_link_twitter']    = preg_replace( '/<script\b[^>]*>(.*?)<\/script>/is', '', $new_instance['social_link_twitter'] );
		
		return $instance;
		
	} // end widget
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @instance	The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args(
			(array)$instance,
			array(
				'social_link_title' 		 => '',
				'social_link_facebook'   => '',
				'social_link_googleplus' => '',
				'social_link_twitter'    => ''
			)
		);
    
		$social_link_title      = esc_textarea( $instance['social_link_title'] );
		$social_link_facebook   = esc_url( $instance['social_link_facebook'] );
		$social_link_googleplus = esc_url( $instance['social_link_googleplus'] );
		$social_link_twitter    = esc_url( $instance['social_link_twitter'] );
    
		// Display the admin form
		include( plugin_dir_path( __FILE__ ) .  'views/admin.php' );
		
	} // end form

	/*--------------------------------------------------------*
	 * Helper Functions
	 *--------------------------------------------------------*/

	/** 
	 * Registers and Enqueues the stylesheets for this widget.
	 */
	public function register_admin_styles() {
	
		wp_enqueue_style( 'thickbox' );
		
		wp_register_style( 'social-links-admin-style', get_template_directory_uri() . '/lib/widget-social_links/css/admin.css' );
		wp_enqueue_style( 'social-links-admin-style' );
		
	} // end register_admin_styles

	/** 
	 * Registers and Enqueues the JavaScript sources for  this widget.
	 */
	public function register_admin_scripts() {
	
		$screen = get_current_screen();

		if( 'widgets' == $screen->id ) {
				
			// thickbox for overlay
			wp_enqueue_script('thickbox');
	
			// admin
			wp_register_script( 'social-links-admin-js', get_template_directory_uri() . '/lib/widget-social_links/js/admin.js', array( 'jquery','thickbox') );
			wp_enqueue_script( 'social-links-admin-js' );
		
		} // end if
		
	} // end register_admin_scripts
	
	
	/** 
	 * Registers and Enqueues the stylesheets for this widget.
	 */
	public function register_widget_styles() {
	
		wp_register_style( 'social-links-widget-style', get_template_directory_uri() . '/lib/widget-social_links/css/widget.css' );
		wp_enqueue_style( 'social-links-widget-style' );
	
	} // end register_widget_styles

} // end class
add_action( 'widgets_init', create_function( '', 'register_widget( "FFW_Social_Links" );' ) ); 
?>