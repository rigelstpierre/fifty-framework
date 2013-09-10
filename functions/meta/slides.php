<?php 

$text_alignment = array("center" => "Center", "left" => "Left", "right" => "Right");

$config = array(
    'id'            => 'slide_options', 
    'title'         => 'Slide Options',
    'prefix'        => "_FFW_slide_",
    'postType'      => array('slides'),
    'context'       => 'normal', 
    'priority'      => 'high', 
    'usage'         => 'theme', 
    'showInColumns' => true 
);

$slide_options_meta_box = new mrMetaBox($config);

$slide_options_meta_box->addField(array(
  'type'  => 'Text',
  'id'    => 'class', 
  'label' => __('Optional Slide Class: ','FFW')
));

$slide_options_meta_box->addField(array(
  'type'    => 'Select', 
  'id'      => "text_alignment", 
  'label'   => __('Text Alignment: ','FFW'),
  'default' => '', 
  'options' => $text_alignment
));

$slide_options_meta_box->addField(array(
  'type'         => 'Image', 
  'id'           => 'thumbnail', 
  'label'        => __('Thumbnail Image: ','FFW'),
  'attachToPost' => false 
));

$slide_options_meta_box->addField(array(
  'type'  => 'Checkbox', 
  'id'    => 'show_text', 
  'label' => __('Show Text: ','FFW')
));