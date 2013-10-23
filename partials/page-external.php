<?php

$select_page 		= get_sub_field('select_page', 'option');
$sel_page_id 		= $select_page->ID; 
$section_width 		= get_sub_field('section_width'); // get the container class (section_width ACF)
$background_color 	= get_sub_field('background_color'); 
$text_color 		= get_sub_field('text_color');
$background_image 	= get_sub_field('background_image');
$repeat_image		= get_sub_field('repeat_image');
$archive_link		= get_sub_field('archive_link');
 
	if( $background_color ){
		$background_color = "background-color:" . $background_color . "; ";
	}

	if( $text_color ){
		$text_color = "color:" . $text_color . "; ";
	}

	if(  !empty( $repeat_image ) ){


		if( in_array( array('Horizontally', 'Vertically') , $repeat_image)){
			$repeat = "background-repeat:repeat;";
		}elseif( in_array( 'Vertically', $repeat_image ) && !in_array( 'Horizontally', $repeat_image )  ){
			echo 'vertical is true';
			$repeat = "background-repeat:repeat-y; ";
		}elseif( in_array( 'Horizontally', $repeat_image ) && !in_array( 'Vertically', $repeat_image ) ){
			echo 'Horizontally is true';
			$repeat = "background-repeat:repeat-x; ";
		}
	}else{
			$repeat = "background-repeat:no-repeat; background-size:cover;";
	}
	
	if( $background_image ){

		$background_image = "background-image:url(" . $background_image . "); " . $repeat;

	}
?>


<?php 
$page_args = array(
	'post_type'		=>	'page',
	'page_id'		=>	$sel_page_id
);
$page_query = new WP_query( $page_args);
if( $page_query->have_posts() ) : while( $page_query->have_posts() ) : $page_query->the_post(); ?>

<section style="<?php echo $background_color. $text_color . $background_image; ?>">
	<div class="<?php echo $section_width; ?>">
		<div class="row">
			<h1><?php the_title(); ?></h1>
			<?php the_excerpt(); ?>
		</div>
		<?php if( $archive_link) : ?>
		<div class="row centered">
			<a href="<?php the_sub_field('page_link'); ?>" class="btn"><?php the_sub_field('archive_text'); ?></a>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php endwhile; endif; wp_reset_query(); ?>