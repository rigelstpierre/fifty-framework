<?php 


$config = array(
    'id'            => 'home_options', 
    'title'         => 'Home Options',
    'prefix'        => "_FFW_home_",
    'postType'      => array('page'),
    'context'       => 'normal', 
    'priority'      => 'high', 
    'usage'         => 'theme', 
    'showInColumns' => true 
);

$home_options_meta_box = new mrMetaBox($config);

$home_options_meta_box->addField(array(
  'type'  => 'Text',
  'id'    => 'class', 
  'label' => __('Optional Slide Class: ','FFW')
));