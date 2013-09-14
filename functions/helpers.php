<?php 

add_action( 'init', 'FFW_helper_functions' );

function FFW_helper_functions() {


  /**
   * get_widgets_count
   * Get the number of widgets in a given sidebar
   * @author Alexander Zizzo
   * @since 1.0
   */
  function get_widgets_count( $sidebar_id ) {
    $sidebars_widgets = wp_get_sidebars_widgets();
    return (int) count( (array) $sidebars_widgets[ $sidebar_id ] );
  }


  /**
   * set_widget_count_class
   * Do a switch after getting the # of widgets to set the css class,
   * and return it to echo out inside the parent element
   * @author Alexander Zizzo
   * @since 1.0
   */
  function set_widget_count_class( $sidebar_id ) {
    $widget_count = get_widgets_count($sidebar_id);

    switch( $widget_count ):
      case 1:
        $w_class = 'single';
        break;
      case 2:
        $w_class = 'halves';
        break;
      case 3:
        $w_class = 'thirds';
        break; 
      case 4:
        $w_class = 'fourths';
        break;
      case 0:
      default:
        $w_class = 'none';
        break;
    endswitch;

    return $w_class;
  }


  /**
   * get_sidebar_position_class()
   * Get the sidebar position and set classes accordingly
   * @since 1.0
   */
  function get_sidebar_position_class() {
    $sidebar_position_class = of_get_option ( 'sidebar_position_blog' );
    return $sidebar_position_class;
  }
  function sidebar_position_class() {
    echo get_sidebar_position_class();
  }



  /**
   * FFW_move_textarea
   * Take the textarea code out of the default fields and print it on top.
   *
   * @param  array $input Default fields if called as filter
   * @since 1.0
   * @author Alexander Zizzo
   * @return string|void
   */
  function FFW_move_textarea( $input = array () )
  {
      static $textarea = '';

      if ( 'comment_form_defaults' === current_filter() )
      {
          // Copy the field to our internal variable …
          $textarea = $input['comment_field'];
          // … and remove it from the defaults array.
          $input['comment_field'] = '';
          return $input;
      }

      print apply_filters( 'comment_form_field_comment', $textarea );
  }
  add_filter( 'comment_form_defaults', 'FFW_move_textarea' );
  add_action( 'comment_form_top', 'FFW_move_textarea' );

}