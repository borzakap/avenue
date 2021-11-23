$(document).ready(function () {

    var $carousel = $('.progress-slider');

    $carousel
            .slick({
                dots: false,
                arrows: true,
                centerPadding: '0',
                focusOnSelect: true,
                vertical: false,
                prevArrow: "<button type='button' class='slick-prev'><i></i></button>",
                nextArrow: "<button type='button' class='slick-next'><i></i></button>",
            })
            .magnificPopup({
                type: 'image',
                delegate: 'a:not(.slick-cloned)',
                gallery: {
                    enabled: true
                },
                callbacks: {
                    open: function () {
                        var current = $carousel.slick('slickCurrentSlide');
                        $carousel.magnificPopup('goTo', current);
                    },
                    beforeClose: function () {
                        $carousel.slick('slickGoTo', parseInt(this.index));
                    }
                }
            });
});