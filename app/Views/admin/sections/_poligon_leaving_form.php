<div id="poligon-panel">
    <input type="hidden" name="section_id" value="<?= $section_id ?>">
    <div class="form-row">
        <!-- layout image_2d --> 
        <div class="form-group col-md-12" id="layouts-poligon-container">
            <?= form_label(lang('Admin.Form.Labels.Poligon'), 'leaving_poligon') ?>
            <?= form_textarea(['name' => 'leaving_poligon', 'rows' => 3, 'class' => 'form-control canvas-area', 'data-image-url' => base_url('images/plans/'.$data->leaving_plan->image_name), 'id' => 'leaving_poligon', 'value' => old('leaving_poligon') ?? $data->leaving_poligon ?? '']) ?>
        </div>
    </div>
</div>