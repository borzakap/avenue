<div class="form-row">
    <!-- item title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_language == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Title', ['language' => $language]), 'title_' . $language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][title]', 'class' => 'form-control', 'id' => 'title_' . $language, 'value' => old('translation.' . $language . '.title') ?? $data->translations[$language]['title'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- item description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_language == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Description', ['language' => $language]), 'description_' . $language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][description]', 'class' => 'form-control sceditor', 'id' => 'description_' . $language, 'value' => old('translation.' . $language . '.description') ?? $data->translations[$language]['description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- item meta_title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_language == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.MetaTitle', ['language' => $language]), 'meta_title_' . $language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][meta_title]', 'class' => 'form-control', 'id' => 'meta_title_' . $language, 'value' => old('translation.' . $language . '.meta_title') ?? $data->translations[$language]['meta_title'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- item meta_description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_language == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Metadescription', ['language' => $language]), 'meta_description_' . $language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][meta_description]', 'class' => 'form-control', 'id' => 'meta_description_' . $language, 'value' => old('translation.' . $language . '.meta_description') ?? $data->translations[$language]['meta_description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- item slug -->
    <div class="form-group col-md-12">
        <?= form_label(lang('Admin.Form.Labels.Slug'), 'slug') ?>
        <?= form_input(['name' => 'slug', 'class' => 'form-control', 'id' => 'slug', 'value' => old('slug') ?? $data->slug ?? '']) ?>
    </div>
    
    <!-- item latitude -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.Latitude'), 'latitude') ?>
        <?= form_input(['name' => 'latitude', 'type'=> 'number', 'step' => 'any', 'class' => 'form-control', 'id' => 'latitude', 'value' => old('latitude') ?? $data->latitude ?? '']) ?>
    </div>
    
    <!-- item longitude -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.Longitude'), 'longitude') ?>
        <?= form_input(['name' => 'longitude', 'type'=> 'number', 'step' => 'any', 'class' => 'form-control', 'id' => 'longitude', 'value' => old('longitude') ?? $data->longitude ?? '']) ?>
    </div>

    <!-- item distance -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.Distance'), 'distance') ?>
        <?= form_input(['name' => 'distance', 'type' => 'number', 'step' => '1', 'class' => 'form-control', 'id' => 'distance', 'value' => old('distance') ?? $data->distance ?? 0]) ?>
    </div>

    <!-- residential -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.Residential'), 'residential_id') ?>
        <?= form_dropdown(['name' => 'residential_id', 'class' => 'form-control', 'id' => 'residential_id', 'options' => $residentials, 'selected' => old('residential_id') ?? $data->residential_id ?? 0]) ?>
    </div>

    <!-- item type -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.InfrastructureType'), 'type') ?>
        <?= form_dropdown(['name' => 'type', 'class' => 'form-control', 'id' => 'type', 'options' => $types, 'selected' => old('type') ?? $data->type ?? 'empty']) ?>
    </div>

    <!-- item publish -->
    <div class="form-group col-md-4">
        <div class="form-check">
            <?= form_checkbox(['name' => 'publish', 'class' => 'form-check-input', 'id' => 'publish', 'value' => 'publish', 'checked' => old('publish') ?? $data->publish ?? false]) ?>
            <?= form_label(lang('Admin.Form.Labels.Publish'), 'publish') ?>
        </div>
    </div>

</div>
