<?php get_header(); ?>

	<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

	404 Template

	<?php endwhile; endif; ?>

<?php get_footer(); ?>