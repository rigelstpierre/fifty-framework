<?php 
/* 
Template Name: Features
 */
get_header(); ?>

<?php do_action('FFW_hero_before'); ?>
<?php do_action('FFW_hero'); ?>
<?php do_action('FFW_hero_after'); ?>


<div id="main" class="page page-debug default">
  <div class="container">

    <div id="sidebar-default" class="sidebar collapsable collapsed push-<?php sidebar_position_class(); ?>">
      <div id="sidebar-toggle"></div>
      <?php get_sidebar(); ?>
    </div><!-- #sidebar -->
    
    <div id="content" class="push-<?php sidebar_position_class(); ?>">
      <div class="content-inner">
        
        <article class="post">
          <h1 class="post-title">Helper Functions:</h1>
          <hr>

          <h3>get_video_service( $url )</h3>
          <p>
            <ul class="list">
              <li><b>Parameters:</b> A URL pointing to the video page of a popular provider</li>
              <li><b>Supported Providers:</b> Youtube, Vimeo</li>
              <li><b>Return:</b> The name of the video hosting provider <em>(string)</em></li>
            </ul>
          </p>

          <h3>get_video_id( $url )</h3>
          <p>
            <ul class="list">
              <li><b>Parameters:</b> A URL pointing to the video page of a popular provider</li>
              <li><b>Supported Providers:</b> Youtube, Vimeo</li>
              <li><b>Return:</b> The ID of the video <em>(string)</em></li>
            </ul>
          </p>

          <h3>get_video_thumb_url( $url )</h3>
          <p>
            <ul class="list">
              <li><b>Parameters:</b> A URL pointing to the video page of a popular provider</li>
              <li><b>Supported Providers:</b> Youtube, Vimeo</li>
              <li><b>Return:</b> The url of thumbnail for the video <em>(string)</em></li>
            </ul>
          </p>
        </article>



        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
          <?php //get_template_part( 'loop/loop', get_post_format() ); ?>
        <?php endwhile; endif; ?>

      </div><!-- .content-inner -->
    </div><!-- #content -->
  </div><!-- .container -->
</div><!-- #main -->



<?php get_footer(); ?>