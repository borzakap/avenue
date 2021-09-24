<div id="all-files-upload-panel">
    <input type="hidden" id="section_id" name="section_id" value="<?= $section_id ?>">
    <div class="form-row">
        <div class="form-group col-md-4">
            <?= form_label(lang('Admin.Form.Labels.ImageUpload'), 'image_file') ?>
            <?= form_upload(['name' => 'image_file', 'class' => 'form-control-file', 'id' => 'image_file', 'value' => '']) ?>
        </div>
        <div class="form-group col-md-4">
            <?= form_label(lang('Admin.Form.Labels.ImageTitle'), 'image_code') ?>
            <?= form_input(['name' => 'image_code', 'type' => 'text', 'class' => 'form-control', 'id' => 'image_code', 'value' => '']) ?>
        </div>
        <div class="form-group col-md-4">
            <?= form_label(lang('Admin.Form.Labels.FloorType'), 'floor_type') ?>
            <?= form_dropdown(['name' => 'floor_type', 'class' => 'form-control', 'id' => 'floor_type', 'options' => $floor_types]) ?>
        </div>
    </div>
    <div class="" id="upload-messages"></div>
</div>