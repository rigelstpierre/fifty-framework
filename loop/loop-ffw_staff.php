<article class="post post-<?php echo get_the_ID(); ?>">
  <header>
    <h1 class="post-title">
      <?php the_title(); ?>
    </h1>
  </header>
  <div class="content">
    <?php the_content(); ?>
  </div>
  <footer></footer>
</article>