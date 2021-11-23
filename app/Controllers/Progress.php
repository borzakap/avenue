<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * Description of Progress
 *
 * @author alexey
 */
class Progress extends BaseController{

    public function view(string $slug): string {
        helper(['number']);
        if (!$item = model(ProgressModel::class)->getBySlug($slug, $this->request->getLocale())) {
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['item'] = $item->withImages();
        $this->data['meta_title'] = $item->meta_title;
        $this->data['meta_description'] = $item->meta_description;
        $this->data['navigation'] = model(ProgressModel::class)->getNavigation($item->residential_id);
        return view('site/progress/view', $this->data);
    }

    public function list(string $slug = 'default') {
        if ($slug == 'default') {
            $default = model(ResidentialsModel::class)->first();
            return redirect()->route('progress-site', [$default->slug]);
        }
        if (!$residential = model(ResidentialsModel::class)->getBySlug($slug, $this->request->getLocale())) {
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['meta_title'] = $residential->meta_title;
        $this->data['meta_description'] = $residential->meta_description;
        $this->data['items'] = model(ProgressModel::class)->getList($this->request->getLocale(), ['residential_id' => $residential->id]);
        $this->data['pager'] = model(ProgressModel::class)->pager;
        return view('site/progress/list', $this->data);
    }

}
