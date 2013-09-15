<?php 

/**
 * Post Format: VIDEO -> Metaboxes
 * Custom metaboxes specifically for the video post format,
 * post formats are listed in /functions/setup.php
 * TUTORIAL: http://goo.gl/ssmWlh
 * @author Alexander Zizzo
 * @package Fifty Framework
 * @since 1.0
 */

/**
 * Post Format Metaboxes -> DEFINE
 * Define the array of arguments to generate the metaboxes
 */
$post_format_metaboxes = array(
  'video' => array(
    'title'             => __('Video Embed', 'FFW'),
    'applicableto'      => 'post',
    'location'          => 'normal',
    'display_condition' => 'post-format-video',
    'priority'          => 'low',
    'fields'            => array(
      'vid_url'         => array(
        'title'       => __('Video URL', 'FFW'),
        'type'        => 'text',
        'description' => '',
        'size'        => 60
      ),
      'vid_title_toggle'   => array(
        'title'       => __('Use video title', 'FFW'),
        'type'        => 'checkbox',
        'description' => '',
        'size'        => 60
      )
    )
  ),
  'quote' => array(
    'title'             => __('Quote', 'FFW'),
    'applicableto'      => 'post',
    'location'          => 'normal',
    'display_condition' => 'post-format-quote',
    'priority'          => 'low',
    'fields'            => array(
      'quote_author'         => array(
        'title'       => __('Quote Author', 'FFW'),
        'type'        => 'text',
        'description' => '',
        'size'        => 60
      ),
      'quote_occupation'   => array(
        'title'       => __('Quote Occupation', 'FFW'),
        'type'        => 'text',
        'description' => '',
        'size'        => 60
      )
    )
  )
);






/**
 * add_post_format_metaboxes()
 * Add the metaboxes to the admin_init function
 */
add_action( 'admin_init', 'add_post_format_metaboxes' );
 
function add_post_format_metaboxes() {
  global $post_format_metaboxes;

  if ( ! empty( $post_format_metaboxes ) ) {
    foreach ( $post_format_metaboxes as $id => $metabox ) {
        add_meta_box( $id, $metabox['title'], 'show_metaboxes', $metabox['applicableto'], $metabox['location'], $metabox['priority'], $id );
    }
  }
}






/**
 * show_metaboxes()
 * Display the metaboxes in the backend
 */
function show_metaboxes( $post, $args ) {
  global $post_format_metaboxes;

  $custom = get_post_custom( $post->ID );
  $fields = $tabs = $post_format_metaboxes[$args['id']]['fields'];

  /** Nonce **/
  $output = '<input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';

  if ( sizeof( $fields ) ) {
    foreach ( $fields as $id => $field ) {
      switch ( $field['type'] ) {
        default:
        case "text":
          $output .= '<div class="post-format-metabox-fields" style="width:100%;">
                        <label class="post-format-metabox-label" style="width:30%;display:inline-block;" for="' . $id . '">' . $field['title'] . '</label>
                        <input id="' . $id . '" type="text" name="' . $id . '" value="' . $custom[$id][0] . '" size="' . $field['size'] . '" />
                      </div>';
        break;
        case "checkbox":
          $output .= '<div class="post-format-metabox-fields" style="width:100%;">
              <label class="post-format-metabox-label" style="width:30%;display:inline-block;" for="' . $id . '">' . $field['title'] . '</label>';
          
          if ($custom[$id][0] == 'true') {
            $output .= '<input id="' . $id . '" type="checkbox" name="' . $id . '" value="true" checked />';  
          } else {
            $output .= '<input id="' . $id . '" type="checkbox" name="' . $id . '" value="true" />';
          }   

          $output .= '</div>';
      }
    }
  }

  echo $output;
}






/**
 * save_metaboxes()
 * Function to save the meta data to the post
 */
add_action( 'save_post', 'save_metaboxes' );
 
function save_metaboxes( $post_id ) {
  global $post_format_metaboxes;

  // verify nonce
  if ( ! wp_verify_nonce( $_POST['post_format_meta_box_nonce'], basename( __FILE__ ) ) )
    return $post_id;

  // check autosave
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    return $post_id;

  // check permissions
  if ( 'page' == $_POST['post_type'] ) {
      if ( ! current_user_can( 'edit_page', $post_id ) )
          return $post_id;
  } elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
      return $post_id;
  }

  $post_type = get_post_type();

  // loop through fields and save the data
  foreach ( $post_format_metaboxes as $id => $metabox ) {
    // check if metabox is applicable for current post type
    if ( $metabox['applicableto'] == $post_type ) {
      $fields = $post_format_metaboxes[$id]['fields'];

      foreach ( $fields as $id => $field ) {
        $old = get_post_meta( $post_id, $id, true );
        $new = $_POST[$id];

        if ( $new && $new != $old ) {
          update_post_meta( $post_id, $id, $new );
        }
        elseif ( '' == $new && $old || ! isset( $_POST[$id] ) ) {
          delete_post_meta( $post_id, $id, $old );
        }
      }
    }
  }
}






/**
 * display_metaboxes()
 * Display the metaboxes as you toggle the post format
 */
add_action( 'admin_print_scripts', 'display_metaboxes', 1000 );

function display_metaboxes() {
    global $post_format_metaboxes;
    if ( get_post_type() == "post" ) :
        ?>
        <script type="text/javascript">// <![CDATA[
            $ = jQuery;
 
            <?php
            $formats = $ids = array();
            foreach ( $post_format_metaboxes as $id => $metabox ) {
                array_push( $formats, "'" . $metabox['display_condition'] . "': '" . $id . "'" );
                array_push( $ids, "#" . $id );
            }
            ?>
 
            var formats = { <?php echo implode( ',', $formats );?> };
            var ids = "<?php echo implode( ',', $ids ); ?>";
                        
            function displayMetaboxes() {
                // Hide all post format metaboxes
                $(ids).hide();
                // Get current post format
                var selectedElt = $("input[name='post_format']:checked").attr("id");
 
                // If exists, fade in current post format metabox
                if ( formats[selectedElt] )
                    $("#" + formats[selectedElt]).fadeIn();
            }

            function hideMCE() {
              $('#postdivrich').fadeIn(150);
              var selectedElt = $("input[name='post_format']:checked").attr("id");

              // console.log(selectedElt);

              if ( selectedElt === 'post-format-image' ) {
                $('#postdivrich').fadeOut(150);
              }

            }
 
            $(function() {
                // Show/hide metaboxes on page load
                displayMetaboxes();
 
                // Show/hide metaboxes on change event
                $("input[name='post_format']").change(function() {
                    displayMetaboxes();
                    hideMCE();
                });
            });
 
        // ]]></script>
        <?php
    endif;
}            
