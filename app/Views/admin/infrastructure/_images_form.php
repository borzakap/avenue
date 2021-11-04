<div id="poligon-panel">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="form-row">
        <!-- layout image_2d --> 
        <div class="form-group col-md-4">
            <?= form_label(lang('Admin.Form.Labels.Image'), 'image') ?>
            <?= form_upload(['name' => 'files[image]', 'class' => 'form-control-file', 'id' => 'image', 'value' => '']) ?>
            <?= img(['src' => 'images/infrastructure/'.$data->image, 'class' =>'img-fluid img-thumbnail']) ?>
        </div>
    </div>
</div>