<?php

// button
function ffw_button_shortcode( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'type' =>  '',
        'url'   =>  '',
    ), $atts));

    $ffw_button = '<a class="btn '.$type.'" href="'.$url.'">' . do_shortcode( $content ) . '</a>';

    return $ffw_button;
}
add_shortcode('button', 'ffw_button_shortcode');


// squish column
function ffw_squish_shortcode( $atts, $content = null ) {
    extract(shortcode_atts(array(
        '' => ''
    ), $atts));
    return '<div class="squish">' . do_shortcode( $content ) . '</div>';
}
add_shortcode('squish', 'ffw_squish_shortcode');



// blockquote full
function ffw_blockquote_full_shortcode( $atts, $content = null ) {
    extract(shortcode_atts(array(
        '' => ''
    ), $atts));
    return '<blockquote class="full">' . do_shortcode( $content ) . '</blockquote>';
}
add_shortcode('blockquote_full', 'ffw_blockquote_full_shortcode');




////////////////////////////////////
// C O L U M N S
////////////////////////////////////

//row
function row_shortcode( $atts, $content = null ) {
    return '<div class="row">' . do_shortcode( $content ) . '</div>';
}
add_shortcode('row', 'row_shortcode');

//one half
function ffw_one_half( $atts, $content = null ) {
 
    extract( shortcode_atts( array(
            'class'   =>  ''
        ), $atts ) );
 
    return '<div class="one-half ' . $class . '">' . do_shortcode( $content ) . '</div>';
 
}
add_shortcode('one_half', 'ffw_one_half');

//one third
function ffw_one_third( $atts, $content = null ) {
 
    extract( shortcode_atts( array(
            'class'   =>  ''
        ), $atts ) );
 
    return '<div class="one-third ' . $class . '">' . do_shortcode( $content ) . '</div>';
 
}
add_shortcode('one_third', 'ffw_one_third');

//two third
function ffw_two_thirds( $atts, $content = null ) {
 
    extract( shortcode_atts( array(
            'class'   =>  ''
        ), $atts ) );
 
    return '<div class="two-thirds ' . $class . '">' . do_shortcode( $content ) . '</div>';
 
}
add_shortcode('two_thirds', 'ffw_two_thirds');


//one column
function ffw_one_fourth( $atts, $content = null ) {
 
    extract( shortcode_atts( array(
            'class'     =>  ''
        ), $atts ) );
 
    return '<div class="one-fourth' . $class . '">' . do_shortcode( $content ) . '</div>';
 
}
add_shortcode('one_fourth', 'ffw_one_fourth');

//three fourths
function ffw_three_fourths( $atts, $content = null ) {
 
    extract( shortcode_atts( array(
            'class'     =>  ''
        ), $atts ) );
 
    return '<div class="three-fourths' . $class . '">' . do_shortcode( $content ) . '</div>';
 
}
add_shortcode('three_fourths', 'ffw_three_fourths');



//one column
function ffw_one_column( $atts, $content = null ) {
 
    extract( shortcode_atts( array(
            'class'     =>  ''
        ), $atts ) );
 
    return '<div class="full ' . $class . '">' . do_shortcode( $content ) . '</div>';
 
}
add_shortcode('one_column', 'ffw_one_column');


////////////////////////////////////
// I C O N S
////////////////////////////////////

function ffw_icon_shortcodes( $atts ){
    extract( shortcode_atts( array( 
            'type'  =>  '',
            'style' =>  ''
        ), $atts ) );

    $icon_style = 'style="' . $style . '"';

    $ffw_icon = '<i class="icon ' . $type . '" '. $icon_style .'></i>';

    return $ffw_icon;
    
}
add_shortcode( 'icon', 'ffw_icon_shortcodes' );

////////////////////////////////////
// S T A N D A R D
////////////////////////////////////
//bloginfo url
function bloginfo_shortcode( $atts ) {
    extract(shortcode_atts(array(
        'key' => '',
    ), $atts));
    return get_bloginfo($key);
}
add_shortcode('bloginfo', 'bloginfo_shortcode');


function raw_shortcode( $atts, $content ) {
    extract(shortcode_atts(array(
        '' => '',
    ), $atts));
    return do_shortcode( $content );
}
add_shortcode('raw', 'raw_shortcode');