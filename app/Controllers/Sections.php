<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of Layouts
 *
 * @author alexey
 */
class Sections extends BaseController{
    /**
     * section view
     * @param string $slug
     * @return type
     */
    public function view(string $slug){
        helper('html');
        $model = model(SectionsModel::class);
        $section = $model->where('slug', $slug)->first();
        $floors_model = model(FloorsImagesModel::class);
        $this->data['floors'] = $floors_model->where('section_id', $section->id)->find();
        return view('site/sections/section', $this->data);
    }
}
