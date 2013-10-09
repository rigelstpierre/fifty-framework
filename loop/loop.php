<?php
  if ( is_single() || is_singular() ) {
    $post_class = 'single';
  } elseif ( is_archive() || is_home() || is_front_page() ) {
    $post_class = 'archive';
  } elseif ( is_page() ) {
    $post_class = 'page';
  }
?>

<article class="post <?php echo $post_class; ?> post-<?php echo get_the_ID(); ?>">
  <header>
    <h2 class="post-title">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>
  </header>
  <div class="content">
    <?php the_content(); ?>
  </div>
  <footer>
    <?php do_action('FFW_post_details'); ?>
  </footer>
</article>