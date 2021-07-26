<?php

namespace App\Libraries;

/**
 * Description of Layouts
 *
 * @author alexey
 */
class Layouts {
    
    private $request;

    public function __construct() {
        $this->request = service('request');
    }
    
    public function carusel(array $params = []) : string{
        $model = model(LayoutsModel::class);
        $layouts = $model->getLayouts($this->request->getLocale(), $params);
        $data = [
            'layouts' => $layouts,
        ];
        return view('site/seils/layouts_carusel', $data);
    }
    
}
