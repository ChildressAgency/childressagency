$.fn.accordionGrid = function(){

  var brands = this;
  var viewportWidth = $(window).width();
  var cols = 3;
  if((viewportWidth >= 768) && (viewportWidth <= 990)){
    cols = 2;
  }

  var rows = Math.floor(brands.find('.brand').length / cols);

  //layout the grid
  brands.find('.brand').each(function(index){
    var self = $(this);
    resetGrid(self, index);
  });

  brands.find('.brand').hover(function(){
    var index = $(this).data('brand_index');
    var col = index % cols;
    var leftPos = col * 145;
    $(this).css('z-index', '99');

    $(this).clearQueue();
    $(this).stop();
    $(this).animate({
      height: 580,
      width: 580,
      top: 0,
      left: leftPos
    });
  }, function(){
    var self = $(this);
    var index = self.data('brand_index');
    resetGrid(self, index);
  });

  function resetGrid(self, index){
    var row = Math.floor(index / cols);
    var col = (index % cols);
    var leftPos = col * 290;
    var topPos = row * 290;

    $(self).attr('data-brand_index', index);
    $(self).clearQueue();
    $(self).stop(); 
    $(self).animate({
      width: 290,
      height:290,
      top: topPos,
      left: leftPos
    }, 400, function(){
      $(self).css('z-index', '0');
    });
  }

}

jQuery(document).ready(function($){

  $('.brands').accordionGrid();

  //$('.brand').hover(function(){
  //  $(this).addClass('big-brand');
  //}, function(){
  //  $(this).removeClass('big-brand');
  //});

});