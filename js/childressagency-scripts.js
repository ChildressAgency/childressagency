$.fn.accordionGrid = function(){

  var brands = this;
  var viewportWidth = $(window).width();
  var cols = 3;
  var blockSize = 290;
  if((viewportWidth >= 768) && (viewportWidth <= 990)){
    cols = 2;
  }

  //set the height of the grid container (to push down the 
  // element below it)
  var rows = Math.floor(brands.find('.brand').length / cols);
  brands.css('height', rows * blockSize);

  setGrid();

  brands.find('.brand').hover(function(){
    var brandBlock = $(this);
    var index = $(brandBlock).data('brand_index');
    //var col = index % cols;
    var col_number = $(brandBlock).data('col');
    var leftPos = col_number * (blockSize / 2);
    var largeImage = $(brandBlock).data('large_image');

    $(brandBlock).css('z-index', '99');
    if(typeof largeImage !== 'undefined' || largeImage){
      $(brandBlock).css('background-image', 'url(' + largeImage + ')');
    }
    $(brandBlock).find('.caption').addClass('right-arrow');
    $(brandBlock).clearQueue();
    $(brandBlock).stop();
    $(brandBlock).animate({
      height: blockSize * 2,
      width: blockSize * 2,
      top: 0,
      left: leftPos
    });

    //squish the other brand blocks
    //$('.brand:not([data-col=' + col_number + '])').animate({
    //  'width': blockSize / 2,
    //  'left': (col_number * blockSize) + (blockSize / 2)
    //});
    squishOtherBlocks(col_number);

  }, function(){
    setGrid();
  });

  function setGrid(){
    brands.find('.brand').each(function(index){
      var brandBlock = $(this);
      var row = Math.floor(index / cols);
      var col = index % cols;
      var leftPos = col * blockSize;
      var topPos = row * blockSize;

      $(brandBlock).attr('data-brand_index', index);
      $(brandBlock).attr('data-col', col);
      var smallImage = $(brandBlock).data('small_image');
      $(brandBlock).removeClass('big-caption');
      $(brandBlock).find('.caption').removeClass('right-arrow');

      $(brandBlock).clearQueue();
      $(brandBlock).stop(); 
      $(brandBlock).animate({
        width: blockSize,
        height: blockSize,
        top: topPos,
        left: leftPos
      }, 400, function(){
        $(brandBlock).css('z-index', '0');
        $(brandBlock).css('background-image', 'url(' + smallImage + ')');
      });
    });
  }
  function squishOtherBlocks(col_number){
    $('.brand').addClass('big-caption');
    switch(col_number){
      case 0:
        $('[data-col=1]').animate({
          'width': blockSize / 2,
          'left': (1 * blockSize) + (blockSize)
        });
        $('[data-col=2]').animate({
          'width': blockSize / 2,
          'left': (2 * blockSize) + (blockSize / 2)
        });
      break;
      case 1:
        $('[data-col=0]').animate({
          'width': blockSize / 2
        });
        $('[data-col=2]').animate({
          'width': blockSize / 2,
          'left': (2 * blockSize) + (blockSize / 2)
        });
      break;
      case 2:
        $('[data-col=0]').animate({
          'width': blockSize / 2
        });
        $('[data-col=1]').animate({
          'width': blockSize / 2,
          'left': blockSize / 2
        });
    }
  }
}

jQuery(document).ready(function($){

  $('.brands').accordionGrid();

});