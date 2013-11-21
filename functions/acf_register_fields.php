<?php
/**
 *  Install Add-ons
 *  
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *  
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme/plugin as outlined in the terms and conditions.
 *  For more information, please read:
 *  - http://www.advancedcustomfields.com/terms-conditions/
 *  - http://www.advancedcustomfields.com/resources/getting-started/including-lite-mode-in-a-plugin-theme/
 */ 

// Add-ons 
include_once('add-ons/acf-repeater/acf-repeater.php');
// include_once('add-ons/acf-gallery/acf-gallery.php');
include_once('add-ons/acf-flexible-content/acf-flexible-content.php');
// include_once( 'add-ons/acf-options-page/acf-options-page.php' );


/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

if( function_exists( "register_field_group" ) ) {
	register_field_group( array(
		'id' => 'acf_flexible-template',
		'title' => 'Flexible Template',
		'fields' => array(
			array(
				'key' => 'field_523a15195241e',
				'label' => 'Sections',
				'name' => 'sections',
				'type' => 'flexible_content',
				'instructions' => 'Add a section.',
				'layouts' => array(
					array(
						'label' => 'Blog',
						'name' => 'blog_layout',
						'display' => 'row',
						'sub_fields' => array(
							array(
								'key' => 'field_5243760dcf349',
								'label' => 'Section Title',
								'name' => 'section_title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => 'From our Blog',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array(
								'key' => 'field_52437620cf34a',
								'label' => 'Section Subtitle',
								'name' => 'section_subtitle',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array(
								'key' => 'field_523a15a85241f',
								'label' => 'Number Posts',
								'name' => 'number_posts',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'none',
								'maxlength' => '',
							),
							array(
								'key' => 'field_52532d34d7662',
								'label' => 'Show Full Content',
								'name' => 'show_full_content',
								'type' => 'true_false',
								'instructions' => 'Choose how to display your blog post. You show full content or just an excerpt. ',
								'column_width' => '',
								'message' => 'Show full content',
								'default_value' => 1,
							),
							array(
								'key' => 'field_52533198e1f6e',
								'label' => 'Show Link to Blog',
								'name' => 'show_link_to_blog',
								'type' => 'true_false',
								'column_width' => '',
								'message' => 'Check to show a link to your blog posts.',
								'default_value' => 0,
							),
							array(
								'key' => 'field_5253327499bbd',
								'label' => 'Blog Link Text',
								'name' => 'blog_link_text',
								'type' => 'text',
								'instructions' => 'If you show a link, you can customize the text here.',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
						),
					),
					array(
						'label' => 'Staff',
						'name' => 'staff_layout',
						'display' => 'row',
						'sub_fields' => array(
							array(
								'key'           => 'field_fiftyand50staffID',
								'label'         => 'Container ID',
								'name'          => 'container_id',
								'type'          => 'text',
								'instructions'  => 'Give the container of the flex element an ID',
								'column_width'  => '',
								'default_value' => '',
								'placeholder'   => '',
								'prepend'       => '',
								'append'        => '',
								'formatting'    => 'none',
								'maxlength'     => '',
							),
							array(
								'key'          => 'field_5241f74c6ce0f',
								'label'        => 'Section Width',
								'name'         => 'section_width',
								'type'         => 'select',
								'instructions' => 'Choose the width of the container (grid-container or full-width)',
								'column_width' => '',
								'choices'      => array(
									'container'      => 'Container',
									'container-full' => 'Full',
								),
								'default_value' => '',
								'allow_null'    => 0,
								'multiple'      => 0,
							),
							array(
								'key'           => 'field_523b464f9a5bb',
								'label'         => 'Section Title',
								'name'          => 'section_title',
								'type'          => 'text',
								'column_width'  => '',
								'default_value' => '',
								'placeholder'   => '',
								'prepend'       => '',
								'append'        => '',
								'formatting'    => 'none',
								'maxlength'     => '',
							),
							array(
								'key'           => 'field_fiftyand50staffSubtitle',
								'label'         => 'Section Subtitle',
								'name'          => 'section_subtitle',
								'type'          => 'text',
								'column_width'  => '',
								'default_value' => '',
								'placeholder'   => '',
								'prepend'       => '',
								'append'        => '',
								'formatting'    => 'html',
								'maxlength'     => '',
							),
							array(
								'key'           => 'field_523b3a72f05f3',
								'label'         => 'Staff Members',
								'name'          => 'staff_members',
								'type'          => 'relationship',
								'column_width'  => '',
								'return_format' => 'object',
								'post_type'     => array(
									0 => 'ffw_staff',
								),
								'filters' => array(
									0 => 'search',
								),
								'result_elements' => array(
									0 => 'featured_image',
									1 => 'post_type',
									2 => 'post_title',
								),
								'max' => '',
							),
							array(
								'key' => 'field_523b465c9a5bc',
								'label' => 'Background Color',
								'name' => 'background_color',
								'type' => 'color_picker',
								'column_width' => '',
								'default_value' => '',
							),
							array(
								'key' => 'field_523b46859a5bd',
								'label' => 'Text Color',
								'name' => 'text_color',
								'type' => 'color_picker',
								'column_width' => '',
								'default_value' => '',
							),
							array(
								'key' => 'field_5240d2c92e764',
								'label' => 'Background Image',
								'name' => 'background_image',
								'type' => 'image',
								'column_width' => '',
								'save_format' => 'url',
								'preview_size' => 'thumbnail',
								'library' => 'all',
							),
							array(
								'key' => 'field_5240d2a999316',
								'label' => 'Repeat Image',
								'name' => 'repeat_image',
								'type' => 'checkbox',
								'column_width' => '',
								'choices' => array(
									'Vertically' => 'Vertically',
									'Horizontally' => 'Horizontally',
								),
								'default_value' => '',
								'layout' => 'vertical',
							),
							array(
								'key' => 'field_5240d394fb4e0',
								'label' => 'Link to Archive',
								'name' => 'archive_link',
								'type' => 'true_false',
								'column_width' => '',
								'message' => 'Would you like to show a link to the archive page?',
								'default_value' => 1,
							),
							array(
								'key' => 'field_5240d3c1387fd',
								'label' => 'Archive Text',
								'name' => 'archive_text',
								'type' => 'text',
								'column_width' => '',
								'default_value' => 'Meet our Team',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'none',
								'maxlength' => '',
							),
						),
					),
					array(
						'label' => 'Portfolio',
						'name' => 'portfolio_layout',
						'display' => 'row',
						'sub_fields' => array(
							array(
								'key' => 'field_5241f7cd6ce10',
								'label' => 'Section Width',
								'name' => 'section_width',
								'type' => 'select',
								'instructions' => 'Choose the width of the container (grid-container or full-width)',
								'column_width' => '',
								'choices' => array(
									'container' => 'Container',
									'container-full' => 'Full',
								),
								'default_value' => '',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array(
								'key' => 'field_5240d61eb3b5f',
								'label' => 'Section Title',
								'name' => 'section_title',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'none',
								'maxlength' => '',
							),
							array(
								'key' => 'field_52437635cf34b',
								'label' => 'Section Subtitle',
								'name' => 'section_subtitle',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array(
								'key' => 'field_5240d61eb3b60',
								'label' => 'Portfolio Items',
								'name' => 'portfolio_items',
								'type' => 'relationship',
								'column_width' => '',
								'return_format' => 'object',
								'post_type' => array(
									0 => 'ffw_portfolio',
								),
								'taxonomy' => array(
									0 => 'all',
								),
								'filters' => array(
									0 => 'search',
								),
								'result_elements' => array(
									0 => 'featured_image',
									1 => 'post_type',
									2 => 'post_title',
								),
								'max' => '',
							),
							array(
								'key' => 'field_5240d61eb3b61',
								'label' => 'Background Color',
								'name' => 'background_color',
								'type' => 'color_picker',
								'column_width' => '',
								'default_value' => '',
							),
							array(
								'key' => 'field_5240d61eb3b62',
								'label' => 'Text Color',
								'name' => 'text_color',
								'type' => 'color_picker',
								'column_width' => '',
								'default_value' => '',
							),
							array(
								'key' => 'field_5240d61eb3b63',
								'label' => 'Background Image',
								'name' => 'background_image',
								'type' => 'image',
								'column_width' => '',
								'save_format' => 'url',
								'preview_size' => 'thumbnail',
								'library' => 'all',
							),
							array(
								'key' => 'field_5240d61eb3b64',
								'label' => 'Repeat Image',
								'name' => 'repeat_image',
								'type' => 'checkbox',
								'column_width' => '',
								'choices' => array(
									'Vertically' => 'Vertically',
									'Horizontally' => 'Horizontally',
								),
								'default_value' => '',
								'layout' => 'vertical',
							),
							array(
								'key' => 'field_5240d61eb3b65',
								'label' => 'Link to Archive',
								'name' => 'archive_link',
								'type' => 'true_false',
								'column_width' => '',
								'message' => 'Would you like to show a link to the archive page?',
								'default_value' => 1,
							),
							array(
								'key' => 'field_5240d61eb3b66',
								'label' => 'Archive Text',
								'name' => 'archive_text',
								'type' => 'text',
								'column_width' => '',
								'default_value' => 'See More',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'none',
								'maxlength' => '',
							),
						),
					),
					array(
						'label' => 'Page',
						'name' => 'page_layout',
						'display' => 'row',
						'sub_fields' => array(
							array(
								'key' => 'field_524204363da4b',
								'label' => 'Section Width',
								'name' => 'section_width',
								'type' => 'select',
								'instructions' => 'Choose the width of the container (grid-container or full-width)',
								'column_width' => '',
								'choices' => array(
									'container' => 'Container',
									'container-full' => 'Full',
								),
								'default_value' => '',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array(
								'key' => 'field_523a161b52426',
								'label' => 'Select Page',
								'name' => 'select_page',
								'type' => 'post_object',
								'column_width' => '',
								'post_type' => array(
									0 => 'page',
								),
								'taxonomy' => array(
									0 => 'all',
								),
								'allow_null' => 0,
								'multiple' => 0,
							),
							array(
								'key' => 'field_52420a433e054',
								'label' => 'Background Color',
								'name' => 'background_color',
								'type' => 'color_picker',
								'column_width' => '',
								'default_value' => '',
							),
							array(
								'key' => 'field_52420a4f3e055',
								'label' => 'Text Color',
								'name' => 'text_color',
								'type' => 'color_picker',
								'column_width' => '',
								'default_value' => '',
							),
							array(
								'key' => 'field_52420a573e056',
								'label' => 'Background Image',
								'name' => 'background_image',
								'type' => 'image',
								'column_width' => '',
								'save_format' => 'url',
								'preview_size' => 'thumbnail',
								'library' => 'all',
							),
							array(
								'key' => 'field_52420a8f3e057',
								'label' => 'Background image repeat',
								'name' => 'repeat_image',
								'type' => 'checkbox',
								'column_width' => '',
								'choices' => array(
									'Vertically' => 'Vertically',
									'Horizontally' => 'Horizontally',
								),
								'default_value' => '',
								'layout' => 'vertical',
							),
							array(
								'key' => 'field_524dbfa5526fd',
								'label' => 'Link to Page',
								'name' => 'archive_link',
								'type' => 'true_false',
								'column_width' => '',
								'message' => 'Would you like to show a link to the archive page?',
								'default_value' => 0,
							),
							array(
								'key' => 'field_524dbfe4526fe',
								'label' => 'Page Text',
								'name' => 'archive_text',
								'type' => 'text',
								'column_width' => '',
								'default_value' => '',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'html',
								'maxlength' => '',
							),
							array(
								'key' => 'field_524dc00b526ff',
								'label' => 'Page Link',
								'name' => 'page_link',
								'type' => 'page_link',
								'instructions' => 'Select a page to link to.',
								'column_width' => '',
								'post_type' => array(
									0 => 'page',
								),
								'allow_null' => 0,
								'multiple' => 0,
							),
						),
					),
					array(
						'label' => 'General Use',
						'name' => 'general_use',
						'display' => 'row',
						'sub_fields' => array(
							array(
								'key'           => 'field_fiftyand50',
								'label'         => 'Container ID',
								'name'          => 'container_id',
								'type'          => 'text',
								'instructions'  => 'Give the container of the flex element an ID',
								'column_width'  => '',
								'default_value' => '',
								'placeholder'   => '',
								'prepend'       => '',
								'append'        => '',
								'formatting'    => 'none',
								'maxlength'     => '',
							),
							array(
								'key' => 'field_5242045e3da4c',
								'label' => 'Section Width',
								'name' => 'section_width',
								'type' => 'select',
								'instructions' => 'Choose the width of the container (grid-container or full-width)',
								'column_width' => '',
								'choices' => array(
									'container' => 'Container',
									'container-full' => 'Full',
								),
								'default_value' => '',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array(
								'key' => 'field_524afd3caa9bb',
								'label' => 'Section Padding Top',
								'name' => 'section_padding_top',
								'type' => 'number',
								'instructions' => 'Adjust padding-top in pixels.',
								'column_width' => '',
								'default_value' => 100,
								'placeholder' => '',
								'prepend' => '',
								'append' => 'px',
								'min' => 50,
								'max' => '',
								'step' => '',
							),
							array(
								'key' => 'field_524b0190d7227',
								'label' => 'Section Padding Bottom',
								'name' => 'section_padding_bottom',
								'type' => 'number',
								'instructions' => 'Adjust padding-bottom in pixels.',
								'column_width' => '',
								'default_value' => 100,
								'placeholder' => '',
								'prepend' => '',
								'append' => 'px',
								'min' => 50,
								'max' => '',
								'step' => '',
							),
							array(
								'key' => 'field_523b31fbba440',
								'label' => 'General Content',
								'name' => 'general_content',
								'type' => 'wysiwyg',
								'column_width' => '',
								'default_value' => '',
								'toolbar' => 'full',
								'media_upload' => 'yes',
							),
							array(
								'key' => 'field_523b32e35703e',
								'label' => 'Background Color',
								'name' => 'background_color',
								'type' => 'color_picker',
								'column_width' => '',
								'default_value' => '',
							),
							array(
								'key' => 'field_5240c5483d10c',
								'label' => 'Text Color',
								'name' => 'text_color',
								'type' => 'color_picker',
								'column_width' => '',
								'default_value' => '',
							),
							array(
								'key' => 'field_5240c74e354a1',
								'label' => 'Background Image',
								'name' => 'background_image',
								'type' => 'image',
								'column_width' => '',
								'save_format' => 'url',
								'preview_size' => 'thumbnail',
								'library' => 'all',
							),
							array(
								'key' => 'field_5240c7092f056',
								'label' => 'Repeat Image',
								'name' => 'repeat_image',
								'type' => 'checkbox',
								'column_width' => '',
								'choices' => array(
									'Vertically' => 'Vertically',
									'Horizontally' => 'Horizontally',
								),
								'default_value' => '',
								'layout' => 'vertical',
							),
						),
					),
					array(
						'label' => 'Slider Layout',
						'name' => 'slider_layout',
						'display' => 'row',
						'sub_fields' => array(
							array(
								'key' => 'field_5244b1a3af892',
								'label' => 'Slider Category',
								'name' => 'slider_category',
								'type' => 'taxonomy',
								'column_width' => '',
								'taxonomy' => 'slides_category',
								'field_type' => 'select',
								'allow_null' => 0,
								'load_save_terms' => 0,
								'return_format' => 'object',
								'multiple' => 0,
							),
							array(
								'key' => 'field_5244b1b7af893',
								'label' => 'Slider Animation',
								'name' => 'slider_animation',
								'type' => 'select',
								'column_width' => '',
								'choices' => array(
									'slide' => 'Slide',
									'fade' => 'Fade',
								),
								'default_value' => 'fade',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array(
								'key' => 'field_5244b1dcaf894',
								'label' => 'Slider Direction',
								'name' => 'slider_direction',
								'type' => 'select',
								'column_width' => '',
								'choices' => array(
									'horizontal' => 'Horizontal',
									'vertical' => 'Vertical',
								),
								'default_value' => 'horizontal : Horizontal',
								'allow_null' => 0,
								'multiple' => 0,
							),
							array(
								'key' => 'field_5244b1f5af895',
								'label' => 'Slider Previous Text',
								'name' => 'slider_prev_text',
								'type' => 'text',
								'instructions' => 'Use <a href="http://www.arrrows.com/">Arrows</a> for different style arrows',
								'column_width' => '',
								'default_value' => 'N',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'none',
								'maxlength' => '',
							),
							array(
								'key' => 'field_5244b23daf896',
								'label' => 'Slider Next Text',
								'name' => 'slider_next_text',
								'type' => 'text',
								'instructions' => 'Use <a href="http://www.arrrows.com/">Arrows</a> for different style arrows',
								'column_width' => '',
								'default_value' => 'n',
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'formatting' => 'none',
								'maxlength' => '',
							),
							array(
								'key' => 'field_5244b248af897',
								'label' => 'Slider Speed',
								'name' => 'slider_speed',
								'type' => 'number',
								'instructions' => 'Enter your preferred slider speed in milliseconds.',
								'column_width' => '',
								'default_value' => 7000,
								'placeholder' => '',
								'prepend' => '',
								'append' => 'milliseconds',
								'min' => '',
								'max' => '',
								'step' => '',
							),
							array(
								'key' => 'field_5244b26eaf898',
								'label' => 'Slider Animation Speed',
								'name' => 'slider_animation_speed',
								'type' => 'number',
								'instructions' => 'Enter your preferred slider speed in milliseconds.',
								'column_width' => '',
								'default_value' => 600,
								'placeholder' => '',
								'prepend' => '',
								'append' => 'milliseconds',
								'min' => '',
								'max' => '',
								'step' => '',
							),
						),
					),
				),
				'button_label' => 'Add Section',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-templates/flex.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array(
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array(
				0 => 'the_content',
			),
		),
		'menu_order' => 0,
	));
}
