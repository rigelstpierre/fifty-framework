<?php get_header(); ?>

<?php do_action('FFW_slider_full', array(
	'id'       => 'slider_full_header',
	'class'    => 'slider-full',
	'category' => 'home'
)); ?>

<div id="main" class="default blog">
	<div class="container">

		<?php $sidebar_position_class = of_get_option ( 'sidebar_position_blog' ); ?>

		<div class="sidebar push-<?php echo $sidebar_position_class; ?>">
			<?php get_sidebar(); ?>
		</div><!-- #sidebar -->


		<div id="content" class="push-<?php echo $sidebar_position_class; ?>">
			<div class="content-inner">
				
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop/loop', get_post_format() ); ?>

				<?php endwhile; endif; ?>

				<?php do_action('FFW_pagination'); ?>
			</div>
		</div><!-- .content -->


	</div>
</div>

<?php get_footer(); ?>