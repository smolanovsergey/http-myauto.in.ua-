//

/*----------------------------------------------------*/
/* MOBILE DETECT FUNCTION
/*----------------------------------------------------*/
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
};



/////////////////////// ready
$(document).ready(function() {



  /*----------------------------------------------------*/
  // PARALLAX CALLING
  /*----------------------------------------------------*/
  $(window).bind('load', function () {
    parallaxInit();
  });
  function parallaxInit() {
    testMobile = isMobile.any();

    if (testMobile == null)
    {
      $('.parallax .bg1').addClass("bg-fixed").parallax("50%", 0.5);

    }
  }
  parallaxInit();















  /*----------------------------------------------------*/
  // Appear
  /*----------------------------------------------------*/
  $('.animated').appear(function() {
    // console.log("111111111111");
      var elem = $(this);
      var animation = elem.data('animation');
      if ( !elem.hasClass('visible') ) {
        var animationDelay = elem.data('animation-delay');
        if ( animationDelay ) {
          setTimeout(function(){
              elem.addClass( animation + " visible" );
          }, animationDelay);
        } else {
          elem.addClass( animation + " visible" );
        }
      }
  });


});

/////////////////////// load
$(window).load(function() {

  /*----------------------------------------------------*/
  // flexslider
  /*----------------------------------------------------*/

  /////// flexslider
  $('#flexslider').flexslider({
    animation: "fade",
    slideshow: true,
    slideshowSpeed: 7000,
    animationDuration: 600,
    pauseOnAction: true,
    prevText: "",
    nextText: "",
    controlNav: false,
    directionNav: true
  });


  /////// flexslider
  $('#carousel').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    itemWidth: 217,
    itemMargin: 5,
    asNavFor: '#gslider'
  });

  $('#gslider').flexslider({
    animation: "slide",
    controlNav: false,
    animationLoop: false,
    slideshow: false,
    sync: "#carousel",
    start: function(slider){
      // $('body').removeClass('loading');
    }
  });






});