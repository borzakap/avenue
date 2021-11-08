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
        helper('number');
        $items = model(InfrastructureModel::class)->getList($this->request->getLocale(), $params);
        $sturcture = [];
        foreach ($items as $item){
            $sturcture[$item->type][] = ['title' => $item->title, 'distance' => number_to_distance($item->distance)];
        }
        if(!isset($params['residential_slug'])){
            $default = model(ResidentialsModel::class)->first();
            $params['residential_slug'] = $default->slug;
        }
        $data = [
            'residential' => model(ResidentialsModel::class)->getBySlug($params['residential_slug'], $this->request->getLocale()),
            'items' => $items,
            'sturcture' => $sturcture,
        ];
        return view('site/seils/map', $data);
    }
}
