/*
 filedrag.js - HTML5 File Drag & Drop demonstration
 Featured on SitePoint.com
 Developed by Craig Buckler (@craigbuckler) of OptimalWorks.net
 */
$(document).ready(function () {
    // getElementById
    function $id(id) {
        return document.getElementById(id);
    }

    // output information
    function Output(msg) {
        var m = $id("upload_messages");
        m.innerHTML = msg + m.innerHTML;
    }

    // file drag hover
    function FileDragHover(e) {
        e.stopPropagation();
        e.preventDefault();
        e.target.className = (e.type == "dragover" ? "hover" : "");
    }

    // file selection
    function FileSelectHandler(e) {

        // cancel event and hover styling
        FileDragHover(e);

        // fetch FileList object
        var files = e.target.files || e.dataTransfer.files;

        // РЎС‡С‘С‚С‡РёРє Р°СЃРёРЅС…СЂРѕРЅРЅС‹С… Р·Р°РїСЂРѕСЃРѕРІ. Р”Р»СЏ РїРµСЂРµРґР°С‡Рё РїРѕ СЃСЃС‹Р»РєРµ вЂ” РѕР±СЉРµРєС‚.
        var counter = {
            value: 0
        },
                count = files.length;

        // process all File objects
        for (var i = 0, f; f = files[i]; i++) {
            if (f.size > $id("upload_max_file_size").value) {
                Output("<p class='failure'>Large file - " + f.name + " (" + f.size + " byte)</p>");
                continue;
            }

            var ext = '|' + f.name.substr(f.name.lastIndexOf(".") + 1) + '|';
            var upload_ext = '|' + $id("upload_ext").value + '|';

            if (upload_ext.indexOf(ext.toLowerCase()) == -1) {
                Output("<p class='failure'>Forbidden type file - " + f.name + " (" + f.type + ")</p>");
                continue;
            }

            // ParseFile(f);
            UploadFile(f, counter, count);
        }
    }

    // output file information
    function ParseFile(file) {
        Output(
                "<p>File information: <strong>" + file.name +
                "</strong> type: <strong>" + file.type +
                "</strong> size: <strong>" + file.size +
                "</strong> bytes</p>"
                );

        return;
    }

    // upload files
    function UploadFile(file, counter, count) {
        // following line is not necessary: prevents running on SitePoint servers
        if (location.host.indexOf("sitepointstatic") >= 0)
            return

        var xhr = new XMLHttpRequest();

        if (xhr.upload && (file.size > $id("upload_max_file_size").value)) {
            return;
        }

        var ext = '|' + file.name.substr(file.name.lastIndexOf(".") + 1) + '|';
        var upload_ext = '|' + $id("upload_ext").value + '|';

        if (xhr.upload && (upload_ext.indexOf(ext.toLowerCase()) > -1)) {

            //// create progress bar
            var o = $id("upload_progress");
            var progress = o.appendChild(document.createElement("p"));
            progress.appendChild(document.createTextNode("Preparing... " + file.name));


            // progress bar
            xhr.upload.addEventListener("progress", function (e) {
                // var pc = parseInt(100 - (e.loaded / e.total * 100));
                // progress.style.backgroundPosition = pc + "% 0";

                progress.innerHTML = "Uploading " + parseInt(e.loaded / e.total * 100) + "% ... please wait...";
            }, false);

            // file received/failed
            xhr.onreadystatechange = function (e) {
                if (xhr.readyState == 4) {
                    progress.className = (xhr.status == 200 ? "success item-" + counter.value : "failure item-" + counter.value);

                    // Output('<p>' + xhr.responseText + '</p>');
                    $("#upload_progress p.item-" + counter.value).fadeOut(9000);

                    counter.value++;
                    //Р РІРѕС‚ РєРѕРіРґР° Р·Р°РєРѕРЅС‡РµРЅ РїРѕСЃР»РµРґРЅРёР№ Р°СЃРёРЅС…СЂРѕРЅРЅС‹Р№ Р·Р°РїСЂРѕСЃ, Р·Р°РїСѓСЃРєР°РµРј РѕР±РЅРѕРІР»РµРЅРёРµ.
                    if (counter.value == count) {
                        $.post(
                                $id("update_path").value,
                                {
                                    dir: "_pages/" + $id("page_id").value
                                },
                                function (data)
                                {
                                    $("#all-files-result").html(data);
                                    lbox();
                                    localStorage.clear();

                                }
                        );
                    }
                }

                if (xhr.readyState == 3) {
                    progress.innerHTML = xhr.responseText;
                }

            };

            // start upload
            xhr.open("POST", $id("upload_action").value, true);

            xhr.setRequestHeader("X-REQUESTED-FILENAME", unescape(encodeURIComponent(file.name)));

            xhr.setRequestHeader("X-REQUESTED-FILEUPDIR", unescape(encodeURIComponent($id("page_id").value)));

            xhr.setRequestHeader("X-REQUESTED-FILETITLE", unescape(encodeURIComponent($id("image_title").value)));

            xhr.send(file);
        }
    }

    // initialize
    function Init() {

        var fileselect = $id("upload_fileselect"),
                filedrag = $id("upload_filedrag"),
                submitbutton = $id("upload_submitbutton");

        // file select
        fileselect.addEventListener("change", FileSelectHandler, false);

        // is XHR2 available?
        var xhr = new XMLHttpRequest();
        if (xhr.upload) {

            // file drop
            filedrag.addEventListener("dragover", FileDragHover, false);
            filedrag.addEventListener("dragleave", FileDragHover, false);
            filedrag.addEventListener("drop", FileSelectHandler, false);
            filedrag.style.display = "block";

            // remove submit button
            submitbutton.style.display = "none";
        }
    }

    // call initialization file
    if (window.File && window.FileList && window.FileReader) {
        Init();
    }

});