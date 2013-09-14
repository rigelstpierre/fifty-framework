<article class="post post-format-video">
  
  <?php if ( is_single() ) : ?>
    <header>
      <h1 class="post-title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </h1>
    </header>
  <?php endif; ?>

  <div class="content">
    <?php // Get the ID from the URL
      $vid_url     = get_post_meta($post->ID, 'vid_url');
      $vid_url     = $vid_url[0];
      $vid_service = get_video_service($vid_url);
      $vid_id      = get_video_id($vid_url);
    ?>
    <?php 
      if( has_post_thumbnail() ) { 
        $vid_img_url    = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        $vid_img_class  = '';
      } else {
        $vid_img_url    = 'http://img.youtube.com/vi/'.$vid_id.'/hqdefault.jpg';
        $vid_img_class  = 'fallback';
      }
    ?>

    <a href="javascript:;" 
       id="<?php echo $vid_service; ?>-<?php echo $vid_id; ?>"
       class="post-format-video-image lazyload <?php echo $vid_img_class; ?>"
       data-video-id="<?php echo $vid_id; ?>"
       data-video-service="<?php echo $vid_service; ?>">
      <div class="post-format-video-overlay">
        <div class="post-format-video-content-wrap">
          <div class="post-format-video-content">
            <span class="post-format-video-icon"></span>
            <div class="post-format-video-title"><?php the_content(); ?></div>
          </div>
        </div>
      </div>
      <img src="<?php echo $vid_img_url; ?>" class="" alt="<?php the_title(); ?>">
    </a>

  </div>

  <footer>
    <?php do_action('FFW_post_details'); ?>
  </footer>
</article>