$(document).ready(function () {
    $('#floors-upload').on('submit', function (e) {
        $('#floors-upload-btn').prop('Disabled');
        e.preventDefault();
        if ($('#image_file').val() == '') {
            alert("Choose File");
            $('#floors-upload-btn').prop('enabled');
            document.getElementById("floors-upload").reset();
        } else {
            $.ajax({
                url: $(this).attr('action'),
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success: function (res) {
                    console.log(res);
                    if (res.success == true) {
                        $('#upload-messages').html(res.message);
                    } else if (res.success == false) {
                        $('#upload-messages').html(res.message);
                    }
                    setTimeout(function () {
                        $('#upload-messages').html('');
                    }, 4000);

                    $('#floors-upload-btn').prop('Enabled');
                    document.getElementById("floors-upload").reset();
                }
            });
        }
    });
});