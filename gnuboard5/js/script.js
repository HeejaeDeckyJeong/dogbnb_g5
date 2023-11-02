//1.스크립트 위로 튕기는것
$(document).on('click', 'a[href="#"]', function (e) {
    e.preventDefault();
});

//2.슬라이드
$(function () {
    var $carousel = $('#mainslide').slick({
        autoplay: true,
        autoplaySpeed: 5500,
        dots: true,
        arrows: false,
        pauseOnHover: false,
        pauseOnFocus: false,
    });

    /* The first slide will not get the animation,
	therefore I add and remove a class that will trigger the css animation */
    $carousel.find('.slick-current').addClass('start');
    /* I use a set-timeoutfunction to hinder optimization
	of adding and removing classes */
    setTimeout(function () {
        $carousel.find('.start').removeClass('start');
    }, 0);
});

//.3.scroll 애니메이션
$(function () {
    $('.animate').scrolla({
        mobile: true, //모바일버전시 활성화
        once: false, //스크롤시 딱 한번만 하고싶을땐 true
    });
});
// 스크롤 높이에 따른
$(window).scroll(function () {
    var scroll = $(window).scrollTop();
    //console.log(scroll);
    if (scroll >= 200) {
        //console.log('a');
        $('.header_g').addClass('change');
    } else {
        //console.log('a');
        $('.header_g').removeClass('change');
    }
});
