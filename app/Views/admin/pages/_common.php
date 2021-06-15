<div class="form-row">
    <div class="">
        <?= \Config\Services::validation()->listErrors() ?>
        <?= session()->get("error") ?>
    </div>
    <!-- home page title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Pages.Form.Labels.MetaTitle', ['language' => $language]), 'meta_title_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][meta_title]', 'class' => 'form-control', 'id' => 'meta_title_'.$language, 'placeholder' => lang('Pages.Form.Plaseholders.Title'), 'value' => old('translation.'.$language.'.meta_title') ?? $data['translation'][$language]['meta_title'] ?? '']) ?>    
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home page meta_description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Residentials.Form.Labels.Metadescription', ['language' => $language]), 'meta_description_'.$language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][meta_description]', 'class' => 'form-control', 'id' => 'meta_description_'.$language, 'placeholder' => lang('Residentials.Form.Plaseholders.Metadescription'), 'value' => old('translation.'.$language.'.meta_description') ?? $data['translation'][$language]['meta_description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home page description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Residentials.Form.Labels.Description', ['language' => $language]), 'description_'.$language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][description]', 'class' => 'form-control sceditor', 'id' => 'description_'.$language, 'placeholder' => lang('Residentials.Form.Plaseholders.Description'), 'value' => old('translation.'.$language.'.description') ?? $data['translation'][$language]['description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home section about title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Pages.Form.Labels.AboutTitle', ['language' => $language]), 'section_about_title_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][section_about_title]', 'class' => 'form-control', 'id' => 'section_about_title_'.$language, 'placeholder' => lang('Pages.Form.Plaseholders.SectiionAboutTitle'), 'value' => old('translation.'.$language.'.section_about_title') ?? $data['translation'][$language]['section_about_title'] ?? '']) ?>    
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home section about second title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Pages.Form.Labels.AboutSecondTitle', ['language' => $language]), 'section_about_second_title_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][section_about_second_title]', 'class' => 'form-control', 'id' => 'section_about_second_title_'.$language, 'placeholder' => lang('Pages.Form.Plaseholders.AboutSecondTitle'), 'value' => old('translation.'.$language.'.section_about_second_title') ?? $data['translation'][$language]['section_about_second_title'] ?? '']) ?>    
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home section about first description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Residentials.Form.Labels.AboutFirstDescription', ['language' => $language]), 'section_about_first_description_'.$language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][section_about_first_description]', 'class' => 'form-control', 'id' => 'section_about_first_description_'.$language, 'placeholder' => lang('Residentials.Form.Plaseholders.AboutFirstDescription'), 'value' => old('translation.'.$language.'.section_about_first_description') ?? $data['translation'][$language]['section_about_first_description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

</div>
