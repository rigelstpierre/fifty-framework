<?php get_header(); ?>

<?php do_action('FFW_slider_full', array(
	'id'       => 'slider_full_header',
	'class'    => 'slider-full',
	'category' => 'home'
)); ?>


<section class="recent-campaigns" style="background-color:inherit;">
	<div class="container-full">
		<h1 class="section-title">Recent Campaigns (STATIC)</h1>
					
		<div class="row">

				<div class="box box-third recent-campaign has_hover_overlay has_footer">
					<a href="#">
						<div class="box-hover-overlay"></div>
						<main class="box-inner">
							<div class="box-image backstretch" data-img-src="<?php bloginfo('template_url') ?>/assets/images/content/samples/recent-campaign-1.jpg"></div>
						</main>
						<footer>
							<h4>Rise against’s Swing life away</h4>
							<span>lyrics to inspire a nation</span>
						</footer>
					</a>
				</div>

				<div class="box box-third recent-campaign has_hover_overlay has_footer">
					<a href="#">
						<div class="box-hover-overlay"></div>
						<main class="box-inner">
							<div class="box-image backstretch" data-img-src="<?php bloginfo('template_url') ?>/assets/images/content/samples/recent-campaign-2.jpg"></div>
						</main>
						<footer>
							<h4>Why drive when you can ride</h4>
							<span>why everyone should ride one day a week</span>
						</footer>
					</a>
				</div>

				<div class="box box-third recent-campaign has_hover_overlay has_footer">
					<a href="#">
						<div class="box-hover-overlay"></div>
						<main class="box-inner">
							<div class="box-image backstretch" data-img-src="<?php bloginfo('template_url') ?>/assets/images/content/samples/recent-campaign-3.jpg"></div>
						</main>
						<footer>
							<h4>Trip of a Lifetime</h4>
							<span>one man’s journey from oregon to patagonia</span>
						</footer>
					</a>
				</div>

		
		</div><!-- .row -->

	</div><!-- .container-full -->
</section>

<div id="main" class="default blog">
	<div class="container">
	<h1 class="section-title">From The Blog</h1>
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
	</div> <!-- .container -->
</div> <!-- #main -->


<?php get_footer(); ?>