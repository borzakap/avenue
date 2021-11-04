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

    public function carusel(array $params = []): string {
        $data = [
            'layouts' => model(LayoutsModel::class)->getList($this->request->getLocale(), $params),
        ];
        return view('site/seils/layouts_carusel', $data);
    }

}
