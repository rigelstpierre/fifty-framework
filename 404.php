<?php get_header(); ?>

<div id="main" class="page page-default default">
  <div class="container">
	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
		<article class="post post-<?php echo get_the_ID(); ?>">
		  <header>
		    <h1 class="post-title">
		      404 Error - Page Not Found
		    </h1>
		  </header>
		  <div class="content">
		   	<p>The page your looking for is either missing or does not exist.</p>
		  </div>
		  <footer></footer>
		</article>
	<?php endwhile; endif; ?>
  </div><!-- .container -->
</div><!-- #main -->

<?php get_footer(); ?>