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
/*   brands.find('.brand').each(function(index){
    var self = $(this);
    $(self).attr('data-brand_index', index);
    var col = (index % cols);
    $(self).attr('data-col', col);

    resetBrandSize(self, index);
  });
 */
  setGrid();

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
    //squish the other brand blocks
    $('.brand:not([data-col=' + col_number + '])').animate({
      'width': blockSize / 2,
      'left': (col_number * blockSize) + (blockSize / 2)
    });
  }, function(){
    //var self = $(this);
    //var index = self.data('brand_index');
    //var col = index % cols;
    //resetBrandSize(self, index);
    setGrid();
  });

  function setGrid(){
    brands.find('.brand').each(function(index){
      var brand = $(this);
      var row = Math.floor(index / cols);
      var col = index % cols;
      var leftPos = col * blockSize;
      var topPos = row * blockSize;

      $(brand).attr('data-brand_index', index);
      $(brand).attr('data-col', col);
      var smallImage = $(brand).data('small_image');

      $(brand).clearQueue();
      $(brand).stop(); 
      $(brand).animate({
        width: blockSize,
        height: blockSize,
        top: topPos,
        left: leftPos
      }, 400, function(){
        $(brand).css('z-index', '0');
        $(brand).css('background-image', 'url(' + smallImage + ')');
      });
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