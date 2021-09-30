<div id="poligon-panel">
    <input type="hidden" name="commerce_id" value="<?= $id ?>">
    <div class="form-row">
        <!-- layout image_2d --> 
        <div class="form-group col-md-4">
            <?= form_label(lang('Admin.Form.Labels.Image2D'), 'image_2d') ?>
            <?= form_upload(['name' => 'files[image_2d]', 'class' => 'form-control-file', 'id' => 'image_2d', 'value' => '']) ?>
            <?= img(['src' => 'images/layouts/'.$data->image_2d, 'class' =>'img-fluid img-thumbnail']) ?>
        </div>
        <!-- layout image_3d --> 
        <div class="form-group col-md-4">
            <?= form_label(lang('Admin.Form.Labels.Image3D'), 'image_3d') ?>
            <?= form_upload(['name' => 'files[image_3d]', 'class' => 'form-control-file', 'id' => 'image_3d', 'value' => '']) ?>
            <?= img(['src' => 'images/layouts/'.$data->image_3d, 'class' =>'img-fluid img-thumbnail']) ?>
        </div>
        <!-- layout file_to_upload --> 
        <div class="form-group col-md-4">
            <?= form_label(lang('Admin.Form.Labels.UploadFile'), 'file_to_upload') ?>
            <?= form_upload(['name' => 'files[file_to_upload]', 'class' => 'form-control-file', 'id' => 'file_to_upload', 'value' => '']) ?>
            <?= img(['src' => 'images/layouts/'.$data->file_to_upload, 'class' =>'img-fluid img-thumbnail']) ?>
        </div>
    </div>
</div>