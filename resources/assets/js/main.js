var $ = require('jquery');
require('slick-carousel');
require('slick-lightbox');

$('.slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: false,
    arrows: false,
    cssEase: 'linear'
});

$('.left').click(function(){
  $('.slider').slick('slickPrev');
})

$('.right').click(function(){
  $('.slider').slick('slickNext');
})

$('.karusele').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  dots: false,
  arrows: false,
   responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: false
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ],
  autoplaySpeed: 2000
});

$('.prev').click(function(){
  $('.karusele').slick('slickPrev');
})

$('.next').click(function(){
  $('.karusele').slick('slickNext');
})


  $('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  arrows: true,
  centerMode: true,
  variableWidth: true,
  focusOnSelect: true
});

$('#gll').slickLightbox();

$('.add-into-cart').click(function(){
    var element = $('#' + $(this).parent().prev().find('span')[0]['id']);
    var token = $('meta[name="csrf-token"]').attr('content');
    var quantity = $(this).parent().prev().find('input').val();
    $.ajax({
        type: "post",
        url: $(this).data('url'),
        data: {quantity: quantity,_token: token},
        dataType: "json",
        success:function ()
        {
            element.html('Added to cart');
            element.css({'color':'green','display':'block'})
        },
        error:function (error)
        {
            element.html(error['responseJSON']['errors']['quantity'][0]);
            element.css({'color':'red','display':'block'});
        }
    });
});

$('#show_packshots').click(function () {
  $('.packshots').toggle();
  return;
});

$('#show_preorders').click(function () {
  $('.preorders').toggle();
  return;
});

var timer = null;
$('.setquantity').keyup(function() {
    var quantity = $(this).val();
    var url = $(this).data('url');
    var messageId = $(this).parent().find('span')[0]['id'];
    clearTimeout(timer);
    timer = setTimeout(function() {

        var token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            type: "post",
            url: url,
            data: {quantity: quantity,_token: token},
            dataType: "json",
            success:function (data)
            {
                var element = $('#message' + data['id']);
                $('#totalQuantity').html(data['totalQuantity']);
                $('#singlePrice' + data['id']).html(data['singleProductPrice'].toFixed(2) + ' €');
                $('#totalPrice').html(data['totalPrice'].toFixed(2) + ' €');
                element.html('updated');
                element.css({'color':'green','display':'block'});
            },
            error:function (error)
            {
                var message = $('#' + messageId);
                message.html(error['responseJSON']['errors']['quantity'][0]);
                message.css({'color':'red','display':'block'});
            }
        });
    }, 10000)
});

$( ".table-tr" ).hover(
  function() {
    $( this ).css("background-color","white").css("opacity", "0.7").css("color", "red");
  }, function() {
    $( this ).css("background-color","").css("opacity", "1").css("color", "black");
  }
);

