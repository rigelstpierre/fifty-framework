<?php

function loop_pagination( $args = array() ) {
  global $wp_rewrite, $wp_query;

  /* If there's not more than one page, return nothing. */
  if ( 1 >= $wp_query->max_num_pages )
    return;

  /* Get the current page. */
  $current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );

  /* Get the max number of pages. */
  $max_num_pages = intval( $wp_query->max_num_pages );

  /* Get the pagination base. */
  $pagination_base = $wp_rewrite->pagination_base;

  /* Set up some default arguments for the paginate_links() function. */
  $defaults = array(
    'base'         => add_query_arg( 'paged', '%#%' ),
    'format'       => '',
    'total'        => $max_num_pages,
    'current'      => $current,
    'prev_next'    => true,
    //'prev_text'  => __( '&laquo; Previous' ), // This is the WordPress default.
    //'next_text'  => __( 'Next &raquo;' ), // This is the WordPress default.
    'show_all'     => false,
    'end_size'     => 1,
    'mid_size'     => 1,
    'add_fragment' => '',
    'type'         => 'plain',

    // Begin loop_pagination() arguments.
    'before'       => '<div class="pagination loop-pagination">',
    'after'        => '</div>',
    'echo'         => true,
  );

  /* Add the $base argument to the array if the user is using permalinks. */
  if ( $wp_rewrite->using_permalinks() && !is_search() )
    $defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . "{$pagination_base}/%#%" );

  /* @todo Find a way to make pretty links work for search in all cases. */
  /*
  if ( is_search() ) {
    $search_permastruct = $wp_rewrite->get_search_permastruct();
    if ( !empty( $search_permastruct ) )
      $defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
  }
  /**/

  /* Allow developers to overwrite the arguments with a filter. */
  $args = apply_filters( 'loop_pagination_args', $args );

  /* Merge the arguments input with the defaults. */
  $args = wp_parse_args( $args, $defaults );

  /* Don't allow the user to set this to an array. */
  if ( 'array' == $args['type'] )
    $args['type'] = 'plain';

  /* Get the paginated links. */
  $page_links = paginate_links( $args );

  /* Remove 'page/1' from the entire output since it's not needed. */
  $page_links = str_replace( array( "?paged=1'", "&#038;paged=1'", "/{$pagination_base}/1'", "/{$pagination_base}/1/'" ), '\'', $page_links );
  $page_links = str_replace( array( '?paged=1"', '&#038;paged=1"', "/{$pagination_base}/1\"", "/{$pagination_base}/1/\"" ), '"', $page_links );

  /* Wrap the paginated links with the $before and $after elements. */
  $page_links = $args['before'] . $page_links . $args['after'];

  /* Allow devs to completely overwrite the output. */
  $page_links = apply_filters( 'loop_pagination', $page_links );

  /* Return the paginated links for use in themes. */
  if ( $args['echo'] )
    echo $page_links;
  else
    return $page_links;
}

?>