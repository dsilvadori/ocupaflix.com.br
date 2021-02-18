
(function($){ //create closure so we can safely use $ as alias for jQuery

    $(document).ready(function(){

        "use strict";

        /*-----------------------------------------------------------------------------------*/
        /*  Superfish Menu
        /*-----------------------------------------------------------------------------------*/
        // initialise plugin
        var example = $('#primary-menu').superfish({
            //add options here if required
            delay:       100,
            speed:       'fast',
            autoArrows:  false  
        });

        $('#primary-menu').slicknav({
            prependTo: '#slick-mobile-menu',
            allowParentLinks: true,
            label:''            
        });   

        /*-----------------------------------------------------------------------------------*/
        /*  Preload
        /*-----------------------------------------------------------------------------------*/               
        $('.archive .content-block').fadeIn("slow");
        $('.search .content-block').fadeIn("slow");
        $('.page-template-all-posts .content-block').fadeIn("slow");
        $('.post-block').fadeIn("slow");
        $('.recent-content .ajax-loader').fadeOut("slow"); 
        $('#primary .ajax-loader').css('display','none');

        /*-----------------------------------------------------------------------------------*/
        /*  Featured Slider
        /*-----------------------------------------------------------------------------------*/
        $('#featured-content').flickity({
          // options
          autoPlay: 6000,
          cellAlign: 'center',
          contain: true,
          cellSelector: '.slide',
          wrapAround: true
        }); 

        $('.post-block').flickity({
          // options
          cellAlign: 'left',
          contain: true,
          cellSelector: '.hentry',
          wrapAround: false,
          groupCells: true,
          pageDots: false,
          imagesLoaded: true,
          adaptiveHeight: false          
        });   

        /*-----------------------------------------------------------------------------------*/
        /*  Show video length after page loaded 
        /*-----------------------------------------------------------------------------------*/
        $('.video-length').fadeIn(400);

       /**
         * Activate FitVids.
         */
        $(".entry-content").fitVids();

        $('.entry-content .fluid-width-video-wrapper').eq(0).addClass('first-video').end();
        
        /*-----------------------------------------------------------------------------------*/
        /* Header Search
        /*-----------------------------------------------------------------------------------*/

        $('.search-icon > .genericon-search').click(function(){

            $('.header-search').slideDown('fast', function() {});
            $('.search-icon > .genericon-search').toggleClass('active');
            $('.search-icon > .genericon-close').toggleClass('active');                                                                

        });

        $('.search-icon > .genericon-close').click(function(){

            $('.header-search').slideUp('fast', function() {});
            $('.search-icon > .genericon-search').toggleClass('active');
            $('.search-icon > .genericon-close').toggleClass('active');                                       

        });                             
    
    });

})(jQuery);
