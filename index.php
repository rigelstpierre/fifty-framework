<?php get_header(); ?>

<!-- <div style="width:100%;height:300px;background-color:#3a3a3a;"></div> -->

<?php do_action('FFW_slider_full'); ?>

<div id="main" class="default">
	<div class="container">

		<div class="content">
			<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
				<div class="post">
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<?php the_content(); ?>
				</div>
			<?php endwhile; endif; ?>

			<?php do_action('FFW_pagination'); ?>
		</div>

		<?php get_sidebar(); ?>

	</div>
</div>

<?php get_footer(); ?>