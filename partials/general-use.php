<?php 
	$section_content		= get_sub_field('general_content');
	$background_color 		= get_sub_field('background_color'); 
	$text_color 			= get_sub_field('text_color');
	$background_image 		= get_sub_field('background_image');
	$repeat_image			= get_sub_field('repeat_image');
	$section_width 			= get_sub_field('section_width'); // get the container class (section_width ACF)
	$section_padding_top	= get_sub_field('section_padding_top');
	$section_padding_bottom	= get_sub_field('section_padding_bottom');
	

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

	if( $section_padding_top || $section_padding_bottom ){
		$section_padding = 'padding:' . $section_padding_top . 'px 0 ' . $section_padding_bottom . 'px 0; ';
	}
 ?>
<section style="<?php echo $background_color. $text_color . $background_image . $section_padding; ?>">
	<div class="<?php echo $section_width; ?>">
		<?php echo $section_content; ?>
	</div>
</section>