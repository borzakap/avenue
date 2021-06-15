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
                <?= form_input(['name' => 'translation[' . $language . '][meta_title]', 'class' => 'form-control', 'id' => 'meta_title_'.$language, 'value' => old('translation.'.$language.'.meta_title') ?? $data['translation'][$language]['meta_title'] ?? '']) ?>    
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home page meta_description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Pages.Form.Labels.Metadescription', ['language' => $language]), 'meta_description_'.$language) ?>
                <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][meta_description]', 'class' => 'form-control', 'id' => 'meta_description_'.$language, 'value' => old('translation.'.$language.'.meta_description') ?? $data['translation'][$language]['meta_description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home page description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Pages.Form.Labels.Description', ['language' => $language]), 'description_'.$language) ?>
                <?= form_textarea(['rows' => '8', 'name' => 'translation[' . $language . '][description]', 'class' => 'form-control sceditor', 'id' => 'description_'.$language, 'value' => old('translation.'.$language.'.description') ?? $data['translation'][$language]['description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home section about title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Pages.Form.Labels.AboutTitle', ['language' => $language]), 'section_about_title_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][section_about_title]', 'class' => 'form-control', 'id' => 'section_about_title_'.$language, 'value' => old('translation.'.$language.'.section_about_title') ?? $data['translation'][$language]['section_about_title'] ?? '']) ?>    
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home section about second title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Pages.Form.Labels.AboutSecondTitle', ['language' => $language]), 'section_about_second_title_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][section_about_second_title]', 'class' => 'form-control', 'id' => 'section_about_second_title_'.$language, 'value' => old('translation.'.$language.'.section_about_second_title') ?? $data['translation'][$language]['section_about_second_title'] ?? '']) ?>    
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home section about first description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Pages.Form.Labels.AboutFirstDescription', ['language' => $language]), 'section_about_first_description_'.$language) ?>
                <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_about_first_description]', 'class' => 'form-control', 'id' => 'section_about_first_description_'.$language, 'value' => old('translation.'.$language.'.section_about_first_description') ?? $data['translation'][$language]['section_about_first_description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home section about first subtitle -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Pages.Form.Labels.AboutFirstSubTitle', ['language' => $language]), 'section_about_first_subtitle_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][section_about_first_subtitle]', 'class' => 'form-control', 'id' => 'section_about_first_subtitle_'.$language, 'value' => old('translation.'.$language.'.section_about_first_subtitle') ?? $data['translation'][$language]['section_about_first_subtitle'] ?? '']) ?>    
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home section about first subdescription -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Pages.Form.Labels.AboutFirstSubDescription', ['language' => $language]), 'section_about_first_subdescription_'.$language) ?>
                <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_about_first_subdescription]', 'class' => 'form-control', 'id' => 'section_about_first_subdescription_'.$language, 'value' => old('translation.'.$language.'.section_about_first_subdescription') ?? $data['translation'][$language]['section_about_first_subdescription'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home section about second subtitle -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Pages.Form.Labels.AboutSecondSubTitle', ['language' => $language]), 'section_about_second_subtitle_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][section_about_second_subtitle]', 'class' => 'form-control', 'id' => 'section_about_second_subtitle_'.$language, 'value' => old('translation.'.$language.'.section_about_second_subtitle') ?? $data['translation'][$language]['section_about_second_subtitle'] ?? '']) ?>    
            </div>
        <?php endforeach; ?>
    </div>
    <!-- home section about second subdescription -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Pages.Form.Labels.AboutSecondSubDescription', ['language' => $language]), 'section_about_second_subdescription_'.$language) ?>
                <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_about_second_subdescription]', 'class' => 'form-control', 'id' => 'section_about_second_subdescription_'.$language, 'value' => old('translation.'.$language.'.section_about_second_subdescription') ?? $data['translation'][$language]['section_about_second_subdescription'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>

</div>
