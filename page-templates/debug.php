<?php 
/* 
  Template Name: FFW Debugging
 */
get_header(); ?>

<?php do_action('FFW_hero_before'); ?>
<?php do_action('FFW_hero', array('text_override' => 'Debug')); ?>
<?php do_action('FFW_hero_after'); ?>

<div id="main" class="default blog">
  <div class="container">
  <!-- <h2 class="section-title">Debugging</h2> -->

    <div id="content" class="full debug">
      <div class="content-inner">
        
        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

          <?php //get_template_part( 'loop/loop', get_post_format() ); ?>

        <?php endwhile; endif; wp_reset_postdata(); ?>

        
        <?php /* FONTAWESOME DEBUGGING
        ================================================== */ ?>
        <div id="debug_fa" class="row row-debug">
          <header><h2>FontAwesome Debug</h2><hr/></header>

          <div class="inner">
            
            <i class="icon icon-angle-up"></i>
            <i class="icon icon-angle-right"></i>
            <i class="icon icon-angle-left"></i>
            <i class="icon icon-angle-down"></i>
          </div>
        </div>




        <?php /* MISC DEBUGGING
        ================================================== */ ?>
        <div id="debug_vardumps" class="row row-debug">
            <header><h2>VAR_DUMPS</h2><hr/></header>
    

            <h3>dntly_get_accounts</h3>
            <pre>
            <?php 
                $dntly          = new DNTLY_API;
                $dntly_accounts = $dntly->get_accounts();
                var_dump($dntly_accounts);
            ?>
            </pre>
            
            <h3>Post Meta</h3>
            <pre><?php var_dump(get_post_meta( $post->ID )); ?></pre>
              

            <h3>Video Services - YOUTUBE</h3>
            <?php $youtube_vid_url  = 'http://www.youtube.com/watch?v=ee1FaPyyyW4'; ?>
            <pre><?php var_dump(get_video_service($youtube_vid_url)); ?></pre>
            <pre><?php var_dump(get_video_id($youtube_vid_url)); ?></pre>
            <pre><?php var_dump(get_video_data($youtube_vid_url, 'thumbnail_large')); ?></pre>

            <h3>Video Services - VIMEO</h3>
            <?php $vimeo_vid_url = 'http://vimeo.com/80973511'; ?>
            <pre><?php var_dump(get_video_service($vimeo_vid_url)); ?></pre>
            <pre><?php var_dump(get_video_id($vimeo_vid_url)); ?></pre>
            <pre><?php var_dump(get_video_data($vimeo_vid_url, 'thumbnail_large')); ?></pre>


            <h3>Attachment Metadata</h3>
            <pre><?php var_dump(wp_get_attachment_metadata( $post->ID, true )); ?></pre>
            <pre><?php var_dump(wp_get_attachment_thumb_file( $post->ID )); ?></pre>
            <pre><?php var_dump(get_post_thumbnail_id( get_the_ID() )); ?></pre>
            <pre><?php var_dump(get_post_meta( $post->ID, '_wp_attachment_metadata', $single = false )); ?></pre>


            <h3>Options Framework Values</h3>
            <pre><?php var_dump(of_get_option('toggle_app_js')); ?></pre>

            

            <h3>Post ID</h3>
            <pre><?php var_dump(get_the_ID()); ?></pre>




            <h3>Donately Meta</h3>
            <pre><?php var_dump($dntly_settings); ?></pre>


        </div>


        <?php do_action('FFW_pagination', array( 'id' => 'nav-below', 'class' => 'center' ) ); ?>
      </div>
    </div><!-- .content -->
  </div> <!-- .container -->
</div> <!-- #main -->


<?php get_footer(); ?>