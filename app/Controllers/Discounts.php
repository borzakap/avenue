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
}
