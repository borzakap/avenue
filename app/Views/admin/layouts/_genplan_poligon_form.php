<div id="all-files-upload-panel">
    <input type="hidden" id="section_id" name="layout_id" value="<?= $id ?>">
    <div class="form-row">
        <div class="form-group col-md-12" id="poligon-container">
            <?= form_label(lang('Sections.Form.Labels.Poligon'), 'plan_poligon') ?>
            <?= form_textarea(['name' => 'plan_poligon', 'rows' => 3, 'class' => 'form-control canvas-area', 'data-image-url' => base_url('images/plans/'.$data->plan_image->image_name), 'id' => 'plan_poligon', 'value' => old('plan_poligon') ?? $data->plan_poligon ?? '']) ?>
        </div>
    </div>
    <div class="" id="upload-messages"></div>
</div>