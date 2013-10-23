<article class="post post-format-image">
  
  <?php if ( is_single() ) : ?>
    <!-- <header>
      <h1 class="post-title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </h1>
    </header> -->
  <?php endif; ?>

  <div class="content">
    <?php 
      if( has_post_thumbnail() ) { 
        $img_url    = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        $img_class  = '';
      } else {
        $img_url    = get_bloginfo('template_url').'/assets/images/content/post-formats/image/fallback.png';
        $img_class  = 'fallback';
      }
    ?>

    <a href="<?php the_permalink() ?>" class="post-format-image-image <?php echo $img_class; ?>">
      <div class="post-format-image-overlay">
        <div class="post-format-image-content-wrap">
          <div class="post-format-image-content">
            <span class="post-format-image-icon"></span>
            <div class="post-format-image-title"><?php the_content(); ?></div>
          </div>
        </div>
      </div>
      <img src="<?php echo $img_url; ?>" class="" alt="<?php the_title(); ?>">
    </a>

  </div>
  <footer>
    <?php do_action('FFW_post_details'); ?>
  </footer>
</article>