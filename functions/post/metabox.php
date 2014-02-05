<?php 
/**
 * Metabox Functions
 *
 * @package     FFW
 * @subpackage  Functions/Post
 * @copyright   Copyright (c) 2014, Bryan Monzon
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/** All Downloads *****************************************************************/

/**
 * Register all the meta boxes for the Download custom post type
 *
 * @since 1.0
 * @return void
 */
function ffw_post_add_meta_box() {

    $post_types = apply_filters( 'ffw_post_metabox_post_types' , array( 'post' ) );

    foreach ( $post_types as $post_type ) {

        add_meta_box( 'postinfo', __( 'Post Controle', 'ffw_post' ),  'ffw_post_render_meta_box', $post_type, 'normal', 'high' );

    }
}
add_action( 'add_meta_boxes', 'ffw_post_add_meta_box' );


/**
 * Sabe post meta when the save_post action is called
 *
 * @since 1.0
 * @param int $post_id Download (Post) ID
 * @global array $post All the data of the the current post
 * @return void
 */
function ffw_post_meta_box_save( $post_id) {
    global $post;


    if ( ! isset( $_POST['ffw_post_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['ffw_post_meta_box_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    if ( ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) || ( defined( 'DOING_AJAX') && DOING_AJAX ) || isset( $_REQUEST['bulk_edit'] ) )
        return $post_id;

    if ( isset( $post->post_type ) && $post->post_type == 'revision' )
        return $post_id;


    // The default fields that get saved
    $fields = apply_filters( 'ffw_post_metabox_fields_save', array(
            'ffw_color_value',
        )
    );


    foreach ( $fields as $field ) {
        if ( ! empty( $_POST[ $field ] ) ) {
            $new = apply_filters( 'ffw_post_save_' . $field, $_POST[ $field ] );
            update_post_meta( $post_id, $field, $new );
        } else {
            delete_post_meta( $post_id, $field );
        }
    }
}
add_action( 'save_post', 'ffw_post_meta_box_save' );



/** Campaign Configuration *****************************************************************/

/**
 * Campaign Metabox
 *
 * Extensions (as well as the core plugin) can add items to the main download
 * configuration metabox via the `ffw_post_meta_box_fields` action.
 *
 * @since 1.0
 * @return void
 */
function ffw_post_render_meta_box() {
    global $post;

    do_action( 'ffw_post_meta_box_fields', $post->ID );
    wp_nonce_field( basename( __FILE__ ), 'ffw_post_meta_box_nonce' );
}



function ffw_post_render_fields( $post )
{
    global $post;

    $ffw_color_value = get_post_meta( $post->ID, 'ffw_color_value', true );


?>
    <div class="ffw_post-wrapper">
        <?php do_action( 'ffw_before_post_meta' ); ?>
        <p>
    <label for="ffw_color_value">
        <input type="text" name="ffw_color_value" class="meta-color" value="<?php echo $ffw_color_value; ?>"></p>
    </label>
        <?php do_action( 'ffw_after_post_meta' ); ?>
    </div>
<?php

}
add_action( 'ffw_post_meta_box_fields', 'ffw_post_render_fields', 10 );