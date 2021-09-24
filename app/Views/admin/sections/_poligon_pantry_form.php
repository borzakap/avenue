<div id="poligon-panel">
    <input type="hidden" name="section_id" value="<?= $section_id ?>">
    <div class="form-row">
        <!-- layout image_2d --> 
        <div class="form-group col-md-12" id="layouts-poligon-container">
            <?= form_label(lang('Admin.Form.Labels.Poligon'), 'pantry_poligon') ?>
            <?= form_textarea(['name' => 'pantry_poligon', 'rows' => 3, 'class' => 'form-control canvas-area', 'data-image-url' => base_url('images/plans/'.$data->pantry_plan->image_name), 'id' => 'pantry_poligon', 'value' => old('pantry_poligon') ?? $data->pantry_poligon ?? '']) ?>
        </div>
    </div>
</div>