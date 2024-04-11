$(document).ready(function (){
    $('.frontpage-slider-container__slider').slick({
        infinite: true,
        slidesToShow: $('.frontpage-slider-container__slider').attr('data-count'),
        slidesToScroll: 1
    });
});