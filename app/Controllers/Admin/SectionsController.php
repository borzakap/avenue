<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;

/**
 * Description 
 *
 * @author alexey
 */
class SectionsController extends BaseController{
    
    protected $helpers = ['form'];

    public function list(){
        $model = model(SectionsModel::class);
        $items = $model->getSections($this->request->getLocale());
        $this->breadcrumb->add(lang('Breadcrumb.Admin.Sections'), '/admin/sections');
        $data = [
            'items' => $items,
            'counts' => 0,
            'breadcrumb' => $this->breadcrumb->render(),
        ];
        return view('admin/sections/list', $data);
    }

    public function create(){
        // verify if request method is not POST
        if ($this->request->getMethod() !== 'post') {
            $config = config(App::class);
            $this->breadcrumb->add(lang('Breadcrumb.Admin.Sections'), '/admin/sections');
            $this->breadcrumb->add(lang('Breadcrumb.Admin.SectionCreate'), '/admin/sections/create');
            $residentials_model = model(ResidentialsModel::class);
            $data = [
                'languages' => $config->supportedLocales,
                'default_naguage' => $config->defaultLocale,
                'breadcrumb' => $this->breadcrumb->render(),
                'residentials' => $residentials_model->getResidentialsList($this->request->getLocale()),
            ];
            return view('admin/sections/create', $data);
        }
        $model = model(SectionsModel::class);
        if (($id = $model->createSection($this->request->getPost()))) {
            return redirect()->route('section_update', [$id])->with('message', lang('Sections.Messages.Messages.Insertatiton'));
        }
        return redirect()->back()->withInput()->with('error', lang('Sections.Messages.Error.Insertatiton'));
    }

    public function update(int $id){
        $model = model(SectionsModel::class);
        $config = config(App::class);
        $this->breadcrumb->add(lang('Breadcrumb.Admin.Sections'), '/admin/sections');
        $this->breadcrumb->add(lang('Breadcrumb.Admin.SectionUpdate'), '/admin/sections/update');
        // verify if request method is not POST
        if ($this->request->getMethod() === 'post') {
            
        }
        $residentials_model = model(ResidentialsModel::class);
        $data = [
            'languages' => $config->supportedLocales,
            'default_naguage' => $config->defaultLocale,
            'breadcrumb' => $this->breadcrumb->render(),
            'residentials' => $residentials_model->getResidentialsList($this->request->getLocale()),
            'data' => $model->find($id)->withTranslations(),
        ];
        return view('admin/sections/update', $data);
        
    }
    
    public function delete(int $id){
        
    }
    
    public function floorsUpload(){
        
        $return = [
            'success' => false,
            'message' => lang('Site.Popapform.Messages.Error.UndefinedError'),
            'data' => '',
            'method' => $this->request->getMethod(),
            'headers' => $this->request->headers(),
        ];
        if (!$this->request->getMethod() === 'post') {
            $return['message'] = lang('Site.Popapform.Messages.Error.NotAjax');
            return $this->response->setJSON($return);
        }
//        $return['data'] = $this->request->getVals();
        return $this->response->setJSON($return);

    }

    public function floorsLoad(){
        
    }
    
    public function floorsDelete(){
        
    }
    public function floorsUpdate(){
        
    }
    //put your code here
}
