$(document).ready(function () {
    'use strict';



//===== Slick Carousel =====//
    if ($.isFunction($.fn.slick)) {
        //=== Featured Area Carousel ===//
        $('.feat-caro').slick({
            arrows: true,
            initialSlide: 0,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            autoplay: false,
            autoplaySpeed: 6000,
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            speed: 1500,
            draggable: true,
            dots: false,
            pauseOnDotsHover: true,
            pauseOnFocus: false,
            pauseOnHover: false,
            prevArrow: "<button type='button' class='slick-prev'><i class='flaticon-back'></i></button>",
            nextArrow: "<button type='button' class='slick-next'><i class='flaticon-next'></i></button>",
            responsive: [
                {
                    breakpoint: 981,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true,
                        dots: false,
                    }
                },
                {
                    breakpoint: 851,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true,
                        dots: false,
                    }
                },
                {
                    breakpoint: 770,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        dots: true,
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        dots: true,
                    }
                }
            ]
        });
        //====== Post Carousel =====//
        $('.layouts-caro').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            centerPadding: '0',
            focusOnSelect: true,
            vertical: false,
            prevArrow: "<button type='button' class='slick-prev'><i class='flaticon-arrow-pointing-to-left'></i></button>",
            nextArrow: "<button type='button' class='slick-next'><i class='flaticon-arrow-pointing-to-right'></i></button>",
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

