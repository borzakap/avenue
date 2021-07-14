<div id="poligon-panel">
    <input type="hidden" name="layout_id" value="<?= $layout_id ?>">
    <div class="form-row">
        <!-- layout image_2d --> 
        <div class="form-group col-md-4">
            <?= form_label(lang('Sections.Form.Labels.Image2D'), 'image_2d') ?>
            <?= form_upload(['name' => 'image_2d', 'class' => 'form-control-file', 'id' => 'image_2d', 'value' => '']) ?>
            <img src="http://farm8.staticflickr.com/7259/6956772778_2fa755a228.jpg" />
        </div>
        <!-- layout image_3d --> 
        <div class="form-group col-md-4">
            <?= form_label(lang('Sections.Form.Labels.Image3D'), 'image_3d') ?>
            <?= form_upload(['name' => 'image_3d', 'class' => 'form-control-file', 'id' => 'image_3d', 'value' => '']) ?>
            <img src="http://farm8.staticflickr.com/7259/6956772778_2fa755a228.jpg" />
        </div>
        <!-- layout file_to_upload --> 
        <div class="form-group col-md-4">
            <?= form_label(lang('Sections.Form.Labels.UploadFile'), 'file_to_upload') ?>
            <?= form_upload(['name' => 'file_to_upload', 'class' => 'form-control-file', 'id' => 'file_to_upload', 'value' => '']) ?>
            <img src="http://farm8.staticflickr.com/7259/6956772778_2fa755a228.jpg" />
        </div>
        <!-- layout residential -->
        <div class="form-group col-md-4">
            <?= form_label(lang('Layouts.Form.Labels.Residential'), 'residential_id') ?>
            <?= form_dropdown(['name' => 'residential_id', 'class' => 'form-control', 'id' => 'residential_id', 'options' => $residentials, 'selected' => old('residential_id') ?? $data->residential_id ?? 0]) ?>
        </div>

        <!-- layout section -->
        <div class="form-group col-md-4">
            <?= form_label(lang('Layouts.Form.Labels.Section'), 'section_id') ?>
            <?= chained_dropdown(['name' => 'section_id', 'class' => 'form-control', 'id' => 'section_id', 'options' => $sections, 'selected' => old('section_id') ?? $data->section_id ?? 0]) ?>
        </div>

        <!-- layout floor -->
        <div class="form-group col-md-4">
            <?= form_label(lang('Layouts.Form.Labels.Floors'), 'floor_images_id') ?>
            <?= chained_dropdown(['name' => 'floor_images_id', 'class' => 'form-control', 'id' => 'floor_images_id', 'options' => $floors, 'selected' => old('floor_images_id') ?? $data->floor_images_id ?? 0]) ?>
        </div>

        <div class="form-group col-md-12">
            <?= form_label(lang('Sections.Form.Labels.Poligon'), 'poligon') ?>
            <?= form_textarea(['name' => 'poligon', 'rows' => 3, 'class' => 'form-control canvas-area', 'data-image-url' => 'http://farm8.staticflickr.com/7259/6956772778_2fa755a228.jpg', 'id' => 'poligon', 'value' => old('poligon') ?? $data->poligon ?? '']) ?>
        </div>
    </div>
    <div class="mar10-tb" id="poligon-image"></div>
</div>