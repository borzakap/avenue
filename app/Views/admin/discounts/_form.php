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

    <!-- item slogan -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_language == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Slogan', ['language' => $language]), 'slogan_' . $language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][slogan]', 'class' => 'form-control', 'id' => 'slogan_' . $language, 'value' => old('translation.' . $language . '.slogan') ?? $data->translations[$language]['slogan'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- item slogan -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_language == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Info', ['language' => $language]), 'info_' . $language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][info]', 'class' => 'form-control', 'id' => 'info_' . $language, 'value' => old('translation.' . $language . '.info') ?? $data->translations[$language]['info'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- item slug -->
    <div class="form-group col-md-12">
        <?= form_label(lang('Admin.Form.Labels.Slug'), 'slug') ?>
        <?= form_input(['name' => 'slug', 'class' => 'form-control', 'id' => 'slug', 'value' => old('slug') ?? $data->slug ?? '']) ?>
    </div>
    
    <!-- date_from -->
    <div class="form-group col-md-6 jquery-datepicker">
        <?= form_label(lang('Admin.Form.Labels.DiscountStart'), 'date_from') ?>
        <?= form_input(['name' => 'meta[date_from]', 'class' => 'jquery-datepicker__input form-control', 'id' => 'date_from', 'value' => old('meta.date_from') ?? $data->date_from ?? '']) ?>
    </div>

    <!-- date_to -->
    <div class="form-group col-md-6 jquery-datepicker">
        <?= form_label(lang('Admin.Form.Labels.DiscountStop'), 'date_to') ?>
        <?= form_input(['name' => 'meta[date_to]', 'class' => 'jquery-datepicker__input form-control', 'id' => 'date_to', 'value' => old('meta.date_to') ?? $data->date_to ?? '']) ?>
    </div>

    <!-- residential -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.Residential'), 'residential_id') ?>
        <?= form_dropdown(['name' => 'residential_id', 'class' => 'form-control', 'id' => 'residential_id', 'options' => $residentials, 'selected' => old('residential_id') ?? $data->residential_id ?? 0]) ?>
    </div>

    <!-- value types -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.ValueTypes'), 'value_type') ?>
        <?= form_dropdown(['name' => 'meta[value_type]', 'class' => 'form-control', 'id' => 'value_type', 'options' => $value_types, 'selected' => old('meta.value_type') ?? $data->value_type ?? 'empty']) ?>
    </div>

    <!-- value -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Admin.Form.Labels.Value'), 'value') ?>
        <?= form_input(['name' => 'meta[value]', 'type'=> 'number', 'step' => 'any', 'class' => 'form-control', 'id' => 'value', 'value' => old('meta.value') ?? $data->value ?? '']) ?>
    </div>
    
    <!-- item publish -->
    <div class="form-group col-md-4">
        <div class="form-check">
            <?= form_checkbox(['name' => 'publish', 'class' => 'form-check-input', 'id' => 'publish', 'value' => 'publish', 'checked' => old('publish') ?? $data->publish ?? false]) ?>
            <?= form_label(lang('Admin.Form.Labels.Publish'), 'publish') ?>
        </div>
    </div>

</div>
