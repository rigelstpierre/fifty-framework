<?php

////////////////////////////////////
// B A S I C S
////////////////////////////////////

/**
 * Shortode for buttons. 
 * @param  [array]  $atts    Attributes passed in by the shortcode
 * @param  [string] $content The text used in the button area
 * @return [string]          Returns the button with a class if needed
 */
function ffw_button_shortcode( $atts, $content = null )
{
    extract( shortcode_atts( array(
        'class' =>  '',
        'url'   =>  '',
    ), $atts ) );

    $ffw_button = '<a class="btn '.$class.'" href="'.$url.'">' . do_shortcode( $content ) . '</a>';

    return $ffw_button;
}
add_shortcode( 'button', 'ffw_button_shortcode' );


/**
 * Not Sure what this does, yet. 
 * @todo   Explain this function
 * @param  [array]  $atts    Attributes passed in by the shortcode
 * @param  [string] $content Returns content
 * @return [string]          Obvi
 */
function ffw_squish_shortcode( $atts, $content = null ) 
{
    extract( shortcode_atts( array(
        '' => ''
    ), $atts ) );
    return '<div class="squish">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'squish', 'ffw_squish_shortcode' );



/**
 * Adds a class for <blockquote>
 * @param  [array]  $atts    Attributes passed in by the shortcode
 * @param  [string]   $content [description]
 * @return [type]          [description]
 * @since  1.0
 */
function ffw_blockquote_full_shortcode( $atts, $content = null )
{
    extract( shortcode_atts( array(
        '' => ''
    ), $atts ) );
    return '<blockquote class="full">' . do_shortcode( $content ) . '</blockquote>';
}
add_shortcode( 'blockquote_full', 'ffw_blockquote_full_shortcode' );


////////////////////////////////////
// M O D A L S
////////////////////////////////////

/**
 * Gives the user an ability to add a modal in the content
 * @param  [array]  $atts       $size, $target, $type, $name
 * @param  [string] $content    Contents of the modal from the user
 * @return [string]             The modal
 * @since  1.0
 */
function ffw_modal( $atts, $content = null ) 
{
    extract( shortcode_atts( array(
        'size' => '',
        'target' => '',
        'type' => '',
        'name' => ''
    ), $atts ) );

    $modal_str = '<a class="modal-trigger '.$type.'" href="javascript:;" data-id="#'.$target.'">'.$name.'</a>';
    $modal_str .= '<div class="modal" id="'.$target.'"><button class="modal-close"></button><div class="modal-body">'. do_shortcode( $content ) .'</div></div>';

    return $modal_str;
}
add_shortcode( 'modal', 'ffw_modal' );



////////////////////////////////////
// C O L U M N S
////////////////////////////////////

//row
function row_shortcode( $atts, $content = null ) 
{
    return '<div class="row">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'row', 'row_shortcode' );

//one half
function ffw_one_half( $atts, $content = null )
{
 
    extract( shortcode_atts( array(
            'type'   =>  '',
            'padding_left'  =>  '10',
            'padding_right' =>  '10'
        ), $atts ) );

    if( !empty( $padding_left ) || !empty( $padding_right ) ) {

        $padding_right      = 'padding-right: ' . $padding_right . 'px; ';
        $padding_left       = 'padding-left: ' . $padding_left . 'px; ';

        $span_inner_styles  = 'style="' . $padding_right . $padding_left .'"';
    }
 
    return '<div class="one-half ' . $type . '"><div class="span-inner" ' . $span_inner_styles . '>' . do_shortcode( $content ) . '</div></div>';
 
}
add_shortcode( 'one_half', 'ffw_one_half' );

//one third
function ffw_one_third( $atts, $content = null ) 
{
 
    extract( shortcode_atts( array(
            'type'   =>  '',
            'padding_left'  =>  '10',
            'padding_right' =>  '10'
        ), $atts ) );

    if( !empty( $padding_left ) || !empty( $padding_right ) ) {

        $padding_right      = 'padding-right: ' . $padding_right . 'px; ';
        $padding_left       = 'padding-left: ' . $padding_left . 'px; ';

        $span_inner_styles  = 'style="' . $padding_right . $padding_left .'"'; 
    }
 
    return '<div class="one-third ' . $type . '"><div class="span-inner" ' . $span_inner_styles . '>' . do_shortcode( $content ) . '</div></div>';
 
}
add_shortcode( 'one_third', 'ffw_one_third' );

//two third
function ffw_two_thirds( $atts, $content = null ) 
{
 
    extract( shortcode_atts( array(
            'type'         =>  '',
            'padding_left'  =>  '10',
            'padding_right' =>  '10'
        ), $atts ) );

    if( !empty( $padding_left ) || !empty( $padding_right ) ){

        $padding_right      = 'padding-right: ' . $padding_right . 'px; ';
        $padding_left       = 'padding-left: ' . $padding_left . 'px; ';
        
        $span_inner_styles  = 'style="' . $padding_right . $padding_left .'"';
    }
 
    return '<div class="two-thirds ' . $type . '"><div class="span-inner" ' . $span_inner_styles . '>' . do_shortcode( $content ) . '</div></div>';
 
}
add_shortcode( 'two_thirds', 'ffw_two_thirds' );


//one column
function ffw_one_fourth( $atts, $content = null ) 
{
 
    extract( shortcode_atts( array(
            'type'         =>  '',
            'padding_left'  =>  '10',
            'padding_right' =>  '10'
        ), $atts ) );

    if( !empty( $padding_left ) || !empty( $padding_right ) ){

        $padding_right      = 'padding-right: ' . $padding_right . 'px; ';
        $padding_left       = 'padding-left: ' . $padding_left . 'px; ';

        $span_inner_styles  = 'style="' . $padding_right . $padding_left .'"';
    }
 
    return '<div class="one-fourth' . $type . '"><div class="span-inner" ' . $span_inner_styles . '>' . do_shortcode( $content ) . '</div></div>';
 
}
add_shortcode( 'one_fourth', 'ffw_one_fourth' );

//three fourths
function ffw_three_fourths( $atts, $content = null ) 
{
 
    extract( shortcode_atts( array(
            'type'         =>  '',
            'padding_left'  =>  '10',
            'padding_right' =>  '10'
        ), $atts ) );

    if( !empty( $padding_left ) || !empty( $padding_right ) ){

        $padding_right      = 'padding-right: ' . $padding_right . 'px; ';
        $padding_left       = 'padding-left: ' . $padding_left . 'px; ';

        $span_inner_styles  = 'style="' . $padding_right . $padding_left .'"';
    }
 
    return '<div class="three-fourths' . $type . '"><div class="span-inner" ' . $span_inner_styles . '>' . do_shortcode( $content ) . '</div></div>';
 
}
add_shortcode( 'three_fourths', 'ffw_three_fourths' );



//one column
function ffw_one_column( $atts, $content = null ) 
{
 
    extract( shortcode_atts( array(
            'type'     =>  ''
        ), $atts ) );
 
    return '<div class="full ' . $type . '">' . do_shortcode( $content ) . '</div>';
 
}
add_shortcode( 'one_column', 'ffw_one_column' );


////////////////////////////////////
// I C O N S
////////////////////////////////////

function ffw_icon_shortcodes( $atts )
{
    extract( shortcode_atts( array( 
            'type'  =>  '',
            'style' =>  ''
        ), $atts ) );

    if( !empty( $style ) ){

        $icon_style = 'style="' . $style . '"';

    }

    $ffw_icon = '<i class="icon ' . $type . '" '. $icon_style .'></i>';

    return $ffw_icon;
    
}
add_shortcode( 'icon', 'ffw_icon_shortcodes' );

////////////////////////////////////
// S T A N D A R D
////////////////////////////////////
//bloginfo url
function bloginfo_shortcode( $atts )
{
    extract( shortcode_atts( array(
        'key' => '',
    ), $atts ) );
    return get_bloginfo( $key );
}
add_shortcode( 'bloginfo', 'bloginfo_shortcode' );


function raw_shortcode( $atts, $content )
{
    extract( shortcode_atts( array(
        '' => '',
    ), $atts ) );
    return do_shortcode( $content );
}
add_shortcode( 'raw', 'raw_shortcode' );