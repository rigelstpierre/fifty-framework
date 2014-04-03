<?php 
/* 
  Template Name: FFW Debugging Child
 */
get_header(); ?>

<?php do_action('FFW_hero_before'); ?>
<?php do_action('FFW_hero', array('text_override' => 'Debug')); ?>
<?php do_action('FFW_hero_after'); ?>

<div id="main" class="default blog">
  <div class="container">
  <h2 class="section-title">Debugging</h2>

    <div id="content" class="full debug">
      <div class="content-inner">
        
        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

          <?php //get_template_part( 'loop/loop', get_post_format() ); ?>

        <?php endwhile; endif; wp_reset_postdata(); ?>


        <?php /* DEBUGGING
        ================================================== */ ?>
        
        <h3>get_the_slug</h3>
        <pre><?php var_dump(get_the_slug()); ?></pre>


        <h3>get_parent_slug</h3>
        <pre><?php var_dump(get_parent_slug()); ?></pre>

        <h3>get_parent_id</h3>
        <pre><?php var_dump(get_parent_id()); ?></pre>
          

      </div>
    </div><!-- .content -->
  </div> <!-- .container -->
</div> <!-- #main -->


<?php get_footer(); ?>