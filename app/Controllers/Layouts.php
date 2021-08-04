<?php

namespace App\Controllers;

/**
 * Description of Layouts
 *
 * @author alexey
 */
class Layouts extends BaseController{
    
    public function view(string $slug) {
        helper(['html', 'number']);
        $model = model(LayoutsModel::class);
        $this->data['layout'] = $model->getLayoutBySlug($slug, $this->request->getLocale())->withSection();
        $this->data['meta_title'] = $this->data['layout']->meta_title;
        return view('site/layouts/layout', $this->data);
    }

    //put your code here
}
