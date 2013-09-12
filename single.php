<?php get_header(); ?>

<?php 
  if( has_post_thumbnail() ) {
    $hero_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
  } elseif ( get_header_image() != '' ) {
    $hero_url = get_header_image();
    $hero_height = get_custom_header()->height;
  } else {
    $hero_url = '';
  }
?>

<div id="hero" style="background-image:url('<?php echo $hero_url; ?>');">
  <div class="container">
    <div class="hero-inner">
      <h1 class="page-title"><?php the_title(); ?></h1>
    </div>
  </div>
</div>

<div id="main" class="single default">
  <div class="container">

  <div class="sidebar push-<?php sidebar_position_class(); ?>">
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

  </div>
</div>

<?php get_footer(); ?>