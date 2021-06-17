<?php

namespace App\Controllers;

class Pages extends BaseController {

    public function index() {
        $this->data['meta_title'] = $this->text->translate('meta_title', 'home');
        $this->data['meta_description'] = $this->text->translate('meta_description', 'home');
        $this->data['description'] = $this->text->translate('description', 'home');
        $this->data['section_about_title'] = $this->text->translate('section_about_title', 'home');
        $this->data['section_about_second_title'] = $this->text->translate('section_about_second_title', 'home');
        $this->data['section_about_first_description'] = $this->text->translate('section_about_first_description', 'home');
        $this->data['section_about_first_subtitle'] = $this->text->translate('section_about_first_subtitle', 'home');
        $this->data['section_about_first_subdescription'] = $this->text->translate('section_about_first_subdescription', 'home');
        $this->data['section_about_second_subtitle'] = $this->text->translate('section_about_second_subtitle', 'home');
        $this->data['section_about_second_subdescription'] = $this->text->translate('section_about_second_subdescription', 'home');
        $this->data['section_prefs_first_sub_title'] = $this->text->translate('section_prefs_first_sub_title', 'home');
        $this->data['section_prefs_first_sub_description'] = $this->text->translate('section_prefs_first_sub_description', 'home');
        $this->data['section_prefs_first_sub_after_description'] = $this->text->translate('section_prefs_first_sub_after_description', 'home');
        $this->data['section_prefs_second_sub_title'] = $this->text->translate('section_prefs_first_sub_title', 'home');
        $this->data['section_prefs_second_sub_description'] = $this->text->translate('section_prefs_first_sub_description', 'home');
        $this->data['section_prefs_second_sub_after_description'] = $this->text->translate('section_prefs_first_sub_after_description', 'home');
        $this->data['section_prefs_third_sub_title'] = $this->text->translate('section_prefs_first_sub_title', 'home');
        $this->data['section_prefs_third_sub_description'] = $this->text->translate('section_prefs_first_sub_description', 'home');
        $this->data['section_prefs_third_sub_after_description'] = $this->text->translate('section_prefs_first_sub_after_description', 'home');
        $this->data['section_prefs_fourth_sub_title'] = $this->text->translate('section_prefs_first_sub_title', 'home');
        $this->data['section_prefs_fourth_sub_description'] = $this->text->translate('section_prefs_first_sub_description', 'home');
        $this->data['section_prefs_fourth_sub_after_description'] = $this->text->translate('section_prefs_first_sub_after_description', 'home');
        $this->data['section_subscribe_title'] = $this->text->translate('section_subscribe_title', 'home');
        $this->data['section_subscribe_before_title'] = $this->text->translate('section_subscribe_before_title', 'home');
        $this->data['section_subscribe_after_title'] = $this->text->translate('section_subscribe_after_title', 'home');
        $this->data['section_faq_title'] = $this->text->translate('section_faq_title', 'home');
        $this->data['section_faq_first_sub_title'] = $this->text->translate('section_faq_first_sub_title', 'home');
        $this->data['section_faq_first_sub_description'] = $this->text->translate('section_faq_first_sub_description', 'home');
        $this->data['section_faq_second_sub_title'] = $this->text->translate('section_faq_second_sub_title', 'home');
        $this->data['section_faq_second_sub_description'] = $this->text->translate('section_faq_second_sub_description', 'home');
        $this->data['section_faq_third_sub_title'] = $this->text->translate('section_faq_third_sub_title', 'home');
        $this->data['section_faq_third_sub_description'] = $this->text->translate('section_faq_third_sub_description', 'home');
        $this->data['section_faq_fourth_sub_title'] = $this->text->translate('section_faq_fourth_sub_title', 'home');
        $this->data['section_faq_fourth_sub_description'] = $this->text->translate('section_faq_fourth_sub_description', 'home');
        $this->data['section_faq_fifth_sub_title'] = $this->text->translate('section_faq_fifth_sub_title', 'home');
        $this->data['section_faq_fifth_sub_description'] = $this->text->translate('section_faq_fifth_sub_description', 'home');
        $this->data['section_promo_title'] = $this->text->translate('section_promo_title', 'home');
        $this->data['section_promo_description'] = $this->text->translate('section_promo_description', 'home');
        $this->data['section_proj_title'] = $this->text->translate('section_proj_title', 'home');
        $this->data['section_proj_title_01'] = $this->text->translate('section_proj_title_01', 'home');
        $this->data['section_proj_title_02'] = $this->text->translate('section_proj_title_02', 'home');
        $this->data['section_proj_title_03'] = $this->text->translate('section_proj_title_03', 'home');
        $this->data['section_proj_title_04'] = $this->text->translate('section_proj_title_04', 'home');
        $this->data['section_proj_title_05'] = $this->text->translate('section_proj_title_05', 'home');
        $this->data['section_proj_title_06'] = $this->text->translate('section_proj_title_06', 'home');
        $this->data['section_proj_title_07'] = $this->text->translate('section_proj_title_07', 'home');
        $this->data['section_proj_title_08'] = $this->text->translate('section_proj_title_08', 'home');
        $this->data['section_proj_title_09'] = $this->text->translate('section_proj_title_09', 'home');
        $this->data['section_proj_title_10'] = $this->text->translate('section_proj_title_10', 'home');
        $this->data['section_proj_title_11'] = $this->text->translate('section_proj_title_11', 'home');
        $this->data['section_proj_title_12'] = $this->text->translate('section_proj_title_12', 'home');
        
        return view('site/pages/home', $this->data);
    }
    
    public function contact() {
        return view('site/pages/contact', $this->data);
    }

}
