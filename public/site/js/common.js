$(document).ready(function () {
    'use strict';

    //===== Dropdown Anmiation =====// 
    var drop = $('nav > div ul ul li');
    $('nav > div ul ul').each(function () {
        var delay = 50;
        $(this).find(drop).each(function () {
            $(this).css({transitionDelay: delay + 'ms'});
            delay += 50;
        });
    });

    //===== Menu Active =====//
    var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
    $("nav ul li a").each(function () {
        if ($(this).attr("href") == pgurl || $(this).attr("href") == '')
            $(this).parent('li').addClass("active").parent().parent().addClass("active").parent().parent().addClass("active");
    });

    //===== Menu Active =====//
    var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
    $(".menu-wrap ul li a").each(function () {
        if ($(this).attr("href") == pgurl || $(this).attr("href") == '')
            $(this).parent('li').addClass("active").parent().parent().addClass("active-parent").parent().parent().addClass("active-parent");
    });

    //===== Side Menu =====//
    $('.rspn-mnu-btn').on('click', function () {
        $('.rsnp-mnu').addClass('slidein');
        return false;
    });
    $('.rspn-mnu-cls').on('click', function () {
        $('.rsnp-mnu').removeClass('slidein');
    });
    $('.rsnp-mnu li.menu-item-has-children > a').on('click', function () {
        $(this).parent().siblings('li').children('ul').slideUp();
        $(this).parent().siblings('li').removeClass('active');
        $(this).parent().children('ul').slideToggle();
        $(this).parent().toggleClass('active');
        return false;
    });

    //===== preparing the form =====//
    $('#contact-form-modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var formtype = button.data('type'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('#form-type').val(formtype);
    });

    //===== Accordions =====//
    if ($(".toggle").length > 0) {
        $(function () {
            $('#toggle .toggle-content').hide();
            $('#toggle h4:first').next().slideDown(500).parent().addClass("active");
            $('#toggle h4').on("click", function () {
                if ($(this).next().is(':hidden')) {
                    $('#toggle h4').next().slideUp(500).parent().removeClass("active");
                    $(this).next().slideDown(500).parent().toggleClass("active");
                }
            });
        });
    }

    //===== Sending Form =====//
    $('#contact-form').on('submit', function (e) {
        e.preventDefault();
        $('button[type="submit"]').attr('disabled', 'disabled');
        var form = $(this);
        var formData = new FormData(this);
        $.ajax({
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            url: form.attr('action'),
            type: "POST",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (data) {
                $('#contact-form .response').html(data.message);
                if (data.success === true) {
                    // send events
                    if (typeof gtag !== "undefined") { 
                        gtag('event', 'send_form', { 'event_category': 'form', 'event_action': 'send', 'event_label': $('input[name=type]', form).val()});
                    }
                    if (typeof fbq !== "undefined") { 
                        fbq('track','Lead');
                    }
                    // clean inputs
                    $(':input', form).not(':button, :submit, :reset, :hidden').val('');
                    setTimeout(function () {
                        $('#contact-form .response').html('');
                        $('#contact-form-modal').modal('hide');
                    }, 10000);
                }
                $('button[type="submit"]').removeAttr('disabled');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error at add data');
            }
        });
    });

});

//===== Sticky Header =====//
$(window).on('scroll', function () {
    'use strict';

    var menu_height = $('header').innerHeight();
    var scroll = $(window).scrollTop();
    if (scroll >= menu_height) {
        $('body').addClass('sticky');
    } else {
        $('body').removeClass('sticky');
    }

});//===== Window onScroll Ends =====//