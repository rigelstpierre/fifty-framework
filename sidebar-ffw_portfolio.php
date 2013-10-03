<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 * If no active widgets in this sidebar, it will be hidden completely.
*/
$portfolio_label = strtolower(ffw_port_get_label_singular() );

if ( ! is_active_sidebar( $portfolio_label . '_default' ) ) {
  return;
}
?>
	
<?php if ( is_active_sidebar( $portfolio_label . '_default' ) ) : ?>
	<div class="sidebar-inner">
		<div class="widget-area">
			<?php dynamic_sidebar( $portfolio_label . '_default' ); ?>
		</div><!-- .widget-area -->
	</div><!-- .sidebar-inner -->

<?php endif; ?>