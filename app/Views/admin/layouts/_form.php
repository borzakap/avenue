<div class="form-row">
    <div class="">
        <?= \Config\Services::validation()->listErrors() ?>
        <?= session()->get("error") ?>
    </div>
    <!-- residential title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Residentials.Form.Labels.Title', ['language' => $language]), 'title_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][title]', 'class' => 'form-control', 'id' => 'title_'.$language, 'placeholder' => lang('Residentials.Form.Plaseholders.Title'), 'value' => old('translation.'.$language.'.title') ?? $data->translations[$language]['title'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- residential address -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Residentials.Form.Labels.Address', ['language' => $language]), 'address_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][address]', 'class' => 'form-control', 'id' => 'address_'.$language, 'placeholder' => lang('Residentials.Form.Plaseholders.Address'), 'value' => old('translation.'.$language.'.address') ?? $data->translations[$language]['address'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    
    <!-- residential description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Residentials.Form.Labels.Description', ['language' => $language]), 'description_'.$language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][description]', 'class' => 'form-control sceditor', 'id' => 'description_'.$language, 'placeholder' => lang('Residentials.Form.Plaseholders.Description'), 'value' => old('translation.'.$language.'.description') ?? $data->translations[$language]['description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- residential metatitle -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Residentials.Form.Labels.Metatitle', ['language' => $language]), 'meta_title_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][meta_title]', 'class' => 'form-control', 'id' => 'meta_title_'.$language, 'placeholder' => lang('Residentials.Form.Plaseholders.Metatitle'), 'value' => old('translation.'.$language.'.meta_title') ?? $data->translations[$language]['meta_title'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- residential meta_description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Residentials.Form.Labels.Metadescription', ['language' => $language]), 'meta_description_'.$language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][meta_description]', 'class' => 'form-control', 'id' => 'meta_description_'.$language, 'placeholder' => lang('Residentials.Form.Plaseholders.Metadescription'), 'value' => old('translation.'.$language.'.meta_description') ?? $data->translations[$language]['meta_description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    
    <!-- residential slug -->
    <div class="form-group col-md-12">
        <?= form_label(lang('Residentials.Form.Labels.Slug'), 'slug') ?>
        <?= form_input(['name' => 'slug', 'class' => 'form-control', 'id' => 'slug', 'placeholder' => lang('Residentials.Form.Plaseholders.Slug'), 'value' => old('slug') ?? $data->slug ?? '']) ?>
    </div>

    <!-- residential build start -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Residentials.Form.Labels.BuildStart'), 'residential_build_start') ?>
        <?= form_input(['name' => 'residential_build_start', 'class' => 'form-control', 'id' => 'residential_build_start', 'placeholder' => lang('Residentials.Form.Plaseholders.BuildStart'), 'value' => old('residential_build_start') ?? $data->residential_build_start ?? '']) ?>
    </div>

    <!-- residential build end -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Residentials.Form.Labels.BuildEnd'), 'residential_build_end') ?>
        <?= form_input(['name' => 'residential_build_end', 'class' => 'form-control', 'id' => 'residential_build_end', 'placeholder' => lang('Residentials.Form.Plaseholders.BuildEnd'), 'value' => old('residential_build_end') ?? $data->residential_build_end ?? '']) ?>
    </div>

    <!-- residential latitude -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Residentials.Form.Labels.Latitude'), 'latitude') ?>
        <?= form_input(['name' => 'latitude', 'type'=> 'number', 'step' => 'any', 'class' => 'form-control', 'id' => 'latitude', 'placeholder' => lang('Residentials.Form.Plaseholders.Latitude'), 'value' => old('latitude') ?? $data->latitude ?? '']) ?>
    </div>
    
    <!-- residential longitude -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Residentials.Form.Labels.Longitude'), 'longitude') ?>
        <?= form_input(['name' => 'longitude', 'type'=> 'number', 'step' => 'any', 'class' => 'form-control', 'id' => 'longitude', 'placeholder' => lang('Residentials.Form.Plaseholders.Longitude'), 'value' => old('longitude') ?? $data->longitude ?? '']) ?>
    </div>

    <!-- residential ceil height -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Residentials.Form.Labels.CeilHeight'), 'ceil_height') ?>
        <?= form_input(['name' => 'ceil_height', 'type'=> 'number', 'step' => '0.01', 'class' => 'form-control', 'id' => 'ceil_height', 'placeholder' => lang('Residentials.Form.Plaseholders.CeilHeight'), 'value' => old('ceil_height') ?? $data->ceil_height ?? '']) ?>
    </div>
    
    <!-- residential ceil height -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Residentials.Form.Labels.FloorNumber'), 'floors_number') ?>
        <?= form_input(['name' => 'floors_number', 'type'=> 'number', 'step' => '1', 'class' => 'form-control', 'id' => 'floors_number', 'placeholder' => lang('Residentials.Form.Plaseholders.FloorNumber'), 'value' => old('floors_number') ?? $data->floors_number ?? '']) ?>
    </div>

    <!-- residential publish -->
    <div class="form-group col-md-6">
        <div class="form-check">
        <?= form_checkbox(['name' => 'publish', 'class' => 'form-check-input', 'id' => 'publish', 'value' => 'publish', 'checked' => (isset($data->publish) &&  $data->publish) ? true : false]) ?>
        <?= form_label(lang('Residentials.Form.Labels.Publish'), 'publish') ?>
        </div>
    </div>
</div>
