$(document).ready(function () {
    //load the floor images
    floorsLoad();
    // uload image
    $('#floors-upload').on('submit', function (e) {
        $('#floors-upload-btn').prop('disabled');
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
    
    // update floors
    $(document).on('submit', '.floors-update', function(e){
        e.preventDefault();
//        console.log(e.submitter);
//        $(this).closest('input[name=delete_img]').on('click', function(){
//            if(!confirm('delete this img?')){
//                return false;
//            }
//        });
        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            dataType: "json",
            success: function(res){
                console.log(res.message);
                floorsLoad();
            }
        });
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
                greed.id = image.id;
                greed.image_name = image.image_name;
                greed.image_code = image.image_code;
                var html = template.map(render(greed)).join('');
                container.append(html);
            });
        }
    });
}

// to render template
function render(props) {
    return function(tok, i) { return (i % 2) ? props[tok] : tok; };
}
