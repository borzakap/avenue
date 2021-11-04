<?php

namespace App\Libraries;

/**
 * Description of Infrasturcture
 *
 * @author alexey
 */
class Infrastructure {
    
    private $request;
    
    public function __construct() {
        $this->request = service('request');
    }

    public function map(array $params = []): string{
        $data = [
            'items' => model(InfrastructureModel::class)->getList($this->request->getLocale(), $params),
        ];
        return view('site/seils/map', $data);
    }
}
