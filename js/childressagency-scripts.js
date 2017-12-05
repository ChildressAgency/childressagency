$.fn.accordionGrid = function(){

  var brands = this;
  var viewportWidth = $(window).width();
  var cols = 3;
  var blockSize = 290;
  if((viewportWidth >= 768) && (viewportWidth <= 990)){
    cols = 2;
  }

  var rows = Math.floor(brands.find('.brand').length / cols);

  //layout the grid
  brands.find('.brand').each(function(index){
    var self = $(this);
    $(self).attr('data-brand_index', index);
    var col = (index % cols);
    $(self).attr('data-col', col);

    resetBrandSize(self, index);
  });

  brands.find('.brand').hover(function(){
    var index = $(this).data('brand_index');
    //var col = index % cols;
    var col_number = $(this).data('col');
    var leftPos = col_number * (blockSize / 2);
    var largeImage = $(this).data('large_image');

    $(this).css('z-index', '99');
    if(typeof largeImage !== 'undefined' || largeImage){
      $(this).css('background-image', 'url(' + largeImage + ')');
    }
    $(this).clearQueue();
    $(this).stop();
    $(this).animate({
      height: blockSize * 2,
      width: blockSize * 2,
      top: 0,
      left: leftPos
    });
    $('.brand:not([data-col=' + col_number + '])').animate({
      'width': blockSize / 2,
      'left': (col_number * blockSize) + (blockSize / 2)
    });
  }, function(){
    var self = $(this);
    var index = self.data('brand_index');
    //var col = index % cols;
    resetBrandSize(self, index);
  });

  function resetBrandSize(self, index){
    var row = Math.floor(index / cols);
    var col_number = $(self).data('col');
    var leftPos = col_number * blockSize;
    var topPos = row * blockSize;
    var smallImage = $(self).data('small_image');

    $(self).clearQueue();
    $(self).stop(); 
    $(self).animate({
      width: blockSize,
      height: blockSize,
      top: topPos,
      left: leftPos
    }, 400, function(){
      $(self).css('z-index', '0');
      $(self).css('background-image', 'url(' + smallImage + ')');
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