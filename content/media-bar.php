<!-- ================== -->
<!--     #MEDIA_BAR     -->
<!-- ================== -->
<div id="media_bar">
  <!-- // LEFT // -->
  <div class="left span6">
    <?php 
    /**
     * Display all the category names and links for Staff
     * @var [type]
     */
    $media_types = get_terms( 'media_type' );
    $count = count( $media_types );

    if( $count > 0 ) :
        
    ?>
    <!-- ================== -->
    <!--    #MEDIA_SORT     -->
    <!-- ================== -->
    <ul class="menu-media_bar" id="media_sort">
      <li class="active"><a href="<?php echo home_url( ffw_get_media_slug() ) ?>">All</a></li>
      <?php foreach( $media_types as $type ) : ?>
      <li><a href="<?php echo get_term_link( $type ) ?>"><?php echo $type->name; ?></a></li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </div>
  <!-- // RIGHT // -->
  <div class="right span6">
    <!-- ================== -->
    <!--   #MEDIA_SEARCH    -->
    <!-- ================== -->
    <div id="media_search" class="media-search inline-search">
      <form action="<?php echo home_url(); ?>" method="get">
          <fieldset class="inline-fields">
              <input class="inline-input" type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Search"/>
              <input type="hidden" name="post_type" value="ffw_media" />
          </fieldset>
      </form>
    </div>
    <div id="media_select" class="media-select inline-dropdown">
      <fieldset class="inline-fields">
        <?php 
        /**
         * Display all the category names and links for Staff
         * @var [type]
         */
        $media_cats = get_terms( 'media_category' );
        $count = count( $media_cats );

        if( $count > 0 ) :
        ?>
        <select class="inline-select" name="ffw_media_select" id="ffw_media_select">
          <option value="- Select a Category -">Select a Category</option>
          <?php foreach( $media_cats as $cats ) : ?>
          <option value="<?php echo get_term_link( $cats ) ?>"><?php echo $cats->name; ?></option>
          <?php endforeach; ?>
        </select>
        <?php endif; ?>
      </fieldset>
    </div>
  </div><!-- .right (span6) -->
</div>