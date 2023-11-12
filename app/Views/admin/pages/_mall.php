<div class="form-row">
    <!-- page title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.MetaTitle', ['language' => $language]), 'meta_title_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][meta_title]', 'class' => 'form-control', 'id' => 'meta_title_'.$language, 'value' => old('translation.'.$language.'.meta_title') ?? $data['translation'][$language]['meta_title'] ?? '']) ?>    
            </div>
        <?php endforeach; ?>
    </div>
    <!-- page meta_description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.Metadescription', ['language' => $language]), 'meta_description_'.$language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][meta_description]', 'class' => 'form-control', 'id' => 'meta_description_'.$language, 'value' => old('translation.'.$language.'.meta_description') ?? $data['translation'][$language]['meta_description'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- section about title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.AboutTitle', ['language' => $language]), 'section_about_title_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][section_about_title]', 'class' => 'form-control', 'id' => 'section_about_title_'.$language, 'value' => old('translation.'.$language.'.section_about_title') ?? $data['translation'][$language]['section_about_title'] ?? '']) ?>    
            </div>
        <?php endforeach; ?>
    </div>
    <!-- section about second title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.AboutSecondTitle', ['language' => $language]), 'section_about_second_title_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][section_about_second_title]', 'class' => 'form-control', 'id' => 'section_about_second_title_'.$language, 'value' => old('translation.'.$language.'.section_about_second_title') ?? $data['translation'][$language]['section_about_second_title'] ?? '']) ?>    
            </div>
        <?php endforeach; ?>
    </div>
    <!-- section about first sub title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.AboutFirstSubTitle', ['language' => $language]), 'section_about_first_subtitle_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][section_about_first_subtitle]', 'class' => 'form-control', 'id' => 'section_about_first_subtitle_'.$language, 'value' => old('translation.'.$language.'.section_about_first_subtitle') ?? $data['translation'][$language]['section_about_first_subtitle'] ?? '']) ?>    
            </div>
        <?php endforeach; ?>
    </div>
    <!-- section about first sub description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.AboutFirstSubDescription', ['language' => $language]), 'section_about_first_subdescription_'.$language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][section_about_first_subdescription]', 'class' => 'form-control', 'id' => 'section_about_first_subdescription_'.$language, 'value' => old('translation.'.$language.'.section_about_first_subdescription') ?? $data['translation'][$language]['section_about_first_subdescription'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- section about second sub title -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.AboutSecondSubTitle', ['language' => $language]), 'section_about_second_subtitle_'.$language) ?>
                <?= form_input(['name' => 'translation[' . $language . '][section_about_second_subtitle]', 'class' => 'form-control', 'id' => 'section_about_second_subtitle_'.$language, 'value' => old('translation.'.$language.'.section_about_second_subtitle') ?? $data['translation'][$language]['section_about_second_subtitle'] ?? '']) ?>    
            </div>
        <?php endforeach; ?>
    </div>
    <!-- section about second sub description -->
    <div class="form-group col-md-12">
        <?php foreach ($languages as $language) : ?>
            <div class="languages-variants<?= ($default_naguage == $language) ? ' active' : '' ?>" data-language="<?= $language ?>">
                <?= form_label(lang('Admin.Form.Labels.AboutSecondSubDescription', ['language' => $language]), 'section_about_second_subdescription_'.$language) ?>
                <?= form_textarea(['name' => 'translation[' . $language . '][section_about_second_subdescription]', 'class' => 'form-control', 'id' => 'section_about_second_subdescription_'.$language, 'value' => old('translation.'.$language.'.section_about_second_subdescription') ?? $data['translation'][$language]['section_about_second_subdescription'] ?? '']) ?>
            </div>
        <?php endforeach; ?>
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

</div>
