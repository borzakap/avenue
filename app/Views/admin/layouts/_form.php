<div class="form-row">
    <!-- layout title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_language == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Title', ['language' => $language]), 'title_' . $language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][title]', 'class' => 'form-control', 'id' => 'title_' . $language, 'value' => old('translation.' . $language . '.title') ?? $data->translations[$language]['title'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- layout description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_language == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Description', ['language' => $language]), 'description_' . $language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][description]', 'class' => 'form-control sceditor', 'id' => 'description_' . $language, 'value' => old('translation.' . $language . '.description') ?? $data->translations[$language]['description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- layout meta_title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_language == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.MetaTitle', ['language' => $language]), 'meta_title_' . $language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][meta_title]', 'class' => 'form-control', 'id' => 'meta_title_' . $language, 'value' => old('translation.' . $language . '.meta_title') ?? $data->translations[$language]['meta_title'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- layout meta_description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_language == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Metadescription', ['language' => $language]), 'meta_description_' . $language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][meta_description]', 'class' => 'form-control', 'id' => 'meta_description_' . $language, 'value' => old('translation.' . $language . '.meta_description') ?? $data->translations[$language]['meta_description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- layout slug -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.Slug'), 'slug') ?>
        <?= form_input(['name' => 'slug', 'class' => 'form-control', 'id' => 'slug', 'value' => old('slug') ?? $data->slug ?? '']) ?>
    </div>

    <!-- layout code -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.Code'), 'code') ?>
        <?= form_input(['name' => 'code', 'class' => 'form-control', 'id' => 'code', 'value' => old('code') ?? $data->code ?? '']) ?>
    </div>

    <!-- layout price -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.Price'), 'price') ?>
        <?= form_input(['name' => 'price', 'type' => 'number', 'step' => '0.01', 'class' => 'form-control', 'id' => 'price', 'value' => old('price') ?? $data->price ?? '']) ?>
    </div>

    <!-- layout ceil height -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.CeilHeight'), 'ceil_height') ?>
        <?= form_input(['name' => 'ceil_height', 'type' => 'number', 'step' => '0.01', 'class' => 'form-control', 'id' => 'ceil_height', 'value' => old('ceil_height') ?? $data->ceil_height ?? '']) ?>
    </div>

    <!-- layout rooms -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.Rooms'), 'rooms') ?>
        <?= form_input(['name' => 'rooms', 'type' => 'number', 'step' => '1', 'class' => 'form-control', 'id' => 'rooms', 'value' => old('rooms') ?? $data->rooms ?? '']) ?>
    </div>

    <!-- layout levels -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.Levels'), 'levels') ?>
        <?= form_input(['name' => 'levels', 'type' => 'number', 'step' => '1', 'class' => 'form-control', 'id' => 'levels', 'value' => old('levels') ?? $data->levels ?? '']) ?>
    </div>

    <!-- layout all_area -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.AllArea'), 'all_area') ?>
        <?= form_input(['name' => 'all_area', 'type' => 'number', 'step' => '0.01', 'class' => 'form-control', 'id' => 'all_area', 'value' => old('all_area') ?? $data->all_area ?? '']) ?>
    </div>

    <!-- layout live_area -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.LiveArea'), 'live_area') ?>
        <?= form_input(['name' => 'live_area', 'type' => 'number', 'step' => '0.01', 'class' => 'form-control', 'id' => 'live_area', 'value' => old('live_area') ?? $data->live_area ?? '']) ?>
    </div>

    <!-- layout kit_area -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.KitArea'), 'kit_area') ?>
        <?= form_input(['name' => 'kit_area', 'type' => 'number', 'step' => '0.01', 'class' => 'form-control', 'id' => 'kit_area', 'value' => old('kit_area') ?? $data->kit_area ?? '']) ?>
    </div>
    <!-- layout residential -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.Residential'), 'residential_id') ?>
        <?= form_dropdown(['name' => 'residential_id', 'class' => 'form-control', 'id' => 'residential_id', 'options' => $residentials, 'selected' => old('residential_id') ?? $data->residential_id ?? 0]) ?>
    </div>

    <!-- layout section -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.Section'), 'section_id') ?>
        <?= chained_dropdown(['name' => 'section_id', 'class' => 'form-control', 'id' => 'section_id', 'options' => $sections, 'selected' => old('section_id') ?? $data->section_id ?? 0]) ?>
    </div>

    <!-- layout floor -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.Floors'), 'floor_images_id') ?>
        <?= chained_dropdown(['name' => 'floor_images_id', 'class' => 'form-control', 'id' => 'floor_images_id', 'options' => $floors, 'data-change-url' => route_to('floors-image-change-url'), 'selected' => old('floor_images_id') ?? $data->floor_images_id ?? 0]) ?>
    </div>

    <!-- layout balcon -->
    <div class="form-group col-md-3">
        <div class="form-check">
            <?= form_checkbox(['name' => 'balcon', 'class' => 'form-check-input', 'id' => 'balcon', 'value' => 'balcon', 'checked' => old('balcon') ?? $data->balcon ?? false]) ?>
            <?= form_label(lang('Admin.Form.Labels.Balcon'), 'balcon') ?>
        </div>
    </div>

    <!-- layout advertise -->
    <div class="form-group col-md-3">
        <div class="form-check">
            <?= form_checkbox(['name' => 'advertise', 'class' => 'form-check-input', 'id' => 'advertise', 'value' => 'advertise', 'checked' => old('advertise') ?? $data->advertise ?? false]) ?>
            <?= form_label(lang('Admin.Form.Labels.Advertise'), 'advertise') ?>
        </div>
    </div>

    <!-- layout sold_out -->
    <div class="form-group col-md-3">
        <div class="form-check">
            <?= form_checkbox(['name' => 'sold_out', 'class' => 'form-check-input', 'id' => 'sold_out', 'value' => 'sold_out', 'checked' => old('sold_out') ?? $data->sold_out ?? false]) ?>
            <?= form_label(lang('Admin.Form.Labels.SoldOut'), 'sold_out') ?>
        </div>
    </div>

    <!-- layout publish -->
    <div class="form-group col-md-3">
        <div class="form-check">
            <?= form_checkbox(['name' => 'publish', 'class' => 'form-check-input', 'id' => 'publish', 'value' => 'publish', 'checked' => old('publish') ?? $data->publish ?? false]) ?>
            <?= form_label(lang('Admin.Form.Labels.Publish'), 'publish') ?>
        </div>
    </div>

</div>
