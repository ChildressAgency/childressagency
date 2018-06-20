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

  //var slides = ['#hero', '#services', '#case-study1', '#case-study2', '#case-study3', '#contact'];
  
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

  var $viewportWidth = $(window).width();
 
  var pinScene = new ScrollMagic.Scene({
    triggerElement: '.page-wrapper',
    triggerHook: 0,
    duration: "1400%"
  })
    .setPin('.page-wrapper')
    .addTo(controller);

  var slideOutSloganTl = new TimelineMax();
  slideOutSloganTl
    .staggerTo($sloganList, .5, {xPercent: '-=200%', ease:Power0.easeNone}, .3)
    .to($('.hp-hero .overlay'), 1, {opacity: 1}, "-=0.8");

  var addLogoServicesTl = new TimelineMax();
  addLogoServicesTl
    .fromTo($('.hp-hero-logo'), .5, {autoAlpha:0}, {autoAlpha:1})
    .staggerFromTo($servicesList, .5, {y: '+=20', autoAlpha: 0}, {y: 0, autoAlpha:1, ease:Power0.easeIn}, .2, -.3)
    .add("pauseOnServices");

  var stretchOverlayTl = new TimelineMax();
  if($viewportWidth > 767){
    stretchOverlayTl
      .to($('.hp-hero .overlay'), 1, {width: '+=120%'}, "pauseOnServices+=1");
  }

  var fadeOutHeroTl = new TimelineMax();
  fadeOutHeroTl
    .to($hpHero, 1, {autoAlpha: 0})
    .add("heroFadeOut")
    .set($hpHero, {className: '-=is-loaded'})
    .set($('#case-study1'), {className: '+=is-loaded'});

  var removeBlindersTl = new TimelineMax();
  if($viewportWidth > 767){
    removeBlindersTl
      .fromTo([$caseStudy1TopBlinder, $caseStudy1BottomBlinder], .5, {height: blinderHeight}, {height: 0, ease:Power1.easeOut});
      //.set($('#header-nav'), { className: '+=white-nav' });
  }
  else{
    removeBlindersTl
      .set([$caseStudy1TopBlinder, $caseStudy1BottomBlinder], {display:'none'});
      //.set($('#header-nav'), { className: '+=white-nav' });
  }
  removeBlindersTl.set($('#header-nav'), {className: '+=white-nav'});

  var heroTimeline = new TimelineMax();
  heroTimeline
    .add(slideOutSloganTl)
    .add(addLogoServicesTl)
    .add(stretchOverlayTl)
    .add(fadeOutHeroTl)
    .add(removeBlindersTl);

  //case study timeline
  var caseStudySlides = ['#case-study1', '#case-study2', '#case-study3', '#case-study4'];
  var caseStudyTl = new TimelineMax();
  var slide = $('.slide');

  if($viewportWidth > 767){
    for(var i=0; i<caseStudySlides.length; i++){
      var $overlay = $(slide[i]).find('.overlay');
      var $caseStudyLogo = $(slide[i]).find('.case-study-logo');
      var $caseStudySummary = $(slide[i]).find('.case-study-summary>*');

      //if($viewportWidth > 767){
      //  caseStudyTl.fromTo($overlay, 1, {width:0}, {width:"50%"});
      //}
      //else{
      //  caseStudyTl.set($overlay, {width:"100%"});
      //}
      caseStudyTl
        .fromTo($overlay, 1, {width:0}, {width:"50%"})
        .fromTo($caseStudyLogo, .5, {autoAlpha:0}, {autoAlpha:1})
        .staggerFromTo($caseStudySummary, .1, {autoAlpha:0, top:50}, {autoAlpha:1, top:0}, .2, "-=.5")
        .to($overlay, 1, {width:"100%"}, "+=2");

      if(((i+1) < caseStudySlides.length) && slide.length > 0){
        caseStudyTl.fromTo(slide[i+1], 1, {x: "-100%"}, {x:"0%"});
      }
    }
  }
  
  var contactTl = new TimelineMax();
  if($viewportWidth > 767){
    contactTl
      .fromTo($('#contact.full-screen'), 1, {x:"-100%"}, {x: "0%"})
      .fromTo($('#contact.full-screen .wrapper h2'), .5, {autoAlpha:0, marginTop:50}, {autoAlpha:1, marginTop:0});
  }
  contactTl.set($('#header-nav'), {className: '-=white-nav'});

  var masterHomepageTimeline = new TimelineMax();
  masterHomepageTimeline
    .add(heroTimeline)
    .add(caseStudyTl)
    .add(contactTl);

  var homepageScene = new ScrollMagic.Scene({
    triggerElement: '.page-wrapper',
    triggerHook: 0,
    duration: "1200%"
  })
    .setTween(masterHomepageTimeline)
    .addTo(controller);

  
  //budget slider
  var budgetSlider = $('.budget-slider').bootstrapSlider({
    id: 'budgetSlider',
    min: 500,
    max: 50000,
    step: 500,
    value: 3000,
    tooltip: 'hide',
    handle: 'square'
  });
  if(budgetSlider){
    budgetSlider.on('slide slideStop', function(slideEvent){
      var plus = '';
      if(slideEvent.value == 50000){ plus = '+'; }
      $('#budget-value>span').text(slideEvent.value + plus).digits();
    });
  }

  $.fn.digits = function(){
    return this.each(function(){
      $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
    });
  }

  //scroll-header
  $(window).on('scroll', function(){
    if($('#header-nav').offset().top > 0){
      $('.scroll-header').addClass('white-bg');
    }
    else{
      $('.scroll-header').removeClass('white-bg');
    }
  });

  var teamMemberTl = new TimelineMax();
  var $teamMemberRows = $('#meet-the-team .row').toArray();

  $teamMemberRows.forEach(function(row, index){
    var teamMembersScene = new ScrollMagic.Scene({
      triggerElement: row,
      triggerHook: .5,
      reverse:false
    })
      .setTween(TweenMax.fromTo(row, .5, {autoAlpha:0, top:100}, {autoAlpha:1, top:0}))
      .addTo(controller);
  });

  //work list page animations
  function workScissorIn(targetPanelId){
    var $textSide = $(targetPanelId).find('.text-side');
    var $imageSide = $(targetPanelId).find('.image-side');

    TweenMax.fromTo($textSide, .5, {y:"-100%"}, {y:"0%", ease: Power2.easeOut});
    TweenMax.fromTo($imageSide, .5, {y:"100%"}, {y:"0%", ease: Power3.easeOut});
  }

  $('.work-nav a[data-toggle="tab"]').on('show.bs.tab', function(e){
    var targetTab = e.target;
    var targetPanelId = $(targetTab).attr('href');

    TweenMax.set($('.work-details'), {autoAlpha:0});
    workScissorIn(targetPanelId);
  });

/*  $('.work-nav a[data-toggle="tab"]').on('hide.bs.tab', function(e){
    var leavingTab = e.target;
    var leavingPanelId = $(leavingTab).attr('href');
    var $leavingPanelWorkSummary = $(leavingPanelId).find('.work-summary')

    TweenMax.set($($leavingPanelWorkSummary), {autoAlpha:1});
  });*/

  function revealDetails(thisWorkSummary){
    var $textSide = $(thisWorkSummary).find('.text-side');
    var $imageSide = $(thisWorkSummary).find('.image-side');
    var $theDetails = $('.work-details');

    TweenMax.to($textSide, .5, {y:"100%"});
    TweenMax.to($imageSide, .5, {y:"-100%"});
    //TweenMax.set($(thisWorkSummary), {autoAlpha:0});
    TweenMax.to($theDetails, 1, {autoAlpha:1, zIndex:5, ease:Power2.easeIn});
  }

  $('.work-description').on('click', '.show-work-details', function(){
    var thisWorkSummary = $(this).parents('.work-summary');

    revealDetails(thisWorkSummary);
  });

});