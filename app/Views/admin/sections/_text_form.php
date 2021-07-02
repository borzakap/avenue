<div class="form-row">
    <!-- section code -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Sections.Form.Labels.SectionCode'), 'section_code') ?>
        <?= form_input(['name' => 'section_code', 'class' => 'form-control', 'id' => 'section_code', 'placeholder' => lang('Sections.Form.Plaseholders.SectionCode'), 'value' => old('section_code') ?? $data->section_code ?? '']) ?>
    </div>

    <!-- section residential -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Sections.Form.Labels.Residential'), 'residential_id') ?>
        <?= form_dropdown(['name' => 'residential_id', 'class' => 'form-control', 'id' => 'residential_id', 'options' => $residentials, 'selected' => old('residential_id') ?? $data->residential_id ?? 0]) ?>
    </div>

    <!-- section build start -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Sections.Form.Labels.BuildStart'), 'section_build_start') ?>
        <?= form_input(['name' => 'section_build_start', 'class' => 'form-control', 'id' => 'section_build_start', 'placeholder' => lang('Sections.Form.Plaseholders.BuildStart'), 'value' => old('section_build_start') ?? $data->section_build_start ?? '']) ?>
    </div>

    <!-- section build end -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Sections.Form.Labels.BuildEnd'), 'section_build_end') ?>
        <?= form_input(['name' => 'section_build_end', 'class' => 'form-control', 'id' => 'section_build_end', 'placeholder' => lang('Sections.Form.Plaseholders.BuildEnd'), 'value' => old('section_build_end') ?? $data->section_build_end ?? '']) ?>
    </div>

    <!-- section ceil height -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Sections.Form.Labels.CeilHeight'), 'ceil_height') ?>
        <?= form_input(['name' => 'ceil_height', 'type' => 'number', 'step' => '0.01', 'class' => 'form-control', 'id' => 'ceil_height', 'placeholder' => lang('Sections.Form.Plaseholders.CeilHeight'), 'value' => old('ceil_height') ?? $data->ceil_height ?? '']) ?>
    </div>

    <!-- section ceil height -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Sections.Form.Labels.FloorNumber'), 'floors_number') ?>
        <?= form_input(['name' => 'floors_number', 'type' => 'number', 'step' => '1', 'class' => 'form-control', 'id' => 'floors_number', 'placeholder' => lang('Sections.Form.Plaseholders.FloorNumber'), 'value' => old('floors_number') ?? $data->floors_number ?? '']) ?>
    </div>

    <!-- section title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Sections.Form.Labels.Title', ['language' => $language]), 'title_' . $language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][title]', 'class' => 'form-control', 'id' => 'title_' . $language, 'placeholder' => lang('Sections.Form.Plaseholders.Title'), 'value' => old('translation.' . $language . '.title') ?? $data->translations[$language]['title'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- section description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Sections.Form.Labels.Description', ['language' => $language]), 'description_' . $language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][description]', 'class' => 'form-control sceditor', 'id' => 'description_' . $language, 'placeholder' => lang('Sections.Form.Plaseholders.Description'), 'value' => old('translation.' . $language . '.description') ?? $data->translations[$language]['description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- section metatitle -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Sections.Form.Labels.Metatitle', ['language' => $language]), 'meta_title_' . $language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][meta_title]', 'class' => 'form-control', 'id' => 'meta_title_' . $language, 'placeholder' => lang('Sections.Form.Plaseholders.Metatitle'), 'value' => old('translation.' . $language . '.meta_title') ?? $data->translations[$language]['meta_title'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- section meta_description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Sections.Form.Labels.Metadescription', ['language' => $language]), 'meta_description_' . $language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][meta_description]', 'class' => 'form-control', 'id' => 'meta_description_' . $language, 'placeholder' => lang('Sections.Form.Plaseholders.Metadescription'), 'value' => old('translation.' . $language . '.meta_description') ?? $data->translations[$language]['meta_description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- section slug -->
    <div class="form-group col-md-12">
        <?= form_label(lang('Sections.Form.Labels.Slug'), 'slug') ?>
        <?= form_input(['name' => 'slug', 'class' => 'form-control', 'id' => 'slug', 'placeholder' => lang('Sections.Form.Plaseholders.Slug'), 'value' => old('slug') ?? $data->slug ?? '']) ?>
    </div>

    <!-- section publish -->
    <div class="form-group col-md-6">
        <div class="form-check">
            <?= form_checkbox(['name' => 'publish', 'class' => 'form-check-input', 'id' => 'publish', 'value' => 'publish', 'checked' => (isset($data->publish) && $data->publish) ? true : false]) ?>
            <?= form_label(lang('Sections.Form.Labels.Publish'), 'publish') ?>
        </div>
    </div>
</div>
