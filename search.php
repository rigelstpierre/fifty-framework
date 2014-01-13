<?php get_header(); ?>
<?php  $search_post_type = $_GET['post_type']; ?>


<?php 	if( $search_post_type !== 'ffw_media' ) : ?>
	<?php do_action('FFW_hero_before'); ?>
	<?php do_action('FFW_hero'); ?>
	<?php do_action('FFW_hero_after'); ?>

	<div id="main" class="default blog">
		<div class="container">
			<h2 class="section-title"><?php printf( __(  'Search Results for: %s', 'ffw' ), get_search_query() );  ?></h2>

			<div class="sidebar <?php sidebar_position_class(); ?>">
				<?php get_sidebar(); ?>
			</div><!-- #sidebar -->

			<div id="content" class="<?php sidebar_position_class(); ?>">
				<div class="content-inner">
					<h1 class="archive-title"></h1>
					<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop/loop', get_post_format() ); ?>

					<?php endwhile; else : ?> 
						<p>Sorry, your search returned no results.</p>
					<?php endif; ?>

					<?php do_action('FFW_pagination', array('id' => 'nav-below') ); ?>
				</div>
			</div><!-- .content -->


		</div>
	</div>
<?php else : ?>
	
	<?php get_template_part( 'search', $search_post_type ); ?>

	
<?php endif; ?>

<?php get_footer(); ?>