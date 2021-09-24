$(document).ready(function () {
    $('.sections-schema polygon').on('click', function () {
        var datasend = new FormData();
        datasend.set('slug', $(this).data('slug'));
        $.ajax({
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            url: $(this).data('action'),
            type: "POST",
            cache: false,
            data: datasend,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (data) {
//                console.log(data);
                $('#layout-modal-body').html(data.html);
                // Display Modal
                $('#layout-modal').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    });
});