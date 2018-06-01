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

  var heroScene = new ScrollMagic.Scene({
    triggerElement: '.hp-hero',
    triggerHook: 0
  })
  .setClassToggle('.hp-hero', 'is-active')
  .addTo(controller);

  function loadComplete(){
    $('html, body').scrollTop(0);
    var preloaderOutTl = new TimelineMax();

    preloaderOutTl
      .set($('body'), { className: '-=is-loading' })
      .set($('#hero'), { className: '+=is-loaded' })
      .to($('#pre-loader'), 0.7, {opacity: 0, ease:Power4.easeInOut})
      .set($('#pre-loader'), {className: '+=is-hidden'})
      .staggerTo($('.slogan-list ul>li'), 1, {transform:'translateX(0)', ease:Power1.easeOut}, .3);

    return preloaderOutTl;
  }

  var pinHeroTl = new TimelineMax();

  pinHeroTl
    .staggerFromTo($('.slogan-list ul>li'), 1, {transform:'translateX(0)'}, {transform:'translateX(-150%)', ease:Power0.easeNone}, .3)
    .to($('.hp-hero .overlay'), 1, {opacity: 1}, .5);

  var pinHero = new ScrollMagic.Scene({
    triggerElement: '.hp-hero',
    triggerHook: 0,
    duration: "200%"
  })
  .setPin('.hp-hero')
  .setTween(pinHeroTl)
  .addTo(controller);

  var servicesScene = new ScrollMagic.Scene({
    triggerElement: $('#services'),
  })
  .setClassToggle('#services', 'is-active')
  .addTo(controller);

/*  var sectionsParallaxUp = new ScrollMagic.Scene({
    triggerElement: '#services',
    triggerHook: 1,
    duration: "100%"
  })
  .setTween(TweenMax.from('#services', 1, {y: '0%', ease:Power0.easeNone}))
  .addTo(controller);*/
});