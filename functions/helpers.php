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


}