<?php 

/**
 * Registers two widget areas (sidebars)
 * @package Fifty Framework
 * @since 1.0
 * @return void
 */

function fiftyframework_widgets_init() {

  /* DEFAULT
  ================================================== */
  register_sidebar( array(
    'name'          => __( 'Sidebar Default', 'FFW' ),
    'id'            => 'sidebar_default',
    'description'   => __( 'Appears in pages and the blog.', 'FFW' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '<div class="separator"></div></aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Sidebar Footer Default', 'FFW' ),
    'id'            => 'sidebar_footer_default',
    'description'   => __( 'Default footer sidebar.', 'FFW' ),
    'before_widget' => '<div id="%1$s" class="footer-widget widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

}
add_action( 'widgets_init', 'fiftyframework_widgets_init' );