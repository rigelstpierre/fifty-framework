<?php
add_action('init', 'FFW_actions');

/**
 * FFW_actions
 * Theme actions - used in some cases in place of template parts for more
 * dynamic control. Ex: social links, hero units, etc. 
 * @since 1.0
 * @author Alexander Zizzo
 */
function FFW_actions(){


  /**
   * Pagination
   * @since 1.0
   */
  function pagination( $args = NULL ) {

    $class = isset($args['class']) ? $args['class'] : null;

    ?>
    
      <div class="pagination <?php echo $class; ?>">
        <div class="next-posts">
          <?php next_posts_link(); ?>
        </div>
        <div class="previous-posts">
          <?php previous_posts_link(); ?>
        </div>
      </div>

    <?php 
  }
  add_action('FFW_pagination', 'pagination');

}