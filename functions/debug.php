<?php 

add_action( 'init', 'FFW_debug_functions' );

function FFW_debug_functions() {

  /**
   * debug_box()
   * Displays a fixed div containing var_dumps, etc for helping debugging
   * @author Alexander Zizzo
   * @since 1.0
   */
  function debug_box( $args = NULL ) {

    global $post;

    // args
    $post_meta = isset($args['post_meta']) ? $args['post_meta'] : false;
    $post_obj  = isset($args['post_obj']) ? $args['post_obj'] : false;

    // check toggle from options

    ?>

      <div id="debug_box" class="closed">
        <header>
          #debug_box
          <button id="debug_box-close"></button>
        </header>
        <div class="debug_box-inner">

          <?php if ( $post_meta )  : ?>
            <span>post meta: # <?php echo $post->ID; ?></span>
            <pre><?php print_r(get_post_meta( $post->ID )); ?></pre>
          <?php endif; ?>

          <?php if ( $post ) : ?>
            <span>$post object</span>
            <pre><?php print_r($post); ?></pre>
          <?php endif; ?>

        </div>
      </div>

    <?php 
  }
  add_action('FFW_debug_box', 'debug_box');

}
