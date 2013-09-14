<?php get_header(); ?>


<div id="main" class="default blog">
	<div class="container">

		<div class="sidebar push-<?php sidebar_position_class(); ?>">
			<?php get_sidebar(); ?>
		</div><!-- #sidebar -->


		<div id="content" class="push-<?php sidebar_position_class(); ?>">
			<div class="content-inner">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'twentythirteen' ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentythirteen' ) ) );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentythirteen' ) ) );
					else :
						_e( 'Archives', 'twentythirteen' );
					endif;
				?></h1>
				<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop/loop', get_post_format() ); ?>

				<?php endwhile; endif; ?>

				<?php do_action('FFW_pagination', array('id' => 'nav-below') ); ?>
			</div>
		</div><!-- .content -->


	</div>
</div>

<?php get_footer(); ?>