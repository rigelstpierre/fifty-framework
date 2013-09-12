!(function ($){

    "use strict"; // jsHint

    window.FIFTYFRAMEWORK = {};
    
    var FF      = window.FIFTYFRAMEWORK;
    var iOS     = ( navigator.userAgent.match(/(iPad|iPhone|iPod)/g) ? true : false );
    var DEBUG   = false;

    /* INITIATE FUNCTIONS
    ================================================== */
    FF.init = function(){
        FF.setElements();
        FF.setVars();
        FF.basics();
        FF.scroll();
        FF.modalEffects();
        FF.fauxPlaceholders();
        FF.regex();
    };

    /* SET ELEMENTS
    ================================================== */
    FF.setElements = function(){
        FF.el = {};
        FF.el.page_overlay              = $('.page-overlay');
        FF.el.page_wrap                 = $('.page-wrap');
    };


    /* SET VARIABLES
    ================================================== */
    FF.setVars = function() {
        // jquery easing plugin init
        jQuery.easing.def = "string";
    }
    

    /* BASICS
    ================================================== */
    FF.basics = function(){


    };


    /* SCROLL (requires .scroll class on anchor)
    ================================================== */
    FF.scroll = function(){

        var duration        = 500,
            easing          = 'swing',
            scroll_offset   = 15;

        // <a> method
        $('a[href^="#"].scroll').click(function(e){
            var $self = $(this);
            var destination = $($self.attr('href'));
            e.preventDefault();
            // if destination is valid, scroll to
            if(destination && destination.offset()){
                if(/(iPhone|iPod)\sOS\s6/.test(navigator.userAgent)){
                    $('html, body').animate({
                        scrollTop: $(destination).offset().top
                    }, duration, easing);
                } else {
                    $('html, body').animate({
                        scrollTop: $(destination).offset().top - (scroll_offset)
                    }, duration, easing);
                }
            }
        });
    };
    


    /* WP PLACEHOLDERS
    ================================================== */
    FF.fauxPlaceholders = function() {

        var comments_input      = $('#respond input[type="text"]'),
            comments_textarea   = $('#respond textarea');

        function labelAsPlaceholder(obj) {
            //check if exists
            if ( !obj.length ) { return; }

            //input as obj
            obj.each(function(){
                var $this = $(this);
                var input_label_text    = $this.siblings('label');
                $this.attr('placeholder', input_label_text.text()); // placeholder method
                input_label_text.hide();
            });
        }

        function labelAsValue(obj) {
            //check if exists
            if ( !obj.length ) { return; }

            //input as obj
            obj.each(function(){
                var $this = $(this);
                var input_label_text    = $this.siblings('label');
                $this.attr('value', input_label_text.text()); // value method
                input_label_text.hide();
            });
        }

        labelAsPlaceholder(comments_input);
        labelAsPlaceholder(comments_textarea);
    };


    /* MODAL EFFECTS
    ================================================== */
    FF.modalEffects = function() {

        var overlay = $('.md-overlay');

        if (!overlay) { return; }

        [].slice.call( $('.md-trigger') ).forEach( function(el, i) {

            var modal_id = $(el).attr('href'),
              modal = $( modal_id ),
              close = modal.find('.md-close');

            // remove modal
            function removeModal(hasPerspective) {
              modal.removeClass('md-show');

              if ( hasPerspective ) {
                  document.documentElement.removeClass('md-perspective');
              }
            }

            // remove handler
            function removeModalHandler() {
              removeModal( $(el).hasClass('md-setperspective') );
              overlay.removeClass('md-show');

              return false;
            }

            // scroll to top of modal on click
            function scrollModalOffset(id) {

                var md_id       = $(el).attr('href'),
                    md          = $( md_id ),
                    md_offset   = md.offset().top;

                    // console.log(md_id);

                    if(md && md.offset() && (md_id === '#MODAL_ID_1' || md_id === '#MODAL_ID_2') ){
                        if(/(iPhone|iPod)\sOS\s6/.test(navigator.userAgent)){
                            $('html, body').animate({
                                scrollTop: md.offset().top - 30
                            }, 250, 'swing');
                        } else {
                            $('html, body').animate({
                                scrollTop: md.offset().top - 30
                            }, 250, 'swing');
                        }
                    }
            }

            // open modal
            el.addEventListener( 'click', function( ev ) {

                ev.preventDefault();

                modal.addClass('md-show');
                overlay.addClass('md-show');
                overlay.unbind( 'click', removeModalHandler );
                overlay.bind( 'click', removeModalHandler );

                if( $(el).hasClass('md-setperspective') ) {
                    setTimeout( function() {
                        document.documentElement.addClass('md-perspective');
                    }, 25 );
                }

                scrollModalOffset();

            });

            // close modal
            close.click(function(ev){
                ev.stopPropagation();
                removeModalHandler();
            })
        });    
    };


    /* FLEXLOADER
    ================================================== */
    FF.flexLoader = function(obj, options){

        if ( !obj ) { return; }

        obj.flexslider(options);

    };


    /* SKROLLER
    ================================================== */
    FF.skrollr = function(opts) {
        var s = skrollr.init({
          edgeStrategy: 'set',
          easing: {
            WTF: Math.random,
            inverted: function(p) {
              return 1-p;
            }
          }
        });
    };


    /* REGEX
    ================================================== */
    FF.regex = function() {

        function urlToLink(obj) {
            var re = /(?:(?=[\s`!()\[\]{};:'".,<>?«»“”‘’])|\b)((?:[a-z][\w-]+:(?:\/{1,3}|[a-z0-9%])|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/|[a-z0-9.\-]+[.](?:com|org|net))(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))*(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'".,<>?«»“”‘’]|\b))/gi;
            obj.html(obj.html().replace(re, '<a href="$1" target="_blank" title="">$1</a>'));
        }
        // urlToLink($('#content article'));
        
    }



    /* ================================================================ */
    /*                                                                  */
    /*                     DOCUMENT / WINDOW CALLS                      */
    /*                                                                  */
    /* ================================================================ */



    /* DOCUMENT READY
    ================================================== */
    $(document).ready(function(){
        
        FF.init();

        // FF.flexLoader(
        //     $('.flexslider'), 
        //     {
        //         animation   : "slide",
        //         prevText    : "N",
        //         nextText    : "n",
        //         start: function(slider){ }
        //     } 
        // );

    });

    /* WINDOW LOAD
    ================================================== */
    $(window).load(function(){
        
        // do stuff once the page has finished loading

    });

    /* WINDOW SCROLL
    ================================================== */
    $(window).scroll(function(){

        // DEBUG - winY position
        if (DEBUG) { var winY = $(window).scrollTop(); console.log(winY);}

    });


    /* WINDOW RESIZE
    ================================================== */
    $(window).resize(function(){   
        
        // do stuff on window resize


    }).trigger('resize');   


    /* SELF INVOKING ANONYMOUS FUNCTION(s)
    ================================================== */
    (function(){ 

        FF.setVars(); // set variables
        //FF.skrollr(); // skroller init

        if(window.location.hash) {
            // puts hash in variable, and removes the # character
            var hash = window.location.hash.substring(1); 
            
            if (hash === 'CUSTOM_HASH_HERE') {
                // do something when custom hash is in url
            }
        } else {
            // no hash found, don't do anything
        }        

    })();

})(jQuery);