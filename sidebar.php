<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 * If no active widgets in this sidebar, it will be hidden completely.
*/
if ( ! is_active_sidebar( 'sidebar_default' ) && ! is_active_sidebar( 'sidebar_footer_default' ) ) {
  return;
}
?>

<?php /* DEFAULT
================================================== */ 
if ( is_home() || is_front_page() || is_page() || is_single() || is_archive() ): ?>

	<?php if ( is_active_sidebar( 'sidebar_default' ) ) : ?>
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar_default' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->
	<?php endif; ?>

<?php elseif( is_single( 'ffw_staff') ) : ?>
	
	<?php $portfolio_label = strtolower(ffw_port_get_label_singular() ); ?>
	<?php if ( is_active_sidebar( $portfolio_label . '_default' ) ) : ?>
		
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( $portfolio_label . '_default' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->

	<?php endif; ?>

<?php elseif( is_single( 'ffw_portfolio' ) ) : ?>
	
	<?php $staff_label = strtolower(ffw_staff_get_label_singular() ); ?>
	<?php if ( is_active_sidebar( $staff_label. '_default' ) ) : ?>
			
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( $staff_label . '_default' ); ?>
			</div><!-- .widget-area -->
		</div><!-- .sidebar-inner -->

	<?php endif; ?>

<?php endif; ?>