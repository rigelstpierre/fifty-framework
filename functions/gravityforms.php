<?php

// filter the Gravity Forms button type test
add_filter("gform_submit_button", "form_submit_button", 10, 2);
function form_submit_button($button, $form){

    return "<button class='btn secondary' id='gform_submit_button_{$form["id"]}'>{$form["button"]["text"]}</button>";

}