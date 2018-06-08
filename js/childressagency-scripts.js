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
  
  var $hpHero = $('.hp-hero'),
      $sloganList = $('.slogan-list ul>li'),
      $servicesList = $('.services-list ul>li');
 
  var blinderHeight = get_blinder_height();
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
      .set([$caseStudy1TopBlinder, $caseStudy1BottomBlinder], { height: blinderHeight})
      .set($('body'), { className: '-=is-loading' })
      .set($hpHero, { className: '+=is-loaded' })
      .to($('#pre-loader'), 0.7, {opacity: 0, ease:Power4.easeInOut})
      .set($('#pre-loader'), {className: '+=is-hidden'})
      .staggerFromTo($sloganList, .3, {xPercent: '120%'}, {xPercent: 0, ease:Power1.easeOut}, .3)
      .set($hpHero, {className: '+=is-active'});

    return preloaderOutTl;
  }

  var slideOutSloganTl = new TimelineMax();
  slideOutSloganTl
    .staggerTo($sloganList, .5, {xPercent: '-=200%', ease:Power0.easeNone}, .3)
    .to($('.hp-hero .overlay'), 1, {opacity: 1}, "-=0.8");

  var addLogoServicesTl = new TimelineMax();
  addLogoServicesTl
    .fromTo($('.hp-hero-logo'), .5, {autoAlpha:0}, {autoAlpha:1})
    .staggerFromTo($servicesList, .5, {y: '+=20', autoAlpha: 0}, {y: 0, autoAlpha:1, ease:Power0.easeIn}, .2)
    .add("pauseOnServices");

  var stretchOverlayTl = new TimelineMax();
  stretchOverlayTl
    .to($('.hp-hero .overlay'), 1, {width: '+=120%'}, "pauseOnServices+=1");

  var fadeOutHeroTl = new TimelineMax();
  fadeOutHeroTl
    .to($hpHero, 1, {autoAlpha: 0}, "-=1.8")
    .add("heroFadeOut");

  var heroTimeline = new TimelineMax();
  heroTimeline
    .add(slideOutSloganTl)
    .add(addLogoServicesTl)
    .add(stretchOverlayTl)
    .add(fadeOutHeroTl);

  var removeBlindersTl = new TimelineMax();
  removeBlindersTl
    .fromTo([$caseStudy1TopBlinder, $caseStudy1BottomBlinder], .5, {height: blinderHeight}, {height: 0, ease:Power1.easeOut}, "heroFadeOut");
  

  var masterTimeline = new TimelineMax();
  masterTimeline
    .add(heroTimeline)
    .add(removeBlindersTl);

  //var slideOutSlogan = new ScrollMagic.Scene({
  var heroScene = new ScrollMagic.Scene({
    triggerElement: '.page-wrapper',
    triggerHook: 0,
    duration: "700%"
  })
  .setPin('.page-wrapper')
  .setTween(masterTimeline)
  .addTo(controller);

});