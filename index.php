<?php get_header(); ?>

<!-- <div style="width:100%;height:300px;background-color:#3a3a3a;"></div> -->

<div class="slider-full flexslider">
	<ul class="slides">

	  <?php 
	  	// if(get_field('header_slider')): while(has_sub_field('header_slider')): 
	   //  $attachment_id = get_sub_field('header_slider_slide');
	   //  $size = "full"; // (thumbnail, medium, large, full or custom size)
	   //  $slide_image = wp_get_attachment_image_src( $attachment_id, $size );
	  ?>

	    <li data-thumb="<?php echo $slide_image[0]; ?>" style="background-image:url('<?php echo $slide_image[0]; ?>');">
	      <div class="container">
	        <div class="slide-content">
	          
	          <?php //the_sub_field('header_slider_content'); ?>

	          Slide Content

	        </div>
	      </div>
	    </li>
	  
	  <?php //endwhile; endif; ?>

	</ul><!-- .slides -->
</div>

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