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
        return view('site/layouts/layout', $this->data);
    }

    //put your code here
}
