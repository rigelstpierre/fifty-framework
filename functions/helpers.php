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
   * generate_random_string()
   * Generate a random string of given length
   * @author Alexander Zizzo
   * @since 1.3
   * @return (string)
   */
  function generate_random_string( $length = 8 ) {
    // Create A# source string [uppercase, lowercase, 0-9]
    $alpha_numeric = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    // Return the substr using str_shuffle and given length parameter
    return substr(str_shuffle($alpha_numeric), 0, $length);
  }


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
   * get_parent_page_title
   * Get the name of the parent page, if not, get current page title
   * @author Alexander Zizzo
   * @since 1.25
   */
  function get_parent_page_title( $args = NULL )
  {
    $parent_page_name =  empty( $post->post_parent ) ? get_the_title( $post->ID ) : get_the_title( $post->post_parent );
    echo $parent_page_name;
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
   * @author Alexander Zizzo
   * @since 1.0
   */
  function get_sidebar_position_class() {

    // If the sidebar is toggled off, content area is full width
    if ( of_get_option( 'toggle_sidebar') ) {
      // Get sidebar positioning class
      $sidebar_position_class = of_get_option ( 'sidebar_position_blog' );
      return 'push-'.$sidebar_position_class;
    } elseif ( !of_get_option( 'toggle_sidebar' ) ) {
      // There is no sidebar, do not push content area
      $sidebar_on_off = 'push-none';
      return $sidebar_on_off;
    }

    
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
   * get_column_box_class()
   * Count the number of posts returned and set a class for columns accordingly
   * @author Alexander Zizzo
   * @since 1.1
   * @param array('class' => '_OPTIONAL_CLASS_NAME_')
   */
  function get_column_count_class( $args = NULL ) {
    global $posts;

    $class = isset($args['class']) ? $args['class'] : null;

    // get the number of posts and set the grid classes accordingly @TODO: refactor for container class & fourths
    $post_count =  count($posts);

    if ( $post_count == 2 && $post_count > 0 ) {
      $column_box_class = 'box-half';
    }
    elseif ( $post_count >= 3 && $post_count > 0 && $post_count != 4 ) {
      $column_box_class = 'box-third';
    }
    elseif ( $post_count >= 4 && $post_count >0 && ($post_count % $post_count == 0)) {
      $column_box_class = 'box-fourth';
    }
    return $column_box_class;
  }


  /**
   * get_featured_image_url()
   * Wrapper for wp_get_attachment_url given it's frequence of use.
   * @author Alexander Zizzo
   * @since 1.1
   * @param Post ID (optional, defaults to current global)
   */
  function get_featured_image_url( $args = NULL ) {
    global $post;
    
    $post_id    = isset($args['post_id']) ? $args['post_id'] : $post->ID;
    $image_size = isset($args['image_size']) ? $args['image_size'] : 'full';

    $image_url  = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $image_size );

    return $image_url[0];
  } 







  /* ================================================================== */
  /*                                                                    */
  /*            V I D E O  S E R V I C E   F U N C T I O N S            */
  /*                                                                    */
  /* ================================================================== */    


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
  function get_video_data( $url, $data_type = NULL, $set_data = false ) {

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

        if ( $set_data ) {
          $data = set_video_data( $post->ID, $vid_id, $data_type, $vid_thumb_url, $meta_data );
        } else {
          $data = $vid_thumb_url;
        }

        return $data;
      }
      // TITLE
      elseif ( $data_type == 'title' ) {
        
        $vid_json_url      = 'http://gdata.youtube.com/feeds/api/videos/'.$vid_id.'?v=2&alt=jsonc';
        $vid_json_contents = file_get_contents($vid_json_url);
        $vid_json_data     = json_decode($vid_json_contents, true);
        $vid_json_data     = $vid_json_data['data'];
        $vid_json_data_str = $vid_json_data[$data_type];

        if ( $set_data ) {
          $data = set_video_data( $post->ID, $vid_id, $data_type, $vid_json_data_str, $meta_data );
        } else {
          $data = $vid_json_data_str;
        }

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

        if ( $set_data ) {
          $data = set_video_data( $post->ID, $vid_id, $data_type, $vid_json_data_str, $meta_data );
        } else {
          $data = $vid_json_data_str;
        }

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




  /**
   * Has_Children_Walker()
   * Use with wp_nav_menu(). Checks if <li> has child <ul> and applies a class
   * to the parent <li> if so.
   * @author Alexander Zizzo
   * @since 1.1
   */
  class Has_Children_Walker extends Walker_Nav_Menu {
      function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
          $id_field = $this->db_fields['id'];

          if ( is_object( $args[0] ) ) {
              $args[0]->has_children = !empty( $children_elements[$element->$id_field] );
          }

          return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
      }

      function start_el( &$output, $item, $depth = 0, $args, $id = 0 ) {
          if ( $args->has_children ) {
              $item->classes[] = 'has_children';
          }
          parent::start_el($output, $item, $depth, $args);
      }
  }





  /**
   * set_featured_image_from_url()
   * Set Featured Image From URl
   * @author Alexander Zizzo
   * @since 1.3
   */
  function set_featured_image_from_url( $img_url )
  {
    // Needed global vars
    global $post;
    
    // Add Featured Image to Post
    $image_url      = $img_url;                               // Define the image URL here
    $upload_dir     = wp_upload_dir();                        // Set upload folder
    $image_rand_id  = ffw_generate_random_string();           // Generated a random ID string to append to image name
    $image_data     = file_get_contents($image_url);          // Get image data
    $filename       = basename($image_url) . $image_rand_id;  // Create image file name
    $post_id        = $post->ID;

    // Check folder permission and define file location
    if( wp_mkdir_p( $upload_dir['path'] ) ) {
        $file = $upload_dir['path'] . '/' . $filename;
    } else {
        $file = $upload_dir['basedir'] . '/' . $filename;
    }

      // Check if file exists ( if we've previously retrieved it before) or not
      // Create the image  file on the server
      file_put_contents( $file, $image_data );

      // Check image file type
      $wp_filetype = wp_check_filetype( $filename, null );

      // Set attachment data
      $attachment = array(
          'post_mime_type' => $wp_filetype['type'],
          'post_title'     => sanitize_file_name( $filename ),
          'post_content'   => '',
          'post_status'    => 'inherit'
      );

      // Create the attachment
      $attach_id = wp_insert_attachment( $attachment, $file, $post_id );

      // Include image.php
      require_once(ABSPATH . 'wp-admin/includes/image.php');

      // Define attachment metadata
      $attach_data = wp_generate_attachment_metadata( $attach_id, $file );

      // Assign metadata to attachment
      wp_update_attachment_metadata( $attach_id, $attach_data );

      // And finally assign featured image to post
      set_post_thumbnail( $post_id, $attach_id );
    }
}