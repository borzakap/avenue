<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

/**
 * Description of Layouts
 *
 * @author alexey
 */
class Commerce extends BaseController{
    
    /**
     * get the layout
     * @param string $slug
     * @return string
     * @throws PageNotFoundException
     */
    public function view(string $slug): string
    {
        helper(['number']);
        if(!$layout = model(CommerceModel::class)->getBySlug($slug, $this->request->getLocale())){
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['layout'] = $layout->withSection();
        $this->data['meta_title'] = $this->data['layout']->meta_title;
        $this->data['meta_description'] = $this->data['layout']->meta_description;
        return view('site/commerce/layout', $this->data);
    }

    /**
     * get the commerce section by slug
     * @param string $slug
     * @return string
     * @throws PageNotFoundException
     */
    public function section(string $slug): string
    {
        if(!$this->data['section'] = model(SectionsModel::class)->getBySlug($slug, $this->request->getLocale())){
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['meta_title'] = $this->data['section']->meta_title;
        $this->data['meta_description'] = $this->data['section']->meta_description;
        $this->data['floors'] = model(FloorsImagesModel::class)->getSectionsFloorsCommerce($this->data['section']->id);
        return view('site/commerce/section', $this->data);
    }

    /**
     * get residential`s commerce genplan
     * @param string $slug
     * @return string
     * @throws type
     */
    public function genplan(string $slug = 'default')
    {
        helper('poligon');
        if($slug == 'default'){
            $default = model(ResidentialsModel::class)->first();
            return redirect()->route('commerce-genplan', [$default->slug]);
        }
        if(!$residential = model(ResidentialsModel::class)->getBySlug($slug, $this->request->getLocale())){
            throw PageNotFoundException::forPageNotFound();
        }
        $this->data['meta_title'] = $residential->meta_title;
        $this->data['meta_description'] = $residential->meta_description;
        $this->data['genplan'] = $residential->withSections()->withPlans();
        $this->data['floors'] = model(PlansImagesModel::class)->getPlanCommerce($residential->id);
        // breadcrumb
        $this->data['breadcrumbs'][] = ['url' => route_to('commerce-genplan', $slug), 'title' => lang('Site.Breadcrumb.Commerce')];
        return view('site/commerce/genplan', $this->data);
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
        $layout = model(CommerceModel::class)->getBySlug($this->request->getPost('slug'), $this->request->getLocale());
        $return['html'] = view('site/commerce/layouts_modal', ['data' => $layout]);
        $return['success'] = true;
        $return['message'] = '';
        return $this->response->setJSON($return);
    }
    
}
