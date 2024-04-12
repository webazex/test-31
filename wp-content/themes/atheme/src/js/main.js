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
});