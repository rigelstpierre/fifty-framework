<?php get_header(); ?>

<?php do_action('FFW_hero_before'); ?>
<?php do_action('FFW_hero'); ?>
<?php do_action('FFW_hero_after'); ?>

<div id="main" class="single default">
  <div class="container">

  <div id="sidebar-default" class="sidebar collapsable collapsed push-<?php sidebar_position_class(); ?>">
    <div id="sidebar-toggle"></div>
    <?php get_sidebar(); ?>
  </div><!-- #sidebar -->
  
  <div id="content" class="push-<?php sidebar_position_class(); ?>">
    <div class="content-inner">
      
      <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'loop/loop', get_post_format() ); ?>

        <?php do_action('FFW_comment_form'); ?>

        <?php comments_template(); ?>

      <?php endwhile; endif; ?>

      <?php do_action('FFW_pagination'); ?>
    </div>
  </div><!-- #content -->

  </div><!-- .container -->
</div><!-- #main -->

<?php get_footer(); ?>