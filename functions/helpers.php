<?php 

add_action( 'init', 'FFW_helper_functions' );

function FFW_helper_functions() {

  /**
   * pp()
   * Pretty print data
   * @author Alexander Zizzo
   * @since 1.0
   */
  function pp( $data ) {
    print '<pre style="color:#1c1c1c;">';
    print_r($data);
    print '</pre>';
  }
  function pp_meta() { global $post; pp(get_post_meta($post->ID)); }


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
   * @package Fifty Framework
   * @author Alexander Zizzo
   * @return string|void
   * @since 1.0
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



  /**
   * get_video_service()
   * Identify the video hosting service (Youtube, Vimeo, etc);
   * @author Alexander Zizzo
   * @package Fifty Framework
   * @since 1.0
   * @return (string) video service name
   */
  function get_video_service( $url ) {
    $url = preg_replace('#\#.*$#', '', trim($url));

    $services_regexp = array(
      "#^\w+\.(?P<format>[a-zA-Z0-9]{2,5})#"                     => 'local',
      '#vimeo\.com\/(?P<id>[0-9]*)[\/\?]?#i'                     => 'vimeo',
      '#youtube\.[a-z]{0,5}/.*[\?&]?v(?:\/|=)?(?P<id>[^&]*)#i'   => 'youtube'
    );

    foreach ( $services_regexp as $pattern => $service ) {
      if ( preg_match ( $pattern, $url, $matches ) ) {
        return ( $service === 'local' ) ? $matches['format']  : $service;
      }
    }
    return false;
  }
  /**
   * get_video_id()
   * Use regex to grab the video ID contained in the URL
   * @author Alexander Zizzo
   * @package Fifty Framework
   * @since 1.0
   * @return (string) the video id
   */
  function get_video_id( $url ) {
    global $post;

    $v_service   = get_video_service($url);
    $meta_data   = get_post_meta( $post->ID, 'vid_id' );

    // youtube
    if ( $v_service == 'youtube' ) {
      preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $id);
      return $id[0];
    }
    // vimeo
    elseif ( $v_service == 'vimeo' ) {
      preg_match('/(\d+)/', $url, $id);
      return $id[0];
    }
  }


  /**
   * set_video_id()
   * set the video id to the post meta
   * @author Alexander Zizzo
   * @package Fifty Framework
   * @since 1.0
   */
  function set_video_id( $id ) {
    global $post;

    $meta_data = get_post_meta( $post->ID, 'vid_id' );

    if ( $meta_data[0] == $id[0] ) {
      return $id[0];
    } else {
      update_post_meta( $post->ID, 'vid_id', $id[0], $meta_data[0] );
      return $id[0];
    }

  }

  /**
   * get_video_data()
   * Get additional video data that requires use of json
   * @author Alexander Zizzo
   * @package Fifty Framework
   * @since 1.0
   */
  function get_video_data( $url, $data_type = NULL ) {

    global $post;

    $vid_service = get_video_service($url);
    $vid_id      = get_video_id($url);
    $meta_data   = get_post_meta( $post->ID, $data_type );

    /* YOUTUBE
    ================================================== */
    if ( $vid_service == 'youtube' ) {

      // THUMBNAIL
      if ( $data_type == 'thumbnail_large' ) {

        $vid_thumb_url = 'http://img.youtube.com/vi/'.$vid_id.'/hqdefault.jpg';

        $data = set_video_data( $post->ID, $vid_id, $data_type, $vid_thumb_url, $meta_data );

        return $data;

      }
      // TITLE
      elseif ( $data_type == 'title' ) {
        
        $vid_json_url      = 'http://gdata.youtube.com/feeds/api/videos/'.$vid_id.'?v=2&alt=jsonc';
        $vid_json_contents = file_get_contents($vid_json_url);
        $vid_json_data     = json_decode($vid_json_contents, true);
        $vid_json_data     = $vid_json_data['data'];
        $vid_json_data_str = $vid_json_data[$data_type];

        $data = set_video_data( $post->ID, $vid_id, $data_type, $vid_json_data_str, $meta_data );

        return $data;
      }
      
    }
    
    /* VIMEO
    ================================================== */
    elseif ( $vid_service == 'vimeo' ) {

      if ( $meta_data ) {
        return $meta_data[0];
      }
      else {
        $vid_json_url      = 'http://vimeo.com/api/v2/video/'.$vid_id.'.json';
        $vid_json_contents = file_get_contents($vid_json_url);
        $vid_json_data     = json_decode($vid_json_contents);
        $vid_json_data     = $vid_json_data[0];

        $vid_json_data_str = (string)$vid_json_data->$data_type;

        // update_post_meta( $post->ID, $data_type, $vid_json_data_str );

        $data = set_video_data( $post->ID, $vid_id, $data_type, $vid_json_data_str, $meta_data );

        return $data;
      }

    }
  }

  /**
   * set_video_data()
   * check if meta is different. if so, update, if not, used old
   * NEEDS REFACTORING -> check by ID first
   * @author Alexander Zizzo
   * @since 1.0
   */
  function set_video_data( $postID, $vid_id, $meta_key, $meta_val, $meta_val_old ) {
    global $post;

    $v_id = set_video_id( $vid_id );

    if ( $v_id[0] == $vid_id ) {
      return $meta_val;
    } else {
      update_post_meta( $postID, $meta_key, $meta_val, $meta_val_old[0] );
      return $meta_val;
    }
  }

}