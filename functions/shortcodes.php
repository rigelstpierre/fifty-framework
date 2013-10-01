<?php

// button
function button_shortcode( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'type' =>  '',
        'url'   =>  '',
    ), $atts));
    return '<a class="btn-tab-reg '.$type.'" href="'.$url.'">' . do_shortcode( $content ) . '</a>';
}
//add_shortcode('button', 'button_shortcode');


// squish column
function squish_shortcode( $atts, $content = null ) {
    extract(shortcode_atts(array(
        '' => ''
    ), $atts));
    return '<div class="squish">' . do_shortcode( $content ) . '</div>';
}
add_shortcode('squish', 'squish_shortcode');



// blockquote full
function blockquote_full_shortcode( $atts, $content = null ) {
    extract(shortcode_atts(array(
        '' => ''
    ), $atts));
    return '<blockquote class="full">' . do_shortcode( $content ) . '</blockquote>';
}
add_shortcode('blockquote_full', 'blockquote_full_shortcode');




////////////////////////////////////
// C O L U M N S
////////////////////////////////////

//row
function row_shortcode( $atts, $content = null ) {
    return '<div class="row">' . do_shortcode( $content ) . '</div>';
}
add_shortcode('row', 'row_shortcode');

//one third
function one_third( $atts, $content = null ) {
 
    extract( shortcode_atts( array(
            'class'   =>  ''
        ), $atts ) );
 
    return '<div class="one-third ' . $class . '">' . do_shortcode( $content ) . '</div>';
 
}
add_shortcode('one_third', 'one_third');

//two third
function two_thirds( $atts, $content = null ) {
 
    extract( shortcode_atts( array(
            'class'   =>  ''
        ), $atts ) );
 
    return '<div class="two-thirds ' . $class . '">' . do_shortcode( $content ) . '</div>';
 
}
add_shortcode('two_thirds', 'two_thirds');

//one half
function one_half( $atts, $content = null ) {
 
    extract( shortcode_atts( array(
            'class'   =>  ''
        ), $atts ) );
 
    return '<div class="one-half ' . $class . '">' . do_shortcode( $content ) . '</div>';
 
}
add_shortcode('one_half', 'one_half');

//one column
function one_column( $atts, $content = null ) {
 
    extract( shortcode_atts( array(
            'class'     =>  ''
        ), $atts ) );
 
    return '<div class="full ' . $class . '">' . do_shortcode( $content ) . '</div>';
 
}
add_shortcode('one_column', 'one_column');



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