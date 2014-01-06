<?php 
if( is_archive( 'ffw_media' ) ) { 

  if( is_tax( 'media_type' ) ) {

      // FFW_MEDIA_QUERY
      $ffw_media_featured_args = array (
        'post_type'  => 'ffw_media',
        'tax_query'  => array(
          array(
            'taxonomy' => 'media_type',
            'field'    => 'slug',
            'terms'    => array( get_query_var( $wp_query->query_vars['taxonomy'] ) )
          )),
        'meta_query' => array( array(
           'key'     => 'ffw_media_type_featured',
           'value'   => array(1),
           'compare' => '>=',
        ) ) 
      );
      $ffw_media_query = new WP_Query( $ffw_media_featured_args );

  } else {

    // FFW_MEDIA_QUERY
      $ffw_media_featured_args = array (
        'post_type'  => 'ffw_media',
        'meta_query' => array( array(
           'key'     => 'ffw_media_type_featured',
           'value'   => array(1),
           'compare' => '>=',
        ) ) 
      );
      $ffw_media_query = new WP_Query( $ffw_media_featured_args );

  } 
  ?>


  <!-- =================== -->
  <!--  #SLIDER_FFW_MEDIA  -->
  <!-- =================== -->

  <?php do_action('FFW_social_share_js', array('addthis' => true, 'sharepop' => true) ); ?>

  <?php do_action('FFW_addthis_js_before'); ?>


  <div id="slider_ffw_media" class="container-full flexslider">
      <?php 
        if( is_tax( 'media_type' ) ) : 
          $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); 
        ?>
          <h2 class="section-title white slider-title" style="">Featured <?php echo $term->name; ?></h2>
      <?php else : ?>
          <h2 class="section-title white slider-title" style="">Featured Media</h2>
      <?php endif; ?>
    <ul class="slides">
      
      <?php if( $ffw_media_query->have_posts() ) : while( $ffw_media_query->have_posts() ) : $ffw_media_query->the_post(); ?>
  
        <?php 


          $ffw_media_meta_media_type           = get_post_meta( $post->ID, 'ffw_media_type' );
          $ffw_media_meta_media_type_id        = get_post_meta( $post->ID, 'ffw_media_type_id', true );
          $ffw_media_meta_media_type_url       = get_post_meta( $post->ID, 'ffw_media_type_url', true );
          $ffw_media_meta_media_type_thumbnail = get_post_meta( $post->ID, 'ffw_media_type_thumbnail', true );
          $ffw_media_meta_media_type_service   = substr($ffw_media_meta_media_type[0], 10);


        ?>

        <li class="" data-thumb="" style="background-image:url('');">
          <div class="container">
            <div class="slide-content clearafter">
              
              <div class="slide-content-left span8">
                  <?php if ( $ffw_media_meta_media_type[0] == 'ffw_media_youtube' || $ffw_media_meta_media_type[0] == 'ffw_media_vimeo' ) : ?>
                    <a 
                      href="javascript:;" 
                      class="media-image video lazyload fallback" 
                      data-video-service="<?php echo $ffw_media_meta_media_type_service; ?>" 
                      data-video-id="<?php echo $ffw_media_meta_media_type_id[0]; ?>"
                      style="background-image:url('<?php echo get_featured_image_url(); ?>');"
                    >
                    <div class="media-image-overlay"></div>
                    <div class="media-image-icon"></div>
                      
  
                  <?php else: ?>
              
                    <a href="javascript:" class="media-image photo">
                      <div class="media-image-overlay"></div>
                      <div class="media-image-icon"></div>
                  <?php endif; ?>

                      
                    
                    </a>
                
              </div><!-- .slide-content-left -->

              <div class="slide-content-right span4" style="color:#fff;">
                <h3><?php the_title(); ?></h3>

                <?php do_action('FFW_post_details', array(
                  'wrapper' => 'div',
                  'author'  => false,
                  'class'   => 'slide-meta'
                )); ?>

                <?php the_content(); ?>

                <footer>
                  <?php //do_action('FFW_social_share_menu', array('email' => true)); ?>
                  <?php do_action('FFW_addthis_js'); ?>
                </footer>
              </div>

            </div><!-- .slide-content.clearafter -->
          </div><!-- .container -->
        </li>

      <?php endwhile; endif; wp_reset_query(); ?>

    </ul>
  </div><!-- #slider_ffw_media.container-full.flexslider -->

<?php }else{ ?>

<!-- =================== -->
<!--  #SLIDER_FFW_MEDIA  -->
<!-- =================== -->

<?php do_action('FFW_social_share_js', array('addthis' => true, 'sharepop' => true)); ?>

<?php do_action('FFW_addthis_js_before'); ?>


<div id="slider_ffw_media" class="container-full flexslider">
  <h2 class="section-title white slider-title" style="">Media</h2>
  <ul class="slides">
    
    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

      <?php 
        $ffw_media_meta_media_type           = get_post_meta( $post->ID, 'ffw_media_type' );
        $ffw_media_meta_media_type_id        = get_post_meta( $post->ID, 'ffw_media_type_id' );
        $ffw_media_meta_media_type_url       = get_post_meta( $post->ID, 'ffw_media_type_url' );
        $ffw_media_meta_media_type_thumbnail = get_post_meta( $post->ID, 'ffw_media_type_thumbnail' );
        $ffw_media_meta_media_type_service   = substr($ffw_media_meta_media_type[0], 10);
      ?>

      <li class="" data-thumb="" style="background-image:url('');">
        <div class="container">
          <div class="slide-content clearafter">
            
            <div class="slide-content-left span8">
                <?php if ( $ffw_media_meta_media_type[0] == 'ffw_media_youtube' || $ffw_media_meta_media_type[0] == 'ffw_media_vimeo' ) : ?>
                  <a 
                    href="javascript:;" 
                    class="media-image video lazyload fallback" 
                    data-video-service="<?php echo $ffw_media_meta_media_type_service; ?>" 
                    data-video-id="<?php echo $ffw_media_meta_media_type_id[0]; ?>"
                    style="background-image:url('<?php echo get_featured_image_url(); ?>');"
                  >
                  <div class="media-image-overlay"></div>
                  <div class="media-image-icon"></div>
                    

                <?php else: ?>
                  <a href="javascript:" class="media-image photo">
                    <div class="media-image-overlay"></div>
                    <div class="media-image-icon"></div>
                <?php endif; ?>

                    
                  
                  </a>
              
            </div><!-- .slide-content-left -->

            <div class="slide-content-right span4" style="color:#fff;">
              <h3><?php the_title(); ?></h3>

              <?php do_action('FFW_post_details', array(
                'wrapper' => 'div',
                'author'  => false,
                'class'   => 'slide-meta'
              )); ?>

              <?php the_content(); ?>

              <footer>
                <?php //do_action('FFW_social_share_menu', array('email' => true)); ?>
                <?php do_action('FFW_addthis_js'); ?>
              </footer>
            </div>

          </div><!-- .slide-content.clearafter -->
        </div><!-- .container -->
      </li>

      </pre>
    <?php endwhile; endif; wp_reset_query(); ?>

  </ul>
</div><!-- #slider_ffw_media.container-full.flexslider -->
<?php 
}