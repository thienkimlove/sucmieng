(function($){
  //slider
  var statusSearch = 0;
  var timeSearch = null;
  var delaySearch = 5000;
  var slidePage = function(){
      $('#slidePage').owlCarousel({
        loop:true,
        margin:25,
        responsiveClass:true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoHeight: false,
        responsive:{
          0:{
            items:1,
            nav:true,
            dots: false
          },
          640:{
            items:1,
            nav:true,
            dots: false
          },
            641:{
                items:2,
                nav:true,
                dots: false,
            },
          960:{
          items:4,
          nav:false,
          loop:true,
          dots: true
        }
      }
    });
  };

  //slide
  /* WOW ANIMATION FUNCTIONS
   /*----------------------------------------------------*/
  new WOW().init();
  var styleWow = function(){
    try{
      new WOW().init();
    }catch (e){}
  };
  //Accordion
   $(function() {
      $("#accordion .accordion").hide();
      $("#accordion a").click(function() {
        $('#accordion .accordion').slideUp(500);
        $('#accordion .accordion').addClass('open');
        $(this).next().slideDown(300);
      });
    });
  //endAccordion
  var slideRelateds = function(){
    $('#slideRelated').owlCarousel({
        loop:true,
        margin:20,
        responsiveClass:true,
        responsive:{
        0:{
            items:1,
            nav:true,
            dots: false
        },
        640:{
            items:4,
            nav:true,
            dots: false
        },
        1000:{
            items:4,
            nav:true,
            loop:true,
            dots: false
          }
        }
      });
    };
  //end
  //listQuestion
  $('#listQuestions > li:has(.contentQuestion)').addClass("hasSub");
  $('#listQuestions > li > a').click(function() {
    var checkElement = $(this).next();
    
    $('#listQuestions li').removeClass('active');
    $(this).closest('li').addClass('active'); 
    
    
    if((checkElement.is('.contentQuestion')) && (checkElement.is(':visible'))) {
      $(this).closest('li').removeClass('active');
      checkElement.slideUp('normal');
    }
    
    if((checkElement.is('.contentQuestion')) && (!checkElement.is(':visible'))) {
      $('#listQuestions .contentQuestion:visible').slideUp('normal');
      checkElement.slideDown('normal');
    }
    
    if (checkElement.is('.contentQuestion')) {
      return false;
    } else {
      return true;  
    }   
  });
  //end
  //HotnewTab
  $('ul.tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');
    $('ul.tabs li').removeClass('active');
    $('.tabContent').removeClass('active');
    $(this).addClass('active');
    $("#"+tab_id).addClass('active');
  })
  //end
  //ProductTab
  $('.proTabs li').click(function(){
    var tab_id = $(this).attr('data-tab');
    $('.proTabs li').removeClass('active');
    $('.tabProduct').removeClass('active');
    $(this).addClass('active');
    $("#"+tab_id).addClass('active');
  })
  //end
  var checkSearch = function(){
    if(statusSearch == 0){
        window.clearTimeout(timeSearch);
        timeSearch = window.setTimeout(function(){
            $("#box-find").stop().animate({width: 210});
        },0);
    }else{
        window.clearTimeout(timeSearch);
        timeSearch = window.setTimeout(function(){
            $("#box-find").stop().animate({width: 40});
        },delaySearch);
    }
};

var changeSearch = function(){
    $("#box-find").hover(function(){
        checkSearch();
        statusSearch = 1;
    },function(){
        checkSearch();
        statusSearch = 0;
    });
};
function bannerAdsSide() {
    var $banner = $('.banner-ads'), $window = $(window);
    var $topDefault = parseFloat( $banner.css('top'), 10 );
    $window.on('scroll', function() {
        var $top = $(this).scrollTop();
        $banner.stop().animate( { top: $top + $topDefault }, 100 , 'easeOutCirc');
    });
}
  //mobile
  /*mobile*/
  var nav_global = $('#globalNav');
  var showMenuMobile = function () {
    $('#btnMenu').click(function(e){
      var w_device = $(window).width();
      if(e.handled !== false){
        if(w_device < 959 && $('#btnMenu').is(':visible')){
          if(nav_global.is(':visible')){
            nav_global.slideUp(500);
          }else{
            nav_global.delay(100).slideDown(500);
          }
        }
        $(this).toggleClass('show');
        e.handled = true;
      }
      e.preventDefault();
    });
  };
  //end
  var slideHomepage = function(){
        $('#slideHomepage').owlCarousel({
            loop:true,
            margin:0,
            responsiveClass:true,
            autoplay: true,
            autoplayTimeout: 5000,
            responsive:{
                0:{
                    items:1,
                    nav:true,
                    dots: false
                },
                640:{
                    items:1,
                    nav:true,
                    dots: false
                },
                1000:{
                    items:1,
                    nav:true,
                    loop:true,
                    dots: false
                }
            }
        });
    };
    //end
    var slideIndex = function(){
      $('#slideIndex').owlCarousel({
        loop:true,
        margin:0,
        responsiveClass:true,
        autoplay: true,
        autoplayTimeout: 5000,
        responsive:{
          0:{
            items:1,
            nav:false,
            dots: true
          },
          640:{
            items:1,
            nav:false,
            dots: true
          },
          1000:{
            items:1,
            nav:false,
            loop:true,
            dots: true
          }
        }
      });
    };
  jQuery(document).ready(function() {
    bannerAdsSide();
    changeSearch();
    slidePage();
    slideRelateds();
    showMenuMobile();
    slideHomepage();
    slideIndex();
  });
  var config = {
    after: '0s',
    enter: 'top',
    move: '60px',
    over: '0.66s',
    easing: 'ease-in-out',
    viewportFactor: 0.33,
    reset: true,
    init: true
  };
  window.scrollReveal = new scrollReveal( config );
})(jQuery);
