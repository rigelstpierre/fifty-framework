<?php get_header(); ?>
<!-- ==================== -->
<!--         HERO         -->
<!-- ==================== -->
<?php do_action('FFW_hero_before', array('class' => 'full_width', 'bg' => false)); ?>
<?php do_action('FFW_hero', array('show_page_title' => true, 'text_override' => 'Team')); ?>
<?php do_action('FFW_hero_after'); ?>


<?php get_template_part('partials/category_sort'); ?>



<?php if( have_posts() ) : ?>

  <!-- ==================== -->
  <!--   ARCHIVE CONTENT    -->
  <!-- ==================== -->
  <section id="content" class="full archive archive-dntly_campaigns">
    <div class="container">
      <div class="span12">
          
        <?php while ( have_posts() ) : the_post(); ?>
        <?php 
          // get featured image url if it exists, fallback to placeholder
          if ( !has_post_thumbnail() ) {
            //@TODO: Replace with a designed placeholder.
            $staff_photo_thumb_url = 'http://placehold.it/600';
          } else {
            $staff_photo_thumb_url = get_featured_image_url();
          }
        ?>

          <div class="box box-fourth has_footer has_hover_overlay">
            <a href="<?php the_permalink(); ?>">
              <div class="box-hover-overlay"></div>
              <main class="box-inner">
                <div class="box-image backstretch" data-img-src="<?php echo $staff_photo_thumb_url; ?>"></div>
              </main>
              <footer>
                <h6><?php the_title(); ?></h6>
                <span><?php the_field( 'staff_member_position' ); ?></span>
              </footer>
            </a>
          </div>

        <?php endwhile; ?>

      </div>
    </div>    

  </section>

<?php endif; ?>
<?php get_footer(); ?>