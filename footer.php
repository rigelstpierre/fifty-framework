
<footer class="default">
  <div class="container">
    <div class="footer-inner">
  
    <?php $widget_class = set_widget_count_class('sidebar_footer_default'); ?>

    <div class="footer-widgets <?php echo $widget_class; ?>">
      <?php dynamic_sidebar( 'sidebar_footer_default' ); ?>
    </div>

    </div><!-- .footer-inner -->
  </div><!-- .container -->
</footer>


<?php do_action('FFW_debug_box', array(
  'post_meta' => true,
  'post_obj'  => true
)); ?>


<?php wp_footer(); ?>	
</body>
</html>