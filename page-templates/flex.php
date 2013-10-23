<?php 
/*
Template Name: Flexible Template
*/
get_header(); ?>

<?php 

//Set true/false field to variable
$show_slider = get_field('show_slider');  

//Check if true
if( $show_slider ){

	//Set variable to the tax object
	$slide_cat = get_field('slide_category');

	//Run Slider action
	do_action('FFW_slider_full', array(
		'id'       => 'slider_full_header',
		'class'    => 'slider-full',
		'category' => $slide_cat->slug
	));
}

?> 


	<?php 
	//set $page_content_location to meta field variable
	$page_content_location = get_field('page_content_location'); ?>
	
	<?php 
	//Conditional checking if the user wants the page content "Above" ::case sensitive
	if( $page_content_location == 'Above') : ?>
		<?php get_template_part( 'partials/page', 'index' ); ?>
	<?php endif; ?>

	<?php while( has_sub_field( 'sections', $post->ID ) ) : ?>

		<?php if( get_row_layout() == 'slider_layout') : ?>
			<?php get_template_part( 'partials/slider', 'index' ); ?>
		<?php endif; ?>

		<?php if( get_row_layout() == 'blog_layout') : ?>
			<?php get_template_part( 'partials/blog', 'index' ); ?>
		<?php endif; ?>

		<?php if( get_row_layout() == "staff_layout") : ?>
			<?php get_template_part( 'partials/staff', 'index' ); ?>
		<?php endif; ?>

		<?php if( get_row_layout() == "portfolio_layout") : ?>
			<?php get_template_part( 'partials/portfolio', 'index' ); ?>
		<?php endif; ?>

		<?php if( get_row_layout() == "page_layout") : ?>
			<?php get_template_part( 'partials/page', 'external' ); ?>
		<?php endif; ?>

		<?php if( get_row_layout() == 'general_use') : ?>
			<?php get_template_part( 'partials/general', 'use' ); ?>
		<?php endif; ?>

	<?php endwhile; ?>

	<?php 
	//Conditional checking if the user wants the page content "Below" ::case sen2itive
	if( $page_content_location == 'Below') : ?>
		<?php get_template_part( 'partials/page', 'index' ); ?>
	<?php endif; ?>


<?php get_footer(); ?>