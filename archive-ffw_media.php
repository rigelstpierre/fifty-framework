<?php get_header(); ?>

<?php do_action('FFW_hero_before'); ?>
<?php do_action('FFW_hero', array('text_override' => 'Media')); ?>
<?php do_action('FFW_hero_after'); ?>


<div id="media_bar">
  <div class="left">
    <ul class="menu-media_bar" id="menu_media_bar">
      <li class="active"><a href="#all">All</a></li>
      <li><a href="#videos">Videos</a></li>
      <li><a href="#photos">Photos</a></li>
      <li><a href="#resources">Resources</a></li>
    </ul>
  </div>
  <div class="right">
    
  </div>
</div>

<div id="main" class="default blog">
  <div class="container-full">
    <h2 class="section-title">All Media</h2>


    <div id="content" class="full archive media">
      <div class="content-inner">
        <h1 class="archive-title"></h1>
        <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>


          <div class="box box-fourth box-media has_footer has_hover_overlay">
            <a href="<?php the_permalink(); ?>">
              <div class="box-hover-overlay"></div>
              <main class="box-inner" style="background-image:url('<?php echo get_featured_image_url(); ?>');">
                <!-- <div class="box-image backstretch" data-img-src="<?php //echo get_featured_image_url(); ?>"></div> -->
              </main>
              <footer>
                <h6><?php the_title(); ?></h6>
                <span>
                  
                </span>
              </footer>
            </a>
          </div>

        <?php endwhile; endif; ?>

        <?php do_action('FFW_pagination', array('id' => 'nav-below') ); ?>
      </div><!-- .content-inner -->
    </div><!-- .content -->

  </div><!-- .container -->
</div><!-- #main -->

<?php get_footer(); ?>