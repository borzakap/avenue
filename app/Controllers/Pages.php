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
        
        return view('site/pages/home', $this->data);
    }
    
    public function contact() {
        return view('site/pages/contact', $this->data);
    }

}
