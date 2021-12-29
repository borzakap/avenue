<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * Description of Progress
 *
 * @author alexey
 */
class Progress extends BaseController{

    /**
     * view
     * @param string $slug
     * @return string
     * @throws PageNotFoundException
     */
    public function view(string $slug): string {
        helper(['number']);
        if (!$item = model(ProgressModel::class)->getBySlug($slug, $this->request->getLocale())) {
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['item'] = $item->withImages();
        $this->data['meta_title'] = $item->meta_title;
        $this->data['meta_description'] = $item->meta_description;
        $this->data['navigation'] = model(ProgressModel::class)->getNavigation($item->residential_id);
        // breadcrumb
        $this->data['breadcrumbs'][] = ['url' => route_to('layouts-genplan', $item->residential_slug), 'title' => $item->residential_title];
        $this->data['breadcrumbs'][] = ['url' => route_to('progress-site', $item->residential_slug), 'title' => lang('Site.Breadcrumb.Progress')];
        $this->data['breadcrumbs'][] = ['url' => route_to('progress-site-view', $item->slug), 'title' => $item->progressed_at->toLocalizedString('LLLL yyyy')];
        return view('site/progress/view', $this->data);
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
            return redirect()->route('progress-site', [$default->slug]);
        }
        if (!$residential = model(ResidentialsModel::class)->getBySlug($slug, $this->request->getLocale())) {
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['meta_title'] = $residential->meta_title;
        $this->data['meta_description'] = $residential->meta_description;
        $this->data['items'] = model(ProgressModel::class)->getList($this->request->getLocale(), ['residential_id' => $residential->id]);
        $this->data['pager'] = model(ProgressModel::class)->pager;
        // breadcrumb
        $this->data['breadcrumbs'][] = ['url' => route_to('layouts-genplan', $residential->slug), 'title' => $residential->title];
        $this->data['breadcrumbs'][] = ['url' => route_to('progress-site', $residential->slug), 'title' => lang('Site.Breadcrumb.Progress')];
        return view('site/progress/list', $this->data);
    }

}
