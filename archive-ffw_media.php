<?php get_header(); ?>


<!-- // FLEXSLIDER JS // -->         
<?php do_action( 'FFW_flexslider_js', array() ); ?>

<?php // FFW_MEDIA_QUERY
  $ffw_media_featured_args = array (
    'post_type'  => 'ffw_media',
    'meta_query' => array( array(
       'key'     => 'ffw_media_type_featured',
       'value'   => array(1),
       'compare' => '>=',
    ) ) 
  );
  $ffw_media_query = new WP_Query( $ffw_media_featured_args );
?>

<!-- =================== -->
<!--  #SLIDER_FFW_MEDIA  -->
<!-- =================== -->
<div id="slider_ffw_media" class="container-full flexslider">
  <h2 class="section-title white slider-title" style="">Featured Media</h2>
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
              <h3><?php the_title(); ?></h3>

              <?php do_action('FFW_post_details', array(
                'wrapper' => 'div',
                'author'  => false,
                'class'   => 'slide-meta'
              )); ?>

              <?php the_content(); ?>
            </div>

          </div><!-- .slide-content.clearafter -->
        </div><!-- .container -->
      </li>

    <?php endwhile; endif; wp_reset_query(); ?>

  </ul>
</div><!-- #slider_ffw_media.container-full.flexslider -->


<!-- ================== -->
<!--     #MEDIA_BAR     -->
<!-- ================== -->
<div id="media_bar">
  <!-- // LEFT // -->
  <div class="left span6">
    <!-- ================== -->
    <!--    #MEDIA_SORT     -->
    <!-- ================== -->
    <ul class="menu-media_bar" id="media_sort">
      <li class="active"><a href="#all">All</a></li>
      <li><a href="#videos">Videos</a></li>
      <li><a href="#photos">Photos</a></li>
      <li><a href="#resources">Resources</a></li>
    </ul>
  </div>
  <!-- // RIGHT // -->
  <div class="right span6">
    <!-- ================== -->
    <!--   #MEDIA_SEARCH    -->
    <!-- ================== -->
    <div id="media_search" class="media-search inline-search">
      <form action="/" method="get">
          <fieldset class="inline-fields">
              <input class="inline-input" type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Search"/>
              <input type="hidden" name="post_type" value="ffw_media" />
          </fieldset>
      </form>
    </div>
    <div id="media_select" class="media-select inline-dropdown">
      <fieldset class="inline-fields">
        <select class="inline-select" name="ffw_media_select" id="ffw_media_select">
          <option value="example1">Example 1</option>
          <option value="example2">Example 2</option>
          <option value="example3">Example 3</option>
          <option value="example4">Example 4</option>
          <option value="example5">Example 5</option>
        </select>
      </fieldset>
    </div>
  </div><!-- .right (span6) -->
</div>

<!-- ================== -->
<!--        #MAIN       -->
<!-- ================== -->
<div id="main" class="default blog">
  <div class="container-full">
    <h2 class="section-title">All Media</h2>

    <!-- ================== -->
    <!--      #CONTENT      -->
    <!-- ================== -->
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
        
        <!-- ================== -->
        <!--     PAGINATION     -->
        <!-- ================== -->
        <?php do_action('FFW_pagination', array('id' => 'nav-below') ); ?>

      </div><!-- .content-inner -->
    </div><!-- .content -->

  </div><!-- .container-full -->
</div><!-- #main -->

<?php get_footer(); ?>