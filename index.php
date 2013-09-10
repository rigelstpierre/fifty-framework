<?php get_header(); ?>

<?php do_action('FFW_slider_full', 'home'); ?>

<div id="main" class="default blog">
	<div class="container">

		<?php $sidebar_position_class = of_get_option ( 'sidebar_position_blog' ); ?>

		<div class="sidebar push-<?php echo $sidebar_position_class; ?>">
			<?php get_sidebar(); ?>
		</div><!-- #sidebar -->


		<div class="content push-<?php echo $sidebar_position_class; ?>">
			<div class="content-inner">
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
					<div class="post">
						<h1 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
						<?php the_content(); ?>
					</div>
				<?php endwhile; endif; ?>

				<?php do_action('FFW_pagination'); ?>
			</div>
		</div><!-- .content -->


	</div>
</div>

<?php get_footer(); ?>