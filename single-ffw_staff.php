<?php get_header(); ?>


<div id="main" class="page page-default default">
  <div class="container">

    <div id="sidebar-default" class="sidebar collapsable collapsed push-<?php sidebar_position_class(); ?>">
      <div id="sidebar-toggle"></div>
      <?php get_sidebar( 'ffw_staff' ); ?>
    </div><!-- #sidebar -->
    
    <div id="content" class="push-<?php sidebar_position_class(); ?>">
      <div class="content-inner">
        <?php if( has_post_thumbnail() ) : ?>
          <?php the_post_thumbnail('staff_detail'); ?>
        <?php endif; ?>
        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
          <?php get_template_part( 'loop/loop', get_post_type() ); ?>
        <?php endwhile; endif; ?>

      </div><!-- .content-inner -->
    </div><!-- #content -->
  </div><!-- .container -->
</div><!-- #main -->

<?php get_footer(); ?>