<?php 

$slider_category 			= get_sub_field('slider_category');
$slider_animation2			= get_sub_field('slider_animation');
$slider_direction2			= get_sub_field('slider_direction');
$slider_prev_text2			= get_sub_field('slider_prev_text');
$slider_next_text2			= get_sub_field('slider_next_text');
$slider_speed2		 		= get_sub_field('slider_speed');
$slider_animation_speed2	= get_sub_field('slider_animation_speed');

// pp(get_field('sections'));

do_action('FFW_slider_full', array(
	'id'       => $slider_category->slug,
	'class'    => 'slider-full',
	'category' => $slider_category->slug,
	'options'	=> array(
		'slider_animation'			=> $slider_animation2,
		'slider_direction'			=> $slider_direction2,
		'slider_prev_text'			=> $slider_prev_text2,
		'slider_next_text'			=> $slider_next_text2,
		'slider_speed'				=> $slider_speed2,
		'slider_animation_speed'	=> $slider_animation_speed2

	)
));