<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * Description of Layouts
 *
 * @author alexey
 */
class Layouts extends BaseController{
    
    /**
     * get the layout
     * @param string $slug
     * @return string
     * @throws PageNotFoundException
     */
    public function view(string $slug): string
    {
        helper(['number']);
        if(!$layout = model(LayoutsModel::class)->getBySlug($slug, $this->request->getLocale())){
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['layout'] = $layout->withSection()->withPlan()->withFloorImage()->withPlanImage();
        $this->data['meta_title'] = $layout->meta_title;
        $this->data['meta_description'] = $layout->meta_description;
        // breadcrumb
        $this->data['breadcrumbs'][] = ['url' => route_to('layouts-genplan', $layout->plan->slug), 'title' => $layout->plan->title];
        $this->data['breadcrumbs'][] = ['url' => route_to('layout-view', $layout->slug), 'title' => $layout->title];
        
        return view('site/layouts/layout', $this->data);
    }

    /**
     * get the leaving section by slug
     * @param string $slug
     * @return string
     * @throws PageNotFoundException
     */
    public function section(string $slug): string
    {
        if(!$section = model(SectionsModel::class)->getBySlug($slug, $this->request->getLocale())){
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['meta_title'] = $section->meta_title;
        $this->data['meta_description'] = $section->meta_description;
        $this->data['floors'] = model(FloorsImagesModel::class)->getSectionsFloorsLayouts($section->id);
        return view('site/layouts/section', $this->data);
    }
    
    /**
     * get residential`s leaving genplan
     * @param string $slug
     * @return RedirectResponse|string
     * @throws PageNotFoundException
     */
    public function genplan(string $slug = 'default') {
        if ($slug == 'default') {
            $default = model(ResidentialsModel::class)->first();
            return redirect()->route('layouts-genplan', [$default->slug]);
        }
        if (!$residential = model(ResidentialsModel::class)->getBySlug($slug, $this->request->getLocale())) {
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['meta_title'] = $residential->meta_title;
        $this->data['meta_description'] = $residential->meta_description;
        $this->data['floors'] = model(PlansImagesModel::class)->getPlanLayouts($residential->id);
        $this->data['genplan'] = $residential->withSections()->withPlans();
        // breadcrumb
        $this->data['breadcrumbs'][] = ['url' => route_to('layouts-genplan', $residential->slug), 'title' => $residential->title];

        return view('site/layouts/genplan', $this->data);
    }

    /**
     * get the layouts in filter
     * @param string $slug
     * @return RedirectResponse|string
     * @throws PageNotFoundException
     */
    public function filter(string $slug = 'default') {
        helper('form');
        if ($slug == 'default') {
            $default = model(ResidentialsModel::class)->first();
            return redirect()->route('layouts-filter', [$default->slug]);
        }
        if (!$residential = model(ResidentialsModel::class)->getBySlug($slug, $this->request->getLocale())) {
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['residential'] = $residential;
        $this->data['meta_title'] = $residential->meta_title;
        $this->data['meta_description'] = $residential->meta_description;
        $this->data['rooms'] = model(LayoutsModel::class)->getRoomsListFilter();
        $this->data['floors'] = model(FloorsImagesModel::class)->getFloorsLayoutsFilter();
        $this->data['sections'] = model(SectionsModel::class)->getSectionsListFilter($residential->id);
        // breadcrumb
        $this->data['breadcrumbs'][] = ['url' => route_to('layouts-genplan', $residential->slug), 'title' => $residential->title];

        if ($this->request->getMethod() !== 'post') {
            $this->data['layouts'] = model(LayoutsModel::class)->getList($this->request->getLocale(), $this->request->getGet());
            $this->data['pager'] = model(LayoutsModel::class)->pager;
            return view('site/layouts/filter', $this->data);
        }
        $this->data['layouts'] = model(LayoutsModel::class)->getList($this->request->getLocale(), $this->request->getPost());
        $this->data['pager'] = model(LayoutsModel::class)->pager;
        return $this->response->setJSON(['html' => view('site/layouts/_layouts_greed_paged', $this->data)]);
    }

    /**
     * show the wishlist
     * @param string $slug
     * @return RedirectResponse|string
     * @throws PageNotFoundException
     */
    public function wishlist(string $slug = 'default'){
        if ($slug == 'default') {
            $default = model(ResidentialsModel::class)->first();
            return redirect()->route('layouts-wishlist', [$default->slug]);
        }
        if (!$residential = model(ResidentialsModel::class)->getBySlug($slug, $this->request->getLocale())) {
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['residential'] = $residential;
        $this->data['meta_title'] = $residential->meta_title;
        $this->data['meta_description'] = $residential->meta_description;
        // breadcrumb
        $this->data['breadcrumbs'][] = ['url' => route_to('layouts-genplan', $residential->slug), 'title' => $residential->title];
        $wished = ['ids' => explode(',', $this->request->getCookie('layoutsfav'))];
        if ($this->request->getMethod() !== 'post') {
            $this->data['layouts'] = model(LayoutsModel::class)->getList($this->request->getLocale(), $wished);
            $this->data['pager'] = model(LayoutsModel::class)->pager;
            return view('site/layouts/wishlist', $this->data);
        }
        $this->data['layouts'] = model(LayoutsModel::class)->getList($this->request->getLocale(), array_merge($wished, $this->request->getPost()));
        $this->data['pager'] = model(LayoutsModel::class)->pager;
        return $this->response->setJSON(['html' => view('site/layouts/_layouts_greed_paged', $this->data)]);
    }

    /**
     * loading layout in popup
     * @return object|null
     */
    public function load(): ?object
    {
        $return = [
            'success' => false,
            'message' => lang('Site.Popapform.Messages.Error.UndefinedError'),
            'html' => '',
        ];
        if (!$this->request->isAJAX()) {
            $return['message'] = lang('Site.Popapform.Messages.Error.NotAjax');
            return $this->response->setJSON($return);
        }
        $layout = model(LayoutsModel::class)->getBySlug($this->request->getPost('slug'), $this->request->getLocale());
        $return['html'] = view('site/layouts/layouts_modal', ['data' => $layout]);
        $return['success'] = true;
        $return['message'] = '';
        return $this->response->setJSON($return);
    }
}
