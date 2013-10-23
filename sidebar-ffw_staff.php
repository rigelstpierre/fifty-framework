<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 * If no active widgets in this sidebar, it will be hidden completely.
*/
$staff_label = strtolower(ffw_staff_get_label_singular() );

if ( ! is_active_sidebar( 'staff_default' ) ) {
  return;
}
?>
	
<?php if ( is_active_sidebar( 'staff_default' ) ) : ?>
	<div class="sidebar-inner">
		<div class="widget-area">
			<?php dynamic_sidebar( 'staff_default' ); ?>
		</div><!-- .widget-area -->
	</div><!-- .sidebar-inner -->

<?php endif; ?>