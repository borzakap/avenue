<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * Description of Discounts
 *
 * @author alexey
 */
class Discounts extends BaseController{
    
    /**
     * view
     * @param string $slug
     * @return string
     * @throws PageNotFoundException
     */
    public function view(string $slug): string {
        helper(['number']);
        if (!$item = model(DiscountsModel::class)->getBySlug($slug, $this->request->getLocale())) {
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['item'] = $item;
        $this->data['meta_title'] = $item->meta_title;
        $this->data['meta_description'] = $item->meta_description;
        return view('site/discounts/view', $this->data);
    }
    
    /**
     * list
     * @param string $slug
     * @return type
     * @throws PageNotFoundException
     */
    public function list(string $slug = 'default') {
        if ($slug == 'default') {
            $default = model(ResidentialsModel::class)->first();
            return redirect()->route('discounts-site', [$default->slug]);
        }
        if (!$residential = model(ResidentialsModel::class)->getBySlug($slug, $this->request->getLocale())) {
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['meta_title'] = $residential->meta_title;
        $this->data['meta_description'] = $residential->meta_description;
        $this->data['items'] = model(DiscountsModel::class)->getList($this->request->getLocale(), ['residential_id' => $residential->id]);
        $this->data['pager'] = model(DiscountsModel::class)->pager;
        return view('site/discounts/list', $this->data);
    }
    
}
