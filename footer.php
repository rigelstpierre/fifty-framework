
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
<footer class="fifty">
  <div class="container">
    Designed and Developed by <a href="http://fiftyandfifty.org">Fifty & Fifty</a>.
  </div>
</footer>

<section id="modals"></section>

<?php /* DEBUG WORDPRESS OBJECTS & QUERIES 
================================================== */
  $site_debug_args = array(
    'wpquery'           => true,
    'post_meta'         => true,
    'post_obj'          => true,
    'current_user_info' => true,
    'options_framework' => true,
    'query_count'       => true
  );
  //do_action('FFW_debug_box', $site_debug_args );
?>

<?php /* DEBUG TEMPLATE NAME IN JS CONSOLE
================================================== */ 
if ( of_get_option('debug_template_name') ) : 
  global $post, $wp_query;
  $page_name     = get_post( $post )->post_name;
  $template_name = basename( get_page_template() );
?>
  <script>console.log('Page Name: %c <?php echo $page_name; ?>', 'font-weight:bold; text-transform:uppercase; color: #bada55');</script>
  <script>console.log('Template:  %c <?php echo $template_name; ?>', 'font-weight:bold; text-transform:uppercase; color: #7db8db');</script>
<?php endif; ?>


</body>
</html>

