<!-- ================== -->
<!--        #MAIN       -->
<!-- ================== -->
<div id="main" class="default blog">
  <div class="container-full">
    <?php if( is_search() ) : ?>
      <h2 class="section-title"><?php printf( __(  'Search Results for: %s', 'ffw' ), get_search_query() ); ?></h2>
    <?php elseif( is_category() ) : ?>
      <h2 class="section-title">Category</h2>
    <?php else :  ?>
      <h2 class="section-title">All Media</h2>
    <?php endif; ?>

    <!-- ================== -->
    <!--      #CONTENT      -->
    <!-- ================== -->
    <div id="content" class="full archive media">
      <div class="content-inner">

          <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

          <?php
            // Get post meta data
            $ffw_media_meta_media_type          = get_post_meta( $post->ID, 'ffw_media_type' );
            $ffw_media_meta_media_type_service  = substr($ffw_media_meta_media_type[0], 10);
            // See if post has featured image (post thumbnail/attachment)
            if ( !has_post_thumbnail( $post->ID ) ) {
              $ffw_media_image_fallback_class = 'box-media-fallback';
            } else {
              $ffw_media_image_fallback_class = '';
            }
          ?>
    
            <div class="box box-fourth box-media has_footer has_hover_overlay <?php echo $ffw_media_image_fallback_class; ?>">
              <a href="<?php the_permalink(); ?>">
                <div class="box-hover-overlay"></div>
                <div class="box-inner" style="background-image:url('<?php echo get_featured_image_url(); ?>');">
                  <!-- <div class="box-image backstretch" data-img-src="<?php //echo get_featured_image_url(); ?>"></div> -->
                </div>
                <footer>
                  <h6><?php the_title(); ?></h6>
                  <span>
                    
                  </span>
                </footer>
              </a>
            </div>

          <?php endwhile; else : ?>
          <div class="container">
              <p>Sorry, your search return no media.</p>  
          </div>        
          
          <?php endif; ?>

        <!-- ================== -->
        <!--     PAGINATION     -->
        <!-- ================== -->
        <?php do_action('FFW_pagination', array('id' => 'nav-below') ); ?>

      </div><!-- .content-inner -->
    </div><!-- .content -->

  </div><!-- .container-full -->
</div><!-- #main -->