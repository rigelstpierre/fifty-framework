<?php

// filter the Gravity Forms button type test

/**
 * Filter to add class to Gravity Forms buttons
 * @param  [type] $button [description]
 * @param  [type] $form   [description]
 * @return [string]         [description]
 */
function form_submit_button( $button, $form )
{

    return "<button class='btn secondary' id='gform_submit_button_{$form["id"]}'>{$form["button"]["text"]}</button>";

}
add_filter("gform_submit_button", "form_submit_button", 10, 2);