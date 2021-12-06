<div id="poligon-panel">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="form-row">
        <div class="form-group col-md-4">
            <?= form_label(lang('Admin.Form.Labels.Image'), 'image') ?>
            <?= form_upload(['name' => 'files[image]', 'class' => 'form-control-file', 'id' => 'image', 'value' => '']) ?>
            <?php if($data->image) : ?>
            <?= img(['src' => 'images/discounts/'.$data->image, 'class' =>'img-fluid img-thumbnail']) ?>
            <?php endif; ?>
        </div>
        <div class="form-group col-md-4">
            <?= form_label(lang('Admin.Form.Labels.Image'), 'rules') ?>
            <?= form_upload(['name' => 'files[rules]', 'class' => 'form-control-file', 'id' => 'rules', 'value' => '']) ?>
            <?= img(['src' => 'images/discounts/'.$data->rules, 'class' =>'img-fluid img-thumbnail']) ?>
        </div>
    </div>
</div>