
function smoothScroll(dataId) {
    console.log(dataId)
    $('html, body').animate({
      scrollTop: $("#" + dataId).offset().top - 86
    }, 500);
  $('.navbar-collapse').on('click', function(){
    setTimeout(function delay(){ $('.navbar-collapse').collapse('hide');},1800);
     });
  };
  $.get("https://api.coinify.com/v3/rates/EUR", function(out, status){
    document.getElementById("priceBTC").innerHTML = out.data.buy + " €";
  });
  $.get("https://api.coinify.com/v3/rates/EUR", function(out, status){
    document.getElementById("BTC").innerHTML = out.data.buy + " €";
  });
  $.get("https://min-api.cryptocompare.com/data/price?fsym=BCH&tsyms=EUR", function(out, status){
    document.getElementById("BCH").innerHTML = out.EUR + " €";
  });
  $.get("https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=EUR", function(out, status){
    document.getElementById("ETH").innerHTML = out.EUR + " €";
  });
  $.get("https://min-api.cryptocompare.com/data/price?fsym=XLM&tsyms=EUR", function(out, status){
    document.getElementById("XLM").innerHTML = out.EUR + " €";
  });
  $.get("https://min-api.cryptocompare.com/data/price?fsym=DASH&tsyms=EUR", function(out, status){
    document.getElementById("DASH").innerHTML = out.EUR + " €";
  });
 
