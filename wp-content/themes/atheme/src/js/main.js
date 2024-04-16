$(document).ready(function (){
    $('.header-menu__mobile-btn').click(function (e){
        if ($(this).hasClass('open')){
            $(this).removeClass('open');
            $('.header-container__header-menu ul.menu').removeClass('active');
        }else{
            $(this).addClass('open');
            $('.header-container__header-menu ul.menu').addClass('active');
        }
    });
    $('.work-article__container-reviews').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1540,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    settings: "unslick"
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    settings: "unslick"
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    settings: "unslick"
                }
            }
        ]
    });
});