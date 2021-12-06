$(document).ready(function () {
    // cained selects
    $("#plans_images_id").chained("#residential_id");
    $("#section_id").chained("#residential_id");
    $("#floor_images_id").chained("#section_id");

    // upload floor image on change select
    $("#floor_images_id").on('change', function () {
        var ajaxUrl = $(this).data('change-url');
        if (!$(this).val()) {
            $('#poligon-save-btn').attr("disabled", true);
        }
        var data = new FormData();
        data.set('floor_images_id', $(this).val());
        $.ajax({
            url: ajaxUrl,
            method: "POST",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            success: function (res) {
                if (res.success) {
                    // set url image
//                    $('#poligon').attr('data-image-url', res.image);
//                    $('#polygon').unbind().removeData();
                    $('#polygon').html($('#polygon').html());
                    $('#polygon').canvasAreaDraw({
                        imageUrl: res.image
                    });
                } else {

                }
            }
        });
    });

    // save section poligon
    $('#poligon_section').on('submit', function (e) {
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
                    $('#section_alert').show();
                    $('#section_alert').html('<div class="alert alert-success" role="alert">' + res.message + '</div>');
                } else {
                    $('#section_alert').show();
                    $('#section_alert').html('<div class="alert alert-warning" role="alert">' + res.message + '</div>');
                }
                setTimeout(function () {
                    $('#section_alert').hide();
                    $('#section_alert').html('');
                }, 10000);
            }
        });
    });
    // save plan poligon
    $('#poligon_plan').on('submit', function (e) {
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
                    $('#plan_alert').show();
                    $('#plan_alert').html('<div class="alert alert-success" role="alert">' + res.message + '</div>');
                } else {
                    $('#plan_alert').show();
                    $('#plan_alert').html('<div class="alert alert-warning" role="alert">' + res.message + '</div>');
                }
                setTimeout(function () {
                    $('#plan_alert').hide();
                    $('#plan_alert').html('');
                }, 10000);
            }
        });
    });
});

