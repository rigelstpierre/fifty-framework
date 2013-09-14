<article class="post post-<?php echo get_the_ID(); ?>">
  <header>
    <h1 class="post-title">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h1>
  </header>
  <div class="content">
    <?php the_content(); ?>
  </div>
  <footer>
    <?php do_action('FFW_post_details'); ?>
  </footer>
</article>