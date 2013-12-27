<?php get_header(); ?>

    <?php do_action('FFW_hero_before'); ?>
    <?php do_action('FFW_hero'); ?>
    <?php do_action('FFW_hero_after'); ?>

    <?php get_template_part( 'content/media', 'bar' ); ?>
    
    <?php get_template_part( 'content/media', 'main' ); ?>


<?php get_footer(); ?>