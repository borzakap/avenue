<div id="all-files-upload-panel">
    <input type="hidden" id="upload_max_file_size" name="upload_max_file_size" value="20000000">
    <input type="hidden" id="upload_action" name="upload_action" value="<?= route_to('floors-upload') ?>">
    <input type="hidden" id="upload_ext" name="upload_ext" value="jpg|jpeg|png|webp">
    <input type="hidden" id="upload_dir" name="upload_dir" value="/home/ocuifkkp/public_html/uploads/_pages/772">
    <input type="hidden" id="update_path" name="update_path" value="//tarasovsky-bucha.info/ajax/YWRtaW4vcGx1Z2lucy9hZG1pbl9wYWdlL2FsbC1maWxlcy11cGRhdGUtYWpheC5waHA=">
    <input type="hidden" id="page_id" name="page_id" value="772">
    <div class="form-row">
        <div class="form-group col-md-12">
            <div id="upload_filedrag" style="display: block;"><?= lang('Sections.Form.Labels.DragFile') ?></div>
            <input class="form-control-file" type="file" id="upload_fileselect" name="upload_fileselect[]" multiple="multiple">
        </div>
        <div class="form-group col-md-12">
            <?= form_label(lang('Sections.Form.Labels.ImageTitle'), 'image_title') ?>
            <?= form_input(['name' => 'image_title', 'type' => 'text', 'class' => 'form-control', 'id' => 'image_title', 'value' => '']) ?>
        </div>
    </div>

    <div id="upload_submitbutton" style="display: none;"><button type="button">Upload Files</button></div>
    <div class="mar10-tb" id="upload_progress"></div>
    <div class="mar10-tb" id="upload_messages"></div>
</div>