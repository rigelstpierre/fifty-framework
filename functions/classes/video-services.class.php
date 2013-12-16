<?php 
/* 
Description:  FFW Video Services Class
Author:       5ifty&5ifty - A humanitarian focused creative agency
Author URI:   http://www.fiftyandfifty.org/
Contributors: Bryan Shanaver, Bryan Monzon, Alexander Zizzo

@TODO - lots. this is an WIP migration of the functions foudnd in helpers.php

EX HTML:
  <?php 
    $V = new FFW_VIDEO_SERVICES; 
    $method_youtube = $V->vid_service_methods['youtube'];
    $V->ffw_media_get_video_data( $method_youtube, 'get_thumbnail' );
    var_dump($V->ffw_media_get_video_data( $method_youtube['get_thumbnail'] ));
  ?>

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
Neither the name of Alex Moss or pleer nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

class FFW_VIDEO_SERVICES {

  /**
   * Variables & Conditionals
   *  
   * @author Alexander Zizzo
   * @package Fifty-Framework
   * @since 1.3
   */
  public $ffw_video_service = null;
  public $ffw_video_id      = null;
  public $ffw_video_thumb   = null;
  public $ffw_video_title   = null;


  /**
   * FFW_VIDEO_SERVICES Constructor
   *
   * What to automatically call when new instance of class is initiated
   *
   * @since 1.3
   * @package Fifty-Framework
   * @author Alexander Zizzo
   */
  function __construct()
  {
    // Debug toggle
    $this->debug = true;
    // Run the API method building function
    $this->ffw_media_build_methods();
    // Set the WP upload directory by running the wp core function
    $this->wordpress_upload_dir = wp_upload_dir();

  }


  /**
   * Build Video Service Methods
   *
   * Build various methods (api calls) as an array for accessibility ease.
   *
   * @since 0.1
   * @package Donately Wordpress
   * @author Alexander Zizzo, Bryan Shanaver, Bryan Monzon (Fifty and Fifty, LLC)
   * @param void
   * @return [array]
   * @todo Create more / remove unneeded
   */
  function ffw_media_build_methods( $return = false )
  {
    /**
     * Video Service Methods
     * @param [array] : Request Method (GET/POST), Request Path
     * @todo replaces nulls with correct param names
     */
    $this->vid_service_methods = array(
      'youtube' => array(
        'service'         => 'youtube',
        'get_thumbnail'   => array( 'api_name' => 'thumbnail_large' ),
        'get_title'       => false
      ),
      'vimeo' => array(
        'service'         => 'vimeo',
        'get_thumbnail'   => array( 'api_name' => 'thumbnail_large' ),
        'get_title'       => false
      )
    );

    if ( $return ) {
      return $this->vid_service_methods;
    } else {
      return NULL;
    }
  }



  /**
   * Get Video Data
   * Get additional video data that requires use of json
   * @author Alexander Zizzo
   * @package Fifty Framework
   * @since 1.3
   * @todo replacate functionality seen in set_video_data() in helpers.php
   */
  function ffw_media_get_video_data( $service_methods = NULL, $return_method = NULL ) 
  {
    // Needed globals
    global $post;

    // Convert methods array to object
    $methods = (object)$service_methods;

    /**
     * Youtube Functions
     * @author Alexander Zizzo
     * @since 1.3
     */
    if ( $methods->service == 'youtube') {
      // Debugging
      if ( $this->debug ) pp($methods->service);

      // Get the video ID



      // RETURN_METHOD : 'get_thumbnail'
      if ( $return_method == 'get_thumbnail' ) {
          $api_name = $methods->get_thumbnail['api_name'];
      }
    }

    // $vid_json_url      = 'http://vimeo.com/api/v2/video/'.$vid_id.'.json';
    // $vid_json_contents = file_get_contents($vid_json_url);
    // $vid_json_data     = json_decode($vid_json_contents);
    // $vid_json_data     = $vid_json_data[0];

    // $vid_json_data_str = (string)$vid_json_data->$data_type;

    // return $vid_json_data_str;


    
  }



}




 ?>