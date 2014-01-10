<?php get_header(); ?>

<!-- ==================== -->
<!--         HERO         -->
<!-- ==================== -->
<?php do_action('FFW_slider_full', array(
	'id'       => 'slider_full_header',
	'class'    => 'slider-full',
	'category' => 'home'
)); ?>

<!-- ==================== -->
<!--         MAIN         -->
<!-- ==================== -->
<div id="main" class="default blog">
	<div class="container">
	<header class="section-header">
		<h2 class="section-title">From The Blog</h2>
	</header>

		<!-- ==================== -->
		<!--        SIDEBAR       -->
		<!-- ==================== -->
		<div id="sidebar-default" class="sidebar collapsable collapsed <?php sidebar_position_class(); ?>">
		    <div id="sidebar-toggle"></div>
		    <?php get_sidebar(); ?>
	  	</div><!-- #sidebar -->
		
		<!-- ==================== -->
		<!--        CONTENT       -->
		<!-- ==================== -->
		<div id="content" class="<?php sidebar_position_class(); ?>">
			<div class="content-inner">
				
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop/loop', get_post_format() ); ?>

				<?php endwhile; endif; wp_reset_postdata(); ?>		

				<?php do_action('FFW_pagination', array( 'id' => 'nav-below', 'class' => 'center' ) ); ?>
			</div>
		</div><!-- .content -->
	</div> <!-- .container -->
</div> <!-- #main -->


<?php get_footer(); ?>