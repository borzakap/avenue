$(document).ready(function () {
    //load the floor images
    floorsLoad();
    // uload image
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
                    floorsLoad();
                }
            });
        }
    });
});

function floorsLoad(){
    var container = $('#images-greed');
    var to_ajax = [];
    container.html('');
    to_ajax.push({name: 'section_id', value: container.data('section')});
    $.ajax({
        url: container.data('action'),
        method: 'POST',
        data: to_ajax,
        success: function(res){
            var greed = [];
            var template = $('script[data-template="images"]').text().split(/\$\{(.+?)\}/g);
            $.each(res, function(i, image){
                greed.floor_img = image.image_name;
                greed.floor_title = image.image_code;
                var html = template.map(render(greed)).join('');
                console.log(html);
                container.append(html);
            });
        }
    });
}

// to render template
function render(props) {
    return function(tok, i) { return (i % 2) ? props[tok] : tok; };
}
