$.fn.accordionGrid = function(){

  var brands = this;
  var viewportWidth = $(window).width();
  var cols = 3;
  var blockSize = 290;
  if ((viewportWidth >= 768) && (viewportWidth <= 990)) {
    cols = 2;
  }else if(viewportWidth < 768){
    cols = 1;
    blockSize = 260;
  }

  //set the height of the grid container (to push down the 
  // element below it)
  var rows = Math.ceil(brands.find('.brand').length / cols);
  brands.css({
    'height': rows * blockSize,
    'width': cols * blockSize
  });

    setGrid();  

  $(window).on('resize orientationchange', function(){
    viewportWidth = $(window).width();
    cols = 3;
    if((viewportWidth >= 768) && (viewportWidth <= 990)){
      cols = 2;
    }else if(viewportWidth < 768){
      cols = 1;
      blockSize = 260;
    }
    rows = Math.ceil(brands.find('.brand').length / cols);
    brands.css({
      'height': rows * blockSize,
      'width': cols * blockSize
    });

      setGrid();
  });

  brands.find('.brand').hover(function(){
    var brandBlock = $(this);
    var index = $(brandBlock).data('brand_index');
    //var col = index % cols;
    var col_number = $(brandBlock).data('col');
    var row_number = $(brandBlock).data('row');
    var leftPos = (cols == 3) ? col_number * (blockSize / 2) : 0;
    var largeImage = $(brandBlock).data('large_image');

    $(brandBlock).css('z-index', '99');
    if(typeof largeImage !== 'undefined' || largeImage){
      $(brandBlock).css('background-image', 'url(' + largeImage + ')');
    }
    $(brandBlock).find('.caption').addClass('right-arrow');
    $(brandBlock).clearQueue();
    $(brandBlock).stop();

    if(cols > 1){
      $(brandBlock).animate({
        height: blockSize * 2,
        width: blockSize * 2,
        top: Math.max(0, (row_number * blockSize) - blockSize),
        left: leftPos
      });
    }

    if(cols == 3){
      squishOtherBlocks(col_number, row_number);
    }

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
      $(brandBlock).attr('data-row', row);
      var smallImage = $(brandBlock).data('small_image');

      $(brandBlock).removeClass('big-caption');
      if(cols > 1){
        $(brandBlock).find('.caption').removeClass('right-arrow');
      }

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
  function squishOtherBlocks(col_number, row_number){
    $('.brand').addClass('big-caption');
    //if()
    var other_row = row_number - 1;
    if(row_number == 0){
      other_row = row_number + 1;
    }
    /*
    for(var i=0; i<cols; i++){
      if(i !== col_number){
        //var leftPos = (i * blockSize) + (blockSize / i);
        var leftPos = (col_number-3+i * blockSize) + (blockSize / i);

        $('[data-col=' + i + '][data-row=' + row_number + '], [data-col=' + i + '][data-row=' + other_row + ']').animate({
          'width':blockSize / 2,
          'left': leftPos
        });
        console.log(leftPos);
      }
    }*/
    
    switch(col_number){
      case 0:
        $('[data-col=1][data-row=' + row_number + '], [data-col=1][data-row=' + other_row + ']').animate({
          'width': blockSize / 2,
          'left': (1 * blockSize) + (blockSize)
        });
        $('[data-col=2][data-row=' + row_number + '], [data-col=2][data-row=' + other_row + ']').animate({
          'width': blockSize / 2,
          'left': (2 * blockSize) + (blockSize / 2)
        });
      break;
      case 1:
        $('[data-col=0][data-row=' + row_number + '], [data-col=0][data-row=' + other_row + ']').animate({
          'width': blockSize / 2
        });
        $('[data-col=2][data-row=' + row_number + '], [data-col=2][data-row=' + other_row + ']').animate({
          'width': blockSize / 2,
          'left': (2 * blockSize) + (blockSize / 2)
        });
      break;
      case 2:
        $('[data-col=0][data-row=' + row_number + '], [data-col=0][data-row=' + other_row + ']').animate({
          'width': blockSize / 2
        });
        $('[data-col=1][data-row=' + row_number + '], [data-col=1][data-row=' + other_row + ']').animate({
          'width': blockSize / 2,
          'left': blockSize / 2
        });
      break;
    }
  }
}

jQuery(document).ready(function($){

  $('.brands').accordionGrid();

});