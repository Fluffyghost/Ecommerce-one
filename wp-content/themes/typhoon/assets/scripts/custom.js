(function($){
    $(document).ready(function(){

        // $.cookieBar({
        //   declineButton: true
        // });

        $('.heroSlider').slick({
            autoplay: false,
            dots: true,
            arrows: false,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
        });

        $('.testSlider').slick({
            autoplay: false,
            dots: false,
            arrows: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            prevArrow: $('.prevButton'),
            nextArrow: $('.nextButton'),
            responsive: [{
               breakpoint: 600,
               settings: {
                 adaptiveHeight: true,
               }
            }]
        });
        // var $slider = $('.testSlider');
        // $slider.find(".slick-slide").height("auto");
        // $slider.slick("setOption", null, null, true);


        $('.woocommerce-product-gallery__wrapper').slick({
          dots: false,
          arrows: false,
          infinite: false,
          speed: 300,
          slidesToShow: 1,
          slidesToSlide: 1,
          mobileFirst: true,
          responsive: [{
             breakpoint: 800,
             settings: 'unslick'
          }]
        });

        $(".shopTog").click(function(){
            $('.shopTogDrop').slideToggle();
            $(this).children('.shopright').toggle();
            $(this).children('.shopdown').toggle();
        });
        $(".moreTog").click(function(){
            $('.moreTogDrop').slideToggle();
            $(this).children('.moreright').toggle();
            $(this).children('.moredown').toggle();
        });
        $(".compTog").click(function(){
            $('.compTogDrop').slideToggle();
            $(this).children('.compright').toggle();
            $(this).children('.compdown').toggle();
        });
        $(".needTog").click(function(){
            $('.needTogDrop').slideToggle();
            $(this).children('.needright').toggle();
            $(this).children('.needdown').toggle();
        });

        $(".postdropdown").click(function(){
            $(this).children().children().children().children('.catdown').toggle();
            $(this).children().children().children().children('.catup').toggle();
        });

        $(".prodTog").click(function(){
            $('.prodesDrop').slideToggle();
            $(this).children().children('.desup').toggle();
            $(this).children().children('.desdown').toggle();
        });
        $(".featTog").click(function(){
            $('.featDrop').slideToggle();
            $(this).children().children('.featup').toggle();
            $(this).children().children('.featdown').toggle();
        });
        $(".shipTog").click(function(){
            $('.shipDrop').slideToggle();
            $(this).children().children('.shipup').toggle();
            $(this).children().children('.shipdown').toggle();
        });
        $(".downTog").click(function(){
            $('.downDrop').slideToggle();
            $(this).children().children('.doup').toggle();
            $(this).children().children('.dodown').toggle();
        });
        $(".shareTog").click(function(){
            $('.shareDrop').slideToggle();
            $(this).children().children('.shareup').toggle();
            $(this).children().children('.sharedown').toggle();
        });


        $('.termscontainer').stickem();
        // $('.prodcontainer').stickem();
        // $('.sharecontainer').stickem();


        $(".inch").click(function(){
            $(this).parent().next().children('.inchesTable').show();
            $(this).parent().next().children().next('.cmTable').hide();
            $(this).parent().next().children().next('.cmTable').removeClass('showtable');
            $(".inch").addClass('activeBorder');
            $(".cm").removeClass('activeBorder');
        });

        $(".cm").click(function(){
            $(this).parent().next().children('.inchesTable').hide();
            $(this).parent().next().children().next('.cmTable').show();
            // $(this).parent().next().next('.cmTable').addClass('showtable');
            $(".cm").addClass('activeBorder');
            $(".inch").removeClass('activeBorder');

        });
        $('.modal-toggle').on('click', function(e) {
          e.preventDefault();
          $('.modal').toggleClass('is-visible');
        });
        $('.modal-close').on('click', function(e) {
          $('.modal').removeClass('is-visible');
        });

        $('.closeReviews').on('click', function(e) {
            $('.reviewsoffcanvas').toggleClass('is-closed');
            $('.reviewsoffcanvas').toggleClass('is-open');
            $('.js-off-canvas-overlay').toggleClass('is-visible');
        });

        $('.wpfButton').on('click', function(e) {
            $('.off-canvas').toggleClass('is-closed');
            $('.off-canvas').toggleClass('is-open');
            $('.js-off-canvas-overlay').toggleClass('is-visible');
        });


        $('.fbutt_1').on('click', function(e) {
            $('#wpfBlock_2 .wpfFilterContent').removeClass('wpfHide');
            $('#wpfBlock_3 .wpfFilterContent').addClass('wpfHide');
            $('#wpfBlock_4 .wpfFilterContent').addClass('wpfHide');
            $('#wpfBlock_5 .wpfFilterContent').addClass('wpfHide');
        });
        $('.fbutt_2').on('click', function(e) {
            $('#wpfBlock_3 .wpfFilterContent').removeClass('wpfHide');
            $('#wpfBlock_2 .wpfFilterContent').addClass('wpfHide');
            $('#wpfBlock_4 .wpfFilterContent').addClass('wpfHide');
            $('#wpfBlock_5 .wpfFilterContent').addClass('wpfHide');
        });
        $('.fbutt_3').on('click', function(e) {
            $('#wpfBlock_4 .wpfFilterContent').removeClass('wpfHide');
            $('#wpfBlock_3 .wpfFilterContent').addClass('wpfHide');
            $('#wpfBlock_2 .wpfFilterContent').addClass('wpfHide');
            $('#wpfBlock_5 .wpfFilterContent').addClass('wpfHide');
        });
        $('.fbutt_4').on('click', function(e) {
            $('#wpfBlock_5 .wpfFilterContent').removeClass('wpfHide');
            $('#wpfBlock_4 .wpfFilterContent').addClass('wpfHide');
            $('#wpfBlock_3 .wpfFilterContent').addClass('wpfHide');
            $('#wpfBlock_2 .wpfFilterContent').addClass('wpfHide');
        });


        //
        //
        // $('.woocommerce-product-rating').attr('data-toggle').data('off-canvas');


        // $(".sizelinks").click(function(event){
        //     $('html, body').animate({
        //         scrollTop: $("#destination-form").offset().top -180
        //     }, 1000);
        // });

        $('.headerSearchButt').click(function(event){
         event.stopPropagation();
           $(".searchDrop").slideToggle("fast");
        });
        $(".searchDrop").on("click", function (event) {
           event.stopPropagation();
        });
        $(document).on("click", function () {
            $(".searchDrop").hide();
        });



        var $hamburger = $(".hamburger");
        $hamburger.on("click", function(e) {
            $hamburger.toggleClass("is-active");
            $('.mobnav').slideToggle();
            $('.is-drilldown-submenu').removeClass('is-active');
            $('body').toggleClass('fixed-position');
        });


        if ($.cookie('modal_shown') == null) {
          $.cookie('modal_shown', 'yes', { expires: 7, path: '/' });
          setTimeout(function() {
               $('#newslettermodal').foundation('open');
          }, 2000);
        }

        // if ($('.mobnav').css('display') == 'block') {
        //    $('.currencymob').show();
        // }

        $(window).load(function() {
            $('.currencymob').addClass("showload");
        });

        // $('#ispmodal').foundation('open');
        //
        // $(document).foundation();


        window.onload=function(){
          // $('#ispmodal').foundation('open');
          document.getElementById("scrollprod").addEventListener("scroll", function () {
              var scrollerWrapper = document.getElementById("scrollprod");
              scrollPercent =
                  (scrollerWrapper.scrollLeft /
                  (scrollerWrapper.scrollWidth - scrollerWrapper.clientWidth)) * 100;
              document.getElementById("myBar").style.width = scrollPercent + "%";
          });
          document.getElementById("scrollcat").addEventListener("scroll", function () {
              var scrollerWrapper = document.getElementById("scrollcat");
              scrollPercent =
                  (scrollerWrapper.scrollLeft /
                  (scrollerWrapper.scrollWidth - scrollerWrapper.clientWidth)) * 100;
              document.getElementById("catBar").style.width = scrollPercent + "%";
          });
        }


    });
})(jQuery);
