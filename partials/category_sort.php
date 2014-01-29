<?php 
/**
 * Display all the category names and links for Staff
 * @var [type]
 */
$staff_terms = get_terms( 'staff_category' );
$count = count( $staff_terms );

if( $count > 0 ) : ?>

    <!-- ==================== -->
    <!--     CATEGORY SORT    -->
    <!-- ==================== -->
    <section id="category_sort" class="category-sort text-center pad-med">
        <h4>Sort Team</h4>

    <?php foreach( $staff_terms as $term ) : ?>
        <a href="<?php echo get_term_link( $term ) ?>" class="btn red transparent"><?php echo $term->name; ?></a>
    <?php endforeach; ?>

    </section>

<?php endif; ?>