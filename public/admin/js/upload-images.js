$(document).ready(function () {
    var form = $('#upload-images');
    var message = $('#upload-messages');
    var btn = $('#floors-upload-btn');
    //load the floor images
    imagesLoad();
    // uload image
    form.on('submit', function (e) {
        btn.prop('disabled');
        e.preventDefault();
        if ($('#image_file').val() === '') {
            alert("Choose File");
            btn.prop('enabled');
        } else {
            $.ajax({
                url: form.attr('action'),
                method: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success: function (res) {
                    console.log(res);
                    if (res.success === true) {
                        message.html(res.message);
                    } else if (res.success === false) {
                        message.html(res.message);
                    }
                    setTimeout(function () {
                        message.html('');
                    }, 4000);

                    btn.prop('Enabled');
                    form[0].reset();
                    imagesLoad();
                }
            });
        }
    });
    
    // update floors
    $(document).on('submit', '.update-image', function(e){
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            success: function(res){
                imagesLoad();
            }
        });
    });
});

function imagesLoad(){
    var container = $('#images-greed');
    var to_ajax = [];
    container.html('');
    to_ajax.push({name: 'id', value: container.data('id')});
    $.ajax({
        url: container.data('action'),
        method: 'POST',
        data: to_ajax,
        success: function(res){
            console.log(res);
            var template = $('script[data-template="images"]').text().split(/\$\{(.+?)\}/g);
            $.each(res, function(i, image){
                var html = template.map(render(image)).join('');
                container.append(html);
            });
        }
    });
}

// to render template
function render(props) {
    return function(tok, i) { return (i % 2) ? props[tok] : tok; };
}
