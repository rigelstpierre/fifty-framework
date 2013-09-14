<?php get_header(); ?>


<div id="main" class="default blog">
	<div class="container">

		<div class="sidebar push-<?php sidebar_position_class(); ?>">
			<?php get_sidebar(); ?>
		</div><!-- #sidebar -->


		<div id="content" class="push-<?php sidebar_position_class(); ?>">
			<div class="content-inner">
				<h1>Search Results for: <?php echo get_search_query(); ?></h1>
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop/loop', get_post_format() ); ?>

				<?php endwhile; endif; ?>

				<?php do_action('FFW_pagination', array('id' => 'nav-below') ); ?>
			</div>
		</div><!-- .content -->


	</div>
</div>

<?php get_footer(); ?>