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

    //====== set tab default show if exist ======//
    if ($('.nav-pills').length > 0) {
        $('.nav-pills').each(function () {
            $('.nav-pills li:first-child a').tab('show');
        });
    }

    //===== Select =====//
    if ($('.slc-wrp > select').length > 0) {
        $('.slc-wrp > select').selectpicker();
    }
    
    $(document).on('click','.page-link', function(e){
        e.preventDefault();
    });
    
    // === filtering ====//
    $(document).on('change, click', '.filter-field, .page-link', function (e) {
        var rooms = $('input[name=rooms]:checked').map(function () {
            return this.value;
        }).get();
        var floors = $('input[name=floors]:checked').map(function () {
            return this.value;
        }).get();
        var sections = $('input[name=sections]:checked').map(function () {
            return this.value;
        }).get();
        var order = $('.ordering').find(':selected').val();
        
        var page = 0;

        if($(this).attr('href')){
            page = getUrlParameter('page_layouts',new URL($(this).attr('href')).search.substring(1));
        }
        
        var ps = {
            rooms: rooms,
            floors: floors,
            sections: sections,
            order: order,
            page_layouts: page[0]
        };
        var qs = $.param(ps);
        window.history.replaceState( {} , '', document.forms.filter_send.action + (qs !== '' ? '?' : '') + decodeURIComponent(qs) );
        var form_data = new FormData();
        appendFormdata(form_data, ps);

        $.ajax({
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            url: $('#filter_send').attr('action'),
            type: "POST",
            cache: false,
            data: form_data,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (data) {
                $('#layouts_filtered').html(data.html);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    });
    
    
    // ====== set chacked  ====== //
    if ($('.filter-field').length > 0) {
        var rooms = getUrlParameter('rooms');
        var floors = getUrlParameter('floors');
        var sections = getUrlParameter('sections');
        var order = getUrlParameter('order');
        console.log(rooms);
        $.each(rooms, function (i, v) {
            $('.filter-inner input[name=rooms][value=' + v + ']').prop('checked', true);
        });
        $.each(floors, function (i, v) {
            $('.filter-inner input[name=floors][value=' + v + ']').prop('checked', true);
        });
        $.each(sections, function (i, v) {
            $('.filter-inner input[name=sections][value=' + v + ']').prop('checked', true);
        });
        $('.ordering').val(order);
//        $('.ordering').val(order).change();
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
                        gtag('event', 'send_form', {'event_category': 'form', 'event_action': 'send', 'event_label': $('input[name=type]', form).val()});
                    }
                    if (typeof fbq !== "undefined") {
                        fbq('track', 'Lead');
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

});

// ==== Functions =====//
function replaceQueryParam(param, newval, search) {
    var regex = new RegExp("([?;&])" + param + "[^&;]*[;&]?");
    var query = search.replace(regex, "$1").replace(/&$/, '');

    return (query.length > 2 ? query + "&" : "?") + (newval ? param + "=" + newval : '');
}

var getUrlParameter = function getUrlParameter(sParam, sPageURL = window.location.search.substring(1)) {
    sPageURL = decodeURI(sPageURL);
    console.log(sPageURL);
    var sURLVariables = sPageURL.split('&'),
            sParameterName,
            valReturn = [],
            i;
    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');
//        console.log(sParameterName[0].replace(/\[.*?\]/g, ''));
        if (sParameterName[0].replace(/\[.*?\]/g, '') === sParam) {
            if (sParameterName[1] !== undefined) {
                valReturn.push(decodeURIComponent(sParameterName[1]));
            }
        }
    }
    return valReturn;
};

function appendFormdata(FormData, data, name){
    name = name || '';
    if (typeof data === 'object'){
        $.each(data, function(index, value){
            if (name == ''){
                appendFormdata(FormData, value, index);
            } else {
                appendFormdata(FormData, value, name + '['+index+']');
            }
        })
    } else {
        FormData.append(name, data);
    }
}    
