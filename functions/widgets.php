<?php 

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