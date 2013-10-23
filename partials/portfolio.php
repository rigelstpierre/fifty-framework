<?php

$posts            = get_sub_field('portfolio_items');
$section_title    = get_sub_field('section_title'); 
$section_subtitle = get_sub_field('section_subtitle'); 
$background_color = get_sub_field('background_color'); 
$text_color       = get_sub_field('text_color');
$background_image = get_sub_field('background_image');
$repeat_image     = get_sub_field('repeat_image');
$archive_link     = get_sub_field('archive_link');


//Set background Color
if( $background_color ){
	$background_color = "background-color:" . $background_color . "; ";
}

//Set Text Color
if( $text_color ){
	$text_color_style = "color:" . $text_color . "; ";

	$box_h4 = 'style=color:' . $text_color . ';' ;
}

//Check if $repeat_image is a 
if(  !empty( $repeat_image ) ){

	//Check if both Horizonatl and Vertical boxes are checked
	if( in_array( array('Horizontally', 'Vertically') , $repeat_image)){
		
		//Set to repeat
		$repeat = "background-repeat:repeat;";

	//Check if just vertical is checked
	}elseif( in_array( 'Vertically', $repeat_image ) && !in_array( 'Horizontally', $repeat_image )  ){
		
		$repeat = "background-repeat:repeat-y; ";

	//Check if just horizontal is checked
	}elseif( in_array( 'Horizontally', $repeat_image ) && !in_array( 'Vertically', $repeat_image ) ){
		
		$repeat = "background-repeat:repeat-x; ";
	}

//If $repeat_image is not set, then set to no-repeat and add background-size:cover
}else{
		$repeat = "background-repeat:no-repeat; background-size:cover;";
}

//If $background_image exists, then set the background style.
if( $background_image ){

	$background_image = "background-image:url(" . $background_image . "); " . $repeat;

}


if( $posts ): ?>

	<?php $section_width = get_sub_field('section_width'); // get the container class (section_width ACF) ?>
	<?php $port_column_class = get_column_count_class(); // get the column box class by counting post objects ?>
	
	<section class="portfolio" style="<?php echo $background_color. $text_color_style . $background_image; ?>">
		<div class="<?php echo $section_width; ?>">

			<?php if( $section_title ) : ?>
				<h2><?php the_sub_field('section_title'); ?></h2>
			<?php else : ?>
				<h2>Our Portfolio</h2>
			<?php endif; ?>
			
			<?php if( $section_subtitle ) : ?>
				<p><?php the_sub_field('section_subtitle'); ?></p>
			<?php endif; ?>


			<div class="row">
			<?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
				<?php setup_postdata($post); ?>
				<?php // get featured image url if it exists, fallback to placeholder
					if ( has_post_thumbnail() ) {
					 	$port_photo_thumb_url = get_featured_image_url();;
					} else {
						$port_photo_thumb_url = 'http://www.placehold.it/600';
					}
				 ?>
				<div class="box <?php echo $port_column_class; ?> has_footer has_hover_overlay">
					<a href="<?php the_permalink(); ?>"> 
						<div class="box-hover-overlay"></div>
						<main class="box-inner">
							<div class="box-image backstretch" data-img-src="<?php echo $port_photo_thumb_url; ?>"></div>
						</main>

						<?php $port_title = get_the_title(); ?>
						<?php if( !empty( $port_title )  ) : ?>
							<?php // if( current_user_can( 'moderate_comments') ) : echo "<!-- "; echo get_permalink( $post->ID ); echo " -->"; endif; ?>
						<footer>
							<h4 <?php echo $box_h4; ?>><?php the_title(); ?></h4>
							<?php 
							$terms = get_the_terms( $post->ID, 'portfolio_category' );
							
							if( $terms && ! is_wp_error( $terms ) ) { ?>
							<span>
								<?php
									foreach( $terms as $term) {
									    echo $term->name . ' ';
									} 
								?>
							</span>
							<?php } ?>
						</footer>
						<?php endif; ?>
					</a>
				</div>
			<?php endforeach; wp_reset_postdata(); ?>
			</div>
			<div class="row">
			<?php if( $archive_link) : ?><a href="/portfolio" class="btn"><?php the_sub_field('archive_text'); ?></a><?php endif; ?>
			</div>
		</div>
	</section>
<?php else :  ?>

	<section class="portfolio">
		<div class="container">
			<h1>Our Portfolio</h1>
			<div class="span4">
				<p>No portfolio items added yet.</p>
			</div>
		</div>
	</section>
	
<?php endif; ?>