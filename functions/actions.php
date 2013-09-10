<?php
add_action('init', 'FFW_actions');

/**
 * FFW_actions
 * Theme actions - used in some cases in place of template parts for more
 * dynamic control. Ex: social links, hero units, etc. 
 * @since 1.0
 * @author Alexander Zizzo
 */
function FFW_actions(){


  /**
   * Pagination
   * @since 1.0
   */
  function pagination( $args = NULL ) {

    $class = isset($args['class']) ? $args['class'] : null;

    ?>
    
      <div class="pagination <?php echo $class; ?>">
        <div class="next-posts">
          <?php next_posts_link(); ?>
        </div>
        <div class="previous-posts">
          <?php previous_posts_link(); ?>
        </div>
      </div>

    <?php 
  }
  add_action('FFW_pagination', 'pagination');





  /**
   * Slider
   * @since 1.0
   */
  function slider_full( $args = NULL ) {

    global $post;
    $class = isset($args['class']) ? $args['class'] : null;
    $category = isset($args['category']) ? $args['category'] : null;

    if ( of_get_option ( 'enable_slides', '1' ) ) :

    ?>

      <?php query_posts( array(
        'ignore_sticky_posts' => 1,
        'posts_per_page'      => 20,
        'post_type'           => 'slides',
        'category'            => $category
      )); ?>

      <?php if(have_posts()) :?>         
        <div class="slider-full flexslider">    
          <ul class="slides">

            <?php $i = 1; while (have_posts()) : the_post(); ?>
            <?php
            //Get slide options
            $slide_class          = get_post_meta($post->ID, "_FFW_slide_class", true);         
            $show_slide_text      = get_post_meta($post->ID, "_FFW_slide_show_text", true);
            $slide_text_alignment = get_post_meta($post->ID, "_FFW_slide_text_alignment", true);
            $slide_thumbnail_img  = wp_get_attachment_image_src(get_post_meta($post->ID, "_FFW_slide_thumbnail", true), 'full');
            $slide_background_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '' );
            // reset vars to first array items
            $slide_background_img = $slide_background_img[0];
            // $slide_class          = $slide_class[0];
            
            $s_styles = "";
            $s_class  = "";
            if($slide_background_img){
              $s_styles .= "background-image: url(".$slide_background_img.");";           
              $s_styles .= "background-repeat: no-repeat;";
              $s_styles .= "background-position: center center;";
              $s_styles .= "background-size: cover;"; 
            }   
            ?>          
          
            <li id="slide<?php echo $i; ?>" data-thumb="" class="<?php echo $s_class; ?>" style="<?php echo $s_styles;?>">  
              <div class="container">
                <div class="slide-content">

                  <?php if($show_slide_text) : ?>       
                    <div class="details <?php echo $slide_text_alignment; ?>">
                      <h1><?php the_title(); ?></h1>
                      <div class="seperator"></div>
                      <?php the_content(); ?>
                      <?php//echo wpautop(do_shortcode($slide_class)); ?>
                    </div>
                  <?php endif; ?>

                </div><!-- .slide-content -->
              </div><!-- .container -->
            </li>
            
            <?php $i++; ?>      
          
            <?php endwhile; ?>
          </ul>
        </div>  

      <?php endif; ?>
      <?php wp_reset_query(); wp_reset_postdata(); ?>

    <?php else : ?>
      <h1> Slider Not Enabled </h1>
    <?php endif;


  }
  add_action('FFW_slider_full', 'slider_full');


  

}