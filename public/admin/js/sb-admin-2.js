(function ($) {
    "use strict"; // Start of use strict

    // Toggle the side navigation
    $("#sidebarToggle, #sidebarToggleTop").on('click', function (e) {
        $("body").toggleClass("sidebar-toggled");
        $(".sidebar").toggleClass("toggled");
        if ($(".sidebar").hasClass("toggled")) {
            $('.sidebar .collapse').collapse('hide');
        }
        ;
    });

    // Close any open menu accordions when window is resized below 768px
    $(window).resize(function () {
        if ($(window).width() < 768) {
            $('.sidebar .collapse').collapse('hide');
        }
        ;

        // Toggle the side navigation when window is resized below 480px
        if ($(window).width() < 480 && !$(".sidebar").hasClass("toggled")) {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $('.sidebar .collapse').collapse('hide');
        }
        ;
    });

    // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
    $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function (e) {
        if ($(window).width() > 768) {
            var e0 = e.originalEvent,
                    delta = e0.wheelDelta || -e0.detail;
            this.scrollTop += (delta < 0 ? 1 : -1) * 30;
            e.preventDefault();
        }
    });

    // Scroll to top button appear
    $(document).on('scroll', function () {
        var scrollDistance = $(this).scrollTop();
        if (scrollDistance > 100) {
            $('.scroll-to-top').fadeIn();
        } else {
            $('.scroll-to-top').fadeOut();
        }
    });

    // Smooth scrolling using jQuery easing
    $(document).on('click', 'a.scroll-to-top', function (e) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top)
        }, 1000, 'easeInOutExpo');
        e.preventDefault();
    });

    // Change the langs
    $(document).on('change', '#lang_changer', function (e) {
        var $lang_field = $('.languages-variants');
        var $selected_lang = $(this).val();
        $lang_field.each(function () {
            if ($(this).data('language') !== $selected_lang) {
                $(this).removeClass('active');
            } else {
                $(this).addClass('active');
            }
        });
    });

    $(document).ready(function () {
        
        // datepicker
        if ($('.jquery-datepicker').length > 0) {
            $('.jquery-datepicker').each(function(){
                var date, date_val = $(this).children('.jquery-datepicker__input').val();
                if(date_val){
                    date = new Date(date_val);
                }else{
                    date = new Date();
                }
                var month = date.getMonth()+1;
                var day = date.getDate();

                var formated = date.getFullYear() + '-' +
                    ((''+month).length<2 ? '0' : '') + month + '-' +
                    ((''+day).length<2 ? '0' : '') + day;

                $(this).datepicker({
                    format: 'yyyymmdd',
                    date: formated
                });
            });
        }
        
        // editor sceditor
        if (typeof sceditor !== 'undefined') {
            var textarea = $('.sceditor');
            if(typeof textarea === 'undefined'){
                return false;
            }
            textarea.each(function(i, e){
                sceditor.create(e, {
                    plugins: 'plaintext',
                    format: 'xhtml',
                    emoticonsEnabled: false,
                    style: '/admin/modules/sceditor/minified/themes/default.min.css',
                    toolbar: 'bold,italic,underline|subscript,superscript|left,center,right,justify|link,unlink|removeformat,source'
                });
            });
        }
        
        // upload images
        if($('#images_upload').length > 0){
            $('#images_upload').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    success: function (res) {
                        if (res.success === true) {
                            $('#images_alert').show();
                            $('#images_alert').html('<div class="alert alert-success" role="alert">' + res.message + '</div>');
                        } else {
                            $('#images_alert').show();
                            $('#images_alert').html('<div class="alert alert-warning" role="alert">' + res.message + '</div>');
                        }
                        setTimeout(function () {
                            $('#images_alert').hide();
                            $('#images_alert').html('');
                        }, 10000);
                    }
                });
            });
        }
    });

})(jQuery); // End of use strict
