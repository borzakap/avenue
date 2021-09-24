<div id="all-files-upload-panel">
    <input type="hidden" id="residential_id" name="residential_id" value="<?= $residential_id ?>">
    <div class="form-row">
        <div class="form-group col-md-4">
            <?= form_label(lang('Admin.Form.Labels.ImageUpload'), 'image_file') ?>
            <?= form_upload(['name' => 'image_file', 'class' => 'form-control-file', 'id' => 'image_file', 'value' => '']) ?>
        </div>
        <div class="form-group col-md-4">
            <?= form_label(lang('Admin.Form.Labels.PlanType'), 'plan_type') ?>
            <?= form_dropdown(['name' => 'plan_type', 'class' => 'form-control', 'id' => 'plan_type', 'options' => $plans_type]) ?>
        </div>
        <div class="form-group col-md-4">
            <?= form_submit('plan_upload', lang('Admin.Form.Buttons.Upload'), ['class' => 'btn btn-primary mt-4', 'id' => 'upload-images-btn']) ?>
        </div>
    </div>
    <div class="" id="upload-messages"></div>
</div>