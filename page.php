<?php get_header(); ?>

<div id="main" class="default blog">
	<div class="container">

		<div class="sidebar push-<?php sidebar_position_class(); ?>">
			<?php get_sidebar(); ?>
		</div><!-- #sidebar -->


		<div id="content" class="push-<?php sidebar_position_class(); ?>">
			<div class="content-inner">
				
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop/loop', get_post_format() ); ?>

				<?php endwhile; endif; ?>

			</div>
		</div><!-- .content -->


	</div>
</div>

<?php get_footer(); ?>