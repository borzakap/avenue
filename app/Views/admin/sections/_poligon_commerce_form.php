<div id="poligon-panel">
    <input type="hidden" name="section_id" value="<?= $section_id ?>">
    <div class="form-row">
        <!-- layout image_2d --> 
        <div class="form-group col-md-12" id="layouts-poligon-container">
            <?= form_label(lang('Admin.Form.Labels.Poligon'), 'commerce_poligon') ?>
            <?= form_textarea(['name' => 'commerce_poligon', 'rows' => 3, 'class' => 'form-control canvas-area', 'data-image-url' => base_url('images/plans/'.$data->commerce_plan->image_name), 'id' => 'commerce_poligon', 'value' => old('commerce_poligon') ?? $data->commerce_poligon ?? '']) ?>
        </div>
    </div>
</div>