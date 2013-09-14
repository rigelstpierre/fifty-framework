<?php
if ( ! function_exists( 'FFW_comment' ) ) :
/**
 * Template for comments and pingbacks.
 * To override this walker in a child theme without modifying the comments template
 * simply create your own FFW_comment(), and that function will be used instead.
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @package Fifty Framework
 * @author Alexander Zizzo
 * @since 1.0
 */
function FFW_comment( $comment, $args, $depth ) {

  // set comment type (ping/track back or comments) with switch
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :

  ?>
  
  <?php /* PINGBACK
  ================================================== */ ?>
  <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
    <p>
      <?php _e( 'Pingback:', 'FFW' ); ?> 
      <?php comment_author_link(); ?> 
      <?php edit_comment_link( __( '(Edit)', 'FFW' ), '<span class="edit-link">', '</span>' ); ?>
    </p>
  <?php break; default : ?>
  <?php global $post; ?>


  <?php /* COMMENT 
  ================================================== */ ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    
    <article id="comment-<?php comment_ID(); ?>" class="comment-wrap">
      
      <div class="comment-inner">

        <div class="avatar-wrap">
          <div class="avatar">
            <?php echo get_avatar( $comment, 44 ); ?>
          </div>
        </div>

      
        <div class="comment-comment">

          <header class="comment-header">
            <div class="comment-meta-header">
              <?php
                printf( '<cite class="comment-author">%1$s %2$s</cite>',
                  get_comment_author_link(),
                  // If current post author is also comment author, make it known visually.
                  ( $comment->user_id === $post->post_author ) ? '<span class="post-author"> ' . __( '', 'FFW' ) . '</span>' : '',
                  ( $comment->user_id === $post->post_author ) ? '' : ''
                );
              ?>
              <?php 
                printf( 
                  // '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>', //with link
                  '<time class="comment-time" datetime="%2$s">%3$s</time>', //without link
                  esc_url( get_comment_link( $comment->comment_ID ) ),
                  get_comment_time( 'c' ),
                  /* translators: 1: date, 2: time */
                  sprintf( __( '%1$s at %2$s', 'FFW' ), get_comment_date(), get_comment_time() )
                ); 
              ?>
            </div>
            <?php 
              comment_reply_link( array_merge( $args, 
                array( 
                  'reply_text' => __( 'Reply', 'FFW' ),
                  'after'      => ' ',
                  'depth'      => $depth,
                  'max_depth'  => $args['max_depth']
                ) 
              ) ); 
            ?>
          </header>

          <?php if ( '0' == $comment->comment_approved ) : ?>
            <p class="comment-awaiting-moderation" style="display:none;">
              <?php //_e( 'Your comment is awaiting moderation.', 'FFW' ); ?>
            </p>
          <?php endif; ?>

          <div class="comment-content">
            <?php comment_text(); ?>
            <?php //edit_comment_link( __( 'Edit', 'FFW' ), '<p class="edit-link">', '</p>' ); ?>
          </div>

          <footer class="comment-meta vcard">
            
          </footer><!-- footer .comment-meta -->

        </div>
      </div><!-- .comment-wrap -->
    </article><!-- #comment-## -->

  <?php break; endswitch; /* end comment_type check */ } endif; ?>