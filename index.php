<?php get_header(); ?>

<div class="wrap">
	<div class="content">
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<div class="post">
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<?php the_content(); ?>
			</div>
		<?php endwhile; endif; ?>

		<div class="pagination">
			<div class="next-posts">
				<?php next_posts_link(); ?>
			</div>
			<div class="previous-posts">
				<?php previous_posts_link(); ?>
			</div>
		</div>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>