$(document).ready(function () {
    // save the poligon for leaving
    $('#section_poligon_leaving').on('submit', function (e) {
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
                    $('#leaving-poligon-alert').show();
                    $('#leaving-poligon-alert').html('<div class="alert alert-success" role="alert">' + res.message + '</div>');
                } else {
                    $('#leaving-poligon-alert').show();
                    $('#leaving-poligon-alert').html('<div class="alert alert-warning" role="alert">' + res.message + '</div>');
                }
                setTimeout(function () {
                    $('#leaving-poligon-alert').hide();
                    $('#leaving-poligon-alert').html('');
                }, 10000);
            }
        });
    });
    // save the poligon for commerce
    $('#section_poligon_commerce').on('submit', function (e) {
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
                    $('#commerce-poligon-alert').show();
                    $('#commerce-poligon-alert').html('<div class="alert alert-success" role="alert">' + res.message + '</div>');
                } else {
                    $('#commerce-poligon-alert').show();
                    $('#commerce-poligon-alert').html('<div class="alert alert-warning" role="alert">' + res.message + '</div>');
                }
                setTimeout(function () {
                    $('#commerce-poligon-alert').hide();
                    $('#commerce-poligon-alert').html('');
                }, 10000);
            }
        });
    });
    // save the poligon for pantry
    $('#section_poligon_pantry').on('submit', function (e) {
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
                    $('#pantry-poligon-alert').show();
                    $('#pantry-poligon-alert').html('<div class="alert alert-success" role="alert">' + res.message + '</div>');
                } else {
                    $('#pantry-poligon-alert').show();
                    $('#pantry-poligon-alert').html('<div class="alert alert-warning" role="alert">' + res.message + '</div>');
                }
                setTimeout(function () {
                    $('#pantry-poligon-alert').hide();
                    $('#pantry-poligon-alert').html('');
                }, 10000);
            }
        });
    });
});
