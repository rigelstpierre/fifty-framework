<?php get_header(); ?>

<?php do_action('FFW_slider_full', array(
	'id'       => 'slider_full_header',
	'class'    => 'slider-full',
	'category' => 'home'
)); ?>

<div id="main" class="default blog">
	<div class="container">


	<div style="background-color:#999;width:100%;height:auto;padding:50px;margin-top:20px;margin-bottom:20px;border-top:1px solid #ccc;border-bottom:1px solid #ccc;">
		<a href="#" class="btn btn-tab icon-group">.btn .btn-tab</a>
		<a href="#" class="btn btn-tab transparent icon-pulse">.btn .btn-tab .transparent</a>
		<a href="#" class="btn btn-tab secondary icon-meter">.btn .btn-tab .secondary</a>
		<a href="#" class="btn btn-tab secondary-transparent icon-piechart">.btn .btn-tab .secondary-transparent</a>
	</div>

	<div id="sidebar-default" class="sidebar collapsable collapsed push-<?php sidebar_position_class(); ?>">
    <div id="sidebar-toggle"></div>
    <?php get_sidebar(); ?>
  </div><!-- #sidebar -->


		<div id="content" class="push-<?php sidebar_position_class(); ?>">
			<div class="content-inner">

				
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop/loop', get_post_format() ); ?>

				<?php endwhile; endif; wp_reset_postdata(); ?>

				

				<?php do_action('FFW_pagination', array('id' => 'nav-below') ); ?>
			</div>
		</div><!-- .content -->




	</div>
</div>

<?php get_footer(); ?>