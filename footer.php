
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
    Designed and Developed by <a href="http://fiftyandfifty.org">Fifty &amp; Fifty</a>.
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
  do_action('FFW_debug_box', $site_debug_args );
?>

<?php /* DEBUG TEMPLATE NAME IN JS CONSOLE
================================================== */ 
if ( of_get_option('debug_template_name') ) : 
  global $post, $wp_query, $template;
  $page_name     = get_post( $post )->post_name;
  $query_count   = get_num_queries();
  $time_til      = timer_stop( 0, 3 );
  $mem_usage     = (memory_get_peak_usage() / 1024 / 1024 );
  
  // Template 
  $template    = explode( '/', $template );
  $array_count = count( $template );
  $array_count = $array_count - 1;
  $template    = $template[$array_count];

?>
  <script>console.log('Page Name:  %c <?php echo $page_name; ?>', 'font-weight:bold; text-transform:uppercase; color: #bada55');</script>
  <script>console.log('Template:   %c <?php echo $template; ?>', 'font-weight:bold; text-transform:uppercase; color: #7db8db');</script>
  <script>console.log('Queries:    %c <?php echo $query_count; ?>', 'font-weight:bold; text-transform:uppercase; color: #b89555');</script>
  <script>console.log('Rendered:   %c <?php echo $time_til; ?>', 'font-weight:bold; text-transform:uppercase; color: #db7bbe');</script>
  <script>console.log('Mem Usage:  %c <?php echo $mem_usage; ?>', 'font-weight:bold; text-transform:uppercase; color: #f4005f');</script>
<?php endif; ?>


<?php wp_footer(); ?> 
</body>
</html>

