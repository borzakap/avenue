<div class="form-row">
    <!-- title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Title', ['language' => $language]), 'title_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][title]', 'class' => 'form-control', 'id' => 'title_'.$language, 'value' => old('translation.'.$language.'.title') ?? $data->translations[$language]['title'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- address -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Address', ['language' => $language]), 'address_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][address]', 'class' => 'form-control', 'id' => 'address_'.$language, 'value' => old('translation.'.$language.'.address') ?? $data->translations[$language]['address'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    
    <!-- description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Description', ['language' => $language]), 'description_'.$language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][description]', 'class' => 'form-control sceditor', 'id' => 'description_'.$language, 'value' => old('translation.'.$language.'.description') ?? $data->translations[$language]['description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Сonditions', ['language' => $language]), 'conditions_'.$language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][conditions]', 'class' => 'form-control sceditor', 'id' => 'conditions_'.$language, 'value' => old('conditions.'.$language.'.description') ?? $data->translations[$language]['conditions'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- metatitle -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Metatitle', ['language' => $language]), 'meta_title_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][meta_title]', 'class' => 'form-control', 'id' => 'meta_title_'.$language, 'value' => old('translation.'.$language.'.meta_title') ?? $data->translations[$language]['meta_title'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- meta_description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Metadescription', ['language' => $language]), 'meta_description_'.$language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][meta_description]', 'class' => 'form-control', 'id' => 'meta_description_'.$language, 'value' => old('translation.'.$language.'.meta_description') ?? $data->translations[$language]['meta_description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    
    <!-- slug -->
    <div class="form-group col-md-12">
        <?= form_label(lang('Admin.Form.Labels.Slug'), 'slug') ?>
        <?= form_input(['name' => 'slug', 'class' => 'form-control', 'id' => 'slug', 'value' => old('slug') ?? $data->slug ?? '']) ?>
    </div>

    <!-- link fasebook -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.LinkFasebook'), 'link_fasebook') ?>
        <?= form_input(['name' => 'link_fasebook', 'class' => 'form-control', 'id' => 'link_fasebook', 'value' => old('link_fasebook') ?? $data->link_fasebook ?? '']) ?>
    </div>
    
    <!-- link youtube -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.LinkYoutube'), 'link_youtube') ?>
        <?= form_input(['name' => 'link_youtube', 'class' => 'form-control', 'id' => 'link_youtube', 'value' => old('link_youtube') ?? $data->link_youtube ?? '']) ?>
    </div>
    
    <!-- link instagram -->
    <div class="form-group col-md-4">
        <?= form_label(lang('Admin.Form.Labels.LinkInstagram'), 'link_instagram') ?>
        <?= form_input(['name' => 'link_instagram', 'class' => 'form-control', 'id' => 'link_instagram', 'value' => old('link_instagram') ?? $data->link_instagram ?? '']) ?>
    </div>

    <!-- build start -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Admin.Form.Labels.BuildStart'), 'residential_build_start') ?>
        <?= form_input(['name' => 'residential_build_start', 'class' => 'form-control', 'id' => 'residential_build_start', 'value' => old('residential_build_start') ?? $data->residential_build_start ?? '']) ?>
    </div>

    <!-- build end -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Admin.Form.Labels.BuildEnd'), 'residential_build_end') ?>
        <?= form_input(['name' => 'residential_build_end', 'class' => 'form-control', 'id' => 'residential_build_end', 'value' => old('residential_build_end') ?? $data->residential_build_end ?? '']) ?>
    </div>

    <!-- latitude -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Admin.Form.Labels.Latitude'), 'latitude') ?>
        <?= form_input(['name' => 'latitude', 'type'=> 'number', 'step' => 'any', 'class' => 'form-control', 'id' => 'latitude', 'value' => old('latitude') ?? $data->latitude ?? '']) ?>
    </div>
    
    <!-- longitude -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Admin.Form.Labels.Longitude'), 'longitude') ?>
        <?= form_input(['name' => 'longitude', 'type'=> 'number', 'step' => 'any', 'class' => 'form-control', 'id' => 'longitude', 'value' => old('longitude') ?? $data->longitude ?? '']) ?>
    </div>

    <!-- ceil height -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Admin.Form.Labels.CeilHeight'), 'ceil_height') ?>
        <?= form_input(['name' => 'ceil_height', 'type'=> 'number', 'step' => '0.01', 'class' => 'form-control', 'id' => 'ceil_height', 'value' => old('ceil_height') ?? $data->ceil_height ?? '']) ?>
    </div>
    
    <!-- floor number -->
    <div class="form-group col-md-6">
        <?= form_label(lang('Admin.Form.Labels.FloorNumber'), 'floors_number') ?>
        <?= form_input(['name' => 'floors_number', 'type'=> 'number', 'step' => '1', 'class' => 'form-control', 'id' => 'floors_number', 'value' => old('floors_number') ?? $data->floors_number ?? '']) ?>
    </div>

    <!-- publish -->
    <div class="form-group col-md-6">
        <div class="form-check">
        <?= form_checkbox(['name' => 'publish', 'class' => 'form-check-input', 'id' => 'publish', 'value' => 'publish', 'checked' => (isset($data->publish) &&  $data->publish) ? true : false]) ?>
        <?= form_label(lang('Admin.Form.Labels.Publish'), 'publish') ?>
        </div>
    </div>
</div>
