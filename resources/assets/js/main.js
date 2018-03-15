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

var timer = null;
$('.updateQ_P').click(function() {
    console.log(1);
    // clearTimeout(timer);
    // timer = setTimeout(function() { update_quantity(id,quantity) }, 1000)

});

function update_quantity(id,quantity)
{
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "post",
        url: 'update' + id,
        data: {quantity: quantity,_token: token},
        dataType: "json",
        success:function (data)
        {
            document.getElementById('totalQuantity').innerHTML = data['totalQuantity'];
            document.getElementById('singlePrice' + id).innerHTML = data['singleProductPrice'] + ' €';
            document.getElementById('totalPrice').innerHTML = data['totalPrice'] + ' €';
            document.getElementById('update' + data['id']).innerHTML = 'updated';
            document.getElementById('update' + data['id']).style.display = 'block';
        },
        error:function (error)
        {
            document.getElementById('update' + id).innerHTML = error['responseJSON']['errors']['quantity'][0];
            document.getElementById('update' + id).style.display = 'block';
        }
    });
}