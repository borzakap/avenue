<div class="form-row">
    <div class="">
        <?= \Config\Services::validation()->listErrors() ?>
        <?= session()->get("error") ?>
    </div>
    <!-- Meta block -->
    <div class="card w-100 mb-4">
        <div class="header mb-3">
            <a href="#collapseMeta" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary"><?= lang('Pages.Home.Form.Blocks.MetaTitle') ?></h6>
            </a>
        </div>
        <div class="collapse" id="collapseMeta">
            <!-- home page title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.MetaTitle', ['language' => $language]), 'meta_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][meta_title]', 'class' => 'form-control', 'id' => 'meta_title_' . $language, 'value' => old('translation.' . $language . '.meta_title') ?? $data['translation'][$language]['meta_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home page meta_description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.Metadescription', ['language' => $language]), 'meta_description_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][meta_description]', 'class' => 'form-control', 'id' => 'meta_description_' . $language, 'value' => old('translation.' . $language . '.meta_description') ?? $data['translation'][$language]['meta_description'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- about description block -->
    <div class="card w-100 mb-4">
        <div class="header mb-3">
            <a href="#collapseAbout" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary"><?= lang('Pages.Home.Form.Blocks.AboutTitle') ?></h6>
            </a>
        </div>
        <div class="collapse" id="collapseAbout">
            <!-- home page description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.Description', ['language' => $language]), 'description_' . $language) ?>
                        <?= form_textarea(['rows' => '8', 'name' => 'translation[' . $language . '][description]', 'class' => 'form-control sceditor', 'id' => 'description_' . $language, 'value' => old('translation.' . $language . '.description') ?? $data['translation'][$language]['description'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section about title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.AboutTitle', ['language' => $language]), 'section_about_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_about_title]', 'class' => 'form-control', 'id' => 'section_about_title_' . $language, 'value' => old('translation.' . $language . '.section_about_title') ?? $data['translation'][$language]['section_about_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section about second title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.AboutSecondTitle', ['language' => $language]), 'section_about_second_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_about_second_title]', 'class' => 'form-control', 'id' => 'section_about_second_title_' . $language, 'value' => old('translation.' . $language . '.section_about_second_title') ?? $data['translation'][$language]['section_about_second_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section about first description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.AboutFirstDescription', ['language' => $language]), 'section_about_first_description_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_about_first_description]', 'class' => 'form-control', 'id' => 'section_about_first_description_' . $language, 'value' => old('translation.' . $language . '.section_about_first_description') ?? $data['translation'][$language]['section_about_first_description'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section about first subtitle -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.AboutFirstSubTitle', ['language' => $language]), 'section_about_first_subtitle_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_about_first_subtitle]', 'class' => 'form-control', 'id' => 'section_about_first_subtitle_' . $language, 'value' => old('translation.' . $language . '.section_about_first_subtitle') ?? $data['translation'][$language]['section_about_first_subtitle'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section about first subdescription -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.AboutFirstSubDescription', ['language' => $language]), 'section_about_first_subdescription_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_about_first_subdescription]', 'class' => 'form-control', 'id' => 'section_about_first_subdescription_' . $language, 'value' => old('translation.' . $language . '.section_about_first_subdescription') ?? $data['translation'][$language]['section_about_first_subdescription'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section about second subtitle -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.AboutSecondSubTitle', ['language' => $language]), 'section_about_second_subtitle_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_about_second_subtitle]', 'class' => 'form-control', 'id' => 'section_about_second_subtitle_' . $language, 'value' => old('translation.' . $language . '.section_about_second_subtitle') ?? $data['translation'][$language]['section_about_second_subtitle'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section about second subdescription -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.AboutSecondSubDescription', ['language' => $language]), 'section_about_second_subdescription_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_about_second_subdescription]', 'class' => 'form-control', 'id' => 'section_about_second_subdescription_' . $language, 'value' => old('translation.' . $language . '.section_about_second_subdescription') ?? $data['translation'][$language]['section_about_second_subdescription'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Prefs block -->
    <div class="card w-100 mb-4">
        <div class="header mb-3">
            <a href="#collapsePrefs" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary"><?= lang('Pages.Home.Form.Blocks.PrefsTitle') ?></h6>
            </a>
        </div>
        <div class="collapse" id="collapsePrefs">
            <!-- home section prefs first sub title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PrefsFirstSubTitle', ['language' => $language]), 'section_prefs_first_sub_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_prefs_first_sub_title]', 'class' => 'form-control', 'id' => 'section_prefs_first_sub_title_' . $language, 'value' => old('translation.' . $language . '.section_prefs_first_sub_title') ?? $data['translation'][$language]['section_prefs_first_sub_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section prefs first sub description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PrefsFirstSubDescription', ['language' => $language]), 'section_prefs_first_sub_description_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_prefs_first_sub_description]', 'class' => 'form-control', 'id' => 'section_prefs_first_sub_description_' . $language, 'value' => old('translation.' . $language . '.section_prefs_first_sub_description') ?? $data['translation'][$language]['section_prefs_first_sub_description'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section prefs first sub after description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PrefsFirstSubAfterDescription', ['language' => $language]), 'section_prefs_first_sub_after_description_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_prefs_first_sub_after_description]', 'class' => 'form-control', 'id' => 'section_prefs_first_sub_after_description_' . $language, 'value' => old('translation.' . $language . '.section_prefs_first_sub_after_description') ?? $data['translation'][$language]['section_prefs_first_sub_after_description'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section prefs second sub title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PrefsSecondSubTitle', ['language' => $language]), 'section_prefs_second_sub_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_prefs_second_sub_title]', 'class' => 'form-control', 'id' => 'section_prefs_second_sub_title_' . $language, 'value' => old('translation.' . $language . '.section_prefs_second_sub_title') ?? $data['translation'][$language]['section_prefs_second_sub_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section prefs second sub description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PrefsSecondSubDescription', ['language' => $language]), 'section_prefs_second_sub_description_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_prefs_second_sub_description]', 'class' => 'form-control', 'id' => 'section_prefs_second_sub_description_' . $language, 'value' => old('translation.' . $language . '.section_prefs_second_sub_description') ?? $data['translation'][$language]['section_prefs_second_sub_description'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section prefs second sub after description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PrefsSecondSubAfterDescription', ['language' => $language]), 'section_prefs_second_sub_after_description_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_prefs_second_sub_after_description]', 'class' => 'form-control', 'id' => 'section_prefs_second_sub_after_description_' . $language, 'value' => old('translation.' . $language . '.section_prefs_second_sub_after_description') ?? $data['translation'][$language]['section_prefs_second_sub_after_description'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section prefs third sub title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PrefsThirdSubTitle', ['language' => $language]), 'section_prefs_third_sub_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_prefs_third_sub_title]', 'class' => 'form-control', 'id' => 'section_prefs_third_sub_title_' . $language, 'value' => old('translation.' . $language . '.section_prefs_third_sub_title') ?? $data['translation'][$language]['section_prefs_third_sub_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section prefs third sub description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PrefsThirdSubDescription', ['language' => $language]), 'section_prefs_third_sub_description_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_prefs_third_sub_description]', 'class' => 'form-control', 'id' => 'section_prefs_third_sub_description_' . $language, 'value' => old('translation.' . $language . '.section_prefs_third_sub_description') ?? $data['translation'][$language]['section_prefs_third_sub_description'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section prefs third sub after description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PrefsThirdSubAfterDescription', ['language' => $language]), 'section_prefs_third_sub_after_description_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_prefs_third_sub_after_description]', 'class' => 'form-control', 'id' => 'section_prefs_third_sub_after_description_' . $language, 'value' => old('translation.' . $language . '.section_prefs_third_sub_after_description') ?? $data['translation'][$language]['section_prefs_third_sub_after_description'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section prefs fourth sub title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PrefsFourthSubTitle', ['language' => $language]), 'section_prefs_fourth_sub_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_prefs_fourth_sub_title]', 'class' => 'form-control', 'id' => 'section_prefs_fourth_sub_title_' . $language, 'value' => old('translation.' . $language . '.section_prefs_fourth_sub_title') ?? $data['translation'][$language]['section_prefs_fourth_sub_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section prefs fourth sub description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PrefsFourthSubDescription', ['language' => $language]), 'section_prefs_fourth_sub_description_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_prefs_fourth_sub_description]', 'class' => 'form-control', 'id' => 'section_prefs_fourth_sub_description_' . $language, 'value' => old('translation.' . $language . '.section_prefs_fourth_sub_description') ?? $data['translation'][$language]['section_prefs_fourth_sub_description'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section prefs fourth sub after description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PrefsFourthSubAfterDescription', ['language' => $language]), 'section_prefs_fourth_sub_after_description_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_prefs_fourth_sub_after_description]', 'class' => 'form-control', 'id' => 'section_prefs_fourth_sub_after_description_' . $language, 'value' => old('translation.' . $language . '.section_prefs_fourth_sub_after_description') ?? $data['translation'][$language]['section_prefs_fourth_sub_after_description'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Subscribe block -->
    <div class="card w-100 mb-4">
        <div class="header mb-3">
            <a href="#collapseSubscribe" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary"><?= lang('Pages.Home.Form.Blocks.SubscribeTitle') ?></h6>
            </a>
        </div>
        <div class="collapse" id="collapseSubscribe">
            <!-- home section subscribe title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.SubscribeTitle', ['language' => $language]), 'section_subscribe_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_subscribe_title]', 'class' => 'form-control', 'id' => 'section_subscribe_title_' . $language, 'value' => old('translation.' . $language . '.section_subscribe_title') ?? $data['translation'][$language]['section_subscribe_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section subscribe before title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.SubscribeBeforeTitle', ['language' => $language]), 'section_subscribe_before_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_subscribe_before_title]', 'class' => 'form-control', 'id' => 'section_subscribe_before_title_' . $language, 'value' => old('translation.' . $language . '.section_subscribe_before_title') ?? $data['translation'][$language]['section_subscribe_before_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section subscribe after title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.SubscribeAfterTitle', ['language' => $language]), 'section_subscribe_after_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_subscribe_after_title]', 'class' => 'form-control', 'id' => 'section_subscribe_after_title_' . $language, 'value' => old('translation.' . $language . '.section_subscribe_after_title') ?? $data['translation'][$language]['section_subscribe_after_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Faq block -->
    <div class="card w-100 mb-4">
        <div class="header mb-3">
            <a href="#collapseFaq" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary"><?= lang('Pages.Home.Form.Blocks.FaqTitle') ?></h6>
            </a>
        </div>
        <div class="collapse" id="collapseFaq">
            <!-- home section faq before title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.FaqTitle', ['language' => $language]), 'section_faq_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_faq_title]', 'class' => 'form-control', 'id' => 'section_faq_title_' . $language, 'value' => old('translation.' . $language . '.section_faq_title') ?? $data['translation'][$language]['section_faq_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section faq first sub before title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.FaqFirstSubTitle', ['language' => $language]), 'section_faq_first_sub_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_faq_first_sub_title]', 'class' => 'form-control', 'id' => 'section_faq_first_sub_title_' . $language, 'value' => old('translation.' . $language . '.section_faq_first_sub_title') ?? $data['translation'][$language]['section_faq_first_sub_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section faq first sub before description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.FaqFirstSubDescription', ['language' => $language]), 'section_faq_first_sub_description_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_faq_first_sub_description]', 'class' => 'form-control', 'id' => 'section_faq_first_sub_description_' . $language, 'value' => old('translation.' . $language . '.section_faq_first_sub_description') ?? $data['translation'][$language]['section_faq_first_sub_description'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section faq second sub before title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.FaqSecondSubTitle', ['language' => $language]), 'section_faq_second_sub_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_faq_second_sub_title]', 'class' => 'form-control', 'id' => 'section_faq_second_sub_title_' . $language, 'value' => old('translation.' . $language . '.section_faq_second_sub_title') ?? $data['translation'][$language]['section_faq_second_sub_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section faq second sub before description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.FaqSecondSubDescription', ['language' => $language]), 'section_faq_second_sub_description_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_faq_second_sub_description]', 'class' => 'form-control', 'id' => 'section_faq_second_sub_description_' . $language, 'value' => old('translation.' . $language . '.section_faq_second_sub_description') ?? $data['translation'][$language]['section_faq_second_sub_description'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section faq third sub before title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.FaqThirdSubTitle', ['language' => $language]), 'section_faq_third_sub_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_faq_third_sub_title]', 'class' => 'form-control', 'id' => 'section_faq_third_sub_title_' . $language, 'value' => old('translation.' . $language . '.section_faq_third_sub_title') ?? $data['translation'][$language]['section_faq_third_sub_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section faq third sub before description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.FaqThirdSubDescription', ['language' => $language]), 'section_faq_third_sub_description_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_faq_third_sub_description]', 'class' => 'form-control', 'id' => 'section_faq_third_sub_description_' . $language, 'value' => old('translation.' . $language . '.section_faq_third_sub_description') ?? $data['translation'][$language]['section_faq_third_sub_description'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section faq fourth sub before title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.FaqFourthSubTitle', ['language' => $language]), 'section_faq_fourth_sub_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_faq_fourth_sub_title]', 'class' => 'form-control', 'id' => 'section_faq_fourth_sub_title_' . $language, 'value' => old('translation.' . $language . '.section_faq_fourth_sub_title') ?? $data['translation'][$language]['section_faq_fourth_sub_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section faq fourth sub before description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.FaqFourthSubDescription', ['language' => $language]), 'section_faq_fourth_sub_description_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_faq_fourth_sub_description]', 'class' => 'form-control', 'id' => 'section_faq_fourth_sub_description_' . $language, 'value' => old('translation.' . $language . '.section_faq_fourth_sub_description') ?? $data['translation'][$language]['section_faq_fourth_sub_description'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section faq fifth sub before title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.FaqFifthSubTitle', ['language' => $language]), 'section_faq_fifth_sub_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_faq_fifth_sub_title]', 'class' => 'form-control', 'id' => 'section_faq_fifth_sub_title_' . $language, 'value' => old('translation.' . $language . '.section_faq_fifth_sub_title') ?? $data['translation'][$language]['section_faq_fifth_sub_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section faq fifth sub before description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.FaqFifthSubDescription', ['language' => $language]), 'section_faq_fifth_sub_description_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_faq_fifth_sub_description]', 'class' => 'form-control', 'id' => 'section_faq_fifth_sub_description_' . $language, 'value' => old('translation.' . $language . '.section_faq_fifth_sub_description') ?? $data['translation'][$language]['section_faq_fifth_sub_description'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Faq block -->
    <div class="card w-100 mb-4">
        <div class="header mb-3">
            <a href="#collapsePromo" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary"><?= lang('Pages.Home.Form.Blocks.PromoTitle') ?></h6>
            </a>
        </div>
        <div class="collapse" id="collapsePromo">
            <!-- home section promo title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PromoTitle', ['language' => $language]), 'section_promo_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_promo_title]', 'class' => 'form-control', 'id' => 'section_promo_title_' . $language, 'value' => old('translation.' . $language . '.section_promo_title') ?? $data['translation'][$language]['section_promo_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section promo description -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.PromoDescription', ['language' => $language]), 'section_promo_description_' . $language) ?>
                        <?= form_textarea(['rows' => '3', 'name' => 'translation[' . $language . '][section_promo_description]', 'class' => 'form-control', 'id' => 'section_promo_description_' . $language, 'value' => old('translation.' . $language . '.section_promo_description') ?? $data['translation'][$language]['section_promo_description'] ?? '']) ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Proj block -->
    <div class="card w-100 mb-4">
        <div class="header mb-3">
            <a href="#collapseProj" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary"><?= lang('Pages.Home.Form.Blocks.PromjTitle') ?></h6>
            </a>
        </div>
        <div class="collapse" id="collapseProj">
            <!-- home section proj title -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.ProjTitle', ['language' => $language]), 'section_proj_title_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_proj_title]', 'class' => 'form-control', 'id' => 'section_proj_title_' . $language, 'value' => old('translation.' . $language . '.section_proj_title') ?? $data['translation'][$language]['section_proj_title'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section proj title 01-->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.ProjTitle01', ['language' => $language]), 'section_proj_title_01_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_proj_title_01]', 'class' => 'form-control', 'id' => 'section_proj_title_01_' . $language, 'value' => old('translation.' . $language . '.section_proj_title_01') ?? $data['translation'][$language]['section_proj_title_01'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section proj title 02 -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.ProjTitle02', ['language' => $language]), 'section_proj_title_02_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_proj_title_02]', 'class' => 'form-control', 'id' => 'section_proj_title_02_' . $language, 'value' => old('translation.' . $language . '.section_proj_title_02') ?? $data['translation'][$language]['section_proj_title_02'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section proj title 03 -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.ProjTitle03', ['language' => $language]), 'section_proj_title_03_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_proj_title_03]', 'class' => 'form-control', 'id' => 'section_proj_title_03_' . $language, 'value' => old('translation.' . $language . '.section_proj_title_03') ?? $data['translation'][$language]['section_proj_title_03'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section proj title 04 -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.ProjTitle04', ['language' => $language]), 'section_proj_title_04_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_proj_title_04]', 'class' => 'form-control', 'id' => 'section_proj_title_04_' . $language, 'value' => old('translation.' . $language . '.section_proj_title_04') ?? $data['translation'][$language]['section_proj_title_04'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section proj title 05 -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.ProjTitle05', ['language' => $language]), 'section_proj_title_05_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_proj_title_05]', 'class' => 'form-control', 'id' => 'section_proj_title_05_' . $language, 'value' => old('translation.' . $language . '.section_proj_title_05') ?? $data['translation'][$language]['section_proj_title_05'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section proj title 06 -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.ProjTitle06', ['language' => $language]), 'section_proj_title_06_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_proj_title_06]', 'class' => 'form-control', 'id' => 'section_proj_title_06_' . $language, 'value' => old('translation.' . $language . '.section_proj_title_06') ?? $data['translation'][$language]['section_proj_title_06'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section proj title 07 -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.ProjTitle07', ['language' => $language]), 'section_proj_title_07_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_proj_title_07]', 'class' => 'form-control', 'id' => 'section_proj_title_07_' . $language, 'value' => old('translation.' . $language . '.section_proj_title_07') ?? $data['translation'][$language]['section_proj_title_07'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section proj title 08 -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.ProjTitle08', ['language' => $language]), 'section_proj_title_08_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_proj_title_08]', 'class' => 'form-control', 'id' => 'section_proj_title_08_' . $language, 'value' => old('translation.' . $language . '.section_proj_title_08') ?? $data['translation'][$language]['section_proj_title_08'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section proj title 09 -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.ProjTitle09', ['language' => $language]), 'section_proj_title_09_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_proj_title_09]', 'class' => 'form-control', 'id' => 'section_proj_title_09_' . $language, 'value' => old('translation.' . $language . '.section_proj_title_09') ?? $data['translation'][$language]['section_proj_title_09'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section proj title 10 -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.ProjTitle10', ['language' => $language]), 'section_proj_title_10_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_proj_title_10]', 'class' => 'form-control', 'id' => 'section_proj_title_10_' . $language, 'value' => old('translation.' . $language . '.section_proj_title_10') ?? $data['translation'][$language]['section_proj_title_10'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section proj title 11 -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.ProjTitle11', ['language' => $language]), 'section_proj_title_11_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_proj_title_11]', 'class' => 'form-control', 'id' => 'section_proj_title_11_' . $language, 'value' => old('translation.' . $language . '.section_proj_title_11') ?? $data['translation'][$language]['section_proj_title_11'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- home section proj title 12 -->
            <div class="form-group col-md-12">
                <?php foreach ($languages as $language) : ?>
                    <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                        <?= form_label(lang('Pages.Home.Form.Labels.ProjTitle12', ['language' => $language]), 'section_proj_title_12_' . $language) ?>
                        <?= form_input(['name' => 'translation[' . $language . '][section_proj_title_12]', 'class' => 'form-control', 'id' => 'section_proj_title_12_' . $language, 'value' => old('translation.' . $language . '.section_proj_title_12') ?? $data['translation'][$language]['section_proj_title_12'] ?? '']) ?>    
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</div>
