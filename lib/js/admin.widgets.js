(function($) {
  $(function() {
    $('h4').each(function() {

      var $parent = $(this).parent().parent().parent();

      if($parent.attr('id') !== undefined && $parent.attr('id') !== false && $parent.attr('id').indexOf('ffw-') > 0) {
        $(this).parents('.widget-top').addClass('widget-highlight');
      } // end if
    });
  });
})(jQuery);