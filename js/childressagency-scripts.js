jQuery(document).ready(function($){
  var loader = (function (window, $loadingScreen) {
    var elapsed = false;
    var loaded = false;

    setTimeout(function () {
      elapsed = true;
      if (loaded) {
        //removeLoader();
        loadComplete();
      }
    }, 300);

    var removeLoader = function () {
      $('.pre-loader').fadeOut();
      $('body').removeClass('is-loading');
    }

    $(window).on('load', function () {
      
      loaded = true;
      if (elapsed) {
        //removeLoader();
        loadComplete();
      }
    });
  }(window, $('.pre-loader')));

  var controller = new ScrollMagic.Controller();

  var slides = ['#hero', '#services', '#case-study1', '#case-study2', '#case-study3', '#contact'];
  
  var $hpHero = $('.hp-hero');
 
  function get_blinder_height(){
    var heroRowHeight = $('.hp-hero .row').height();
    var windowHeight = $(window).height();
    var remainingHeight = windowHeight  - heroRowHeight;
    var blinderHeight = remainingHeight / 2;
    return blinderHeight;
  }

  var $caseStudy1TopBlinder = $('.top-blinder');
  var $caseStudy1BottomBlinder = $('.bottom-blinder');

  function loadComplete(){
    $('html, body').scrollTop(0);
    var preloaderOutTl = new TimelineMax();

    preloaderOutTl
      .set([$caseStudy1TopBlinder, $caseStudy1BottomBlinder], { height: get_blinder_height()})
      .set($('body'), { className: '-=is-loading' })
      .set($hpHero, { className: '+=is-loaded' })
      .to($('#pre-loader'), 0.7, {opacity: 0, ease:Power4.easeInOut})
      .set($('#pre-loader'), {className: '+=is-hidden'})
      .staggerFromTo($('.slogan-list ul>li'), .3, {xPercent: '120%'}, {xPercent: 0, ease:Power1.easeOut}, .3)
      .set($hpHero, {className: '+=is-active'});

    return preloaderOutTl;
  }

  var slideOutSloganTl = new TimelineMax();

  slideOutSloganTl
    .staggerTo($('.slogan-list ul>li'), .5, {xPercent: '-=120%', ease:Power0.easeNone}, .3)
    .to($('.hp-hero .overlay'), 1, {opacity: 1}, .5)
    .fromTo($('.hp-hero-logo'), 1, {autoAlpha:0}, {autoAlpha:1}, 1)
    .staggerFromTo($('.services-list ul>li'), .5, {y: '+=20', autoAlpha: 0}, {y: 0, autoAlpha:1, ease:Power0.easeIn}, 1)
    .to($('.hp-hero .overlay'), 7, {width: '+=120%'}, "+=2.5")
    .to($('.hp-hero'), 1, {autoAlpha: 0}, "-=3");

  var slideOutSlogan = new ScrollMagic.Scene({
    triggerElement: '.page-wrapper',
    triggerHook: 0,
    duration: "800%"
  })
  .setPin('.page-wrapper')
  .setTween(slideOutSloganTl)
  .addTo(controller);

});