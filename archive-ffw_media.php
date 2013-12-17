<?php get_header(); ?>

<?php //do_action('FFW_hero_before'); ?>
<?php //do_action('FFW_hero', array('text_override' => 'Media')); ?>
<?php //do_action('FFW_hero_after'); ?>

 
         
<script>
jQuery(window).load(function($){
  jQuery('#slider_ffw_media.flexslider').flexslider({
    animation       : "slide",
    prevText        : "N",
    nextText        : "n",
    direction       : "horizontal",
    slideShowSpeed  : "7000",
    animationSpeed  : "600",
    useCSS          : false,
    start: function(slider){
      slider.find('ul.slides').fadeIn(250);
    }
  });
});
</script>

<?php 
  $ffw_media_featured_args = array (
    'post_type'  => 'ffw_media',
    'tax_query'  => array( array(
      'taxonomy' => 'media_category', 
      'field'    => 'slug', 
      'terms'    => 'featured'
    ) )
  );
  $ffw_media_query = new WP_Query( $ffw_media_featured_args );
?>


<div id="slider_ffw_media" class="container-full flexslider">
  <ul class="slides">
    
    <?php if( $ffw_media_query->have_posts() ) : while( $ffw_media_query->have_posts() ) : $ffw_media_query->the_post(); ?>

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
            
            <div class="slide-content-left">
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

            <div class="slide-content-right" style="color:#fff;">
              <?php the_title(); ?>
            </div>

          </div>
        </div>
      </li>

    <?php endwhile; endif; wp_reset_query(); ?>

  </ul>
</div>



<div id="media_bar">
  <div class="left">
    <ul class="menu-media_bar" id="menu_media_bar">
      <li class="active"><a href="#all">All</a></li>
      <li><a href="#videos">Videos</a></li>
      <li><a href="#photos">Photos</a></li>
      <li><a href="#resources">Resources</a></li>
    </ul>
  </div>
  <div class="right">
    
  </div>
</div>

<div id="main" class="default blog">
  <div class="container-full">
    <h2 class="section-title">All Media</h2>


    <div id="content" class="full archive media">
      <div class="content-inner">
        <h1 class="archive-title"></h1>
        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>


          <div class="box box-fourth box-media has_footer has_hover_overlay">
            <a href="<?php the_permalink(); ?>">
              <div class="box-hover-overlay"></div>
              <main class="box-inner" style="background-image:url('<?php echo get_featured_image_url(); ?>');">
                <!-- <div class="box-image backstretch" data-img-src="<?php //echo get_featured_image_url(); ?>"></div> -->
              </main>
              <footer>
                <h6><?php the_title(); ?></h6>
                <span>
                  
                </span>
              </footer>
            </a>
          </div>

        <?php endwhile; endif; ?>

        <?php do_action('FFW_pagination', array('id' => 'nav-below') ); ?>
      </div><!-- .content-inner -->
    </div><!-- .content -->

  </div><!-- .container -->
</div><!-- #main -->

<?php get_footer(); ?>