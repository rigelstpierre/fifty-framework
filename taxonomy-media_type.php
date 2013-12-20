<?php get_header(); ?>


<!-- // FLEXSLIDER JS // -->         
<?php do_action( 'FFW_flexslider_js', array() ); ?>

<?php get_template_part( 'content/media', 'header' ); ?>

<?php get_template_part( 'content/media', 'bar' ); ?>

<?php get_template_part( 'content/media', 'main' ); ?>



<?php get_footer(); ?>