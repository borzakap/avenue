<div id="all-files-upload-panel">
    <input type="hidden" id="layout_id" name="layout_id" value="<?= $id ?>">
    <div class="form-row">
        <div class="form-group col-md-12" id="poligon-container">
            <?= form_label(lang('Sections.Form.Labels.Poligon'), 'poligon') ?>
            <?= form_textarea(['name' => 'poligon', 'rows' => 3, 'class' => 'form-control canvas-area', 'data-image-url' => base_url('images/sections/'.$data->floor_image->image_name), 'id' => 'poligon', 'value' => old('poligon') ?? $data->poligon ?? '']) ?>
        </div>
    </div>
    <div class="" id="upload-messages"></div>
</div>