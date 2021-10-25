<div id="all-files-upload-panel">
    <input type="hidden" id="progress_id" name="progress_id" value="<?= $id ?>">
    <div class="form-row">
        <div class="form-group col">
            <?= form_label(lang('Admin.Form.Labels.ImageUpload'), 'image_file') ?>
            <?= form_upload(['name' => 'image_file', 'class' => 'form-control-file', 'id' => 'image_file', 'value' => '']) ?>
        </div>
        <div class="form-group col">
            <?= form_submit('plan_upload', lang('Admin.Form.Buttons.Upload'), ['class' => 'btn btn-primary mt-4', 'id' => 'upload-images-btn']) ?>
        </div>
    </div>
    <div class="" id="upload-messages"></div>
</div>