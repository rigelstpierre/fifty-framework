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
    global $wp_query;
    global $current_user;

    // args
    $wpquery  = isset($args['wpquery']) ? $args['wpquery'] : false;
    $post_meta = isset($args['post_meta']) ? $args['post_meta'] : false;
    $post_obj  = isset($args['post_obj']) ? $args['post_obj'] : false;
    $current_user_info  = isset($args['current_user_info']) ? $args['current_user_info'] : false;
    $options_framework  = isset($args['options_framework']) ? $args['options_framework'] : false;
    $query_count  = isset($args['query_count']) ? $args['query_count'] : false;


    // check toggle from options

    ?>

      <div id="debug_box" class="closed">
        <header>
          #debug_box
          <button id="debug_box-close"></button>
        </header>
        <div class="debug_box-inner">
          
          <?php if ( $wpquery )  : ?>
            <span>$wp_query</span>
            <pre><?php print_r($wp_query); ?></pre>
          <?php endif; ?>

          <?php if ( $post_meta )  : ?>
            <span>post meta: # <?php echo $post->ID; ?></span>
            <pre><?php print_r(get_post_meta( $post->ID )); ?></pre>
          <?php endif; ?>

          <?php if ( $post_obj ) : ?>
            <span>$post object</span>
            <pre><?php print_r($post); ?></pre>
          <?php endif; ?>

          <?php if ( $current_user_info ) : ?>
            <span>$current_user</span>
            <pre><?php print_r($current_user); ?></pre> 
          <?php endif; ?>
          
          <?php if ( $options_framework) : ?>
            <span>optionsframework_</span>
            <pre><?php print_r(get_option( 'optionsframework_fifty_framework' )); ?></pre>
          <?php endif; ?>

          <?php if ( $query_count ) : ?>
            <span>Query Count</span>
            <?php 
              $stat = sprintf(  
                  '%d queries in %.3f seconds, using %.2fMB memory',
                  get_num_queries(),
                  timer_stop( 0, 3 ),
                  memory_get_peak_usage() / 1024 / 1024
              );
            ?>
            <pre><?php echo $visible ? $stat : "{$stat}" ; ?></pre>
          <?php endif; ?>

        </div>
      </div>

    <?php 
  }
  add_action('FFW_debug_box', 'debug_box');

}
