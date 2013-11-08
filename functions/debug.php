<?php 

/**
 * This function adds the debug box in the bottom right hand corner
 * @todo  Make the actual box look nicer 
 */
function FFW_debug_functions() 
{

  /**
   * debug_box()
   * Displays a fixed div containing var_dumps, etc for helping debugging
   * @author Alexander Zizzo
   * @since 1.0
   */
  function debug_box( $args = NULL ) 
  {

    global $post;
    global $wp_query;
    global $current_user;

    // args
    $wpquery           = isset($args['wpquery']) ? $args['wpquery'] : false;
    $post_meta         = isset($args['post_meta']) ? $args['post_meta'] : false;
    $post_obj          = isset($args['post_obj']) ? $args['post_obj'] : false;
    $current_user_info = isset($args['current_user_info']) ? $args['current_user_info'] : false;
    $options_framework = isset($args['options_framework']) ? $args['options_framework'] : false;
    $query_count       = isset($args['query_count']) ? $args['query_count'] : false;


    $debug_obj = new stdClass();
    foreach( $args as $key => $arg ) { $debug_obj->$key = $arg; }

    ?>

    <div id="debug_box" class="closed">
      <header>
        Debug Box
        <button id="debug_box-close"></button>
      </header>

      <div class="debug_box-inner">

        <nav>
          <?php 
            while($element = current($args)) {
                echo '<a href="javascript:;" name="'.key($args).'">'.key($args).'</a>';
                next($args);
            }
          ?>
        </nav>
        
        <?php if ( $wpquery )  : ?>
          <div id="wpquery" class="vardump hide">
            <span>$wp_query</span>
            <pre><?php print_r($wp_query); ?></pre>
          </div>
        <?php endif; ?>

        <?php if ( $post_meta )  : ?>
          <div id="post_meta" class="vardump hide">
            <span>post meta: #<?php echo $post->ID; ?></span>
            <pre><?php print_r(get_post_meta( $post->ID )); ?></pre>
          </div>
        <?php endif; ?>

        <?php if ( $post_obj ) : ?>
          <div id="post_obj" class="vardump hide">
            <span>$post_obj</span>
            <pre><?php print_r($post); ?></pre>
          </div>
        <?php endif; ?>

        <?php if ( $current_user_info ) : ?>
          <div id="current_user_info" class="vardump hide">
            <span>$current_user</span>
            <pre><?php print_r($current_user); ?></pre> 
          </div>
        <?php endif; ?>
        
        <?php if ( $options_framework) : ?>
          <div id="options_framework" class="vardump hide">
            <span>$options_framework</span>
            <pre><?php print_r(get_option( 'optionsframework_fifty_framework' )); ?></pre>
          </div>
        <?php endif; ?>

        <?php if ( $query_count ) : ?>
          <div id="query_count" class="vardump hide">
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
          </div>
        <?php endif; ?>

      </div>
    </div>

    <?php 
  }
  add_action('FFW_debug_box', 'debug_box');

}
add_action( 'init', 'FFW_debug_functions' );
