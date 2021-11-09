$(document).ready(function () {
    'use strict';



//===== Slick Carousel =====//
    if ($.isFunction($.fn.slick)) {
        //====== Post Carousel =====//
        $('.layouts-caro').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            centerPadding: '0',
            focusOnSelect: true,
            vertical: false,
            prevArrow: "<button type='button' class='slick-prev'><i></i></button>",
            nextArrow: "<button type='button' class='slick-next'><i></i></button>",
            responsive: [
                {
                    breakpoint: 1605,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        arrows: true
                    }
                },
                {
                    breakpoint: 981,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        arrows: true
                    }
                },
                {
                    breakpoint: 851,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        arrows: true
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        dots: false
                    }
                }
            ]
        });
    }
});

