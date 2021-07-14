$(document).ready(function () {
    // cained selects
    $("#section_id").chained("#residential_id");
    $("#floor_images_id").chained("#section_id");

    $('#poligon_save').on('submit', function (e) {
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
                if (res.success == true) {
                    console.log(res.data);
//                $('#upload-messages').html(res.message);
                } else if (res.success == false) {
//                $('#upload-messages').html(res.message);
                }

                $('#floors-upload-btn').prop('Enabled');
            }
        });

    });


});

