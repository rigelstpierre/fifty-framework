<?php get_header(); ?>

<?php do_action('FFW_hero_before'); ?>
<?php do_action('FFW_hero'); ?>
<?php do_action('FFW_hero_after'); ?>

<div id="main" class="default blog">
	<div class="container">
		<h2 class="section-title">From the Blog</h2>
		<div class="sidebar <?php sidebar_position_class(); ?>">
			<?php get_sidebar(); ?>
		</div><!-- #sidebar -->


		<div id="content" class="<?php sidebar_position_class(); ?>">
			<div class="content-inner">
				<h1 class="archive-title"></h1>
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

					<?php  get_template_part( 'loop/loop', get_post_format() ); ?>

				<?php endwhile; endif; ?>

				<?php do_action('FFW_pagination', array('id' => 'nav-below') ); ?>
			</div><!-- .content-inner -->
		</div><!-- .content -->

	</div><!-- .container -->
</div><!-- #main -->

<?php get_footer(); ?>